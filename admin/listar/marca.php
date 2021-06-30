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
				<h1 class="float-left">Listar Marcas</h1>
				<div class="float-right">
					<a href="cadastro/marca" class="btn btn-success">Novo Registro</a>
				</div>

				<div class="clearfix"></div>
  				<br>
				<table class="table table-striped table-bordered table-hover" id="tabela" >
					<thead>
						<tr>
							<td>ID</td>
							<td>Nome Marca</td>
							<td>Opções</td>
						</tr>
					</thead>
					<tbody>
						<?php
							//buscar as editoras alfabeticamente
							$sql = "SELECT * FROM marca 
							ORDER BY Marca";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id 	= $dados->id;
								$Marca 	= $dados->Marca;
								//mostrar na tela
								echo '<tr>
									<td>'.$id.'</td>
									<td>'.$Marca.'</td>
									<td>
										<a href="cadastro/marca/'.$id.'" class="btn btn-primary btn-sm" alt="Editar" title="Editar">
											<i class="fas fa-pencil-alt"></i>
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
	function excluir(id){

		if (confirm("Deseja mesmo excluir? ")) {
			//ir para exclusao
			location.href="excluir/marca/"+id;
		}
	}
</script>
<script>
	$(document).ready( function () {
    $('#tabela').DataTable({
        language: {
            "emptyTable":     "Nenhum registro",
            "info":           "Mostrando de _START_ a _END_ de _TOTAL_ registros",
            "lengthMenu":     "Mostrar _MENU_ registros",
            "loadingRecords": "Carregando...",
            "processing":     "Processando...",
            "search":         "Procurar:",
            "zeroRecords":    "Nenhum registro encontrado",
            "paginate": {
                "first":      "Primeiro",
                "last":       "Último",
                "next":       "Próximo",
                "previous":   "Anterior"
            },
}
    });
} );
</script>