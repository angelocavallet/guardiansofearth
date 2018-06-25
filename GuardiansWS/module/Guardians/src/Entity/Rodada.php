<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rodada de partida.
 *
 * @ORM\Entity
 * @ORM\Table(name="roda_rodada")
 */
class Rodada
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="roda_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="roda_part_codigo")
     */
    protected $partida;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_iniciativa1_jogador1")
     */
    protected $iniciativa1Jog1;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_iniciativa2_jogador1")
     */
    protected $iniciativa2Jog1;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_iniciativa3_jogador1")
     */
    protected $iniciativa3Jog1;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_guarda_jogador1")
     */
    protected $guardaJog1;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_descarta_jogador1")
     */
    protected $descartaJog1;

    /**
     * @ORM\Column(type="integer", name="roda_jogador1_pronto")
     */
    protected $jogador1Pronto;



    /**
     * @ORM\Column(type="integer", name="roda_pcar_iniciativa1_jogador2")
     */
    protected $iniciativa1Jog2;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_iniciativa2_jogador2")
     */
    protected $iniciativa2Jog2;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_iniciativa3_jogador2")
     */
    protected $iniciativa3Jog2;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_guarda_jogador2")
     */
    protected $guardaJog2;

    /**
     * @ORM\Column(type="integer", name="roda_pcar_descarta_jogador2")
     */
    protected $descartaJog2;

    /**
     * @ORM\Column(type="integer", name="roda_jogador2_pronto")
     */
    protected $jogador2Pronto;



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
    public function getIniciativa1Jog1()
    {
        return $this->iniciativa1Jog1;
    }

    /**
     * @param mixed $iniciativa1Jog1
     */
    public function setIniciativa1Jog1($iniciativa1Jog1)
    {
        $this->iniciativa1Jog1 = $iniciativa1Jog1;
    }

    /**
     * @return mixed
     */
    public function getIniciativa2Jog1()
    {
        return $this->iniciativa2Jog1;
    }

    /**
     * @param mixed $iniciativa2Jog1
     */
    public function setIniciativa2Jog1($iniciativa2Jog1)
    {
        $this->iniciativa2Jog1 = $iniciativa2Jog1;
    }

    /**
     * @return mixed
     */
    public function getIniciativa3Jog1()
    {
        return $this->iniciativa3Jog1;
    }

    /**
     * @param mixed $iniciativa3Jog1
     */
    public function setIniciativa3Jog1($iniciativa3Jog1)
    {
        $this->iniciativa3Jog1 = $iniciativa3Jog1;
    }

    /**
     * @return mixed
     */
    public function getGuardaJog1()
    {
        return $this->guardaJog1;
    }

    /**
     * @param mixed $guardaJog1
     */
    public function setGuardaJog1($guardaJog1)
    {
        $this->guardaJog1 = $guardaJog1;
    }

    /**
     * @return mixed
     */
    public function getDescartaJog1()
    {
        return $this->descartaJog1;
    }

    /**
     * @param mixed $descartaJog1
     */
    public function setDescartaJog1($descartaJog1)
    {
        $this->descartaJog1 = $descartaJog1;
    }

    /**
     * @return mixed
     */
    public function getJogador1Pronto()
    {
        return $this->jogador1Pronto;
    }

    /**
     * @param mixed $jogador1Pronto
     */
    public function setJogador1Pronto($jogador1Pronto)
    {
        $this->jogador1Pronto = $jogador1Pronto;
    }

    /**
     * @return mixed
     */
    public function getIniciativa1Jog2()
    {
        return $this->iniciativa1Jog2;
    }

    /**
     * @param mixed $iniciativa1Jog2
     */
    public function setIniciativa1Jog2($iniciativa1Jog2)
    {
        $this->iniciativa1Jog2 = $iniciativa1Jog2;
    }

    /**
     * @return mixed
     */
    public function getIniciativa2Jog2()
    {
        return $this->iniciativa2Jog2;
    }

    /**
     * @param mixed $iniciativa2Jog2
     */
    public function setIniciativa2Jog2($iniciativa2Jog2)
    {
        $this->iniciativa2Jog2 = $iniciativa2Jog2;
    }

    /**
     * @return mixed
     */
    public function getIniciativa3Jog2()
    {
        return $this->iniciativa3Jog2;
    }

    /**
     * @param mixed $iniciativa3Jog2
     */
    public function setIniciativa3Jog2($iniciativa3Jog2)
    {
        $this->iniciativa3Jog2 = $iniciativa3Jog2;
    }

    /**
     * @return mixed
     */
    public function getGuardaJog2()
    {
        return $this->guardaJog2;
    }

    /**
     * @param mixed $guardaJog2
     */
    public function setGuardaJog2($guardaJog2)
    {
        $this->guardaJog2 = $guardaJog2;
    }

    /**
     * @return mixed
     */
    public function getDescartaJog2()
    {
        return $this->descartaJog2;
    }

    /**
     * @param mixed $descartaJog2
     */
    public function setDescartaJog2($descartaJog2)
    {
        $this->descartaJog2 = $descartaJog2;
    }

    /**
     * @return mixed
     */
    public function getJogador2Pronto()
    {
        return $this->jogador2Pronto;
    }

    /**
     * @param mixed $jogador2Pronto
     */
    public function setJogador2Pronto($jogador2Pronto)
    {
        $this->jogador2Pronto = $jogador2Pronto;
    }


}
