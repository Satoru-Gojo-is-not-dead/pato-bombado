<?php

use src\dao\PlayerDao;
use src\model\Player;

require_once("../helpers/autoload.php");
require_once("../helpers/connection.php");

header('Content-Type: application/json');

$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);

if (
  !isset($conn) ||
  !isset($data['nickname']) ||
  !isset($data['nivel']) ||
  !isset($data['id'])
) {
  echo "Oooopa meu consagrado(a), ocorreu um erro ao passar de nível aqui. Tenta de novo ai!";
  exit();
}
try {
  $playerDao = new PlayerDao($conn);
  $player =  new Player($data['id'], $data['nickname'], $data['nivel']);

  $result = $playerDao->updatePlayer($player);

  http_response_code(200);
} catch (\Exception $th) {
  http_response_code(400);
  echo $th->getMessage();
  exit();
}
