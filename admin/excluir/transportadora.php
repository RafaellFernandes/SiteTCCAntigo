<?php
//verificar se nao esta logado
if ( !isset ( $_SESSION["bancotcc"]["id"] ) ) {
    exit;
}

//se nao existe o id
if ( !isset ($id) ) {
    echo '<script>alert("Erro ao Realizar Requisição");history.back();</script>';
    exit;
}

//excluir a transportadora
$sql = "DELETE FROM transportadora WHERE id = ? LIMIT 1";
$verificar = $pdo->prepare($sql);
$verificar->bindParam(1, $id);
//verificar se executou
if (!$verificar->execute()) {
    $erro = $verificar->errorInfo();
    echo '<script>alert("Erro ao excluir!");history.back();</script>';
    exit;
}

echo "<script>location.href='listar/transportadora';</script>";

?>