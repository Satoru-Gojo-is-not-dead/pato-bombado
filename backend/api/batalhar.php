<?php

use src\controller\BatalharController;
use src\dao\PatoDao;
use src\dao\PlayerDao;
use src\dao\ZumbiDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (
    !isset($conn) || 
    !isset($data["idPato"]) ||
    !isset($data["idZumbi"]) ||
    !isset($data["idPlayer"]) ||
    !isset($data["codigoAtaque"])
) {
    http_response_code(400);
    echo "
        Oooopa meu consagrado(a), 
        ocorreu um erro ao realizar o ataque! 
        Tenta de novo ai pra ver se funciona
    ";
    exit();
}

$playerDao = new PlayerDao($conn);
$patoDao = new PatoDao($conn);
$zumbiDao = new ZumbiDao($conn);

$batalharController = new BatalharController($playerDao, $patoDao, $zumbiDao);

try {
   $player = $batalharController->getPlayer($data["idPlayer"]);
   $pato = $batalharController->getPato($data["idPato"]);
   $zumbi = $batalharController->getZumbi($data["idZumbi"]);

   $arrayRetorno = $batalharController->batalhar($player, $pato, $zumbi, $data["codigoAtaque"]);

   http_response_code(200);
   echo json_encode($arrayRetorno);
} catch (\Exception $e) {
    http_response_code(400);
    echo $e->getMessage();
}
