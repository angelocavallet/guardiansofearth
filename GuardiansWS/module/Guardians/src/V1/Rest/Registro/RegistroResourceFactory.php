<?php
namespace Guardians\V1\Rest\Registro;

class RegistroResourceFactory
{
    public function __invoke($services)
    {
        $usuario = $services->get('application')
            ->getMvcEvent()->getParam('user')->getAuthenticationIdentity();

        $em = $services->get('Doctrine\ORM\EntityManager');

        return new RegistroResource($em, $usuario);
    }
}
