<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao  implements InterfaceControllerRequisicao
{
    use RenderizadorHtmlTrait;
    
    private $repositorioDeCursos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

        if (is_null($id) || $id === false) {
            header("Location: /listar-cursos", false, 302);
            return;
        }

        $curso = $this->repositorioDeCursos->find($id);
        $this->renderizaHtml("/cursos/formulario.php", [
            'titulo' => "Alterar Curso " . $curso->getDescricao(),
            'curso' => $curso
        ]);
    }
}
