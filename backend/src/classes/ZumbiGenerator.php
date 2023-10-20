<?php

namespace src\classes;

use src\model\Hospedeiro;
use src\model\Zumbi;

class ZumbiGenerator {
    public function gerarZumbi(Hospedeiro $hospedeiro) : Zumbi {
        $idHospedeiro = $hospedeiro->getId();
        $forca = $this->definirForca($hospedeiro);
        $velocidade = $this->definirVelocidade($hospedeiro);
        $inteligencia = $this->definirInteligencia($hospedeiro);

        return new Zumbi(
            $idHospedeiro,
            $forca,
            $velocidade,
            $inteligencia,
        );
    }

    private function definirForca(Hospedeiro $hospedeiro) : int {
        $forca = 0;

        $idade = $hospedeiro->getIdade();
        $sexo = $hospedeiro->getSexo();
        $esportesPraticados = $hospedeiro->getEsportesPraticados();

        if ($idade <= 14) {
            $forca += 15;
        } else if ($idade <= 30) {
            $forca += 30;
        } else if ($idade <= 45) {
            $forca += 20;
        } else {
            $forca += 10;
        }

        if ($sexo == "Masculino") {
            $forca += 15;
        } else {
            $forca += 10;
        }

        if ($esportesPraticados != null && count($esportesPraticados) >= 1) {
            $forca += 10;
            if (in_array("futebol", $esportesPraticados)) {
                $forca += 20;
            }
        } else if ($esportesPraticados != null && count($esportesPraticados) >= 3) {
            $forca += 20;
            if (in_array("futebol", $esportesPraticados)) {
                $forca += 20;
            }
        }

        if ($forca > 100) {
            $forca = 100;
        }

        return $forca;
    }

    private function definirVelocidade(Hospedeiro $hospedeiro) : int {
        $velocidade = 0;

        $idade = $hospedeiro->getIdade();
        $peso = $hospedeiro->getPeso();
        $altura = $hospedeiro->getAltura();
        $esportesPraticados = $hospedeiro->getEsportesPraticados();

        if ($idade <= 35) {
            $velocidade += 30;
        } else {
            $velocidade += 15;
        }

        if ($peso <= 80) {
            $velocidade += 15;
        } else if ($peso <= 100) {
            $velocidade += 10;
        } else {
            $velocidade += 5;
        }

        if ($altura <= 1.75) {
            $velocidade += 15;
        } else {
            $velocidade += 8;
        }

        if ($esportesPraticados != null && count($esportesPraticados) >= 1) {
            $velocidade += 10;
            if (in_array("futebol", $esportesPraticados)) {
                $velocidade += 15;
            }
        }

        if ($velocidade > 100) {
            $velocidade = 100;
        }

        return $velocidade;
    }

    private function definirInteligencia(Hospedeiro $hospedeiro) : int {
        $inteligencia = 10;

        $idade = $hospedeiro->getIdade();
        $esportesPraticados = $hospedeiro->getEsportesPraticados();
        $jogoPreferido = $hospedeiro->getJogoPreferido();

        if ($idade <= 7) {
            $inteligencia += 5;
        } else {
            $inteligencia += 20;
        }

        if ($esportesPraticados != null && count($esportesPraticados) > 1) {
            $inteligencia += 10;

            if (in_array("tenis", $esportesPraticados)) {
                $inteligencia += 10;
            }
        }

        if ($jogoPreferido != null) {
            switch ($jogoPreferido) {
                case 'CrossFiring':
                    $inteligencia += 10;
                    break;
                case 'Roblox':
                    $inteligencia += 2;
                    break;
                case 'PUBG':
                    $inteligencia += 5;
                    break;
                case 'Minecraft':
                    $inteligencia += 35;
                    break;
                case 'Lost Ark':
                    $inteligencia += 12;
                    break;
                case 'Counter Strike':
                    $inteligencia += 15;
                    break;
                case 'League of Legends':
                    $inteligencia += 25;
                    break;
                case 'EA FC':
                    $inteligencia += 14;
                    break;
                
                default:
                    $inteligencia += 5;
                    break;
            }
        }

        if ($inteligencia > 100) {
            $inteligencia = 100;
        }

        return $inteligencia;
    }
}
