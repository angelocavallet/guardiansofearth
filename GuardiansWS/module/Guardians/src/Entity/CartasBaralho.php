<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Baralho de jogo.
 *
 * @ORM\Entity
 * @ORM\Table(name="caba_cartas_baralho")
 */
class CartasBaralho
{

    function __construct($carta, $baralho)
    {
        $this->carta = $carta;
        $this->baralho = $baralho;
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="caba_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="caba_cart_codigo")
     */
    protected $carta;

    /**
     * @ORM\Column(type="integer", name="caba_bara_codigo")
     */
    protected $baralho;



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
    public function getBaralho()
    {
        return $this->baralho;
    }

    /**
     * @param mixed $baralho
     */
    public function setBaralho($baralho)
    {
        $this->baralho = $baralho;
    }

}