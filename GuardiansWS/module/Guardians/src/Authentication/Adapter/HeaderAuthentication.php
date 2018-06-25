<?php
namespace Guardians\Authentication\Adapter;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Http\Request;

use Doctrine\ORM\EntityManager;

use Guardians\Entity\Usuario;
use ZF\MvcAuth\Identity\AuthenticatedIdentity;

class HeaderAuthentication implements AdapterInterface
{

    protected $request;
    protected $repository;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;


    public function __construct(Request $request, Usuario $repository, $em)
    {
        $this->request = $request;
        $this->repository = $repository;
        $this->em = $em;
    }

    public function authenticate()
    {

        $request = $this->getRequest();
        $headers = $request->getHeaders();

        // Check Authorization header presence
        if (!$headers->has('Authorization')) {
            return new Result(Result::FAILURE, null, array(
                'Cabeçalho HTTP Authorization BASIC64 de autorização não informado'
            ));
        }

        // Check Authorization prefix
        $authorization = $headers->get('Authorization')
                                 ->getFieldValue();
        if (strpos($authorization, 'Basic') !== 0) {
            return new Result(Result::FAILURE, null, array(
                'Cabeçalho de autorização inválido, falta prefixo Basic'
            ));
        }

        $auth_array = explode(' ', $authorization);
        if(count($auth_array) != 2){
            return new Result(Result::FAILURE, null, array(
                'Valor do hash de autorização inválido, hash Basic 64 padrão: "usuário:senha"'
            ));
        }
        $base64_decoded = base64_decode($auth_array[1]);

        $array_auth_decoded = explode(':', $base64_decoded);
        if(count($array_auth_decoded) != 2){
            return new Result(Result::FAILURE, null, array(
                'Valor do hash de autorização inválido, hash Basic 64 padrão: "usuário:senha"'
            ));
        }

        $email = $array_auth_decoded[0];
        $senha = $array_auth_decoded[1];

        $user = $this->em->getRepository('Guardians\Entity\Usuario')
            ->findOneBy(array(
                'email' => $email ,
                'senha'=> $senha
                ));

        if ($user === null) {
            $code = Result::FAILURE_IDENTITY_NOT_FOUND;
            return new Result($code, null, array(
                'Usuário não encontrado na base de dados'
            ));
        }
        $identity = new AuthenticatedIdentity($user);
        return new Result(Result::SUCCESS, $identity);
    }

    public function getRequest(){
        return $this->request;
    }
}