<?php
namespace Guardians\V1\Rest\Item;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class ItemResource extends AbstractResourceListener
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
        $part_codigo = $params->Get('partida');

        if($part_codigo){
            $qb = $this->em->createQueryBuilder();
            $qb->select('e.id,
                         b.jogador');
            $qb->from('Guardians\Entity\PilhaCarta', 'e');
            $qb->leftJoin('Guardians\Entity\Item', 'i', 'WITH', 'e.id = i.carta');
            $qb->leftJoin('Guardians\Entity\Equipamento', 'eq', 'WITH', 'e.id = eq.carta');
            $qb->leftJoin('Guardians\Entity\CartasBaralho', 'cb', 'WITH', 'e.cartaBaralho = cb.id');
            $qb->join('Guardians\Entity\Baralho', 'b', 'WITH', 'cb.baralho = b.id');
            $qb->add('where', $qb->expr()->andX(
                $qb->expr()->orX(
                    $qb->expr()->eq('i.carta', 'e.id'),
                    $qb->expr()->eq('eq.carta', 'e.id')
                ),
                $qb->expr()->eq('e.partida', ':partida')
            ));
            $qb->setParameters(array(
                'partida' => $part_codigo
            ));
            return $qb->getQuery()->getResult();

        }else{
            return new ApiProblem(400, 'Informe o codigo da partida Ex. "?partida=1" ');

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
