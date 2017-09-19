<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('usuarios-dao.php');
require_once('usuarios-validation.php');

// url do sistema
$url = $_SERVER['HTTP_HOST'] . '/ProjetoFinal';

$usuario = $_POST['usuario'] ?? array();
$id = (int) ($_GET['id'] ?? 0);
$action = $_GET['action'];
$dadosImagem = $_FILES['perfil'] ?? array();

if($action == 'store') {

    validarNome($usuario['nome']);

    validarEmail($usuario['email']);

    validarSenha($usuario['senha'], $usuario['senha_confirmar']);

    if(existeErro()) {

        header("Location: http://$url/usuarios/criar-form.php");
    } elseif(!store($usuario, $dadosImagem)) {
    	// gera um erro customisavel 
    	gerarErro("Ocorreu erro na inserção dos dados!");

        header("Location: http://$url/usuarios/criar-form.php");
        
    } else {
        success("O usuário ".$usuario['nome']." foi cadastrado com sucesso");

        header("Location: http://$url/usuarios/");
    }
} elseif($action == 'destroy') {
    // apaga o registro
    destroy($id);

    success("O usuário foi deletado com sucesso");

    header("Location: http://$url/usuarios/");

} elseif($action == 'update') {
    validarNome($usuario['nome']);

    validarEmail($usuario['email']);

    validarSenhaEditar($usuario['senha'], $usuario['senha_confirmar']);

    if(existeErro()) {

    } elseif(!update($usuario, $dadosImagem, $id)) {
        // gera um erro customisavel 
        gerarErro("Ocorreu erro na inserção dos dados!");

        header("Location: http://$url/usuarios/criar-form.php");
    } else {
        success("O usuário ".$usuario['nome']." foi editado com sucesso");

        header("Location: http://$url/usuarios/");
    }
}