<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Infra\EntityManagerCreator;

/**
 * Description of RealizarLogin
 *
 * @author leonardoz
 */
class Logout implements InterfaceControllerRequisicao
{

    public function processaRequisicao(): void
    {
        session_destroy();
        header("Location: /login");
    }
}
