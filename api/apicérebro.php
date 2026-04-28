<?php
header('Content-Type: application/json; charset=utf-8');

// Captura a rota completa
$rota = trim($_SERVER['REQUEST_URI'], "/");
$partes = explode("/", $rota);

// A primeira parte depois de "api" é a pasta
$primeiraRota = strtolower($partes[1] ?? "");
$pasta = __DIR__ . "/" . $primeiraRota;
$caminhoCerebro = $pasta . "/cerebro.php";

// Se a pasta existir e tiver cerebro.php → executa
if ($primeiraRota !== "" && is_dir($pasta) && file_exists($caminhoCerebro)) {
    require $caminhoCerebro;
    exit;
}

// Se não encontrar rota → erro
echo json_encode([
    "erro" => "Rota inválida",
    "rota" => $primeiraRota
]);
exit;
