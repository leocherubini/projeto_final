<?php 

require_once('../partials/header.php'); 
// verifica se e adm
verificaAdm();
require_once('usuarios-dao.php');

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
    <h1>Usuário <?=$usuario['nome']?></h1>
    
    <ul class="list-group">
      <li class="list-group-item">Nome: <?=$usuario['nome']?></li>
      <li class="list-group-item">E-mail: <?=$usuario['email']?></li>
      <li class="list-group-item">Imagem: 
        <img src="<?=$src?>" alt="..." class="img-rounded">
      </li>
    </ul>

    <a href="http://<?=$url?>/usuarios/" class="btn btn-default">Voltar</a>
</div>

<?php require_once('../partials/footer.php'); ?>

