<?php

namespace Alura\Cursos\Controller;

class Logout implements InterfaceControllerRequisicao
{
    public function processaRequisicao(): void
    {
        session_destroy();
        header("Location: /login");
    }
}
