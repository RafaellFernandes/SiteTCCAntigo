<?php

  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

    //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
  
  if ( !isset ( $id ) ) $id = "";

  $Nome = $cpf  = $DataNascimento = $Email = $Senha = $Cep = $Endereco = $Complemento = $Bairro = $cidade_id = 
  $Foto = $Telefone = $Celular = $nome_cidade = $estado = $numeroCasa = $numeroApto = $sexo = "";

  if ( !empty ( $id ) ) {
	  //selecionar os dados do cliente
	  $sql =  "SELECT c.*, DATE_FORMAT(c.DataNascimento,'%d/%m/%Y') DataNascimento,
	  ci.cidade, ci.estado FROM cliente c 
	  INNER JOIN cidade ci ON ( ci.id = c.cidade_id ) WHERE c.id = :id LIMIT 1";
	  $consulta = $pdo->prepare( $sql);
	  $consulta->bindParam(":id", $id);
	  $consulta->execute();

	  $dados = $consulta->fetch(PDO::FETCH_OBJ);

	  if ( empty ( $dados->id ) ) {
		  echo "<p class='alert alert-danger'>Cliente Não Existente</p>";
	  }

	  $id             = $dados->id;
	  $Nome           = $dados->Nome;
	  $DataNascimento = $dados->DataNascimento;
	  $Endereco       = $dados->Endereco;
	  $Bairro         = $dados->Bairro;
	  $cidade_id      = $dados->cidade_id;
	  $estado         = $dados->estado;
	  $Senha          = $dados->Senha;
	  $cpf            = $dados->cpf;
	  $Email          = $dados->Email;
	  $Cep            = $dados->Cep;
	  $Complemento    = $dados->Complemento;
	  $Foto           = $dados->Foto;
	  $Telefone       = $dados->Telefone;
	  $Celular        = $dados->Celular;
	  $numeroCasa     = $dados->numeroCasa;
	  $numeroApto     = $dados->numeroApto;
	  $sexo           = $dados->sexo;
	  $estado         = $dados->estado;
	  $nome_cidade    = $dados->nome_cidade;


  }
