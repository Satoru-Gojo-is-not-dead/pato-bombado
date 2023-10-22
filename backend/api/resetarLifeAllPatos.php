<?php

use src\dao\PatoDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (!isset($conn)) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro ao resetar a vida dos patos. Tenta de novo ai!";
    exit();
}

$patoDao = new PatoDao($conn);

try {
    $vidasForamResetadas = $patoDao->resetarVidaPatos();

    if (!$vidasForamResetadas) {
        http_response_code(400);
        echo "Vidas não resetadas! Tente novamente";
        exit();
    }

    http_response_code(200);
    echo true;
} catch (\Exception $th) {
    http_response_code(400);
    echo $th->getMessage();
    exit();
}
