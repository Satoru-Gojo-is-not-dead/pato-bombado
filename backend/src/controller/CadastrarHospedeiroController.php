<?php

namespace src\controller;

use src\dao\HospedeiroDao;
use src\model\Hospedeiro;

class CadastrarHospedeiroController
{
    private HospedeiroDao $hospedeiroDao;

    public function __construct(HospedeiroDao $hospedeiroDao)
    {
        $this->hospedeiroDao = $hospedeiroDao;
    }

    public function criarHospedeiroModel(
        string $idade,
        string $sexo,
        string $peso,
        string $altura,
        string $tipoSanguineo,
        string|array $gostosMusicais,
        string|array $esportesPraticados,
        string $jogoPreferido,
    ) {
        if (!is_array($gostosMusicais) && !is_array($esportesPraticados)) {
            throw new \Exception();
        }

        $hospedeiro = new Hospedeiro(
            $idade,
            $sexo,
            (float) $peso,
            (float) $altura,
            $tipoSanguineo,
            (array) $gostosMusicais,
            (array) $esportesPraticados,
            $jogoPreferido,
        );

        return $hospedeiro;
    }

    public function salvarHospedeiroNoBanco(Hospedeiro $hospedeiro): bool
    {
        try {
            $hospedeiroFoiSalvo = $this->hospedeiroDao->insertHospedeiro($hospedeiro);

            return $hospedeiroFoiSalvo;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
