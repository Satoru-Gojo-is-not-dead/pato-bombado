<?php

use src\controller\GetAllHospedeirosController;
use src\dao\HospedeiroDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (!isset($conn)) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao buscar os hospedeiros aqui. Tenta de novo ai!";
    exit();
}

$hospedeiroDao = new HospedeiroDao($conn);

$getAllHospedeirosController = new GetAllHospedeirosController($hospedeiroDao);

try {
    $hospedeiros = $getAllHospedeirosController->getAllHospedeiros();

    http_response_code(200);
    echo json_encode($hospedeiros);
} catch (\Exception $th) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao buscar os hospedeiros aqui. Tenta de novo ai!";
    exit();
}
