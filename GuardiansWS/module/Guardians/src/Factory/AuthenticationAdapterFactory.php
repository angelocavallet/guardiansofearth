<?php
namespace Guardians\Factory;

use Guardians\Authentication\Adapter\HeaderAuthentication;
use Guardians\Entity\Usuario;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthenticationAdapterFactory implements FactoryInterface
{



    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createService($container);
    }


    public function createService(ServiceLocatorInterface $sl)
    {
        $request     = $sl->get('Request');
        $em          = $sl->get('Doctrine\ORM\EntityManager');
        $repository = new Usuario();


        $adapter = new HeaderAuthentication($request, $repository, $em);
        return $adapter;
    }
}
