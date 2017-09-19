<?php 

require_once('../partials/header.php');
// verifica se e adm
verificaAdm();

require_once('usuarios-dao.php');

$grupos = grupos();

?>

<div class="container">
    <h1>Cadastrar Usuário</h1>
    
    <br>
    
    <?php include('../partials/errors.php'); ?>
    
    <form method="post" action="http://<?=$url?>/usuarios/usuarios-controller.php?action=store"
        enctype="multipart/form-data">
        <label>Nome:</label>
        <input type="text" class="form-control" name="usuario[nome]">
        
        <br>
        
        <label>Email:</label>
        <input type="email" class="form-control" name="usuario[email]">
        
        <br>
        
        <label>Senha:</label>
        <input type="password" class="form-control" name="usuario[senha]">
        
        <br>
        
        <label>Confirmar senha:</label>
        <input type="password" class="form-control" name="usuario[senha_confirmar]">
        
        <br>
        
        <label>Descrição:</label>
        <textarea name="usuario[descricao]" class="form-control" rows="3"></textarea>
        
        <br>
        
        <label>Grupo:</label>
        <select name="usuario[grupo_id]" class="form-control">
            <?php foreach($grupos as $grupo): ?>
            <option value="<?= $grupo['id'] ?>"><?= $grupo['nome'] ?></option>
            <?php endforeach; ?>
        </select>
        
        <br>

        <!-- Input File Jasny -->
        <label>Imagem Perfil:</label>
        <br>
        <div class="fileinput fileinput-new" data-provides="fileinput">
          <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            <img src="holder.js/200x150" alt="...">
          </div>
          <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
          <div>
            <span class="btn btn-default btn-file">
                <span class="fileinput-new">Select image</span>
                <span class="fileinput-exists">Change</span>
                <input type="file" name="perfil">
            </span>
            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
          </div>
        </div>
        <!-- / Input File Jasny -->

        <br>
        <br>
        
        <input type="submit" value="Cadastrar" class="btn btn-primary">
        
    </form>
</div>

<?php require_once('../partials/footer.php'); ?>

