<?php
namespace Guardians\V1\Rest\Partida;

class PartidaResourceFactory
{
    public function __invoke($services)
    {
        $usuario = $services->get('application')
            ->getMvcEvent()->getParam('user')->getAuthenticationIdentity();

        $em = $services->get('Doctrine\ORM\EntityManager');

        return new PartidaResource($em, $usuario);
    }
}
