<?php

namespace src\utilities;
use src\classes\ZumbiGenerator;
use src\model\Pato;
use src\model\Player;
use src\model\Zumbi;

class ArrayFormatterRequest {
    private ZumbiGenerator $zumbiGenerator;

    public function __construct() {
        $this->zumbiGenerator = new ZumbiGenerator();
    }

    public function formarZumbiRetornoRequest(Zumbi $zumbi) : array {
        $idZumbi = $zumbi->getId();
        $idHospedeiro = $zumbi->getIdHospedeiro();
        $forca = $zumbi->getForca();
        $velocidade = $zumbi->getVelocidade();
        $inteligencia = $zumbi->getInteligencia();
        $hp = $zumbi->getHp();
        $habilidadePredominante = $this->zumbiGenerator->definirHabilidadePredominante($zumbi);

        $z = [
            "id" => $idZumbi,
            "idHospedeiro" => $idHospedeiro,
            "forca" => $forca,
            "velocidade" => $velocidade,
            "inteligencia" => $inteligencia,
            "hp" => $hp,
            "habilidadePredominante" => $habilidadePredominante,
        ];

        return $z;
    }

    public function formarPatoRetornoRequest(Pato $pato) : array {
        $idPato = $pato->getId();
        $nomePato = $pato->getNome();
        $hp = $pato->getHp();
        $escudoEstaAtivo = $pato->getEscudoEstaAtivo();

        $habilidadesPato = [];

        foreach ($pato->getHabilidadesPato() as $habilidade) {
            $habilidadePato = [
                "codigoHabilidade" => $habilidade->getCodigoHabilidade(),
                "nomeHabilidade" => $habilidade->getNomehabilidade(),
                "dano" => $habilidade->getDano(),
            ];

            array_push($habilidadesPato, $habilidadePato);
        }

        $p = [
            "id" => $idPato,
            "nome" => $nomePato,
            "hp" => $hp,
            "escudo" => $escudoEstaAtivo,
            "habilidadesPato" => $habilidadesPato,
        ];

        return $p;
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
