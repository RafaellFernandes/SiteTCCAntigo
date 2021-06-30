<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }
?>
<div class="container-fluid">
    <br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
				<h1 class="float-left">Listar Departamento</h1>
				<div class="float-right">
					<a href="cadastro/departamento" class="btn btn-success">Novo Registro</a>
				</div>

				<div class="clearfix"></div>
  				<br>
				<table class="table table-striped table-bordered table-hover" id="tabela">
					<thead>
						<tr>
							<td>ID</td>
							<td>Nome do Departamento</td>
							<td>Opções</td>
						</tr>
					</thead>
					<tbody>
						<?php
							//buscar id de Departamento alfabeticamente
							$sql = "SELECT * from departamento ORDER BY NomeDept";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 	    = $dados->id;
								$NomeDept 	= $dados->NomeDept;
								
								//mostrar na tela
								echo '<tr>
										<td>'.$id.'</td>
										<td>'.$NomeDept.'</td>
										<td>
											<a href="cadastro/departamento/'.$id.'" class="btn btn-primary btn-sm" alt="Editar" title="Editar">
												<i class="fas fa-edit"></i>
											</a>

											<a href="javascript:excluir('.$id.')" class="btn btn-danger btn-sm" alt="Excluir" title="Excluir">
												<i class="fas fa-trash"></i>
											</a>
							
										</td>
									</tr>';
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	//funcao para perguntar se deseja excluir
	//se sim direcionar para o endereco de exclusão
	function excluir( id ) {
		//perguntar - função confirm
		if ( confirm ( "Deseja mesmo excluir?" ) ) {
			//direcionar para a exclusao
			location.href="excluir/departamento/"+id;
		}
	}

	//adicionar o dataTable 
$(document).ready(function(){
	$('#tabela').DataTable({
		"language": {
			"lengthMenu": "Mostrando _MENU_ Registros por Pagina",
			"zeroRecords": "Nenhum Registro Encontrado",
			"info": "Mostrando Paginas de  _PAGE_ de _PAGES_",
			"infoEmpty": "No records available",
			"infoFiltered": "(filtered from _MAX_ total records)",
			"search": "Procurar:",
			"zeroRecords":   "Nenhum registro encontrado",
			
      "paginate": {
                "first":      "Primeiro",
                "last":       "Último",
                "next":       "Próximo",
                "previous":   "Anterior"
      }
		}
	} );
})
</script>