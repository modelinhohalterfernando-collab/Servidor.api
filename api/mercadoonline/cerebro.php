<?php

header('Content-Type: application/json; charset=utf-8');

// Captura a URL completa
$rota = trim($_SERVER['REQUEST_URI'], "/");

// Divide em partes
$partes = explode("/", $rota);

// A primeira parte é o nome da pasta (investsmart, mercadoonline, lojaonline)
$pasta = strtolower($partes[0]);

// A segunda parte é o arquivo que queremos abrir
$arquivo = $partes[1] ?? "";

// Se não houver arquivo → rota raiz da pasta
if ($arquivo === "") {
    echo json_encode([
        "status" => "ok",
        "pasta" => $pasta,
        "mensagem" => "Rota principal da pasta"
    ]);
    exit;
}

// Caminho do arquivo PHP dentro da mesma pasta
$caminhoArquivo = __DIR__ . "/" . $arquivo . ".php";

// Se o arquivo existir → incluir
if (file_exists($caminhoArquivo)) {
    require $caminhoArquivo;
    exit;
}

// Se não existir → erro
echo json_encode([
    "erro" => "Arquivo não encontrado",
    "pasta" => $pasta,
    "arquivo" => $arquivo
]);
exit;
