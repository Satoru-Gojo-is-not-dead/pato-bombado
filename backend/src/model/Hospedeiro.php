<?php

namespace src\model;

class Hospedeiro
{
    private ?int $id;
    private int $idade;
    private string $sexo;
    private float $peso;
    private float $altura;
    private string $tipoSanguineo;
    private ?array $esportesPraticados;
    private ?string $jogoPreferido;

    public function __construct(
        int $idade,
        string $sexo,
        float $peso,
        float $altura,
        string $tipoSanguineo,
        ?array $esportesPraticados,
        ?string $jogoPreferido
    ) {
        $this->idade = $idade;
        $this->sexo = $sexo;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->tipoSanguineo = $tipoSanguineo;
        $this->esportesPraticados = $esportesPraticados;
        $this->jogoPreferido = $jogoPreferido;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }

    public function getSexo(): string
    {
        return $this->sexo;
    }

    public function getPeso(): float
    {
        return $this->peso;
    }

    public function getAltura(): float
    {
        return $this->altura;
    }

    public function getTipoSanguineo(): string
    {
        return $this->tipoSanguineo;
    }

    public function getEsportesPraticados(): ?array
    {
        return $this->esportesPraticados;
    }

    public function getJogoPreferido(): ?string
    {
        return $this->jogoPreferido;
    }
}
