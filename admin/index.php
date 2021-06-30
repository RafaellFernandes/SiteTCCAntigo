<?php
  //iniciar a sessão
  session_start();

  //mostrar erros
  ini_set('display_errors',1);
  ini_set('display_startup_erros',1);
  error_reporting(E_ALL);

  //iniciar a variavel pagina
  $pagina = "paginas/login";

  //incluir o arquivo de conexao
  include "config/conexao.php";

  $site   = $_SERVER['SERVER_NAME'];
  $porta  = $_SERVER['SERVER_PORT'];
  $url    = $_SERVER['SCRIPT_NAME'];
  //$url    = $_SERVER['SERVER_NAME'];

  $h = "http";

  if( isset($_SERVER['HTTPS']) ) {
    $h = "https";
  }

  $base = "$h://$site:$porta/$url";

?>
<!DOCTYPE html>
<html>
<head>
  <title>Sistema - Quantic Shop</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="../_arquivos/atomic.png" rel="shortcut icon">

  <base href="<?=$base;?>">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script><!-- <script>$(document).ready(function(){alert('funcionou a instalação!');});</script>  -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/862f0da969.js" crossorigin="anonymous"></script>
  <!-- include summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <!-- Ionicons -->
  <link  rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link  rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="plugins/style.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed navbar-fixed">

  <?php
      //completar o nome da página
      $pagina = $pagina.".php";

      //se não esta logado
      //mostrar tela do login
      if ( !isset ( $_SESSION["bancotcc"]["id"] ) ){
        //incluir o login
        include $pagina;
      } else {

      //mostrar a pagina bonita do template
  ?>

  <div class="wrapper">

  <!-- Navbar -->
  <nav  class="main-header navbar navbar-expand navbar-black navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="paginas/home" class="nav-link">Home</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Conta</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Configuração de Conta </a>
        
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="paginas/sairConta.php?token='.md5(session_id()).'"><i class="fa fa-sign-out"></i> Sair</a>
            
          </div>
      </li>
    </ul>
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
      </div>
    </form>
</nav>
<!-- /.nav bar -->

<!-- Main Sidebar Container -->
<aside class=" main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="paginas/home" class="brand-link">
    <img src="../_arquivos/atomic.png" alt="Quantic Shop Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><strong>Quantic Shop</strong></span>
  </a>

  <!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user panel (optional)-->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../fotos/<?=$_SESSION["bancotcc"]["Foto"];?>p.jpg" class="img-circle elevation-2"   alt="User Image">
      </div>
      <div class="info">
        <a href="paginas/home" class="d-block">
          <!-- Mostra o nome da pessoa que esta logada -->
          <?=$_SESSION["bancotcc"]["Nome"];?>
        </a>
      </div>
    </div>
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link active">
          <i class="nav-icon fa fa-address-card"></i>
          <p>
            Painel
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="paginas/home" class="nav-link">
              <i class="fa fa-bookmark nav-icon" aria-hidden="true"></i>
              <p>Painel Principal</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="paginas/vendas" class="nav-link">
              <i class="fa fa-credit-card nav-icon" aria-hidden="true"></i>
              <p>Painel de Venda</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="paginas/marketing" class="nav-link">
            <i class="fa fa-cloud nav-icon" aria-hidden="true"></i>
              <p>Painel de Marketing</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="paginas/estoque" class="nav-link">
              <i class="fa fa-archive nav-icon" aria-hidden="true"></i>
              <p>Controle de Estoque</p>
            </a>
          </li>
        </li>
    </ul>
  <!-- Inicio do Cadastro -->
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-pen"></i>
          <p>
            Cadastros
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="cadastro/cidade" class="nav-link">
            <i class="fa fa-location-arrow nav-icon"></i>
              <p>Cidade</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cadastro/cliente" class="nav-link">
            <i class="fa fa-male nav-icon"></i>
              <p>Cliente</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cadastro/departamento" class="nav-link">
            <i class="fa fa-bars nav-icon"></i>
              <p>Departamento</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cadastro/fornecedor" class="nav-link">
            <i class="fa fa-industry nav-icon"></i>
              <p>Fornecedor</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cadastro/marca" class="nav-link">
              <i class="fa fa-trademark nav-icon"></i>
              <p>Marca</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cadastro/produto" class="nav-link">
            <i class="fa fa-cart-plus nav-icon"></i>
              <p>Produto</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cadastro/transportadora" class="nav-link">
            <i class="fa fa-truck nav-icon"></i>
              <p>Transportadora</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="cadastro/usuario" class="nav-link">
              <i class="fa fa-user nav-icon"></i>
              <p>Usuario</p>
            </a>
          </li>
        </li>
      </ul>
  <!-- Fim do Cadastro -->
  <!-- Inicio da Listagem -->
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link active">
          <i class="nav-icon fas fa-list"></i>
          <p>
            Listagem
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="listar/cidade" class="nav-link">
              <i class="fa fa-location-arrow nav-icon"></i>
              <p>Cidade</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listar/cliente" class="nav-link">
              <i class="fa fa-male nav-icon"></i>
              <p>Cliente</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listar/departamento" class="nav-link">
              <i class="fa fa-bars nav-icon"></i>
              <p>Departamento</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listar/fornecedor" class="nav-link">
              <i class="fa fa-industry nav-icon"></i>
              <p>Fornecedor</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listar/marca" class="nav-link">
            <i class="fa fa-trademark nav-icon"></i>
              <p>Marca</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listar/produto" class="nav-link">
              <i class="fa fa-cart-plus nav-icon"></i>
              <p>Produto</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listar/transportadora" class="nav-link">
              <i class="fa fa-truck nav-icon"></i>
              <p>Transportadora</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="listar/usuario" class="nav-link">
              <i class="fa fa-user nav-icon"></i>
              <p>Usuario</p>
            </a>
          </li>
        </ul>
    </li>
    <!-- Fim da Listagem -->

    <!-- Inicio Processo -->
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
    <li class="nav-item has-treeview">
        <a href="#" class="nav-link active">
          <i class="nav-icon fa fa-archive"></i>
          <p>
          Processos
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="venda/cadastro" class="nav-link">
              <i class="fa fa-credit-card nav-icon"></i>
              <p>Venda</p>
            </a>
          </li>
      </ul>
<!-- Fim Processo -->

      <!-- Atalho loja -->
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link active">
        <i class="fas fa-shopping-bag"></i>
          <p class="ml-1"> Store</p>
        </a>
      </li>
    <!-- fim atalho loja -->
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
<!--Conteudo da pagina-->
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
    <!-- Paginas que serao exibidas dentro do body  -->
    <?php
      //adicionar a programação para abrir a página desejada

      $pagina = "paginas/home.php";

      //verificar se o parametro existe
      if ( isset ( $_GET["parametro"])){
        //recuperar o parametro
        $p = trim ( $_GET["parametro"] );
        //separar por /
        $p = explode("/", $p);

        $pasta 		= $p[0];
        $arquivo  = $p[1];

        //configurar nome do arquivo
        $pagina = "$pasta/$arquivo.php";

        //verificar se o id ou o 3 item existe
        if ( isset ( $p[2] ) )
          $id = $p[2];
      }

      //verificar se a pagina existe
      if ( file_exists($pagina) )
        include $pagina;
      else
        include "paginas/404.php";

    ?>

    </div>
  </main>
  <br>
<!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2020 <a href="http://localhost/TCCS%20admin/home">Quantic Shop </a>.</strong>
        Todos os Direitos Reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 4.4.16
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
</div>
<!-- ./wrapper -->

<?php
	//continuação do meu codigo php
  }

?>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="plugins/mask/jquery.mask.min.js" ></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>

</body>
</html>