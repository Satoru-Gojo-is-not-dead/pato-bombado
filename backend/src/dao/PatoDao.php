<?php

namespace src\dao;

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
                    p.hp, 
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
            throw new \Exception($th->getMessage());
        }
    }
}
