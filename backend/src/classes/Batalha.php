<?php

namespace src\classes;

use src\model\HabilidadePato;
use src\model\Pato;
use src\model\Player;
use src\model\Zumbi;

class Batalha
{
    private CalculadoraDeDano $calculadoraDeDano;
    private ZumbiGenerator $zumbiGenerator;
    private VerificadorDeEficaciaDeAtaque $verificadorDeEficaciaDeAtaque;
    private VerificadorDeEscudoPato $verificadorDeEscudoPato;

    public function __construct()
    {
        $this->calculadoraDeDano = new CalculadoraDeDano();
        $this->zumbiGenerator = new ZumbiGenerator();
        $this->verificadorDeEficaciaDeAtaque = new VerificadorDeEficaciaDeAtaque();
        $this->verificadorDeEscudoPato = new VerificadorDeEscudoPato();
    }

    // PATO
    public function atacarZumbi(
        Player $player,
        Pato $pato,
        Zumbi $zumbi,
        int $codigoAtaqueASerExecutado
    ): int {
        if ($pato->getEscudoEstaAtivo()) {
            $pato->desativarEscudoPato();
        }

        $habilidadePredominanteZumbi = $this->zumbiGenerator->definirHabilidadePredominante($zumbi);

        $ataqueIsEficienteContraZumbi = $this->verificadorDeEficaciaDeAtaque->ataqueIsEficienteVSZumbi(
            $habilidadePredominanteZumbi,
            $codigoAtaqueASerExecutado
        );

        $ataqueASerDado = $this->getAtaqueASerDado($codigoAtaqueASerExecutado, $pato);

        if ($ataqueASerDado == null) {
            throw new \Exception("OOPA, esse pato não possui o ataque desejado! Escolha um válido");
        }

        $danoASerDado = $this->calculadoraDeDano->calcularDanoAoZumbi(
            $ataqueASerDado->getDano(),
            $ataqueIsEficienteContraZumbi
        );

        $this->atualizarInformacoesPersonagensPosAtaquePato(
            $zumbi,
            $pato,
            $danoASerDado,
        );

        return $danoASerDado;
    }

    private function getAtaqueASerDado(int $codigoAtaqueASerExecutado, Pato $pato): ?HabilidadePato
    {
        $habilidadesPato = $pato->getHabilidadesPato();

        foreach ($habilidadesPato as $habilidade) {
            if ($habilidade->getCodigoHabilidade() == $codigoAtaqueASerExecutado) {
                return $habilidade;
            }
        }

        return null;
    }

    private function atualizarInformacoesPersonagensPosAtaquePato(
        Zumbi $zumbi,
        Pato $pato,
        int $danoASerDado,
    ) {
        $zumbi->reduzirHp($danoASerDado);

        $escudoPatoFoiAtivado = $this->verificadorDeEscudoPato->escudoSeraAtivado();

        if ($escudoPatoFoiAtivado) {
            $pato->ativarEscudoPato();
        }
    }

    // ZUMBI
    public function atacarPato(
        Player $player,
        Pato $pato,
        Zumbi $zumbi,
    ) : int {
        if ($pato->getEscudoEstaAtivo()) {
            return 0;
        }

        $danoASerDado = $this->calculadoraDeDano->calcularDanoAoPato();

        $pato->reduzirHp($danoASerDado);

        return $danoASerDado;
    }
}
