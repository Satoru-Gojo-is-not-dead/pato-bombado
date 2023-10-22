<?php

namespace src\model;

class Zumbi {
    private ?int $id;
    private int $idHospedeiro;
    private int $forca;
    private int $velocidade;
    private int $inteligencia;
    private int $hp = 100;

    public function __construct(
        int $idHospedeiro,
        int $forca,
        int $velocidade,
        int $inteligencia,
    )
    {
        $this->idHospedeiro = $idHospedeiro;
        $this->forca = $forca;
        $this->velocidade = $velocidade;
        $this->inteligencia = $inteligencia;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId() : ?int {
        return $this->id;
    }

    public function getIdHospedeiro() : int {
        return $this->idHospedeiro;
    }

    public function getForca(): int {
        return $this->forca;
    }

    public function getVelocidade(): int {
        return $this->velocidade;
    }

    public function getInteligencia(): int {
        return $this->inteligencia;
    }

    public function restaurarVida() {
        $this->hp = 100;
    }

    public function reduzirHp(int $hpASerReduzido) {
        $this->hp -= $hpASerReduzido;

        if ($this->hp < 0) {
            $this->hp = 0;
        }
    }

    public function setHp(int $hp) {
        $this->hp = $hp;
    }

    public function getHp() : int {
        return $this->hp;
    }
}