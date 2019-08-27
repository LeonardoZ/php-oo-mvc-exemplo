<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Helper\FlashMessageTrait;


/**
 * Description of RealizarLogin
 *
 * @author leonardoz
 */
class RealizarLogin implements InterfaceControllerRequisicao
{
    use FlashMessageTrait;

    private $repositorioDeUsuarios;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator)->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager->getRepository(Usuario::class);
    }

    //put your code here
    public function processaRequisicao(): void
    {
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

        if (is_null($email) || $email === false) {
            $this->defineMensagem("danger", "Email inválido.");
            header("Location: /login");

            return;
        }

        $senha = filter_input(INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING);

        $usuario = $this->repositorioDeUsuarios->findOneBy(['email' => $email]);

        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem("danger", "Email ou senha inválidos");
            header("Location: /login");
            return;
        }
        $_SESSION["logado"] = true;
        $_SESSION["usuario"] = $usuario;

        header("Location: /listar-cursos");
    }
}
