<?php
namespace Guardians\V1\Rest\Rodada;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class RodadaCollection extends Paginator
{
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
