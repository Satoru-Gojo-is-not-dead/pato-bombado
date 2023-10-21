<?php
use src\controller\GetPatoController;
use src\dao\PatoDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (!isset($conn)) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao buscar os patos aqui. Tenta de novo ai!";
    exit();
}

$patoDao = new PatoDao($conn);

$getPatoController = new GetPatoController($patoDao);

try {
    $patos = [];

    for ($i = 1; $i <= 4 ; $i++) { 
        $pato = $getPatoController->getPato($i);
        $patoJson = $getPatoController->formarPatoRetornoRequest($pato);

        array_push($patos, $patoJson);
    }

    http_response_code(200);
    echo json_encode($patos);
} catch (\Exception $e) {
    http_response_code(400);
    echo $e->getMessage();
}
