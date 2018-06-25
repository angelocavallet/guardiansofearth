<?php
namespace Guardians\V1\Rest\Partida;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class PartidaCollection extends Paginator
{
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
