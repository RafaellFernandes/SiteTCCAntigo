<?php
	$link = new mysqli("localhost","root","","bancotcc");
	$pesquisar = $_POST['buscar'];
	$result_produto = mysqli_query($link, "SELECT * FROM produto WHERE Nome LIKE '%$pesquisar%' LIMIT 1");
	$rows_produto = mysqli_fetch_array($result_produto, MYSQLI_ASSOC);
     while ( $rows_produto = $result_produto->fetch(PDO::FETCH_OBJ) ) {
         echo "Produtos: ".$rows_produto['Nome']."<br>";

    }
?>