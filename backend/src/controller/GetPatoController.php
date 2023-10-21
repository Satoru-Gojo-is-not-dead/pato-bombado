<?php

namespace src\controller;

use src\dao\PatoDao;
use src\model\Pato;
use src\utilities\PatoCreator;

class GetPatoController
{
    private PatoDao $patoDao;
    private PatoCreator $patoCreator;

    public function __construct(
        PatoDao $patoDao, 
    )
    {
        $this->patoDao = $patoDao;
        $this->patoCreator = new PatoCreator();
    }

    public function getPato(int $patoId): Pato
    {
        if ($patoId < 1 && $patoId > 4) {
            throw new \Exception("Escolha um pato válido");
        }

        try {
            $dadosPato = $this->patoDao->getPato($patoId);

            if ($dadosPato == null) {
                throw new \Exception(
                    "Pato não cadastrado!",
                );
            }

            $pato = $this->patoCreator->criarPatoModel($dadosPato);

            return $pato;
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
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
}
