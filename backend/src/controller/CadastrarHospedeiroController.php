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
        string|array $esportesPraticados,
        string $jogoPreferido,
    ) {
        if (is_array($esportesPraticados) || empty($esportesPraticados)) {
            $hospedeiro = new Hospedeiro(
                $idade,
                $sexo,
                (float) $peso,
                (float) $altura,
                $tipoSanguineo,
                (empty($esportesPraticados)) ? null : (array) $esportesPraticados,
                (empty($jogoPreferido)) ? null : $jogoPreferido,
            );

            return $hospedeiro;
        }

        throw new \Exception();
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
