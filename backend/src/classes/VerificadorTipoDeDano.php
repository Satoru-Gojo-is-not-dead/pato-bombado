<?php

namespace src\classes;
use src\model\Pato;

class VerificadorTipoDeDano
{
    public function verificarTipoDeDano(
        int $codigoAtaque,
        Pato $pato,
        int $danoAoZumbi,
    ) : String {
        $danoDoAtaque = 0;

        foreach ($pato->getHabilidadesPato() as $habilidade) {
            if ($habilidade->getCodigoHabilidade() == $codigoAtaque) {
                $danoDoAtaque += $habilidade->getDano();
                break;
            }
        }

        if ($danoAoZumbi == 0) {
            return "ERROU O ATAQUE";
        }

        if ($danoAoZumbi == $danoDoAtaque) {
            return "ACERTO COMUM";
        }

        if ($danoAoZumbi - 10 == $danoDoAtaque) {
            return "ACERTO EM PONTO FRACO";
        }

        return "TIPO DE ACERTO DESCONHECIDO";
    }
}
