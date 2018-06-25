<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Baralho de jogo.
 *
 * @ORM\Entity
 * @ORM\Table(name="bara_baralho")
 */
class Baralho
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="bara_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="bara_usua_codigo")
     */
    protected $jogador;

    /**
     * @ORM\Column(type="integer", name="bara_tbar_codigo")
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
    public function getJogador()
    {
        return $this->jogador;
    }

    /**
     * @param mixed $jogador
     */
    public function setJogador($jogador)
    {
        $this->jogador = $jogador;
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