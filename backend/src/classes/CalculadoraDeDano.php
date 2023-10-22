<?php

namespace src\classes;

class CalculadoraDeDano
{
    public function calcularDanoAoZumbi(
        int $danoASerDado,
        bool $ataqueAPontoFracoDoZumbi,
    ): int {
        if ($ataqueAPontoFracoDoZumbi) {
            $danoASerDado += 10;
        }

        $chanceDoGolpeAcertar = rand(1, 2);

        if ($chanceDoGolpeAcertar == 1) {
            return $danoASerDado;
        }

        return 0;
    }

    public function calcularDanoAoPato() : int {
        $danoASerDado = rand(15, 35);

        $chanceDoGolpeAcertar = rand(1, 2);

        if ($chanceDoGolpeAcertar == 1) {
            return $danoASerDado;
        }

        return 0;
    }
}
