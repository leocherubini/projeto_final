<?php

session_start();

require_once('../usuarios/usuarios-dao.php');

// url do sistema
$url = $_SERVER['HTTP_HOST'] . '/ProjetoFinal';

$usuario = $_POST['usuario'] ?? array();
$action = $_GET['action'];

if($action == 'login') {
	$dados = login($usuario);

	$_SESSION['auth'] = get_object_vars($dados);

	header("Location: http://$url/");
} elseif($action == 'logout') {
	session_destroy();

	header("Location: http://$url/");
}