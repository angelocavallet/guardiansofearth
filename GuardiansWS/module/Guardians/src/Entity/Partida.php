<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partida de jogo.
 *
 * @ORM\Entity
 * @ORM\Table(name="part_partida")
 */
class Partida
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="part_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="part_bara_codigo1")
     */
    protected $baraJog1;

    /**
     * @ORM\Column(type="integer", name="part_bara_codigo2")
     */
    protected $baraJog2;

    /**
     * @ORM\Column(type="integer", name="part_ponto_vida1")
     */
    protected $vidaJogador1;

    /**
     * @ORM\Column(type="integer", name="part_ponto_vida2")
     */
    protected $vidaJogador2;

    /**
     * @ORM\Column(type="string", name="part_status", length=1)
     */
    protected $status;



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
    public function getBaraJog1()
    {
        return $this->baraJog1;
    }

    /**
     * @param mixed $baraJog1
     */
    public function setBaraJog1($baraJog1)
    {
        $this->baraJog1 = $baraJog1;
    }

    /**
     * @return mixed
     */
    public function getBaraJog2()
    {
        return $this->baraJog2;
    }

    /**
     * @param mixed $baraJog2
     */
    public function setBaraJog2($baraJog2)
    {
        $this->baraJog2 = $baraJog2;
    }

    /**
     * @return mixed
     */
    public function getVidaJogador1()
    {
        return $this->vidaJogador1;
    }

    /**
     * @param mixed $vidaJogador1
     */
    public function setVidaJogador1($vidaJogador1)
    {
        $this->vidaJogador1 = $vidaJogador1;
    }

    /**
     * @return mixed
     */
    public function getVidaJogador2()
    {
        return $this->vidaJogador2;
    }

    /**
     * @param mixed $vidaJogador2
     */
    public function setVidaJogador2($vidaJogador2)
    {
        $this->vidaJogador2 = $vidaJogador2;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}