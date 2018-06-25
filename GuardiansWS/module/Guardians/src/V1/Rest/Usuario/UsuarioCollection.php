<?php
namespace Guardians\V1\Rest\Usuario;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class UsuarioCollection extends Paginator
{

    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }

}
