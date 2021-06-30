<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }
  //verificar se existem dados no POST
  if ( $_POST ) {
    include "../admin/validacao/functions.php";
    include "../admin/config/conexao.php";

  	//recuperar os dados do formulario
  	$id = $Nome = $cnpj = $Telefone = $Endereco = $cep = $cidade_id = $email = $nome_cidade = $estado = "";
    
  	foreach ($_POST as $key => $value) {
  		//guardar as variaveis
  		$$key = trim ( $value );
      }

    //validar os campos em branco
    if( empty ( $Nome ) ){
        echo "<script>alert('Digite o Nome da Empresa');history.back();</script>";
        exit;
    } else if( empty($cnpj) ){
        echo "<script>alert('Digite o CNPJ');history.back();</script>";
        exit;
    } else if( empty($Endereco) ){
        echo "<script>alert('Digite o Endereço');history.back();</script>";
        exit;
    } else if( empty($Telefone) ){
        echo "<script>alert('Digite o Telefone');history.back();</script>";
        exit;
    } else if( empty($cep) ){
        echo "<script>alert('Digite o CEP');history.back();</script>";
        exit;
    } 
      

    //iniciar uma transacao
    $pdo->beginTransaction();
     
      if( empty ( $id ) ) {
          //inserir se o id estiver em branco
          $sql = "INSERT INTO transportadora (Nome, cnpj, Telefone, Endereco, cep, email, cidade_id, nome_cidade, estado)
          VALUES ( :Nome, :cnpj, :Telefone, :Endereco, :cep, :email, :cidade_id, :nome_cidade, :estado)";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":Telefone", $Telefone);
          $consulta->bindParam(":Endereco", $Endereco); 
          $consulta->bindParam(":cep", $cep);
          $consulta->bindParam(":email", $email);
          $consulta->bindParam(":cidade_id", $cidade_id); 
          $consulta->bindParam(":nome_cidade", $nome_cidade);      
          $consulta->bindParam(":estado", $estado); 
  
      } else {
          //update se o id estiver preenchido
          //qual arquivo sera gravado
                    
          $sql = "UPDATE transportadora SET Nome = :Nome, cnpj = :cnpj, Telefone = :Telefone, Endereco = :Endereco, cep = :cep, email = :email,   
          cidade_id = :cidade_id, nome_cidade = :nome_cidade, estado = :estado WHERE id = :id ";
          $consulta = $pdo->prepare($sql);
          $consulta->bindParam(":Nome", $Nome);
          $consulta->bindParam(":cnpj", $cnpj);
          $consulta->bindParam(":Telefone", $Telefone);
          $consulta->bindParam(":Endereco", $Endereco);
          $consulta->bindParam(":cep", $cep);
          $consulta->bindParam(":email", $email);
          $consulta->bindParam(":cidade_id", $cidade_id);
          $consulta->bindParam(":nome_cidade", $nome_cidade);      
          $consulta->bindParam(":estado", $estado);  
          $consulta->bindParam(":id",$id);
          
      }
  	//executar e verificar se deu certo
  	if ( $consulta->execute() ) {  
      //salvar no banco
        $pdo->commit();
        echo '<script>alert("Transportadora Salva com Sucesso!");location.href="listar/transportadora";</script>';
    } else {
      echo '<script>alert("Erro ao salvar");history.back();</script>';
      exit;
  }

} else {
  //mensagem de erro
  //javascript - mensagem alert
  //retornar history.back
  echo '<script>alert("Erro ao realizar requisição");history.back();</script>';
}