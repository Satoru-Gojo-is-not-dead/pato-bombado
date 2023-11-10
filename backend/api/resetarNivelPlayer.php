<?php

use src\dao\PlayerDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (!isset($conn) || !isset($data["nickName"])) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao resetar o nivel do jogador. Tenta de novo ai!";
    exit();
}

$playerDao = new PlayerDao($conn);

try {
    $nivelFoiResetado = $playerDao->resetarNivel($data["nickName"]);

    if (!$nivelFoiResetado) {
        http_response_code(400);
        echo "Nível não resetado! Tente novamente";
        exit();
    }

    http_response_code(200);
    echo true;
} catch (\Exception $th) {
    http_response_code(400);
    echo $th->getMessage();
    exit();
}
