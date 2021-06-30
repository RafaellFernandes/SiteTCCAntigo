<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  //iniciar as variaveis 
  $Marca = "";

  //se nao existe o id
  if ( !isset ( $id ) ) $id = "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {
  	//selecionar os dados do banco
  	$sql = "SELECT * FROM marca 
  		WHERE id = ? LIMIT 1";
  	$consulta = $pdo->prepare($sql);
  	$consulta->bindParam(1, $id); 
  	$consulta->execute();
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
  	$id 	  = $dados->id;
	$Marca    = $dados->Marca;

  } 
?>

<div class="container-fluid">
    <br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
				<h1 class="float-left">Cadastrar Marca</h1>
				<div class="float-right">
					<a href="cadastro/produto" class="btn btn-dark">Cadastrar Produto</a>
                    <a href="cadastro/departamento" class="btn btn-dark">Cadastrar Departamento</a>
					<a href="listar/marca" class="btn btn-primary">Listar Registros</a>
				</div>

				<div class="clearfix"></div>
  				<br>
				<form name="formCadastro" method="post" action="salvar/marca" data-parsley-validate>
				<p>* Campos Obrigatórios</p>
					<div class="row">
						<div class="col-12 col-md-2">
							<label for="id">ID</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-10">
							<label for="Marca"> * Nome da Marca</label>
							<input type="text" name="Marca" id="Marca" class="form-control" required data-parsley-required-message="Preencha este campo, por favor"
							value="<?=$Marca;?>">
						</div>
  					</div>
					<br>
					<button type="submit" class="btn btn-success margin" alt="Salvar" title="Salvar">
						<i class="fas fa-check"></i> Salvar Dados
					</button>
					<br>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
	//verificar se o id é vazio
	if ( empty ( $id ) ) $id = 0;
?>