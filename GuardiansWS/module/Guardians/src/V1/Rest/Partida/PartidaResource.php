<?php
namespace Guardians\V1\Rest\Partida;

use Herrera\Json\Exception\Exception;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Guardians\Entity\Partida;
use Guardians\Entity\PilhaCarta;
use Guardians\Entity\Rodada;

class PartidaResource extends AbstractResourceListener
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
        $qb->from('Guardians\Entity\Baralho', 'e');
        $qb->where('e.jogador = :jogador');
        $qb->setParameters(array(
            'jogador' => $this->usuario->getId()
        ));
        $baraJog = $qb->getQuery()->getSingleResult();

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\Partida', 'e');
        $qb->where('e.baraJog2 is NULL');
        $qb->andWhere('e.baraJog1 != :baraJog1');
        $qb->setParameters(array(
            'baraJog1' => $baraJog->getId()
        ));

        try {
            $partida = $qb->getQuery()->getSingleResult();
            $partida->setBaraJog2($baraJog->getId());
            $partida->setStatus('I');
            $this->em->merge($partida);
            $this->em->flush();

            $this->initPartida($partida);

        }catch(\Doctrine\ORM\NoResultException $e) {
            $partida = new Partida();
            $partida->setBaraJog1($baraJog->getId());
            $partida->setVidaJogador1(20);
            $partida->setVidaJogador2(20);
            $partida->setStatus('P');
            $this->em->persist($partida);
            $this->em->flush();
        }


        return $partida;


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
        $qb->select('e.id, 
                     e.status,
                     e.baraJog1,
                     e.vidaJogador1,
                     u1.id AS jog1Id,
                     u1.nome AS jogador1,
                     e.baraJog2,
                     e.vidaJogador2,
                     u2.id AS jog2Id,
                     u2.nome AS jogador2');
        $qb->from('Guardians\Entity\Partida', 'e');
        $qb->leftJoin('Guardians\Entity\Baralho', 'b1', 'WITH', 'e.baraJog1 = b1.id');
        $qb->leftJoin('Guardians\Entity\Usuario', 'u1', 'WITH', 'b1.jogador = u1.id');
        $qb->leftJoin('Guardians\Entity\Baralho', 'b2', 'WITH', 'e.baraJog2 = b2.id');
        $qb->leftJoin('Guardians\Entity\Usuario', 'u2', 'WITH', 'b2.jogador = u2.id');
        $qb->add('where', $qb->expr()->andX(
            $qb->expr()->eq('e.id', ':id'),
            $qb->expr()->orX(
                $qb->expr()->eq('b1.jogador', ':jogador'),
                $qb->expr()->eq('b2.jogador', ':jogador')
            ))
        );
        $qb->setParameters(array(
            'jogador' => $this->usuario->getId(),
            'id' => $id
        ));

        try {

            $partida = $qb->getQuery()->getSingleResult();

        }catch(\Doctrine\ORM\NoResultException $e) {

            return new ApiProblem(400, 'Nenhuma partida encontrada');

        }

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\Rodada', 'e');
        $qb->add('where', $qb->expr()->eq('e.partida', ':partida'));
        $qb->orderBy('e.id', 'DESC');
        $qb->setMaxResults(1);
        $qb->setParameters(array(
            'partida' => $partida['id']
        ));

        try{
            $rodada = $qb->getQuery()->getSingleResult();

            $partida['rodadaId'] = $rodada->getId();
            $partida['jogador1Pronto'] = $rodada->getJogador1Pronto();
            $partida['jogador2Pronto'] = $rodada->getJogador2Pronto();

        }catch(\Exception $e){
            $partida['rodadaId'] = null;
            $partida['jogador1Pronto'] = 0;
            $partida['jogador2Pronto'] = 0;

        }

        return $partida;
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
        $qb->select('e.id, 
                     e.status,
                     e.baraJog1,
                     e.vidaJogador1,
                     u1.id AS jog1Id,
                     u1.nome AS jogador1,
                     e.baraJog2,
                     e.vidaJogador2,
                     u2.id AS jog2Id,
                     u2.nome AS jogador2');
        $qb->from('Guardians\Entity\Partida', 'e');
        $qb->leftJoin('Guardians\Entity\Baralho', 'b1', 'WITH', 'e.baraJog1 = b1.id');
        $qb->leftJoin('Guardians\Entity\Usuario', 'u1', 'WITH', 'b1.jogador = u1.id');
        $qb->leftJoin('Guardians\Entity\Baralho', 'b2', 'WITH', 'e.baraJog2 = b2.id');
        $qb->leftJoin('Guardians\Entity\Usuario', 'u2', 'WITH', 'b2.jogador = u2.id');
        $qb->where('b1.jogador = :jogador OR b2.jogador = :jogador');
        $qb->setParameters(array(
            'jogador' => $this->usuario->getId()
        ));

        $result = $qb->getQuery()->getArrayResult();

        for($i=0; $i < count($result); $i++){

            $qb = $this->em->createQueryBuilder();
            $qb->select('e');
            $qb->from('Guardians\Entity\Rodada', 'e');
            $qb->add('where', $qb->expr()->eq('e.partida', ':partida'));
            $qb->orderBy('e.id', 'DESC');
            $qb->setMaxResults(1);
            $qb->setParameters(array(
                'partida' => $result[$i]['id']
            ));

            try{
                $rodada = $qb->getQuery()->getSingleResult();
                $result[$i]['rodadaId'] = $rodada->getId();
                $result[$i]['jogador1Pronto'] = $rodada->getJogador1Pronto();
                $result[$i]['jogador2Pronto'] = $rodada->getJogador2Pronto();

            }catch(\Exception $e){
                $result[$i]['rodadaId'] = null;
                $result[$i]['jogador1Pronto'] = 0;
                $result[$i]['jogador2Pronto'] = 0;

            }



        }

        return $result;


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



    private function initPartida( Partida $partida){

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\CartasBaralho', 'e');
        $qb->where('e.baralho = :baralho');
        $qb->setParameters(array(
            'baralho' => $partida->getBaraJog1()
        ));

        $cartasBaralho1 = $qb->getQuery()->getResult();
        shuffle($cartasBaralho1);
        $cabaCont = 1;
        foreach($cartasBaralho1 as $caba){
            $pilhaCarta = new PilhaCarta();
            $pilhaCarta->setCartaBaralho($caba->getId());
            $pilhaCarta->setPartida($partida->getId());
            $pilhaCarta->setDescartada(0);
            $pilhaCarta->setSequencia($cabaCont++);
            $this->em->persist($pilhaCarta);

        }

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\CartasBaralho', 'e');
        $qb->where('e.baralho = :baralho');
        $qb->setParameters(array(
            'baralho' => $partida->getBaraJog2()
        ));

        $cartasBaralho2 = $qb->getQuery()->getResult();
        shuffle($cartasBaralho2);
        $cabaCont = 1;
        foreach($cartasBaralho2 as $caba){
            $pilhaCarta = new PilhaCarta();
            $pilhaCarta->setCartaBaralho($caba->getId());
            $pilhaCarta->setPartida($partida->getId());
            $pilhaCarta->setDescartada(0);
            $pilhaCarta->setSequencia($cabaCont++);
            $this->em->persist($pilhaCarta);

        }

        $this->em->flush();

        $rodada = new Rodada();
        $rodada->setPartida($partida->getId());

        $rodada->setJogador1Pronto(0);
        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\PilhaCarta', 'e');
        $qb->join('Guardians\Entity\CartasBaralho', 'cb', 'WITH', 'e.cartaBaralho = cb.id');
        $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'e.partida = p.id');
        $qb->where('cb.baralho = :baralho');
        $qb->andWhere('e.descartada = 0');
        $qb->andWhere('e.partida = :partida');
        $qb->setMaxResults(5);
        $qb->orderBy('e.sequencia', 'ASC');
        $qb->setParameters(array(
            'baralho' => $partida->getBaraJog1(),
            'partida' => $partida->getId()
        ));

        $pilhaCarta1 = $qb->getQuery()->getResult();
        $rodada->setIniciativa1Jog1($pilhaCarta1[0]->getId());
        $rodada->setIniciativa2Jog1($pilhaCarta1[1]->getId());
        $rodada->setIniciativa3Jog1($pilhaCarta1[2]->getId());
        $rodada->setGuardaJog1($pilhaCarta1[3]->getId());
        $rodada->setDescartaJog1($pilhaCarta1[4]->getId());


        $rodada->setJogador2Pronto(0);
        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\PilhaCarta', 'e');
        $qb->join('Guardians\Entity\CartasBaralho', 'cb', 'WITH', 'e.cartaBaralho = cb.id');
        $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'e.partida = p.id');
        $qb->where('cb.baralho = :baralho');
        $qb->andWhere('e.descartada = 0');
        $qb->andWhere('e.partida = :partida');
        $qb->setMaxResults(5);
        $qb->orderBy('e.sequencia', 'ASC');
        $qb->setParameters(array(
            'baralho' => $partida->getBaraJog2(),
            'partida' => $partida->getId()
        ));

        $pilhaCarta2 = $qb->getQuery()->getResult();
        $rodada->setIniciativa1Jog2($pilhaCarta2[0]->getId());
        $rodada->setIniciativa2Jog2($pilhaCarta2[1]->getId());
        $rodada->setIniciativa3Jog2($pilhaCarta2[2]->getId());
        $rodada->setGuardaJog2($pilhaCarta2[3]->getId());
        $rodada->setDescartaJog2($pilhaCarta2[4]->getId());


        $this->em->persist($rodada);
        $this->em->flush();
    }
}
