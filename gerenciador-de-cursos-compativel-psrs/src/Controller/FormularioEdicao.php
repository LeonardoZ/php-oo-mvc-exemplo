<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\RenderizadorHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderizadorHtmlTrait;

    private $repositorioDeCursos;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getQueryParams();
        $id = filter_var(
            $queryString['id'],
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            return new Response(302, ["Location" => "/listar-cursos"]);
        }

        $curso = $this->repositorioDeCursos->find($id);
        $html = $this->renderizaHtml("/cursos/formulario.php", [
            'titulo' => "Alterar Curso " . $curso->getDescricao(),
            'curso' => $curso,
        ]);
        return new Response(302, [], $html);
    }
}
