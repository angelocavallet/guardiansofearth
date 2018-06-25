<?php
namespace Guardians\V1\Rest\Usuario;

class UsuarioResourceFactory
{
    public function __invoke($services) {
        $usuario = $services->get('application')
            ->getMvcEvent()->getParam('user');

        if($usuario)
            $usuario = $usuario->getAuthenticationIdentity();

        $em = $services->get('Doctrine\ORM\EntityManager');
        return new UsuarioResource($em, $usuario);
    }
}
