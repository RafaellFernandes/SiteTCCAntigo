<?php
  //verificar se não está logado
  if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
    exit;
  }

//se nao existe o id
if ( !isset ( $id ) ) $id = "";
//iniciar as variaveis
$Nome = $ValorProduto = $Descricao = $qtd_estoque = $FotoProduto = $departamento_id = $NomeDept= $Marca_id = $nomeMarca =  "";

  //verificar se existe um id
  if ( !empty ( $id ) ) {

    include "../admin/validacao/functions.php";
   
  	//selecionar os dados do banco para poder editar
      $sql = "SELECT 
                    p.*
                    ,d.*
                    ,m.*
                FROM produto p
                left join departamento d on (d.id = p.departamento_id)
                left join marca m on(m.id = p.Marca_id)
                WHERE p.id = :id LIMIT 1";
      $consulta = $pdo->prepare($sql);
      $consulta->bindParam(":id", $id);
      $consulta->execute();
      
  	$dados  = $consulta->fetch(PDO::FETCH_OBJ);

  	//separar os dados
    $id         	  = $dados->id;
    $Nome 	          = $dados->Nome; 
    $ValorProduto     = $dados->ValorProduto;
    $ValorProduto     = number_format($ValorProduto,2,",",".");
    $Descricao        = $dados->Descricao;
    $qtd_estoque      = $dados->qtd_estoque;
    $departamento_id  = $dados->departamento_id;
    $NomeDept         = $dados->NomeDept;
    $Marca_id         = $dados->Marca_id;
    $nomeMarca        = $dados->Marca;
    $FotoProduto      = $dados->FotoProduto;
  }

?>

<head>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
</head>

<div class="container-fluid">
<br>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="float-left">Cadastrar Produto</h1>
                <div class="float-right">
                    <a href="cadastro/departamento" class="btn btn-dark">Cadastrar Departamento</a>
                    <a href="cadastro/marca" class="btn btn-dark">Cadastrar Marca</a>
                    <a href="listar/produto" class="btn btn-primary">Listar Registro</a>
                </div>

                <div class="clearfix"></div>
                <br>
                <form method="post" name="formCadastro"  action="salvar/produto" data_parsley_validate enctype="multipart/form-data">
                <p> * Campos Obrigatórios </p>
                    <div class="row">
                        <div class="col-12 col-md-2">
                            <label for="id">ID</label>
                            <input type="text" name="id" id="id" readonly class="form-control" value="<?=$id;?>">
                        </div>

                        <div class="col-12 col-md-10">
                            <label for="Nome">* Nome do Produto</label>
                            <input type="text" name="Nome" id="Nome" class="form-control" require data-parsley-required-message="Por favor, preencha este campo" 
                            value="<?=$Nome;?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="Marca_id">* Marca</label>
                            <select name="Marca_id" id="Marca_id" class="form-control" required data-parsley-required-message="selecione uma opção">
                                <option value="<?=$Marca_id;?>"><?=$nomeMarca;?></option>
                                    <?php
                                        $sql = "SELECT * FROM marca ORDER BY Marca";
                                        $consulta = $pdo->prepare($sql);
                                        $consulta->execute();

                                        while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                            # code...
                                            //separar os dados
                                            $id   = $d->id;
                                            $Marca = $d->Marca;

                                            echo '<option value="'.$id.'">'.$Marca.'</option>';
                                        }
                                    
                                    ?>
                            </select>
                        </div>
                    <div class="col-12 col-md-4">
                        <label for="departamento_id">* Departamento</label>
                        <select name="departamento_id" id="departamento_id" class="form-control" required data-parsley-required-message="Selecione um Departamento">
                            <option value="<?=$departamento_id;?>"><?=$NomeDept;?></option>
                                <?php
                                $sql = "SELECT id, NomeDept FROM departamento ORDER BY NomeDept";
                                $consulta = $pdo->prepare($sql);
                                $consulta->execute();

                                while ($d = $consulta->fetch(PDO::FETCH_OBJ) ) {
                                    # code...
                                    //separar os dados
                                    $id        = $d->id;
                                    $NomeDept  = $d->NomeDept;
                                    echo '<option value="'.$id.'">'.$NomeDept.'</option>';
                                }
                                ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="qtd_estoque">* Quantidade em Estoque</label>
                        <input type="text" name="qtd_estoque" id="qtd_estoque" required data-parsley-required-message="Preencha este campo"
                         class="form-control" value="<?=$qtd_estoque;?>" placeholder="Quantidade Max: 99999">
                    </div>

                    <div class="col-12 col-md-6">
                            <?php 
                            //variavel r requerido se ID está vazio
                                $r = 'required data-parsley-required-message="Selecione uma foto"';
                                
                                if(!empty($id)) $r = '';
                            ?>

                            <label for="FotoProduto">* Foto do Produto</label>
                            <input type="file" name="FotoProduto" id="FotoProduto" class="form-control" accept=".jpg"<?=$r;?>>
                            <input type="hidden" name="FotoProduto" value="<?=$FotoProduto;?>" class="form-control">

                            <?php  
                                
                            if( !empty($FotoProduto)){
                                $foto = "<img src='../fotos/".$FotoProduto."p.jpg' alt='".$Nome."' width='150px'>";
                            } else{
                                $foto = "";
                            }?>

                            <div><?php echo $foto ;?></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="ValorProduto">* Valor Unitário</label>
                        <input type="text" name="ValorProduto" id="ValorProduto" required data-parsley-required-message="Preencha este campo" 
                        class="form-control" value="<?=$ValorProduto;?>" placeholder="R$">
                    </div>
                    
                    <div class="col-12 col-md-12">
                        <label for="Descricao">* Resumo/Descrição</label>
                        <textarea name="Descricao" id="summernote" required data-parsley-required-message="Preencha este campo" class="form-control" 
                        rows="4" ><?=$Descricao;?></textarea>
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
<script>$("#ValorProduto").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#qtd_estoque").mask("99999");
    });
</script>
<script>
      $('#summernote').summernote({
        placeholder: 'Descrição do Produto',
        tabsize: 2,
        height: 120,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['codeview', 'help']]
        ]
      });
</script>



