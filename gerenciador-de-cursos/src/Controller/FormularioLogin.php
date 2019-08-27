<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Helper\RenderizadorHtmlTrait;

class FormularioLogin implements InterfaceControllerRequisicao
{
    use RenderizadorHtmlTrait;
    
    public function processaRequisicao(): void
    {
        $this->renderizaHtml("/login/formulario.php", [
           "titulo" => "Login"
        ]);
    }
}
