<?php

namespace src\classes;

class VerificadorDeEscudoPato
{
    public function escudoSeraAtivado() : bool {
        $chanceDoEscudoSerAtivado = rand(1, 5);

        if ($chanceDoEscudoSerAtivado == 4) {
            return true;
        }

        return false;
    }
}
