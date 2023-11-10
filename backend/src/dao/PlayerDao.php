<?php

namespace src\dao;

use src\model\Player;

class PlayerDao
{
    private \PDO $conn;

    public function __construct(\PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getPlayer(string $nickName): ?array
    {
        try {
            $query = "SELECT * FROM player WHERE nickName = :nickName LIMIT 1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nickName", $nickName);
            $stmt->execute();

            $dadosPlayer = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!is_array($dadosPlayer)) {
                return null;
            }

            return $dadosPlayer;
        } catch (\PDOException $th) {
            throw new \Exception("Ocorreu um erro ao buscar o player! Tente novamente");
        }
    }

    public function getPlayerPorId(int $id): ?array
    {
        try {
            $query = "SELECT * FROM player WHERE id = :id LIMIT 1";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $dadosPlayer = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!is_array($dadosPlayer)) {
                return null;
            }

            return $dadosPlayer;
        } catch (\PDOException $th) {
            throw new \Exception("Ocorreu um erro ao buscar o player! Tente novamente");
        }
    }

    public function insertPlayer(Player $player): bool
    {
        try {
            $query = "INSERT INTO player (nickName, nivel) VALUES (:nickName, :nivel)";

            $nickName = $player->getNickName();
            $nivel = $player->getNivel();

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":nickName", $nickName);
            $stmt->bindParam(":nivel", $nivel);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $th) {
            throw new \Exception("Ocorreu um erro ao criar o player! Tente novamente");
        }
    }

    public function updatePlayer(Player $player): bool
    {
        try {
            $query = "UPDATE player SET nivel = :nivel WHERE id = :id";

            $nivel = $player->getNivel();
            $id = $player->getId();

            $nivel++;

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":nivel", $nivel);
            $stmt->bindParam(":id", $id);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $th) {
    
            throw new \Exception("Ocorreu um erro ao atualizar as informações do player! Tente novamente");
        }
    }

    public function resetarNivel(String $nickName): bool
    {
        try {
            $query = "UPDATE player SET nivel = 1 WHERE nickName = :nickName";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(":nickName", $nickName);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true;
            }

            return false;
        } catch (\PDOException $th) {
    
            throw new \Exception("Ocorreu um erro ao atualizar as informações do player! Tente novamente");
        }
    }
}
