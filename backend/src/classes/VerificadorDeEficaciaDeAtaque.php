<?php

namespace src\classes;

class VerificadorDeEficaciaDeAtaque
{
    public function ataqueIsEficienteVSZumbi(
        string $habilidadePredominanteZumbi,
        int $codigoAtaquePato,
    ): bool {
        switch ($habilidadePredominanteZumbi) {
            case 'FORCA':
                return $this->verificarSeAtaqueIsEficienteContraForca($codigoAtaquePato);
            case 'VELOCIDADE':
                return $this->verificarSeAtaqueIsEficienteContraVelocidade($codigoAtaquePato);
            case 'INTELIGENCIA':
                return $this->verificarSeAtaqueIsEficienteContraInteligencia($codigoAtaquePato);
            case 'GANADO':
                return false;
            default:
                return false;
        }
    }

    private function verificarSeAtaqueIsEficienteContraForca(int $codigoAtaquePato): bool
    {
        switch ($codigoAtaquePato) {
            case "1":
                return false;
            case "2":
                return false;
            case "3":
                return true;
            case "4":
                return true;
            case "5":
                return false;
            case "6":
                return true;
            case "7":
                return false;
            case "8":
                return true;
            case "9":
                return false;
            case "10":
                return false;
            case "11":
                return false;
            case "12":
                return true;
            case "13":
                return true;
            case "14":
                return false;
            case "15":
                return false;
            case "16":
                return true;
            default:
                return false;
        }
    }

    private function verificarSeAtaqueIsEficienteContraVelocidade(int $codigoAtaquePato): bool
    {
        switch ($codigoAtaquePato) {
            case "1":
                return true;
            case "2":
                return false;
            case "3":
                return false;
            case "4":
                return true;
            case "5":
                return true;
            case "6":
                return false;
            case "7":
                return true;
            case "8":
                return false;
            case "9":
                return true;
            case "10":
                return false;
            case "11":
                return false;
            case "12":
                return true;
            case "13":
                return false;
            case "14":
                return false;
            case "15":
                return true;
            case "16":
                return false;
            default:
                return false;
        }
    }

    private function verificarSeAtaqueIsEficienteContraInteligencia(int $codigoAtaquePato): bool
    {
        switch ($codigoAtaquePato) {
            case "1":
                return true;
            case "2":
                return true;
            case "3":
                return false;
            case "4":
                return false;
            case "5":
                return false;
            case "6":
                return true;
            case "7":
                return false;
            case "8":
                return true;
            case "9":
                return false;
            case "10":
                return true;
            case "11":
                return false;
            case "12":
                return false;
            case "13":
                return true;
            case "14":
                return true;
            case "15":
                return false;
            case "16":
                return true;
            default:
                return false;
        }
    }

}
