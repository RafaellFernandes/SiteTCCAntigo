
<?php

//verificar se nao esta logado
if ( !isset ( $_SESSION["bancotcc"]["id"] ) ) {
    exit;
}

//iniciar as variaveis
$cidade = $estado = "";

//se nao existe o id
if ( !isset ( $id ) ) $id = "";

//verificar se existe um id
if ( !empty ( $id ) ) {
    //selecionar os dados do banco para poder editar

    $sql = "SELECT * FROM cidade WHERE id = :id LIMIT 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);

     //separar os dados
    //$id 	    = $dados->id;
    $cidade 	= $dados->cidade;
    $estado 	= $dados->estado;
  
}
//***********************************************
?>

<link rel="stylesheet" href="../admin/vendor/bootstrap/js/bootstrap.min.js">
<link rel="stylesheet" href="../admin/vendor/css/bootstrap.min.css">
<div class="container-fluid">
    <br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="float-left">Cadastrar Cidade</h1>
                <div class="float-right">
                    <a href="listar/cidade" class="btn btn-primary">Listar Registros</a>
                </div>

                <div class="clearfix"></div>
                <br>
                <form name="formCadastro" method="post" action="salvar/cidade" data-parsley-validate>
                <p>* Campos Obrigatórios</p>
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" class="form-control" readonly
                            value="<?=$id;?>">
                        </div>

                        <div class="col-12 col-md-8">
                            <label for="cidade">* Cidade</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" required
                            data-parsley-required-message="Preencha este campo, por favor"
                            value="<?=$cidade;?>" placeholder="Nome da Cidade">
                        </div>

                        <div class="col-12 col-md-2">
                            <label for="estado">* Estado</label>
                            <input type="text" name="estado" id="estado" class="form-control" required
                            data-parsley-required-message="Preencha este campo, por favor"
                            value="<?=$estado;?>" placeholder="UF">
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
</div>