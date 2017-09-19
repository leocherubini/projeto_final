<?php 

require_once('../partials/header.php'); 
// verifica se e adm
verificaAdm();
require_once('usuarios-dao.php');

$grupos = grupos();
$id = (int) $_GET['id'];
// retorna o usuario a partir do id
// url do sistema
$url = $_SERVER['HTTP_HOST'] . '/ProjetoFinal';
$usuario = findById($id);
// caminho da imagem do perfil se existir
if($usuario['perfil'] == '') {
    $src = '';
} else {
    $src = "http://$url/public/uploads/perfil/".$usuario['id']."-".$usuario['perfil'];
}

?>

<div class="container">
    <h1>Editar Usuário</h1>
    
    <br>
    
    <?php include('../partials/errors.php'); ?>
    
    <form method="post" action="http://<?=$url?>/usuarios/usuarios-controller.php?action=update&id=<?=$id?>"
        enctype="multipart/form-data">

        <label>Nome:</label>
        <input type="text" class="form-control" name="usuario[nome]" value="<?=$usuario['nome']?>">
        
        <br>
        
        <label>Email:</label>
        <input type="email" class="form-control" name="usuario[email]" value="<?=$usuario['email']?>">
        
        <br>
        
        <label>Senha:</label>
        <input type="password" class="form-control" name="usuario[senha]">
        
        <br>
        
        <label>Confirmar senha:</label>
        <input type="password" class="form-control" name="usuario[senha_confirmar]">
        
        <br>
        
        <label>Descrição:</label>
        <textarea name="usuario[descricao]" class="form-control" rows="3"><?=$usuario['nome']?></textarea>
        
        <br>
        
        <label>Grupo:</label>
        <select name="usuario[grupo_id]" class="form-control">
            <?php foreach($grupos as $grupo): ?>
                <?php if($grupo['id'] == $usuario['grupo_id']): ?>
                    <option value="<?= $grupo['id'] ?>" selected><?= $grupo['nome'] ?></option>
                <?php else: ?>
                    <option value="<?= $grupo['id'] ?>"><?= $grupo['nome'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        
        <br>

        <!-- Input File Jasny -->
        <label>Imagem Perfil:</label>
        <br>
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <?php if($usuario['perfil'] == ''): ?>
            <img src="holder.js/200x150" alt="...">
            <?php else: ?>
            <img src="<?=$src?>" alt="...">
            <?php endif; ?>
          </div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
          <div>
            <span class="btn btn-default btn-file">
                <span class="fileinput-new">Select image</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="perfil">
                <!-- Campo ocuto para se nenhum perfil for selecionado -->
                <input type="hidden" name="perfil_null" value="<?=$usuario['perfil']?>">
            </span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
        </div>
        <!-- / Input File Jasny -->

        <br>
        <br>
        
        <input type="submit" value="Editar" class="btn btn-primary">
        
    </form>
</div>

<?php require_once('../partials/footer.php'); ?>

