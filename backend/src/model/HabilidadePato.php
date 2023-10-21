<?php

namespace src\model;

class HabilidadePato
{
    private int $codigoHabilidade;
    private string $nomeHabilidade;
    private int $dano;

    public function __construct(
        int $codigoHabilidade,
        string $nomeHabilidade,
        int $dano,
    ) {
        $this->codigoHabilidade = $codigoHabilidade;
        $this->nomeHabilidade = $nomeHabilidade;
        $this->dano = $dano;
    }

    public function getCodigoHabilidade(): int
    {
        return $this->codigoHabilidade;
    }

    public function getNomeHabilidade(): string {
        return $this->nomeHabilidade;
    }

    public function getDano(): int {
        return $this->dano;
    }
}
