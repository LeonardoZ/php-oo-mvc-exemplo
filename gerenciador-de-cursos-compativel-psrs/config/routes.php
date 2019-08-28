<?php

use Alura\Cursos\Controller\CursosEmJson;
use Alura\Cursos\Controller\CursosEmXml;
use Alura\Cursos\Controller\ExcluirCurso;
use Alura\Cursos\Controller\FormularioEdicao;
use Alura\Cursos\Controller\FormularioInsercao;
use Alura\Cursos\Controller\FormularioLogin;
use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Logout;
use Alura\Cursos\Controller\PersisteCurso;
use Alura\Cursos\Controller\RealizarLogin;

$rotas = [
    "/listar-cursos" => ListarCursos::class,
    "/novo-curso" => FormularioInsercao::class,
    "/salvar-curso" => PersisteCurso::class,
    "/excluir-curso" => ExcluirCurso::class,
    "/alterar-curso" => FormularioEdicao::class,
    "/login" => FormularioLogin::class,
    "/realiza-login" => RealizarLogin::class,
    "/logout" => Logout::class,
    "/buscarCursosEmJson" => CursosEmJson::class,
    "/buscarCursosEmXml" => CursosEmXml::class,
];
return $rotas;
