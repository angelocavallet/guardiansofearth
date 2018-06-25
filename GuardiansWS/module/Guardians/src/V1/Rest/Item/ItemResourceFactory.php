<?php
namespace Guardians\V1\Rest\Item;

class ItemResourceFactory
{
    public function __invoke($services)
    {
        $usuario = $services->get('application')
            ->getMvcEvent()->getParam('user')->getAuthenticationIdentity();

        $em = $services->get('Doctrine\ORM\EntityManager');

        return new ItemResource($em, $usuario);
    }
}
