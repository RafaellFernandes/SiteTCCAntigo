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
              <h1 class="float-left">Listar Clientes</h1>
              <div class="float-right">
                <a href="cadastro/cliente" class="btn btn-success">Novo Registro</a>
              </div>

              <div class="clearfix"></div>
              <br>
              <table class="table table-striped table-bordered table-hover" id="tabela">
                <thead>
                  <tr>
                    <td>Foto</td>
                    <td>Nome</td>
                    <td>Nascimento</td>
                    <td>Cidade</td>
                    <td>Email</td>
                    <td>Celular</td>
                    <td>Opções</td> 
                  </tr>
                </thead>
                <tbody>
                  <?php
                      $sql = "SELECT id, Nome, Cpf, date_format(DataNascimento, '%d/%m/%Y') DataNascimento, Email, nome_cidade, estado, Foto, Celular FROM cliente
                      ORDER BY Nome";
                      $consulta = $pdo->prepare($sql);
                      $consulta->execute();
                      while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                        //separar os dados
                      $id 	            = $dados->id;
                      $Foto           	= $dados->Foto;
                      $Nome 	          = $dados->Nome;
                      $DataNascimento 	= $dados->DataNascimento;
                      $Email 	          = $dados->Email;
                      $Celular 	        = $dados->Celular;
                      $nome_cidade 	    = $dados->nome_cidade;
							      	$estado           = $dados->estado;

                        echo '<tr>
                                <td><img src="../fotos/'.$Foto.'p.jpg" alt="'.$Nome.'" width="70px"></td>
                                <td>'.$Nome.'</td>
                                <td>'.$DataNascimento.'</td>
                                <td>'.$nome_cidade.' - '.$estado.'</td>
                                <td>'.$Email.'</td>
                                <td>'.$Celular.'</td>
                                <td>
                                  <a href="cadastro/cliente/'.$id.'" class="btn btn-primary btn-sm" alt="Editar" title="Editar">
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
<script type="text/javascript">
  function excluir(id){
    if ( confirm("deseja realmente excluir este registro?") ){
      location.href='excluir/cliente/'+id;
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
      "zeroRecords":  "Nenhum registro encontrado",
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