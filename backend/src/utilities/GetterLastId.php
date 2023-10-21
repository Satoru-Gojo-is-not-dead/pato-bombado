<?php

namespace src\utilities;

class GetterLastId
{
    private \PDO $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getLastId(string $tableName): ?int
    {
        $query = "SELECT max(id) FROM $tableName";

        try {
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            $id = $stmt->fetch(\PDO::FETCH_ASSOC);

            if ($id == null) {
                throw new \Exception("Nenhum valor foi encontrado na tabela $tableName");
            }

            return $id["max(id)"];
        } catch (\PDOException $th) {
            throw new \Exception("Ocorreu um erro ao buscar o último id da tabela $tableName");
        }
    }
}
