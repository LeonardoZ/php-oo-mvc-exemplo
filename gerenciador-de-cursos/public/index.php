<?php

use Alura\Cursos\Controller\InterfaceControllerRequisicao;

require __DIR__ . '/../vendor/autoload.php';

$caminho = $_SERVER["PATH_INFO"];
$rotas = require __DIR__ . '/../config/routes.php';
$whitelist = ["/login", "/realiza-login"];

if (!array_key_exists($caminho, $rotas)) {
    echo "Not found";
    http_response_code(404);
    exit();
}

session_start();

$ehRotaLivre = in_array($caminho, $whitelist);

if (!$ehRotaLivre && !isset($_SESSION["logado"])) {
    header("Location: /login");
    exit();
}

$classeControladora = $rotas[$caminho];

/** @var InterfaceControllerRequisicao $controlador */
$controlador = new $classeControladora();
$controlador->processaRequisicao();
