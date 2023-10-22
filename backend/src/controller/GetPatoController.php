<?php

namespace src\controller;

use src\dao\PatoDao;
use src\model\Pato;
use src\utilities\ArrayFormatterRequest;
use src\utilities\PatoCreator;

class GetPatoController
{
    private PatoDao $patoDao;
    private PatoCreator $patoCreator;
    private ArrayFormatterRequest $arrayFormatterRequest;

    public function __construct(
        PatoDao $patoDao, 
    )
    {
        $this->patoDao = $patoDao;
        $this->patoCreator = new PatoCreator();
        $this->arrayFormatterRequest = new ArrayFormatterRequest();
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
        return $this->arrayFormatterRequest->formarPatoRetornoRequest($pato);
    }
}
