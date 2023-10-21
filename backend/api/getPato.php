<?php
use src\controller\GetPatoController;
use src\dao\PatoDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (!isset($conn) || !isset($_GET["idPato"])) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao buscar o pato aqui. Tenta de novo ai!";
    exit();
}

$patoDao = new PatoDao($conn);

$getPatoController = new GetPatoController($patoDao);

try {
    $pato = $getPatoController->getPato($_GET["idPato"]);
    
    http_response_code(200);
    echo json_encode($getPatoController->formarPatoRetornoRequest($pato));
} catch (\Exception $e) {
    http_response_code(400);
    echo $e->getMessage();
}
