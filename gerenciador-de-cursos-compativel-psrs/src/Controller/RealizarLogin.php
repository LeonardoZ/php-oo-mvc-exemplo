<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Helper\FlashMessageTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $repositorioDeUsuarios;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = $request->getParsedBody()["email"];
        if (is_null($email) || $email === false) {
            $this->defineMensagem("danger", "Email inválido.");
            return new Response(302, ["Location" => "/login"]);
        }

        $senha = $request->getParsedBody()["senha"];
        $usuario = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem("danger", "Email ou senha inválidos");
            return new Response(302, ["Location" => "/login"]);
        }

        $_SESSION["logado"] = true;
        $_SESSION["usuario"] = $usuario;


        return new Response(302, ["Location" => "/listar-cursos"]);
    }
}
