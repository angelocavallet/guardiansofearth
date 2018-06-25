<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pilha de cartas da partida.
 *
 * @ORM\Entity
 * @ORM\Table(name="pcar_pilha_carta")
 */
class PilhaCarta
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="pcar_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="pcar_caba_codigo")
     */
    protected $cartaBaralho;

    /**
     * @ORM\Column(type="integer", name="pcar_part_codigo")
     */
    protected $partida;

    /**
     * @ORM\Column(type="integer", name="pcar_descartada")
     */
    protected $descartada;

    /**
     * @ORM\Column(type="integer", name="pcar_sequencia")
     */
    protected $sequencia;



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
    public function getCartaBaralho()
    {
        return $this->cartaBaralho;
    }

    /**
     * @param mixed $cartaBaralho
     */
    public function setCartaBaralho($cartaBaralho)
    {
        $this->cartaBaralho = $cartaBaralho;
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

    /**
     * @return mixed
     */
    public function getDescartada()
    {
        return $this->descartada;
    }

    /**
     * @param mixed $descartada
     */
    public function setDescartada($descartada)
    {
        $this->descartada = $descartada;
    }

    /**
     * @return mixed
     */
    public function getSequencia()
    {
        return $this->sequencia;
    }

    /**
     * @param mixed $sequencia
     */
    public function setSequencia($sequencia)
    {
        $this->sequencia = $sequencia;
    }


}
