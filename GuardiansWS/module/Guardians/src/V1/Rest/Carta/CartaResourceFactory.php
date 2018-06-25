<?php
namespace Guardians\V1\Rest\Carta;

class CartaResourceFactory
{
    public function __invoke($services)
    {
        $usuario = $services->get('application')
            ->getMvcEvent()->getParam('user')->getAuthenticationIdentity();

        $em = $services->get('Doctrine\ORM\EntityManager');

        return new CartaResource($em, $usuario);
    }
}
