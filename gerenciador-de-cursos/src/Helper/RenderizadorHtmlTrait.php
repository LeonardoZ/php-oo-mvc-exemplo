<?php

namespace Alura\Cursos\Helper;

trait RenderizadorHtmlTrait {

  public function renderizaHtml(string $caminhoTemplate, $dados) : string
    {
        extract($dados);
    //    ob_start();
        require __DIR__ . "/../../view/" . $caminhoTemplate;
    //    $html = ob_get_clean();
                
        return "html";
    }

}