<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registro de rodadas.
 *
 * @ORM\Entity
 * @ORM\Table(name="regi_registro")
 */
class Registro
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="regi_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="regi_roda_codigo")
     */
    protected $rodada;

    /**
     * @ORM\Column(type="integer", name="regi_sequencia")
     */
    protected $sequencia;

    /**
     * @ORM\Column(type="integer", name="regi_vida_jogador1")
     */
    protected $vidaJog1;

    /**
     * @ORM\Column(type="integer", name="regi_ataque_jogador1")
     */
    protected $ataqueJog1;

    /**
     * @ORM\Column(type="integer", name="regi_defesa_jogador1")
     */
    protected $defesaJog1;

    /**
     * @ORM\Column(type="integer", name="regi_cura_jogador1")
     */
    protected $curaJog1;

    /**
     * @ORM\Column(type="integer", name="regi_vida_jogador2")
     */
    protected $vidaJog2;

    /**
     * @ORM\Column(type="integer", name="regi_ataque_jogador2")
     */
    protected $ataqueJog2;

    /**
     * @ORM\Column(type="integer", name="regi_defesa_jogador2")
     */
    protected $defesaJog2;

    /**
     * @ORM\Column(type="integer", name="regi_cura_jogador2")
     */
    protected $curaJog2;


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
    public function getRodada()
    {
        return $this->rodada;
    }

    /**
     * @param mixed $rodada
     */
    public function setRodada($rodada)
    {
        $this->rodada = $rodada;
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

    /**
     * @return mixed
     */
    public function getVidaJog1()
    {
        return $this->vidaJog1;
    }

    /**
     * @param mixed $vidaJog1
     */
    public function setVidaJog1($vidaJog1)
    {
        $this->vidaJog1 = $vidaJog1;
    }

    /**
     * @return mixed
     */
    public function getAtaqueJog1()
    {
        return $this->ataqueJog1;
    }

    /**
     * @param mixed $ataqueJog1
     */
    public function setAtaqueJog1($ataqueJog1)
    {
        $this->ataqueJog1 = $ataqueJog1;
    }

    /**
     * @return mixed
     */
    public function getDefesaJog1()
    {
        return $this->defesaJog1;
    }

    /**
     * @param mixed $defesaJog1
     */
    public function setDefesaJog1($defesaJog1)
    {
        $this->defesaJog1 = $defesaJog1;
    }

    /**
     * @return mixed
     */
    public function getCuraJog1()
    {
        return $this->curaJog1;
    }

    /**
     * @param mixed $curaJog1
     */
    public function setCuraJog1($curaJog1)
    {
        $this->curaJog1 = $curaJog1;
    }

    /**
     * @return mixed
     */
    public function getVidaJog2()
    {
        return $this->vidaJog2;
    }

    /**
     * @param mixed $vidaJog2
     */
    public function setVidaJog2($vidaJog2)
    {
        $this->vidaJog2 = $vidaJog2;
    }

    /**
     * @return mixed
     */
    public function getAtaqueJog2()
    {
        return $this->ataqueJog2;
    }

    /**
     * @param mixed $ataqueJog2
     */
    public function setAtaqueJog2($ataqueJog2)
    {
        $this->ataqueJog2 = $ataqueJog2;
    }

    /**
     * @return mixed
     */
    public function getDefesaJog2()
    {
        return $this->defesaJog2;
    }

    /**
     * @param mixed $defesaJog2
     */
    public function setDefesaJog2($defesaJog2)
    {
        $this->defesaJog2 = $defesaJog2;
    }

    /**
     * @return mixed
     */
    public function getCuraJog2()
    {
        return $this->curaJog2;
    }

    /**
     * @param mixed $curaJog2
     */
    public function setCuraJog2($curaJog2)
    {
        $this->curaJog2 = $curaJog2;
    }


}