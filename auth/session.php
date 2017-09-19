<?php

// iniciando a sessao
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

/*
 * Funcao responsavel por verificar se usuario esta autenticado
 */
function usuarioAutenticado()
{
	$url = $_SERVER['HTTP_HOST'] . '/ProjetoFinal';
	// verifica se o usuario esta autenticado
	if(!isset($_SESSION['auth'])) {
	    header("Location: http://$url/auth/login-form.php");
	}
}

/*
 *
 */
function verificaAdm()
{
	$url = $_SERVER['HTTP_HOST'] . '/ProjetoFinal';
	// verifica se o usuario esta autenticado
	if($_SESSION['auth']['grupo'] != 'adm') {
	    header("Location: http://$url/");
	}
}