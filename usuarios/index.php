<?php 
require_once('../partials/header.php'); 
require_once('usuarios-dao.php');
// verifica se e adm
verificaAdm();

$usuarios = all();
?>

<div class="container">
    <h1>Usuários</h1>
    
    <br>
    
    <a href="http://<?=$url?>/usuarios/criar-form.php" class="btn btn-primary">Cadastrar Usuário</a>
    
    <br>
    <br>
    
    <?php include('../partials/success.php'); ?>
    
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Grupo</th>
                <th>Ações</th>
            </tr>
        </thead>
        
        <tbody>
            <?php foreach($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id'] ?></td>
                <td><?= $usuario['nome'] ?></td>
                <td></td>
                <td>
                    <a href="http://<?=$url?>/usuarios/visualizar.php?id=<?=$usuario['id']?>" class="btn btn-default">Visualizar</a>
                    <a href="http://<?=$url?>/usuarios/editar-form.php?id=<?=$usuario['id']?>" class="btn btn-primary">Editar</a>
                    <a href="http://<?=$url?>/usuarios/usuarios-controller.php?id=<?=$usuario['id']?>&action=destroy" class="btn btn-danger">Deletar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        
        <tfoot>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Grupo</th>
                <th>Ações</th>
            </tr>
        </tfoot>
    </table>
</div>

<?php require_once('../partials/footer.php'); ?>