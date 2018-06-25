<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carta de jogo.
 *
 * @ORM\Entity
 * @ORM\Table(name="cart_carta")
 */
class Carta
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="cart_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="cart_nome")
     */
    protected $nome;

    /**
     * @ORM\Column(type="integer", name="cart_ataque")
     */
    protected $ataque;

    /**
     * @ORM\Column(type="integer", name="cart_defesa")
     */
    protected $defesa;

    /**
     * @ORM\Column(type="integer", name="cart_cura")
     */
    protected $cura;

    /**
     * @ORM\Column(type="integer", name="cart_energia")
     */
    protected $energia;

    /**
     * @ORM\Column(type="string", name="cart_tipo")
     */
    protected $tipo;


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
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getAtaque()
    {
        return $this->ataque;
    }

    /**
     * @param mixed $ataque
     */
    public function setAtaque($ataque)
    {
        $this->ataque = $ataque;
    }

    /**
     * @return mixed
     */
    public function getDefesa()
    {
        return $this->defesa;
    }

    /**
     * @param mixed $defesa
     */
    public function setDefesa($defesa)
    {
        $this->defesa = $defesa;
    }

    /**
     * @return mixed
     */
    public function getCura()
    {
        return $this->cura;
    }

    /**
     * @param mixed $cura
     */
    public function setCura($cura)
    {
        $this->cura = $cura;
    }

    /**
     * @return mixed
     */
    public function getEnergia()
    {
        return $this->energia;
    }

    /**
     * @param mixed $energia
     */
    public function setEnergia($energia)
    {
        $this->energia = $energia;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

}