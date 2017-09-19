<?php

session_start();
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
                    <a class="navbar-brand" href="http://<?=$url?>/index.php">Projeto Final</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="http://<?=$url?>/index.php">Home</a></li>
                    
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

        <div class="container">
            Página inicial
        </div>

        <!-- Bootstrap JavaScript -->
        <script src="http://<?=$url?>/public/js/bootstrap.min.js"></script>
        <!-- Holder.js Biblioteca para manipular a imagem do upload -->
        <script src="http://<?=$url?>/public/js/holder.js"></script>
        <!-- Jasny Bootstrap JavaScript -->
        <script src="http://<?=$url?>/public/js/jasny-bootstrap.min.js"></script>

    </body>
</html>