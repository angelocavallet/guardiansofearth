<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item da partida.
 *
 * @ORM\Entity
 * @ORM\Table(name="item_item")
 */
class Item
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="item_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="item_pcar_codigo")
     */
    protected $carta;

    /**
     * @ORM\Column(type="integer", name="item_part_codigo")
     */
    protected $partida;

    public function getArrayCopy(){
        return get_object_vars($this);

    }

    public function exchangeArray($array){

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCarta()
    {
        return $this->carta;
    }

    /**
     * @param mixed $carta
     */
    public function setCarta($carta)
    {
        $this->carta = $carta;
    }

    /**
     * @return mixed
     */
    public function getPartida()
    {
        return $this->partida;
    }

    /**
     * @param mixed $partida
     */
    public function setPartida($partida)
    {
        $this->partida = $partida;
    }

}