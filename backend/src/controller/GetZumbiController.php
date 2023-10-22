<?php

namespace src\controller;

use src\classes\ZumbiGenerator;
use src\dao\HospedeiroDao;
use src\dao\ZumbiDao;
use src\model\Zumbi;
use src\utilities\ArrayFormatterRequest;
use src\utilities\GetterLastId;
use src\utilities\HospedeiroCreator;

class GetZumbiController
{
    private HospedeiroDao $hospedeiroDao;
    private HospedeiroCreator $hospedeiroCreator;
    private ZumbiGenerator $zumbiGenerator;
    private ZumbiDao $zumbiDao;
    private GetterLastId $getterLastId;
    private ArrayFormatterRequest $arrayFormatterRequest;

    public function __construct(
        HospedeiroDao $hospedeiroDao, 
        ZumbiDao $zumbiDao,
        GetterLastId $getterLastId,
    )
    {
        $this->hospedeiroDao = $hospedeiroDao;
        $this->hospedeiroCreator = new HospedeiroCreator();
        $this->zumbiGenerator = new ZumbiGenerator();
        $this->zumbiDao = $zumbiDao;
        $this->getterLastId = $getterLastId;
        $this->arrayFormatterRequest = new ArrayFormatterRequest();
    }

    public function getZumbi(): Zumbi
    {
        try {
            $dadosHospedeiro = $this->hospedeiroDao->getHospedeiroAleatorio();

            if ($dadosHospedeiro == null) {
                throw new \Exception(
                    "Nenhum hospedeiro cadastrado! Para criar um zumbi é necessário pelo menos 1 hospedeiro",
                );
            }

            $hospedeiro = $this->hospedeiroCreator->criarHospedeiroModel($dadosHospedeiro);

            $zumbi = $this->zumbiGenerator->gerarZumbi($hospedeiro);

            return $zumbi;
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function salvarZumbiNoBanco(Zumbi $zumbi) {
        try {
            $zumbiFoiSalvo = $this->zumbiDao->insertZumbi($zumbi);

            if (!$zumbiFoiSalvo) {
                throw new \Exception("Ocorreu um erro ao salvar o zumbi! Tente novamente");
            }
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function atribuirIdAoZumbi(Zumbi $zumbi) {
        try {
            $id = $this->getterLastId->getLastId("zumbi");

            $zumbi->setId($id);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function formarZumbiRetornoRequest(Zumbi $zumbi) : array {
        return $this->arrayFormatterRequest->formarZumbiRetornoRequest($zumbi);
    }
}
