<?php

session_start();
require_once('../auth/session.php');
// verifica se usuario esta autenticado
usuarioAutenticado();

// url do sistema
$url = $_SERVER['HTTP_HOST'] . '/ProjetoFinal';

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Projeto Final</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="http://<?=$url?>/public/css/bootstrap.min.css">
        <!-- Jasny Bootstrap - Biblioteca para upload de arquivos -->
        <link rel="stylesheet" href="http://<?=$url?>/public/css/jasny-bootstrap.min.css">
        
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="http://<?=$url?>/">Projeto Final</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="http://<?=$url?>/">Home</a></li>

                    <?php if(isset($_SESSION['auth'])): ?>
                    
                        <?php if($_SESSION['auth']['grupo'] == 'adm'): ?>
                        <li><a href="http://<?=$url?>/usuarios/">Usuários</a></li>
                        
                        <?php elseif($_SESSION['auth']['grupo'] == 'mantenedor'): ?>
                        <li><a href="#">Conteúdos</a></li>
                        <?php endif; ?>

                    <?php endif; ?>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['auth'])): ?>
                    
                    <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/ProjetoFinal/auth/auth-controller.php?action=logout">Logout</a></li>
                    
                    <?php else: ?>
                    
                    <li><a href="http://<?= $_SERVER['HTTP_HOST'] ?>/ProjetoFinal/auth/login-form.php">Login</a></li>

                    <?php endif; ?>
                </ul>
            </div>
        </nav>

