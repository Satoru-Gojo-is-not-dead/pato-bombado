<?php
use src\controller\GetZumbiController;

use src\controller\StartGameController;
use src\dao\PlayerDao;
use src\utilities\GetterLastId;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (!isset($conn) || !isset($_POST["nickName"])) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao iniciar o jogo!";
    exit();
}

$playerDao = new PlayerDao($conn);
$getterLastId = new GetterLastId($conn);

$startGameController = new StartGameController($playerDao, $getterLastId);

try {
    $player = $startGameController->getPlayer($_POST["nickName"]);

    http_response_code(200);
    echo json_encode($startGameController->formarPlayerRetornoRequest($player));
} catch (\Exception $e) {
    http_response_code(400);
    echo $e->getMessage();
}
