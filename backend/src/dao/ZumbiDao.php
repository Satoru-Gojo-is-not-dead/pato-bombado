<?php

namespace src\dao;

use src\model\Zumbi;
use src\utilities\ConversorArray;

class ZumbiDao
{
    private \PDO $conn;
    private ConversorArray $conversorArrayEmString;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
        $this->conversorArrayEmString = new ConversorArray();
    }

    public function insertZumbi(Zumbi $zumbi): bool
    {
        try {
            $query = "INSERT INTO Zumbi (
                idHospedeiro,
                forca,
                velocidade,
                inteligencia,
                hp
            ) VALUES (
                :idHospedeiro,
                :forca,
                :velocidade,
                :inteligencia,
                :hp
            )";

            $idHospedeiro = $zumbi->getIdHospedeiro();
            $forca = $zumbi->getForca();
            $velocidade = $zumbi->getVelocidade();
            $inteligencia = $zumbi->getInteligencia();
            $hp = $zumbi->getHp();

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":idHospedeiro", $idHospedeiro);
            $stmt->bindParam(":forca", $forca);
            $stmt->bindParam(":velocidade", $velocidade);
            $stmt->bindParam(":inteligencia", $inteligencia);
            $stmt->bindParam(":hp", $hp);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        }
    }

   

    /* public function getAllZumbis(): array
    {
        try {
            $query = "SELECT * FROM zumbi";

            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $dadosZumbis = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            return $dadosZumbis;
        } catch (\PDOException $th) {
            throw new \Exception($th->getMessage());
        } catch (\Exception $th) {
            throw new \Exception($th->getMessage());
        }
    } */
}
