<?php
namespace Guardians\V1\Rest\Rodada;

class RodadaResourceFactory
{
    public function __invoke($services)
    {
        $usuario = $services->get('application')
            ->getMvcEvent()->getParam('user')->getAuthenticationIdentity();

        $em = $services->get('Doctrine\ORM\EntityManager');

        return new RodadaResource($em, $usuario);
    }
}
