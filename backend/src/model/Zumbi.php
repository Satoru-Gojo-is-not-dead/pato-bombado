<?php

namespace src\model;

class Zumbi {
    private ?int $id;
    private int $idHospedeiro;
    private int $forca;
    private int $velocidade;
    private int $inteligencia;

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
}