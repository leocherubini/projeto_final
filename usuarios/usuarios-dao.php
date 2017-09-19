<?php

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

function connection() : PDO
{
    // configuracoes do arquivo config.php
    $config = require('../config.php');
    // credenciais do Bando de Dados
    $database = $config['database'];

    try {
        $conn = new PDO(
            $database['driver'].":host=".$database['host'].";dbname=".$database['dbname'], 
            $database['user'], $database['password']
        );

        $conn->exec("set names utf8");

    } catch (PDOException $e) {
        echo "Erro de conexão: $e";
        exit();
    }
    
    return $conn;
}

function login(array $usuario)
{
    // configuracoes do arquivo config.php
    $config = require('../config.php');
    // chave de protecao para criptografia
    $hash = $config['APP'];
    $usuario['senha'] = md5($hash['APP'].$usuario['senha']);

    $conn = connection();
    $sql = "SELECT u.id, u.nome as nome, g.slug as grupo "
        . "FROM usuarios as u "
        . "INNER JOIN grupos as g "
        . "ON u.grupo_id = g.id "
        . "WHERE u.email = ? AND u.senha = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $usuario['email']);
    $stmt->bindParam(2, $usuario['senha']);

    if($stmt->execute()) {
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        
        return $result;
    } else {
        var_dump($stmt->errorInfo());
        exit();
    }

}

/*
 * Retorna todas os registros de usuarios do BD
 * a partir de um SELECT
 */
function all() : array
{
    $conn = connection();
    
    $rs = $conn->prepare("SELECT * FROM usuarios");
    
    $rs->execute();
    
    $usuarios = $rs->fetchAll();
    
    return $usuarios;
}

/*
 * Retorna todas os registros de grupos do BD
 * a partir de um SELECT
 */
function grupos() : array
{
    $conn = connection();
    
    $rs = $conn->prepare("SELECT * FROM grupos");
    
    $rs->execute();
    
    $grupos = $rs->fetchAll();
    
    return $grupos;
}

function store(array $usuario, array $dadosImagem) : bool
{
    // configuracoes do arquivo config.php
    $config = require('../config.php');
    // chave de protecao para criptografia
    $hash = $config['APP'];
    $usuario['senha'] = md5($hash['APP'].$usuario['senha']);
    $conn = connection();
    
    $stmt = $conn->prepare("INSERT INTO usuarios (nome,email,senha,descricao,grupo_id, perfil) "
                    ."VALUES (?,?,?,?,?,?)");

    $stmt->bindParam(1, $usuario['nome']);
    $stmt->bindParam(2, $usuario['email']);
    $stmt->bindParam(3, $usuario['senha']);
    $stmt->bindParam(4, $usuario['descricao']);
    $stmt->bindParam(5, $usuario['grupo_id']);

    // verifica se imagem existe
    if($dadosImagem['error'] != 4) {
        $stmt->bindParam(6, $dadosImagem['name']);
    } else {
        $stmt->bindParam(6, '');
    }
    
    if($stmt->execute()) {

        // verifica se uma imagem enviada pelo requisicao nao esta vazia
        if($dadosImagem['error'] != 4) {
            // retorna o id do ultimo usuario cadastrado
            $usuarioId = $conn->lastInsertId();

            uploadImagem($dadosImagem, $usuarioId);
        }

        return true;
    } else {
        // var_dump($stmt->errorInfo());
        // exit();
        return false;
    }
}

function update(array $usuario, array $dadosImagem, int $id) : bool
{
    //$usuario['senha'] = md5($hash['APP'].$usuario['senha']);
    $conn = connection();

    $sql = "UPDATE usuarios SET nome=?,email=?,senha=?,descricao=?,grupo_id=?, perfil=? "
        ."WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(1, $usuario['nome']);
    $stmt->bindParam(2, $usuario['email']);
    $stmt->bindParam(3, $usuario['senha']);
    $stmt->bindParam(4, $usuario['descricao']);
    $stmt->bindParam(5, $usuario['grupo_id']);

    // verifica se imagem existe
    if($dadosImagem['error'] != 4) {
        $stmt->bindParam(6, $dadosImagem['name']);
    } else {
        $stmt->bindParam(6, $usuario['perfil_null']);
    }

    $stmt->bindParam(7, $id);
    
    if($stmt->execute()) {

        // verifica se uma imagem enviada pelo requisicao nao esta vazia
        if($dadosImagem['error'] != 4) {

            uploadImagem($dadosImagem, $id);
        }

        return true;
    } else {
        // var_dump($stmt->errorInfo());
        // exit();
        return false;
    }
}

function uploadImagem(array $dadosImagem, int $id)
{
    // redireciona o arquivo do caminha temporario para o original da aplicacao
    // o nome consiste no id do usuario e no nome da imagem
    move_uploaded_file($dadosImagem['tmp_name'], 
        '../public/uploads/perfil/'.$id.'-'.$dadosImagem['name']);
}   

function findById(int $id) : array
{
    $conn = connection();

    $rs = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    // injeta o valor no SQL e evita codigos maliciosos
    $rs->bindParam(1, $id);

    if($rs->execute()) {
        $usuario = $rs->fetch(PDO::FETCH_OBJ);
        // converte usuario para array
        $usuario = get_object_vars($usuario);

        return $usuario;
    } else {
        var_dump($rs->errorInfo());
        exit();
    }
}

function findGrupoById(int $id) : array
{
    $conn = connection();

    $rs = $conn->prepare("SELECT * FROM grupos WHERE id = ?");
    // injeta o valor no SQL e evita codigos maliciosos
    $rs->bindParam(1, $id);

    if($rs->execute()) {
        $grupo = $rs->fetch(PDO::FETCH_OBJ);
        // converte grupo para array
        $grupo = get_object_vars($usuario);

        return $grupo;
    } else {
        var_dump($rs->errorInfo());
        exit();
    }
}

function destroy(int $id)
{
    // remove o arquivo antes de deletar o usuario
    removerImagem($id);

    $conn = connection();

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id=?");
    $stmt->bindParam(1, $id);

    if(!$stmt->execute()) {
        var_dump($stmt->errorInfo());
        exit();
    }
}

/*
 * Remove o arquivo do disco
 */
function removerImagem(int $id)
{
    $usuario = findById($id);

    unlink('../public/uploads/perfil/'.$usuario['id'].'-'.$usuario['perfil']);
}