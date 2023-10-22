<?php

use src\controller\BatalharController;
use src\dao\PatoDao;
use src\dao\PlayerDao;
use src\dao\ZumbiDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (
    !isset($conn) || 
    !isset($_POST["idPato"]) ||
    !isset($_POST["idZumbi"]) ||
    !isset($_POST["idPlayer"]) ||
    !isset($_POST["codigoAtaque"])
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
   $player = $batalharController->getPlayer($_POST["idPlayer"]);
   $pato = $batalharController->getPato($_POST["idPato"]);
   $zumbi = $batalharController->getZumbi($_POST["idZumbi"]);

   $arrayRetorno = $batalharController->batalhar($player, $pato, $zumbi, $_POST["codigoAtaque"]);

   http_response_code(200);
   echo json_encode($arrayRetorno);
} catch (\Exception $e) {
    http_response_code(400);
    echo $e->getMessage();
}
