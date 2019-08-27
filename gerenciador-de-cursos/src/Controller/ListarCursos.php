<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCursos implements InterfaceControllerRequisicao
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
        $this->renderizaHtml("/cursos/listar-cursos.php", [
            "titulo" => "Lista de Cursos",
            "cursos" => $this->repositorioDeCursos->findAll()
        ]);
    }
}
