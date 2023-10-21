<?php

namespace src\model;

class Player
{
    private ?int $id;
    private string $nickName;
    private int $nivel;

    public function __construct(
        ?int $id,
        string $nickName,
        int $nivel
    ) {
        $this->id = $id;
        $this->nickName = $nickName;
        $this->nivel = $nivel;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNickName(): string {
        return $this->nickName;
    }

    public function getNivel(): int {
        return $this->nivel;
    }

    public function avancarNivel() {
        $this->nivel++;
    }

    public function resetarNivel() {
        $this->nivel = 1;
    }

}
