<?php
use src\controller\GetZumbiController;
use src\dao\HospedeiroDao;
use src\dao\ZumbiDao;
use src\utilities\GetterLastId;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (!isset($conn)) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao buscar os hospedeiros aqui. Tenta de novo ai!";
    exit();
}

$hospedeiroDao = new HospedeiroDao($conn);
$zumbiDao = new ZumbiDao($conn);
$getterLastId = new GetterLastId($conn);

$getZumbiController = new GetZumbiController($hospedeiroDao, $zumbiDao, $getterLastId);

try {
    $zumbi = $getZumbiController->getZumbi();
    $getZumbiController->salvarZumbiNoBanco($zumbi);
    $getZumbiController->atribuirIdAoZumbi($zumbi);

    http_response_code(200);
    echo json_encode($getZumbiController->formarZumbiRetornoRequest($zumbi));
} catch (\Exception $e) {
    http_response_code(400);
    echo $e->getMessage();
}