?>
<div class="container-fluid">
    <br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
				<h1 class="float-left">Cadastrar Cliente</h1>
				<div class="float-right">
					<a href="listar/cliente" class="btn btn-primary">Listar Registros</a>
				</div>

				<div class="clearfix"></div>
  				<br>
				<form name="formCadastro" method="post"
				action="salvar/cliente" data-parsley-validate enctype="multipart/form-data">
				<p>* Campos Obrigatórios</p>
					<div class="row">
						
						<div class="col-12 col-md-2">
							<label for="id">ID:</label>
							<input type="text" name="id" id="id" class="form-control" readonly value="<?=$id;?>">
						</div>
						<div class="col-12 col-md-10">
							<label for="Nome">* Nome:</label>
							<input type="text" name="Nome" id="Nome" class="form-control" required data-parsley-required-message="Preencha o Nome" 
							value="<?=$Nome;?>" placeholder="Digite seu nome completo">
						</div>

						<div class="col-12 col-md-4">
							<label for="cpf">* CPF:</label>
							<input type="text" name="cpf" id="cpf" class="form-control" required data-parsley-required-message="Preencha o cpf" value="<?=$cpf;?>" onblur="verificarCpf(this.value)"
							placeholder="Digite seu CPF">
						</div>
						
						<div class="col-12 col-md-4">
							<label for="sexo">Gênero:</label>
							<input type="text" name="sexo" id="sexo" class="form-control" value="<?=$sexo;?>" placeholder="Gênero">
						</div> 

						<div class="col-12 col-md-4">
							<label for="DataNascimento">* Data de Nascimento:</label>
							<input type="text" name="DataNascimento" id="DataNascimento" class="form-control" required data-parsley-required-message="Preencha a data de nascimento" 
							placeholder="Ex: 11/12/1990" value="<?=$DataNascimento;?>">
						</div>
						<div class="col-12 col-md-8">
							<label for="Foto">* Foto </label>
							<input type="file" name="Foto" id="Foto" class="form-control" >
							<input type="hidden" name="Foto" value="<?=$Foto?>" class="form-control">
								<?php  
									
									if( !empty($Foto)){
										$Foto = "<img src='../fotos/".$Foto."p.jpg' alt='".$Nome."' width='150px'>";
									} else{
										$Foto = "";
									}
								?>
							<div><?php echo $Foto;?></div>
						</div>

						<div class="col-12 col-md-4">
							<label for="Telefone">Telefone:</label>
							<input type="text" name="Telefone" id="Telefone" class="form-control" placeholder="Telefone com DDD"
							value="<?=$Telefone;?>">
						</div>
						<div class="col-12 col-md-4">
							<label for="Celular">* Celular:</label>
							<input type="text" name="Celular" id="Celular" class="form-control" placeholder="Celular com DDD"
							value="<?=$Celular;?>" required data-parsley-required-message="Preencha o Celular">
						</div>

						<div class="col-12 col-md-4">
							<label for="Email">* E-mail:</label>
							<input type="email" name="Email" id="Email" class="form-control" required data-parsley-required-message="Preencha o e-mail" 
							data-parsley-type-message="Digite um E-mail válido" placeholder="exemple@hotmail.com"
							value="<?=$Email;?>" onblur="confirmarEmail(this.value)">
						</div>

						<div class="col12 col-md-4">
							<label for="Senha">* Senha:</label>
							<input type="password" name="Senha" id="Senha" class="form-control" value="<?=$Senha?>" placeholder="Digite sua Senha">
						</div>
						<div class="col12 col-md-4">
							<label for="senha2">* Redigite a Senha:</label>
							<input type="password" name="senha2" id="senha2" class="form-control"  data-parsley-equalto="#Senha" data-parsley-trigger="keyup" data-parsley-error-message="Senha não confere" value="<?=$Senha?>"
							placeholder="Redigite sua Senha">
						</div>

						<div class="col-12 col-md-3">
							<label for="Cep">* CEP:</label>
							<input type="text" name="Cep" id="Cep" class="form-control" required data-parsley-required-message="Preencha o CEP"
							value="<?=$Cep;?>" placeholder="Digite o CEP da Sua Cidade">
						</div>
						<div class="col-12 col-md-2">
							<label for="cidade_id">ID Cidade</label>
							<input type="text" name="cidade_id" id="cidade_id" class="form-control" required data-parsley-required-message="Preencha a Cidade" readonly value="<?=$cidade_id;?>">
						</div>
						<div class="col-12 col-md-3">
							<label for="nome_cidade">* Cidade:</label>
							<input type="text" id="nome_cidade" name="nome_cidade" class="form-control"
							value="<?=$nome_cidade;?>" placeholder="Nome da Cidade" readonly>
						</div>
						<div class="col-12 col-md-2">
							<label for="estado">* Estado:</label>
							<input type="text" id="estado" name="estado" class="form-control"
							value="<?=$estado;?>" placeholder="UF" readonly>
						</div>
						<div class="col-12 col-md-5">
							<label for="Endereco">* Endereço</label>
							<input type="text" name="Endereco" id="Endereco" class="form-control"
							value="<?=$Endereco;?>" placeholder="Av. Gopouva, Alameda Yayá">
						</div>
						<div class="col-12 col-md-5">
							<label for="Bairro">* Bairro</label>
							<input type="text" name="Bairro" id="Bairro" class="form-control"
							value="<?=$Bairro;?>" placeholder="Nome do bairro">
						</div>
						<div class="col-12 col-md-3">
							<label for="numeroCasa">* Numero Residência</label>
							<input type="text" name="numeroCasa" id="numeroCasa" class="form-control"
							value="<?=$numeroCasa;?>" placeholder="Numero da casa">
						</div>
						<div class="col-12 col-md-4">
							<label for="numeroApto">Apartamento</label>
							<input type="text" name="numeroApto" id="numeroApto" class="form-control"
							value="<?=$numeroApto;?>" placeholder="Numero do Apto com andar e bloco">
						</div>
						<div class="col-12 col-md-5">
							<label for="Complemento">Complemento</label>
							<input type="text" name="Complemento" id="Complemento" class="form-control"
							value="<?=$Complemento;?>">
						</div>
						<br>
						
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
	<?php
		//verificar se o id é vazio
		if ( empty ( $id ) ) $id = 0;
	?>

<script type="text/javascript">
	
	$(document).ready(function(){
        
		$('#Cep').mask('00000-000');
		$('#cpf').mask('000.000.000-00');
		$("#DataNascimento").mask("00/00/0000");
		$("#Telefone").mask("(00) 0000-0000");
		$("#Celular").mask("(00) 00000-0000");
	});

/***********************************************************************************************/
function verificarCpf(cpf) {
    $.get("validacao/verificarCpf.php", {cpf:cpf, id:<?=$id;?>}, function(dados){
        if(dados != ""){
			//mostrar erro retornado
			alert(dados);
			//zerar cpf
			$("#cpf").val("");
        }
    })
}

/***********************************************************************************************/

	function confirmarEmail(Email){
		   $.get("validacao/verificaEmail.php", {Email:Email,id:<?=$id;?>}, function(dados){
			   if(dados != ""){
				   alert(dados);
				   $("#Email").val("");
			   }
		   }) 
	}

/***********************************************************************************************/

		$("#Cep").blur(function(){
				//pegar o cep
                cep = $("#Cep").val();
                cep = cep.replace(/\D/g, '');
                //alert(cep);
				//verificar se esta em branco
                if(cep == ""){
                    alert("Preencha o cep");
                } else {
                    //consultar o cep no viacep.com.br
                     $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados){
						$("#nome_cidade").val(dados.localidade);
                		$("#Endereco").val(dados.logradouro);
                		$("#estado").val(dados.uf);
						$("#Bairro").val(dados.bairro);
                         
                         //buscar id da cidade
                         
                         $.get("buscarCidade.php", {cidade: dados.localidade, estado: dados.uf}, function(dados){
                            if(dados != "Erro")
                                $("#cidade_id").val(dados);
							else 
                            	alert(dados);
							 
                         })
                         //focar no complemento
                         $("#Bairro").focus();
                     })
                }
            });
		
	</script>
</div>