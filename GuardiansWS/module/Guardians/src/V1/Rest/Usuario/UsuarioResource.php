<?php
namespace Guardians\V1\Rest\Usuario;

use Zend\Mvc\MvcEvent;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Guardians\Entity\Usuario;
use Guardians\Entity\Baralho;
use Guardians\Entity\CartasBaralho;


class UsuarioResource extends AbstractResourceListener
{

    private $em;
    private $usuario;
    public function __construct($em, $usuario) {
        $this->em = $em;
        $this->usuario = $usuario;
    }

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\Usuario', 'e');
        $qb->where('e.email = :email');
        $qb->setParameters(array(
            'email' => $data->email
        ));

        if($qb->getQuery()->getResult()){
            return new ApiProblem(409, 'Exite uma conta com este email!');
        }

        $usuario = new Usuario();

        $usuario->setNome($data->nome);
        $usuario->setSenha($data->senha);
        $usuario->setEmail($data->email);

        $this->em->persist($usuario);
        $this->em->flush();

        $this->createBaralhoGuerreiro($usuario);

        return $usuario;
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\Usuario', 'e');
        $qb->where('e.id = :id');
        $qb->setParameters(array(
            'id' => $id
        ));

        try {

            return $qb->getQuery()->getSingleResult();

        }catch(\Doctrine\ORM\NoResultException $e) {

            return new ApiProblem(400, 'Usuario nao encontrado!');

        }

    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\Usuario', 'e');
        $qb->where('e.id = :id');
        $qb->setParameters(array(
            'id' => $this->usuario->getId()
        ));
        try {

            return $qb->getQuery()->getSingleResult();

        }catch(\Doctrine\ORM\NoResultException $e) {

            return new ApiProblem(400, 'Usuario nao encontrado');

        }
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }


    /**
     * @param $usuario
     */
    private function createBaralhoGuerreiro($usuario){


        $bara = new Baralho();

        $bara->setTipo(1);
        $bara->setJogador($usuario->getId());

        $this->em->persist($bara);
        $this->em->flush();

//        $this->em->persist(new CartasBaralho(1, $bara->getId()));
//      $this->em->persist(new CartasBaralho(3, $bara->getId()));
//        $this->em->persist(new CartasBaralho(3, $bara->getId()));
//        $this->em->persist(new CartasBaralho(15, $bara->getId()));
//
//        $this->em->persist(new CartasBaralho(19, $bara->getId()));
//        $this->em->persist(new CartasBaralho(15, $bara->getId()));

//        $this->em->persist(new CartasBaralho(21, $bara->getId()));

        //$this->em->persist(new CartasBaralho(12, $bara->getId()));
        //$this->em->persist(new CartasBaralho(12, $bara->getId()));
        //$this->em->persist(new CartasBaralho(12, $bara->getId()));

        //$this->em->persist(new CartasBaralho(10, $bara->getId()));

        //$this->em->persist(new CartasBaralho(11, $bara->getId()));

        //$this->em->persist(new CartasBaralho(13, $bara->getId()));
        //$this->em->persist(new CartasBaralho(17, $bara->getId()));





        $this->em->persist(new CartasBaralho(2, $bara->getId()));
        $this->em->persist(new CartasBaralho(2, $bara->getId()));
        $this->em->persist(new CartasBaralho(2, $bara->getId()));


        $this->em->persist(new CartasBaralho(4, $bara->getId()));
        $this->em->persist(new CartasBaralho(4, $bara->getId()));
        $this->em->persist(new CartasBaralho(4, $bara->getId()));
        $this->em->persist(new CartasBaralho(4, $bara->getId()));
        $this->em->persist(new CartasBaralho(4, $bara->getId()));
        $this->em->persist(new CartasBaralho(4, $bara->getId()));
        $this->em->persist(new CartasBaralho(4, $bara->getId()));

        $this->em->persist(new CartasBaralho(4, $bara->getId()));
        $this->em->persist(new CartasBaralho(5, $bara->getId()));
        $this->em->persist(new CartasBaralho(5, $bara->getId()));

        $this->em->persist(new CartasBaralho(5, $bara->getId()));
        $this->em->persist(new CartasBaralho(5, $bara->getId()));

        $this->em->persist(new CartasBaralho(5, $bara->getId()));
        $this->em->persist(new CartasBaralho(5, $bara->getId()));
        $this->em->persist(new CartasBaralho(5, $bara->getId()));

        $this->em->persist(new CartasBaralho(6, $bara->getId()));
        $this->em->persist(new CartasBaralho(6, $bara->getId()));
        $this->em->persist(new CartasBaralho(6, $bara->getId()));

        $this->em->persist(new CartasBaralho(7, $bara->getId()));
        $this->em->persist(new CartasBaralho(7, $bara->getId()));

        $this->em->persist(new CartasBaralho(8, $bara->getId()));
        $this->em->persist(new CartasBaralho(8, $bara->getId()));

        $this->em->persist(new CartasBaralho(8, $bara->getId()));
        $this->em->persist(new CartasBaralho(8, $bara->getId()));

        $this->em->persist(new CartasBaralho(9, $bara->getId()));
        $this->em->persist(new CartasBaralho(9, $bara->getId()));
        $this->em->persist(new CartasBaralho(9, $bara->getId()));

        $this->em->persist(new CartasBaralho(14, $bara->getId()));
        $this->em->persist(new CartasBaralho(14, $bara->getId()));
        $this->em->persist(new CartasBaralho(14, $bara->getId()));
        $this->em->persist(new CartasBaralho(14, $bara->getId()));


        $this->em->persist(new CartasBaralho(16, $bara->getId()));
        $this->em->persist(new CartasBaralho(16, $bara->getId()));
        $this->em->persist(new CartasBaralho(16, $bara->getId()));

        $this->em->persist(new CartasBaralho(18, $bara->getId()));
        $this->em->persist(new CartasBaralho(18, $bara->getId()));

        $this->em->persist(new CartasBaralho(20, $bara->getId()));

        $this->em->flush();
    }
}
