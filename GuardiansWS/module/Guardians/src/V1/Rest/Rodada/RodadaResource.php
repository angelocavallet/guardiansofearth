<?php
namespace Guardians\V1\Rest\Rodada;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use Guardians\Entity\Rodada;
use Guardians\Entity\Registro;
use Guardians\Entity\Equipamento;

class RodadaResource extends AbstractResourceListener
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
            $qb->select('e');
            $qb->from('Guardians\Entity\Rodada', 'e');
            $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'e.partida = p.id');
            $qb->join('Guardians\Entity\Baralho', 'b1', 'WITH', 'p.baraJog1 = b1.id');
            $qb->add('where', $qb->expr()->andX(
                $qb->expr()->eq('p.id', ':partida'),
                $qb->expr()->eq('b1.jogador', ':jogador')
            ));
            $qb->setParameters(array(
                'partida' => $part_codigo,
                'jogador' => $this->usuario->getId()
            ));
            $rodadas = $qb->getQuery()->getResult();

            if(count($rodadas) == 0){
                $qb = $this->em->createQueryBuilder();
                $qb->select('e');
                $qb->from('Guardians\Entity\Rodada', 'e');
                $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'e.partida = p.id');
                $qb->join('Guardians\Entity\Baralho', 'b1', 'WITH', 'p.baraJog2 = b1.id');
                $qb->add('where', $qb->expr()->andX(
                    $qb->expr()->eq('p.id', ':partida'),
                    $qb->expr()->eq('b1.jogador', ':jogador')
                ));
                $qb->setParameters(array(
                    'partida' => $part_codigo,
                    'jogador' => $this->usuario->getId()
                ));
                $rodadas = $qb->getQuery()->getResult();

            }

            return $rodadas;

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

        if(!isset($data->partida)){
            return new ApiProblem(400, 'Obrigatorio informar valor "partida"');
        }

        $part_codigo = (int) $data->partida;

        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\Rodada', 'e');
        $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'e.partida = p.id');
        $qb->join('Guardians\Entity\Baralho', 'b1', 'WITH', 'p.baraJog1 = b1.id');
        $qb->where('p.id = :partida');
        $qb->andWhere('b1.jogador = :jogador');
        $qb->andWhere('e.id = :rodada');
        $qb->setParameters(array(
            'partida' => $part_codigo,
            'jogador' => $this->usuario->getId(),
            'rodada' => $id
        ));

        try {
            $rodada = $qb->getQuery()->getSingleResult();

        }catch(\Doctrine\ORM\NoResultException $e) {
            $rodada = false;
        }


        if($rodada){
            if($rodada->getJogador1Pronto()){
                return new ApiProblem(400, 'Jogador ja confirmou a jogada');
            }

            $jogadaOriginal = [
                'iniciativa1' => $rodada->getIniciativa1Jog1(),
                'iniciativa2' => $rodada->getIniciativa2Jog1(),
                'iniciativa3' => $rodada->getIniciativa3Jog1(),
                'guarda' => $rodada->getGuardaJog1(),
                'descarta' => $rodada->getDescartaJog1()
            ];

            $jogadaConfirmada = [
                'iniciativa1' => $data->iniciativa1,
                'iniciativa2' => $data->iniciativa2,
                'iniciativa3' => $data->iniciativa3,
                'guarda' => $data->guarda,
                'descarta' => $data->descarta
            ];

            if($jogadaOriginal !== array_intersect($jogadaOriginal, $jogadaConfirmada) ||
                $jogadaConfirmada !== array_intersect($jogadaConfirmada, $jogadaOriginal)) {
                return new ApiProblem(400, 'Cartas informadas nao condizem com as disponiveis');
            }

            $rodada->setIniciativa1Jog1($data->iniciativa1);
            $rodada->setIniciativa2Jog1($data->iniciativa2);
            $rodada->setIniciativa3Jog1($data->iniciativa3);
            $rodada->setGuardaJog1($data->guarda);
            $rodada->setDescartaJog1($data->descarta);
            $rodada->setJogador1Pronto(1);

            $this->em->merge($rodada);
            $this->em->flush();

        }else{
            $qb = $this->em->createQueryBuilder();
            $qb->select('e');
            $qb->from('Guardians\Entity\Rodada', 'e');
            $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'e.partida = p.id');
            $qb->join('Guardians\Entity\Baralho', 'b1', 'WITH', 'p.baraJog2 = b1.id');
            $qb->where('p.id = :partida');
            $qb->andWhere('b1.jogador = :jogador');
            $qb->andWhere('e.id = :rodada');
            $qb->setParameters(array(
                'partida' => $part_codigo,
                'jogador' => $this->usuario->getId(),
                'rodada' => $id
            ));

            try {
                $rodada = $qb->getQuery()->getSingleResult();

                if($rodada->getJogador2Pronto()){
                    return new ApiProblem(400, 'Jogador ja confirmou a jogada');
                }


                $jogadaOriginal = [
                    'iniciativa1' => $rodada->getIniciativa1Jog2(),
                    'iniciativa2' => $rodada->getIniciativa2Jog2(),
                    'iniciativa3' => $rodada->getIniciativa3Jog2(),
                    'guarda' => $rodada->getGuardaJog2(),
                    'descarta' => $rodada->getDescartaJog2()
                ];

                $jogadaConfirmada = [
                    'iniciativa1' => $data->iniciativa1,
                    'iniciativa2' => $data->iniciativa2,
                    'iniciativa3' => $data->iniciativa3,
                    'guarda' => $data->guarda,
                    'descarta' => $data->descarta
                ];

                if($jogadaOriginal !== array_intersect($jogadaOriginal, $jogadaConfirmada) ||
                    $jogadaConfirmada !== array_intersect($jogadaConfirmada, $jogadaOriginal)) {
                    return new ApiProblem(400, 'Cartas informadas nao condizem com as disponiveis');
                }

                $rodada->setIniciativa1Jog2($data->iniciativa1);
                $rodada->setIniciativa2Jog2($data->iniciativa2);
                $rodada->setIniciativa3Jog2($data->iniciativa3);
                $rodada->setGuardaJog2($data->guarda);
                $rodada->setDescartaJog2($data->descarta);
                $rodada->setJogador2Pronto(1);

                $this->em->merge($rodada);
                $this->em->flush();

            }catch(\Doctrine\ORM\NoResultException $e) {
                return new ApiProblem(400, 'Rodada nao encontrada');
            }
        }

        if($rodada->getJogador1Pronto() == 1 && $rodada->getJogador2Pronto() == 1){
            $qb = $this->em->createQueryBuilder();
            $qb->select('e');
            $qb->from('Guardians\Entity\Partida', 'e');
            $qb->andWhere('e.id = :partida');
            $qb->setParameters(array(
                'partida' => $part_codigo
            ));

            try {
                $partida = $qb->getQuery()->getSingleResult();
            }catch(\Doctrine\ORM\NoResultException $e) {
                return new ApiProblem(500, 'Erro ao buscar partida');
            }


            $jogador1 = [];
            $jogador2 = [];

            $jogador1['vida'] = $partida->getVidaJogador1();
            $jogador2['vida'] = $partida->getVidaJogador2();

            $jogador1['ataque'] = 0;
            $jogador1['defesa'] = 0;

            $jogador2['ataque'] = 0;
            $jogador2['defesa'] = 0;

            $jogador1['itens'] = $this->getItens($partida->getBaraJog1(), $partida->getId());
            $jogador2['itens'] = $this->getItens($partida->getBaraJog2(), $partida->getId());

            $jogador1['equipamentos'] = $this->getEquipamentos($partida->getBaraJog1(), $partida->getId());
            foreach($jogador1['equipamentos'] as $eq){
                $cartEq =  $this->getCartaPilhaCarta($eq->getId());
                $jogador1['ataque'] += $cartEq->getAtaque();
                $jogador1['defesa'] += $cartEq->getDefesa();
            }

            $jogador2['equipamentos'] = $this->getEquipamentos($partida->getBaraJog2(), $partida->getId());
            foreach($jogador2['equipamentos'] as $eq){
                $cartEq =  $this->getCartaPilhaCarta($eq->getId());
                $jogador2['ataque'] += $cartEq->getAtaque();
                $jogador2['defesa'] += $cartEq->getDefesa();
            }

            $jogador1[1]['carta'] = $this->getCartaPilhaCarta($rodada->getIniciativa1Jog1());
            $jogador1[1]['pilhacarta'] = $rodada->getIniciativa1Jog1();

            $jogador1[2]['carta'] = $this->getCartaPilhaCarta($rodada->getIniciativa2Jog1());
            $jogador1[2]['pilhacarta'] = $rodada->getIniciativa2Jog1();

            $jogador1[3]['carta'] = $this->getCartaPilhaCarta($rodada->getIniciativa3Jog1());
            $jogador1[3]['pilhacarta'] = $rodada->getIniciativa3Jog1();

            $jogador1['guarda'] = $rodada->getGuardaJog1();
            $jogador1['descarta'] = $rodada->getDescartaJog1();

            $jogador2[1]['carta'] = $this->getCartaPilhaCarta($rodada->getIniciativa1Jog2());
            $jogador2[1]['pilhacarta'] = $rodada->getIniciativa1Jog2();

            $jogador2[2]['carta'] = $this->getCartaPilhaCarta($rodada->getIniciativa2Jog2());
            $jogador2[2]['pilhacarta'] = $rodada->getIniciativa2Jog2();

            $jogador2[3]['carta'] = $this->getCartaPilhaCarta($rodada->getIniciativa3Jog2());
            $jogador2[3]['pilhacarta'] = $rodada->getIniciativa3Jog2();

            $jogador2['guarda'] = $rodada->getGuardaJog2();
            $jogador2['descarta'] = $rodada->getDescartaJog2();

            for($i=1; $i <=3; $i++){

                $regi = new Registro();

                $regi->setRodada($rodada->getId());
                $regi->setSequencia($i);

                $regi->setVidaJog1($jogador1['vida']);
                $regi->setVidaJog2($jogador2['vida']);

                $danoJog1 = 0;
                $defesaJog1 = 0;
                $curaJog1 = 0;

                $danoJog2 = 0;
                $defesaJog2 = 0;
                $curaJog2 = 0;

                if($jogador1[$i]['carta']->getEnergia() <= $i){

                    if($jogador1[$i]['carta']->getTipo() == 'E'){
                        $equipa = new Equipamento();
                        $equipa->setPartida($partida->getId());
                        $equipa->setCarta($jogador1[$i]['pilhacarta']);
                        $this->em->persist($equipa);
                        $this->em->flush();

                    }else{
                        $danoJog1 = $jogador1['ataque'] + $jogador1[$i]['carta']->getAtaque();
                        $defesaJog1 = $jogador1['defesa'] + $jogador1[$i]['carta']->getDefesa();
                        $curaJog1 = $jogador1[$i]['carta']->getCura();
                    }

                }

                if($jogador2[$i]['carta']->getEnergia() <= $i){

                    if($jogador2[$i]['carta']->getTipo() == 'E'){
                        $equipa = new Equipamento();
                        $equipa->setPartida($partida->getId());
                        $equipa->setCarta($jogador2[$i]['pilhacarta']);
                        $this->em->persist($equipa);
                        $this->em->flush();

                    }else {
                        $danoJog2 = $jogador2['ataque'] + $jogador2[$i]['carta']->getAtaque();
                        $defesaJog2 = $jogador2['defesa'] + $jogador2[$i]['carta']->getDefesa();
                        $curaJog2 = $jogador2[$i]['carta']->getCura();

                    }
                }

                if($curaJog1 > 0 && $jogador1['vida'] + $curaJog1 > 20){
                    $jogador1['vida'] = 20;

                }else if($curaJog1 > 0){
                    $jogador1['vida'] += $curaJog1;
                }

                if($curaJog2 > 0 && $jogador2['vida'] + $curaJog2 > 20){
                    $jogador2['vida'] = 20;

                }else if($curaJog2 > 0){
                    $jogador2['vida'] += $curaJog2;
                }
				
				if($jogador2['vida'] > 0){
					if($danoJog1 > $defesaJog2){
						if(($jogador2['vida'] - ($danoJog1 - $defesaJog2)) <= 0){
							$jogador2['vida'] = 0;
						}else{
							$jogador2['vida'] = $jogador2['vida'] - ($danoJog1 - $defesaJog2);	
						}
					}	
				}

				if($jogador1['vida'] > 0){
					if($danoJog2 > $defesaJog1){
						if(($jogador1['vida'] - ($danoJog2 - $defesaJog1)) <= 0){
							$jogador1['vida'] = 0;
						}else{
							$jogador1['vida'] = $jogador1['vida'] - ($danoJog2 - $defesaJog1);	
						}
					}	
				}

                $regi->setAtaqueJog1($danoJog1);
                $regi->setDefesaJog1($defesaJog1);
                $regi->setCuraJog1($curaJog1);

                $regi->setAtaqueJog2($danoJog2);
                $regi->setDefesaJog2($defesaJog2);
                $regi->setCuraJog2($curaJog2);

                $this->em->merge($regi);
                $this->em->flush();

            }

            $partida->setVidaJogador1($jogador1['vida']);
            $partida->setVidaJogador2($jogador2['vida']);

            $this->descartaCarta($rodada->getIniciativa1Jog1());
            $this->descartaCarta($rodada->getIniciativa2Jog1());
            $this->descartaCarta($rodada->getIniciativa3Jog1());
            $this->descartaCarta($rodada->getDescartaJog1());
            $this->descartaCarta($rodada->getIniciativa1Jog2());
            $this->descartaCarta($rodada->getIniciativa2Jog2());
            $this->descartaCarta($rodada->getIniciativa3Jog2());
            $this->descartaCarta($rodada->getDescartaJog2());


            if($jogador1['vida'] <= 0){
                $partida->setStatus('F');
            }
            if($jogador2['vida'] <= 0){
                $partida->setStatus('F');
            }

            $this->em->merge($partida);
            $this->em->flush();

            if($partida->getStatus() != 'F'){
                $rodada = new Rodada();
                $rodada->setPartida($partida->getId());

                $rodada->setJogador1Pronto(0);
                $qb = $this->em->createQueryBuilder();
                $qb->select('e');
                $qb->from('Guardians\Entity\PilhaCarta', 'e');
                $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'p.id = e.partida');
                $qb->join('Guardians\Entity\CartasBaralho', 'cb', 'WITH', 'e.cartaBaralho = cb.id');
                $qb->where('cb.baralho = :baralho');
                $qb->andWhere('e.descartada = 0');
                $qb->andWhere('p.id = :partida');
                $qb->andWhere('e.id != :guarda');
                $qb->setMaxResults(4);
                $qb->orderBy('e.sequencia', 'ASC');
                $qb->setParameters(array(
                    'baralho' => $partida->getBaraJog1(),
                    'partida' => $partida->getId(),
                    'guarda' => $jogador1['guarda']
                ));

                $pilhaCarta1 = $qb->getQuery()->getResult();
                $rodada->setIniciativa1Jog1($pilhaCarta1[0]->getId());
                $rodada->setIniciativa2Jog1($pilhaCarta1[1]->getId());
                $rodada->setIniciativa3Jog1($pilhaCarta1[2]->getId());
                $rodada->setGuardaJog1($jogador1['guarda']);
                $rodada->setDescartaJog1($pilhaCarta1[3]->getId());


                $rodada->setJogador2Pronto(0);
                $qb = $this->em->createQueryBuilder();
                $qb->select('e');
                $qb->from('Guardians\Entity\PilhaCarta', 'e');
                $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'p.id = e.partida');
                $qb->join('Guardians\Entity\CartasBaralho', 'cb', 'WITH', 'e.cartaBaralho = cb.id');
                $qb->where('cb.baralho = :baralho');
                $qb->andWhere('e.descartada = 0');
                $qb->andWhere('p.id = :partida');
                $qb->andWhere('e.id != :guarda');
                $qb->setMaxResults(4);
                $qb->orderBy('e.sequencia', 'ASC');
                $qb->setParameters(array(
                    'baralho' => $partida->getBaraJog2(),
                    'partida' => $partida->getId(),
                    'guarda' => $jogador2['guarda']
                ));

                $pilhaCarta2 = $qb->getQuery()->getResult();
                $rodada->setIniciativa1Jog2($pilhaCarta2[0]->getId());
                $rodada->setIniciativa2Jog2($pilhaCarta2[1]->getId());
                $rodada->setIniciativa3Jog2($pilhaCarta2[2]->getId());
                $rodada->setGuardaJog2($jogador2['guarda']);
                $rodada->setDescartaJog2($pilhaCarta2[3]->getId());


                $this->em->persist($rodada);
                $this->em->flush();

                return $rodada;
            }

            return new ApiProblem(200, 'END');
        }

        return new ApiProblem(200, 'OK');
    }

    private function getCartaPilhaCarta($pcar_codigo){
        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\Carta', 'e');
        $qb->join('Guardians\Entity\CartasBaralho', 'c', 'WITH', 'e.id = c.carta');
        $qb->join('Guardians\Entity\PilhaCarta', 'p', 'WITH', 'p.cartaBaralho = c.id');
        $qb->where('p.id = :pilhaCarta');
        $qb->setParameters(array(
            'pilhaCarta' => $pcar_codigo
        ));

        try {
            return $qb->getQuery()->getSingleResult();
        }catch(\Doctrine\ORM\NoResultException $e) {
            return new ApiProblem(500, 'Erro ao buscar cartas');
        }

    }

    private function getItens($baralho, $partida){
        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\PilhaCarta', 'e');
        $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'p.id = e.partida');
        $qb->join('Guardians\Entity\CartasBaralho', 'c', 'WITH', 'c.id = e.cartaBaralho');
        $qb->join('Guardians\Entity\Item', 'i', 'WITH', 'i.carta = e.id');
        $qb->where('c.baralho = :baralho');
        $qb->andWhere('p.id = :partida');
        $qb->andWhere('e.descartada = 0');
        $qb->setParameters(array(
            'baralho' => $baralho,
            'partida' => $partida
        ));

        return $qb->getQuery()->getResult();

    }

    private function getEquipamentos($baralho, $partida){
        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\PilhaCarta', 'e');
        $qb->join('Guardians\Entity\Partida', 'p', 'WITH', 'p.id = e.partida');
        $qb->join('Guardians\Entity\CartasBaralho', 'c', 'WITH', 'c.id = e.cartaBaralho');
        $qb->join('Guardians\Entity\Equipamento', 'eq', 'WITH', 'eq.carta = e.id');
        $qb->where('c.baralho = :baralho');
        $qb->andWhere('p.id = :partida');
        $qb->andWhere('e.descartada = 0');
        $qb->setParameters(array(
            'baralho' => $baralho,
            'partida' => $partida
        ));

        return $qb->getQuery()->getResult();

    }

    private function descartaCarta($pcar_codigo){
        $qb = $this->em->createQueryBuilder();
        $qb->select('e');
        $qb->from('Guardians\Entity\PilhaCarta', 'e');
        $qb->where('e.id = :pilhacarta');
        $qb->setParameters(array(
            'pilhacarta' => $pcar_codigo
        ));

        $pcar = $qb->getQuery()->getSingleResult();
        $pcar->setDescartada(1);

        $this->em->merge($pcar);
        $this->em->flush();
    }

}
