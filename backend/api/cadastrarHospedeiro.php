<?php
use src\controller\CadastrarHospedeiroController;
use src\dao\HospedeiroDao;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (
    !isset($data["idade"]) ||
    !isset($data["sexo"]) ||
    !isset($data["peso"]) ||
    !isset($data["altura"]) ||
    !isset($data["tipoSanguineo"]) ||
    !isset($data["esportesPraticados"]) ||
    !isset($data["jogoPreferido"]) ||
    !isset($conn)
) {

    http_response_code(400);
    echo "Oooopa meu consagrado(a), ocorreu um erro  ao cadastrar o hospedeiro. Tenta de novo ai!";
    exit();
}
$idade = $data["idade"];
$sexo = $data["sexo"];
$peso = $data["peso"];
$altura = $data["altura"];
$tipoSanguineo = $data["tipoSanguineo"];
$esportesPraticados = $data["esportesPraticados"];
$jogoPreferido = $data["jogoPreferido"];

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
