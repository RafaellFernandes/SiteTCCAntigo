<?php

    //verificar se nao esta logado
    if ( !isset ( $_SESSION["bancotcc"]["id"] ) ) {
        exit;
    }

    //iniciar as variaveis
    $NomeDept = "";

    //se nao existe o id
    if ( !isset ( $id ) ) $id = "";
    
    //verificar se existe um id
    if ( !empty ( $id ) ) {
        //selecionar os dados do banco para poder editar

        $sql = "SELECT * FROM departamento WHERE id = :id LIMIT 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //separar os dados
        //$id 	    = $dados->id;
        $NomeDept  	= $dados->NomeDept ;
	  
  }
  
?>
<div class="container-fluid">
    <br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="float-left">Cadastrar Departamento</h1>
                <div class="float-right">
                    <a href="cadastro/marca" class="btn btn-dark">Cadastrar Marca</a>
                    <a href="cadastro/produto" class="btn btn-dark">Cadastrar Produto</a>
                    <a href="listar/departamento" class="btn btn-primary">Listar Registro</a>
                </div>

                <div class="clearfix"></div>
                <br>
                <form name="formCadastro" method="post" action="salvar/departamento" data-parsley-validate>
                <p>* Campos Obrigatórios</p>
                <div class="row">
                    <div class="col-12 col-md-2">
                        <label for="id">ID</label>
                        <input type="text" name="id" id="id"
                        class="form-control" readonly
                        value="<?=$id;?>">
                    </div>
                    <div class="col-12 col-md-10">
                        <label for="NomeDept">* Departamento:</label>
                        <input type="text" name="NomeDept" id="NomeDept"
                        class="form-control" required
                        data-parsley-required-message="Preencha este campo, por favor"
                        value="<?=$NomeDept;?>">
                    </div> 
                </div>
                <br>
                    <button type="submit" class="btn btn-success margin">
                        <i class="fas fa-check"></i> Salvar Dados
                    </button>
              
                </form>
            </div>
        </div>
    </div>
</div> <!-- container -->