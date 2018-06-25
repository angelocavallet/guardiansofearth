<?php
namespace Guardians\V1\Rest\Registro;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class RegistroCollection extends Paginator
{
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
