<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Helper\FlashMessageTrait;


class PersisteCurso implements InterfaceControllerRequisicao
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $descricao = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);

        $curso = new Curso();
        $curso->setDescricao($descricao);

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT);

        if (!is_null($id) && $id !== false) {
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->defineMensagem("success", "Curso atualizado com sucesso");
        } else {
            $this->entityManager->persist($curso);
            $this->defineMensagem("success", "Curso inserido com sucesso");
        }

        $this->entityManager->flush();
        header("Location: /listar-cursos", false, 302);
    }
}
