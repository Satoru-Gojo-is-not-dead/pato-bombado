<?php
use src\controller\CadastrarHospedeiroController;
use src\dao\HospedeiroDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

if (
    !isset($_POST["idade"]) ||
    !isset($_POST["sexo"]) ||
    !isset($_POST["peso"]) ||
    !isset($_POST["altura"]) ||
    !isset($_POST["tipoSanguineo"]) ||
    !isset($_POST["esportesPraticados"]) ||
    !isset($_POST["jogoPreferido"]) ||
    !isset($conn)
) {
    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro  ao cadastrar o hospedeiro. Tenta de novo ai!";
    exit();
}

$idade = $_POST["idade"];
$sexo = $_POST["sexo"];
$peso = $_POST["peso"];
$altura = $_POST["altura"];
$tipoSanguineo = $_POST["tipoSanguineo"];
$esportesPraticados = $_POST["esportesPraticados"];
$jogoPreferido = $_POST["jogoPreferido"];

$hospedeiroDao = new HospedeiroDao($conn);

$cadastrarHospedeiroController = new CadastrarHospedeiroController($hospedeiroDao);

try {
    $hospedeiro = $cadastrarHospedeiroController->criarHospedeiroModel(
        $idade,
        $sexo,
        $peso,
        $altura,
        $tipoSanguineo,
        $esportesPraticados,
        $jogoPreferido,
    );

    $hospedeiroFoiSalvoNoBanco = $cadastrarHospedeiroController->salvarHospedeiroNoBanco($hospedeiro);

    if (!$hospedeiroFoiSalvoNoBanco) {
        http_response_code(400);
        echo "Oooopa meu consagrado(a), ocorreu um erro  ao cadastrar o hospedeiro. Tenta de novo ai!";
        exit();
    }

    http_response_code(200);
    echo "Hospedeiro cadastrado com sucesso!";
} catch (\Exception $e) {
    http_response_code(400);
    echo $e->getMessage();
    exit();
}
