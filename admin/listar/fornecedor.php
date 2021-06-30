<?php

  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

  //mostrar erros
	ini_set('display_errors',1);
	ini_set('display_startup_erros',1);
    error_reporting(E_ALL);
?>
<div class="container-fluid">
    <br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="clearfix"></div>

                <h1 class="float-left">Listar Fornecedores</h1>
                <div class="float-right">
                    <a href="cadastro/fornecedor" class="btn btn-success">Novo Registro</a>
                </div>

                <div class="clearfix"></div>
                <br>
                <table class="table table-striped table-bordered table-hover" id="tabela">
                    <thead>
                        <tr>
                            
                            <td>Nome</td>
                            <td>cnpj</td>
                            <td>telefone</td>
                            <td>Cidade</td>
                            <td>Opções</td>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                            $sql = "SELECT * FROM fornecedor";
                            $consulta = $pdo->prepare($sql);
                            $consulta->execute();

                            while ( $dados = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                //separar os dados
                                $id         	  = $dados->id;
                                $Nome 	          = $dados->Nome; 
                                $cnpj             = $dados->cnpj;               
                                $Telefone         = $dados->Telefone;
                                $nome_cidade 	  = $dados->nome_cidade;
								$estado           = $dados->estado;
                                
                            
                                    //mostrar na tela
                                    echo '<tr>
                                        <td>'.$Nome.'</td>
                                        <td>'.$cnpj.'</td>
                                        <td>'.$Telefone.'</td>
                                        <td>'.$nome_cidade.' - '.$estado.'</td>
                                        <td>
                                            <a href="cadastro/fornecedor/'.$id.'" class="btn btn-primary btn-sm" alt="Editar" title="Editar">
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
                location.href="excluir/fornecedor/"+id;
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
    