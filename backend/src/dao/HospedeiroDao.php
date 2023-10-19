<?php

namespace src\dao;

use src\model\Hospedeiro;
use src\utilities\ConversorArray;

class HospedeiroDao
{
    private \PDO $conn;
    private ConversorArray $conversorArrayEmString;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
        $this->conversorArrayEmString = new ConversorArray();
    }

    public function insertHospedeiro(Hospedeiro $hospedeiro): bool
    {
        try {
            $query = "INSERT INTO hospedeiro (
                idade,
                sexo,
                peso,
                altura,
                tipoSanguineo,
                gostosMusicais,
                esportesPraticados,
                jogoPreferido
            ) VALUES (
                :idade,
                :sexo,
                :peso,
                :altura,
                :tipoSanguineo,
                :gostosMusicais,
                :esportesPraticados,
                :jogoPreferido
            )";

            $idade = $hospedeiro->getIdade();
            $sexo = $hospedeiro->getSexo();
            $peso = $hospedeiro->getPeso();
            $altura = $hospedeiro->getAltura();
            $tipoSanguineo = $hospedeiro->getTipoSanguineo();
            $gostosMusicais = $this->conversorArrayEmString->converterArrayEmString($hospedeiro->getGostosMusicais());
            $esportesPraticados = $this->conversorArrayEmString->converterArrayEmString($hospedeiro->getEsportesPraticados());
            $jogoPreferido = $hospedeiro->getJogoPreferido();

            //var_dump(explode(",", $gostosMusicais));

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":idade", $idade);
            $stmt->bindParam(":sexo", $sexo);
            $stmt->bindParam(":peso", $peso);
            $stmt->bindParam(":altura", $altura);
            $stmt->bindParam(":tipoSanguineo", $tipoSanguineo);
            $stmt->bindParam(":gostosMusicais", $gostosMusicais);
            $stmt->bindParam(":esportesPraticados", $esportesPraticados);
            $stmt->bindParam(":jogoPreferido", $jogoPreferido);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
            throw new \Exception($th->getMessage());
        }
    }
}
