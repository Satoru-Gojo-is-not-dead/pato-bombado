<?php

namespace src\utilities;

use src\model\Hospedeiro;

class HospedeiroCreator {
    private ConversorArray $conversorArray;

    public function __construct()
    {
        $this->conversorArray = new ConversorArray();
    }

    public function criarHospedeiroModel(array $dadosHospedeiro) : Hospedeiro {
        if (
            !array_key_exists("id", $dadosHospedeiro) &&
            !array_key_exists("idade", $dadosHospedeiro) &&
            !array_key_exists("sexo", $dadosHospedeiro) &&
            !array_key_exists("peso", $dadosHospedeiro) &&
            !array_key_exists("altura", $dadosHospedeiro) &&
            !array_key_exists("tipoSanguineo", $dadosHospedeiro) &&
            !array_key_exists("esportesPraticados", $dadosHospedeiro) &&
            !array_key_exists("jogoPreferido", $dadosHospedeiro)
        ) {
            throw new \Exception("Ocorreu um erro ao buscar o hospedeiro!");
        }

        $esportesPraticados = $this->conversorArray->converterStringEmArray($dadosHospedeiro["esportesPraticados"]);

        $hospedeiro = new Hospedeiro(
            $dadosHospedeiro["idade"],
            $dadosHospedeiro["sexo"],
            $dadosHospedeiro["peso"],
            $dadosHospedeiro["altura"],
            $dadosHospedeiro["tipoSanguineo"],
            $esportesPraticados,
            $dadosHospedeiro["jogoPreferido"],
        );

        $hospedeiro->setId($dadosHospedeiro["id"]);

        return $hospedeiro;
    }
}