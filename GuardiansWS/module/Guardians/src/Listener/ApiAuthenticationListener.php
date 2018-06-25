<?php
namespace Guardians\Listener;

use Guardians\Authentication\Adapter\HeaderAuthentication;
use Zend\Authentication\Result;
use ZF\MvcAuth\Identity\AuthenticatedIdentity;
use ZF\MvcAuth\Identity\GuestIdentity;
use ZF\MvcAuth\MvcAuthEvent;

class ApiAuthenticationListener
{
    protected $adapter;

    public function __construct(HeaderAuthentication $adapter)
    {
        $this->adapter = $adapter;
    }


    public function __invoke(MvcAuthEvent $mvcAuthEvent)
    {

        $event = $mvcAuthEvent->getMvcEvent();

        if ((strpos($event->getRequest()->getRequestUri(), 'usuario') !== false &&
            $event->getRequest()->isPost()) ||
            strpos($event->getRequest()->getRequestUri(), 'apigility') !== false) {

            $event->setParam('user', null);

        }else{
            $result = $this->adapter->authenticate();

            if (!$result->isValid()) {
                $response = $event->getResponse();

                if($result->getCode() == Result::FAILURE_CREDENTIAL_INVALID){
                    $response->setStatusCode(403);
                    $response->setContent(json_encode(array(
                        'error' => $result->getMessages()
                    )));
                    return $response;
                }

                $response->setStatusCode(401);
                $response->setContent(json_encode(array(
                    'error' => $result->getMessages()
                )));
                return $response;
            }

            $event->setParam('user', $result->getIdentity());
            return $result;
        }
    }
}