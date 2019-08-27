<?php

use Alura\Cursos\Controller\InterfaceControllerRequisicao;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

require __DIR__ . '/../vendor/autoload.php';

$caminho = $_SERVER["PATH_INFO"];
$rotas = require __DIR__ . '/../config/routes.php';

/** @var ContainerInterface */
$container = require __DIR__ . '/../config/dependencies.php';

if (!array_key_exists($caminho, $rotas)) {
    echo "Not found";
    http_response_code(404);
    exit();
}

session_start();

$psr17Factory = new \Nyholm\Psr7\Factory\Psr17Factory();

$creator = new \Nyholm\Psr7Server\ServerRequestCreator(
    $psr17Factory, // ServerRequestFactory
    $psr17Factory, // UriFactory
    $psr17Factory, // UploadedFileFactory
    $psr17Factory // StreamFactory
);

$serverRequest = $creator->fromGlobals();

$classeControladora = $rotas[$caminho];

/** @var RequestHandlerInterface $controlador */
$controlador = $container->get($classeControladora);
$resposta = $controlador->handle($serverRequest);

foreach ($resposta->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf("%s: %s", $name, $value), false);
    }
}
echo $resposta->getBody();
