<?php

namespace src\dao;
use src\model\Pato;

class PatoDao
{
    private \PDO $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getPato(int $patoId): ?array
    {
        try {
            $query = "
                SELECT 
                    p.id, 
                    p.nome, 
                    p.healthPoints, 
                    p.escudoEstaAtivo, 
                    hp.codigoHabilidade, 
                    hp.nomeHabilidade, 
                    hp.dano
                FROM pato as p INNER JOIN habilidades_pato as hp
                ON p.id = hp.idPato
                WHERE p.id = :id LIMIT 4
            ";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $patoId);
            $stmt->execute();

            $dadosPato = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if (!is_array($dadosPato)) {
                return null;
            }

            return $dadosPato;
        } catch (\PDOException $th) {
            throw new \Exception("Ocorreu um erro ao buscar o pato! Tente novamente");
        }
    }

    public function updatePato(Pato $pato) : bool {
        try {
            $query = "UPDATE pato SET escudoEstaAtivo = :escudoEstaAtivo, healthPoints = :healthPoints WHERE id = :id";

            $hp = $pato->getHp();
            $escudoEstaAtivo = ($pato->getEscudoEstaAtivo()) ? "1" : "0";
            $id = $pato->getId();

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":healthPoints", $hp);
            $stmt->bindParam(":escudoEstaAtivo", $escudoEstaAtivo);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $th) {
            throw new \Exception("Ocorreu um erro ao atualizar as informações do pato! Tente novamente");
        }
    }
}
