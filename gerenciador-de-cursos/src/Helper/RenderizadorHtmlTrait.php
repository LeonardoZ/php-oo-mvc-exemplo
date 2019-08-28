<?php

namespace Alura\Cursos\Helper;

trait RenderizadorHtmlTrait
{
    public function renderizaHtml(string $caminhoTemplate, $dados): string
    {
        extract($dados);
        ob_start();
        include __DIR__ . "/../../view/" . $caminhoTemplate;
        $html = ob_get_contents();
        return $html;
    }
}
