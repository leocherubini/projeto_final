<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

function validarNome(string $nome)
{
    if(strlen(utf8_decode($nome)) < 5) {
        $_SESSION['errors'][] = "O nome $nome deve possuir mais que 5 caracteres";
    }
}

function validarEmail(string $email)
{
	if($email == '') {
		$_SESSION['errors'][] = "O campos E-mail não pode ser vazio";
	}
}

function validarSenha(string $senha, string $senhaConfirmar)
{
	if(strlen(utf8_decode($senha)) < 6) {
		$_SESSION['errors'][] = "O campo Senha deve possuir mais que 6 caracteres";
	}

	if(strlen(utf8_decode($senhaConfirmar)) < 6) {
		$_SESSION['errors'][] = "O campo Confirmar Senha deve possuir mais que 6 caracteres";
	}

	if($senha !== $senhaConfirmar) {
		$_SESSION['errors'][] = "Os campos Senha e Confirmar Senha devem ser iguais";
	}
}

/*
 * As senha podem ser vazias
 * a unica validacao e se sao iguais
 */
function validarSenhaEditar(string $senha, string $senhaConfirmar)
{
	if((strlen(utf8_decode($senha)) >= 1) && (strlen(utf8_decode($senha)) < 6)) {
		$_SESSION['errors'][] = "O campo Senha deve possuir mais que 6 caracteres";
	}

	if((strlen(utf8_decode($senhaConfirmar)) >= 1) && (strlen(utf8_decode($senhaConfirmar)) < 6)) {
		$_SESSION['errors'][] = "O campo Senha deve possuir mais que 6 caracteres";
	}

	if($senha !== $senhaConfirmar) {
		$_SESSION['errors'][] = "Os campos Senha e Confirmar Senha devem ser iguais";
	}
}

function existeErro() : bool
{
    return isset($_SESSION['errors']);
}

function success(string $nome)
{
    $_SESSION['success'] = $nome;
}

function gerarErro(string $mensagem)
{
	$_SESSION['errors'][] = $mensagem;
}