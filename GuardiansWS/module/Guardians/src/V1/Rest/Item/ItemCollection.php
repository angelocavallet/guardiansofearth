<?php
namespace Guardians\V1\Rest\Item;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class ItemCollection extends Paginator
{
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
