<?php

namespace src\model;

class Pato
{
    private int $id;
    private string $nome;
    private int $hp;
    private bool $escudoEstaAtivo;
    private array $habilidadesPato;

    public function __construct(
        int $id,
        string $nome,
        int $hp,
        bool $escudoEstaAtivo,
        array $habilidadesPato,
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->hp = $hp;
        $this->escudoEstaAtivo = $escudoEstaAtivo;
        $this->habilidadesPato = $habilidadesPato;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function ativarEscudoPato() {
        $this->escudoEstaAtivo = true;
    }

    public function desativarEscudoPato() {
        $this->escudoEstaAtivo = false;
    }

    public function getEscudoEstaAtivo(): bool {
        return $this->escudoEstaAtivo;
    }

    public function getHabilidadesPato(): array {
        return $this->habilidadesPato;
    }

}
