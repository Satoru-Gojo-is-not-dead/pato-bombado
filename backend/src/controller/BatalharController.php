<?php

namespace src\controller;

use src\classes\Batalha;
use src\classes\VerificadorTipoDeDano;
use src\dao\PatoDao;
use src\dao\PlayerDao;
use src\dao\ZumbiDao;
use src\model\Pato;
use src\model\Player;
use src\model\Zumbi;
use src\utilities\ArrayFormatterRequest;
use src\utilities\PatoCreator;

class BatalharController
{
    private PlayerDao $playerDao;
    private PatoDao $patoDao;
    private ZumbiDao $zumbiDao;
    private Batalha $batalha;
    private PatoCreator $patoCreator;
    private ArrayFormatterRequest $arrayFormatterRequest;
    private VerificadorTipoDeDano $verificadorTipoDeDano;

    public function __construct(
        PlayerDao $playerDao,
        PatoDao $patoDao,
        ZumbiDao $zumbiDao,
    ) {
        $this->playerDao = $playerDao;
        $this->patoDao = $patoDao;
        $this->zumbiDao = $zumbiDao;
        $this->batalha = new Batalha();
        $this->patoCreator = new PatoCreator();
        $this->arrayFormatterRequest = new ArrayFormatterRequest();
        $this->verificadorTipoDeDano = new VerificadorTipoDeDano();
    }

    // buscar participantes da batalha
    public function getPlayer(int $id): Player
    {
        try {
            $player = $this->buscarPlayer($id);

            if ($player == null) {
                throw new \Exception(
                    "Ocorreu um erro ao buscar as informações dos integrantes da batalha! Tente novamente"
                );
            }

            return $player;
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    }

    private function buscarPlayer(int $id): ?Player
    {
        $dadosPlayer = $this->playerDao->getPlayerPorId($id);

        if ($dadosPlayer == null) {
            return null;
        }

        $player = new Player(
            $dadosPlayer["id"],
            $dadosPlayer["nickName"],
            $dadosPlayer["nivel"],
        );

        return $player;
    }

    public function getZumbi(int $id): Zumbi
    {
        try {
            $zumbi = $this->buscarZumbi($id);

            if ($zumbi == null) {
                throw new \Exception(
                    "Ocorreu um erro ao buscar as informações dos integrantes da batalha! Tente novamente"
                );
            }

            return $zumbi;
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    }

    private function buscarZumbi(int $id): ?Zumbi
    {
        $dadosZumbi = $this->zumbiDao->getZumbi($id);

        if ($dadosZumbi == null) {
            return null;
        }

        $zumbi = new Zumbi(
            $dadosZumbi["idHospedeiro"],
            $dadosZumbi["forca"],
            $dadosZumbi["velocidade"],
            $dadosZumbi["inteligencia"],
        );

        $zumbi->setId($id);
        $zumbi->setHp($dadosZumbi["hp"]);

        return $zumbi;
    }

    public function getPato(int $patoId): Pato
    {
        try {
            $dadosPato = $this->patoDao->getPato($patoId);

            if ($dadosPato == null) {
                throw new \Exception(
                    "Ocorreu um erro ao buscar as informações dos integrantes da batalha! Tente novamente",
                );
            }

            $pato = $this->patoCreator->criarPatoModel($dadosPato);

            return $pato;
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    }

    // batalhar
    public function batalhar(
        Player $player,
        Pato $pato,
        Zumbi $zumbi,
        int $codigoAtaqueASerExecutado,
    ): array {
        $danoRecebidoPeloZumbi = $this->batalha->atacarZumbi($player, $pato, $zumbi, $codigoAtaqueASerExecutado);
        $danoRecebidoPeloPato = $this->batalha->atacarPato($player, $pato, $zumbi);

        try {
            $this->playerDao->updatePlayer($player);
            $this->patoDao->updatePato($pato);
            $this->zumbiDao->updateZumbi($zumbi);

            $infosParticipantesAtualizadas = $this->formarRetornoRequest(
                $player,
                $pato,
                $zumbi,
                $danoRecebidoPeloZumbi,
                $danoRecebidoPeloPato,
                $codigoAtaqueASerExecutado,
            );

            return $infosParticipantesAtualizadas;
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        }
    }

    // retorno request
    private function formarRetornoRequest(
        Player $player,
        Pato $pato,
        Zumbi $zumbi,
        int $danoRecebidoPeloZumbi,
        int $danoRecebidoPeloPato,
        int $codigoAtaqueExecutado,
    ): array {
        $tipoDanoAoZumbi = $this->verificadorTipoDeDano->verificarTipoDeDano(
            $codigoAtaqueExecutado,
            $pato,
            $danoRecebidoPeloZumbi,
        );

        $response = [
            "danoAplicadoAoZumbi" => $danoRecebidoPeloZumbi,
            "danoAplicadoAoPato" => $danoRecebidoPeloPato,
            "categoriaDano" => $tipoDanoAoZumbi,
        ];

        $retornoPlayer = $this->arrayFormatterRequest->formarPlayerRetornoRequest($player);
        $response["player"] = $retornoPlayer;

        if ($pato->getHp() > 0) {
            $retornoPato = $this->arrayFormatterRequest->formarPatoRetornoRequest($pato);
            $response["pato"] = $retornoPato;
        } else {
            $response["pato"] = null;
        }

        if ($zumbi->getHp() > 0) {
            $retornoZumbi = $this->arrayFormatterRequest->formarZumbiRetornoRequest($zumbi);
            $response["zumbi"] = $retornoZumbi;
        } else {
            $response["zumbi"] = null;
        }

        return $response;
    }
}
