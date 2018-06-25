<?php
namespace Guardians\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuário do jogo.
 *
 * @ORM\Entity
 * @ORM\Table(name="usua_usuario")
 */
class Usuario
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="usua_codigo")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="usua_nome", length=100)
     */
    protected $nome;

    /**
     * @ORM\Column(type="string", name="usua_email", length=250)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", name="usua_senha", length=100)
     */
    protected $senha;

    public function getArrayCopy(){
        return get_object_vars($this);

    }

    public function exchangeArray($array){

    }

    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getSenha(){
        return $this->senha;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }
    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }
    public function setSenha($senha){
        $this->senha = $senha;
        return $this;
    }
}