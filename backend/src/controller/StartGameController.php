<?php

namespace src\controller;

use src\dao\PatoDao;
use src\dao\PlayerDao;
use src\model\Player;
use src\utilities\GetterLastId;

class StartGameController
{
    private PlayerDao $playerDao;
    private GetterLastId $getterLastId;

    public function __construct(
        PlayerDao $playerDao,
        GetterLastId $getterLastId,
    ) {
        $this->playerDao = $playerDao;
        $this->getterLastId = $getterLastId;
    }

    public function getPlayer(string $nickName): ?Player
    {
        try {
            $player = $this->buscarPlayer($nickName);

            if ($player != null) {
                return $player;
            }

            $player = $this->insertPlayer($nickName);

            if ($player == null) {
                throw new \Exception("Ocorreu um erro ao criar o player! Tente novamente");
            }

            return $player;
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    }

    private function buscarPlayer(string $nickName): ?Player
    {
        $dadosPlayer = $this->playerDao->getPlayer($nickName);

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

    private function insertPlayer(string $nickName): ?Player
    {
        $player = new Player(null, $nickName, 1);

        $playerFoiInserido = $this->playerDao->insertPlayer($player);

        if (!$playerFoiInserido) {
            return null;
        }

        $idPlayer = $this->getterLastId->getLastId("player");

        $player->setId($idPlayer);

        return $player;
    }

    public function formarPlayerRetornoRequest(Player $player): array
    {
        $idPlayer = $player->getId();
        $nickName = $player->getNickName();
        $nivel = $player->getNivel();

        $p = [
            "id" => $idPlayer,
            "nickName" => $nickName,
            "nivel" => $nivel,
        ];

        return $p;
    }
}
