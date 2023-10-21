<?php

namespace src\utilities;

use src\model\HabilidadePato;
use src\model\Pato;

class PatoCreator {
    public function criarPatoModel(array $dadosPato) : Pato {
        $habilidadesPato = [];

        foreach ($dadosPato as $value) {
            $codigoHabilidade = $value["codigoHabilidade"];
            $nomeHabilidade = $value["nomeHabilidade"];
            $dano = $value["dano"];

            $habilidadePato = new HabilidadePato($codigoHabilidade, $nomeHabilidade, $dano);

            array_push($habilidadesPato, $habilidadePato);
        }

        $idPato = $dadosPato[0]["id"];
        $nomePato = $dadosPato[0]["nome"];
        $hpPato = $dadosPato[0]["hp"];
        $escudoEstaAtivo = ($dadosPato[0]["escudoEstaAtivo"] == "1") ? true : false;

        $pato = new Pato($idPato, $nomePato, $hpPato, $escudoEstaAtivo, $habilidadesPato);

        return $pato;
    }
}
