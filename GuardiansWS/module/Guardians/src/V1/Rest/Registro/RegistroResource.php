<?php
namespace Guardians\V1\Rest\Registro;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class RegistroResource extends AbstractResourceListener
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
        return new ApiProblem(405, 'The POST method has not been defined');
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
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = [])
    {
        $roda_codigo = $params->Get('rodada');

        if($roda_codigo){

            $qb = $this->em->createQueryBuilder();
            $qb->select('e.sequencia, 
                     p.baraJog1,
                     u1.id AS jog1Id,
                     e.vidaJog1,
                     e.ataqueJog1,
                     e.defesaJog1,
                     e.curaJog1,
                     p.baraJog2,
                     u2.id AS jog2Id,
                     e.vidaJog2,
                     e.ataqueJog2,
                     e.defesaJog2,
                     e.curaJog2');
            $qb->from('Guardians\Entity\Registro', 'e');
            $qb->leftJoin('Guardians\Entity\Rodada', 'r', 'WITH', 'e.rodada = r.id');
            $qb->leftJoin('Guardians\Entity\Partida', 'p', 'WITH', 'r.partida = p.id');
            $qb->leftJoin('Guardians\Entity\Baralho', 'b1', 'WITH', 'p.baraJog1 = b1.id');
            $qb->leftJoin('Guardians\Entity\Usuario', 'u1', 'WITH', 'b1.jogador = u1.id');
            $qb->leftJoin('Guardians\Entity\Baralho', 'b2', 'WITH', 'p.baraJog2 = b2.id');
            $qb->leftJoin('Guardians\Entity\Usuario', 'u2', 'WITH', 'b2.jogador = u2.id');
            $qb->orderBy('e.sequencia', 'ASC');
            $qb->add('where', $qb->expr()->andX(
                $qb->expr()->eq('r.id', ':rodada'),
                $qb->expr()->orX(
                    $qb->expr()->eq('b1.jogador', ':jogador'),
                    $qb->expr()->eq('b2.jogador', ':jogador')
                )
            ));
            $qb->setParameters(array(
                'rodada' => $roda_codigo,
                'jogador' => $this->usuario->getId()
            ));

            $result = $qb->getQuery()->getArrayResult();

            return $result;

        }else{
            return new ApiProblem(400, 'Informe o codigo da rodada Ex. "?rodada=1" ');

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
}
