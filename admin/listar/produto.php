<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
	error_reporting(E_ALL);
	
	//$ValorProduto = formatarValor($ValorProduto);
?>
<div class="container-fluid">
    <br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
				<div class="clearfix"></div>
				<h1 class="float-left">Listar Produtos</h1>
				<div class="float-right">
					<a href="cadastro/produto" class="btn btn-success">Novo Registro</a>
				</div>

				<div class="clearfix"></div>
  				<br>
				<table class="table table-striped table-bordered table-hover" id="tabela">
					<thead>
						<tr>
							<td>Foto</td>
							<td>Nome</td>
							<td>Valor</td>
							<td>Marca</td>
							<td>Dept.</td>
							<td>Opções</td>
						</tr>
					</thead>
					<tbody>
					<?php

							$sql = "SELECT p.id, p.FotoProduto, p.Nome, p.ValorProduto, p.Marca_id, p.departamento_id, m.Marca marca from produto p 
							INNER JOIN marca m ON (m.id = p.Marca_id) ORDER BY p.Nome";
							// $sql = "SELECT * FROM produto";
							$consulta = $pdo->prepare($sql);
							$consulta->execute();

							while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
								//separar os dados
								$id         	  = $dados->id;
								$FotoProduto      = $dados->FotoProduto;
								$Nome 	          = $dados->Nome;                
								$Marca_id         = $dados->Marca_id;
								$departamento_id  = $dados->departamento_id;
								$ValorProduto     = $dados->ValorProduto;
								$ValorProduto     = number_format($ValorProduto,2, '.' , ',');	

								$imagem = "../fotos/".$FotoProduto."p.jpg";
								
								//mostrar na tela
								echo '<tr>
											
											<td><img src="'.$imagem.'" alt="'.$Nome.'" width="70px"></td>
											<td>'.$Nome.'</td>
											<td>R$ '.$ValorProduto.'</td>
											<td>'.$Marca_id.'</td>
											<td>'.$departamento_id.'</td>
											<td>
												<a href="cadastro/produto/'.$id.'" class="btn btn-primary btn-sm" alt="Editar" title="Editar">
													 <i class="fas fa-pencil-alt"></i>
												</a>
												<a href="javascript:excluir('.$id.')" class="btn btn-danger btn-sm" alt="Excluir" title="Excluir">
													  <i class="fas fa-trash"></i>
												</a>
											</td>
										</tr>
								
								';
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
			location.href="excluir/produto/"+id;
		}
	}
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