<?php
namespace Guardians\V1\Rest\Carta;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class CartaCollection extends Paginator
{
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
