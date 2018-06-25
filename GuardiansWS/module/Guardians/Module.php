<?php
namespace Guardians;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Mvc\MvcEvent;
use ZF\MvcAuth\MvcAuthEvent;

class Module implements ApigilityProviderInterface
{

    public function onBootstrap(MvcEvent $event)
    {
        $app = $event->getApplication();
        $sm  = $app->getServiceManager();
        $em  = $app->getEventManager();

        $listener = $sm->get('Guardians\Listener\ApiAuthenticationListener');
        $em->attach(MvcAuthEvent::EVENT_AUTHENTICATION, $listener, 10);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return [
            'ZF\Apigility\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}
