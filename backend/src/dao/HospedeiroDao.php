<?php

namespace src\dao;

use src\model\Hospedeiro;
use src\utilities\ConversorArray;
use src\utilities\HospedeiroCreator;

class HospedeiroDao
{
    private \PDO $conn;
    private ConversorArray $conversorArrayEmString;
    private HospedeiroCreator $hospedeiroCreator;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
        $this->conversorArrayEmString = new ConversorArray();
        $this->hospedeiroCreator = new HospedeiroCreator();
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
                esportesPraticados,
                jogoPreferido
            ) VALUES (
                :idade,
                :sexo,
                :peso,
                :altura,
                :tipoSanguineo,
                :esportesPraticados,
                :jogoPreferido
            )";
            
            $idade = $hospedeiro->getIdade();
            $sexo = $hospedeiro->getSexo();
            $peso = $hospedeiro->getPeso();
            $altura = $hospedeiro->getAltura();
            $tipoSanguineo = $hospedeiro->getTipoSanguineo();
            $esportesPraticados = $this->getEsportesPraticados($hospedeiro->getEsportesPraticados());
            $jogoPreferido = $hospedeiro->getJogoPreferido();

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":idade", $idade);
            $stmt->bindParam(":sexo", $sexo);
            $stmt->bindParam(":peso", $peso);
            $stmt->bindParam(":altura", $altura);
            $stmt->bindParam(":tipoSanguineo", $tipoSanguineo);
            $stmt->bindParam(":esportesPraticados", $esportesPraticados);
            $stmt->bindParam(":jogoPreferido", $jogoPreferido);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function getHospedeiroAleatorio() : Hospedeiro {
        try {
            $query = "SELECT * FROM hospedeiro ORDER BY RAND() LIMIT 1";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $dadosHospedeiro = $stmt->fetch(\PDO::FETCH_ASSOC);

            $hospedeiro = $this->hospedeiroCreator->criarHospedeiroModel($dadosHospedeiro);

            return $hospedeiro;
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }

    }

    public function getAllHospedeiros() : array {
        try {
            $query = "SELECT * FROM hospedeiro";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $dadosHospedeiros = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $dadosHospedeiros;
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    }

    // helper
    private function getEsportesPraticados(?array $esportesPraticados) : ?string {
        return ($esportesPraticados != null) ? 
            $this->conversorArrayEmString->converterArrayEmString(
                $esportesPraticados
            ) : null;
    }
}
