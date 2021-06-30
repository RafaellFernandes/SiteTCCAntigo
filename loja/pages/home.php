<!-- Inicio Carrosel -->
<div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="_arquivos/Banners/banner2.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="_arquivos/Banners/banner6.jpg" alt="Second slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<!-- Fim do carrosel -->
<!-- Inicio dos produtos em destaque -->
<section id="services" class="services">
<div class="container-fluid "> 
        <div class="container-fluid">
       
			<div class="section-title">
				<span>Produtos em Destaque</span>
				<h2>Produtos em Destaque</h2>
			</div>
			<div class="container-fluid row d-flex align-items-center " data-aos="fade-up">
				<?php
					//selecionar 1 produto aleatorios
					$sql = "SELECT id, Nome, ValorProduto, FotoProduto FROM produto ORDER BY rand() LIMIT 8";
					$consulta = $pdo->prepare($sql);
					$consulta->execute();

					while ( $linha = $consulta->fetch(PDO::FETCH_ASSOC) ) {

						//recuperar as variaveis
						$id 	            = $linha["id"];
						$Nome               = $linha["Nome"];
						$ValorProduto      	= $linha["ValorProduto"];
						$FotoProduto     	= $linha["FotoProduto"] ."p.jpg";

						//formatar o valor
						$ValorProduto = number_format($ValorProduto, 2, ",", ".");
						//var,casas decimais,sep decimal,sep milhares

						echo "<div class='col-3 text-center'>
						 	<img src='fotos/$FotoProduto' class='w-65'>
						 	<p>$Nome</p>
						 	<p class='valor'>R$ $ValorProduto</p>
						 	<a href='produto/$id'
						 	class='btn btn-info'>Detalhes</a><br>
						 	</div>";

						}
				?>
			</div>
		</div>
	</div>
</section> 
<!-- Fim da seção de Produtos em destaque -->
<!-- ======= Clients Section ======= -->
<section id="clients" class="clients">
    <div class="row" data-aos="zoom-in">
        <div class="row d-flex align-items-center">

			<div class="col-lg-2 col-md-1 col-2">
				<img src="vendor/assets/img/clients/client-1.png" class="img-fluid" alt="Nvidia">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-3.png" class="img-fluid" alt="AMD">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-4.png" class="img-fluid" alt="Intel">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-2.png" class="img-fluid" alt="Samsung">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-9.png" class="img-fluid" alt="Xiaomi">
			</div>
			<div class="col-lg-1 col-md-1 col-2">
				<img src="vendor/assets/img/clients/client-5.png" class="img-fluid" alt="Apple">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-6.png" class="img-fluid" alt="Google">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-22.png" class="img-fluid" alt="Microsoft">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-13.png" class="img-fluid" alt="HyperX">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-12.png" class="img-fluid" alt="Redragon">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-19.png" class="img-fluid" alt="DxRacer">
			</div>
			<div class="col-lg-2 col-md-2 col-2">
				<img src="vendor/assets/img/clients/client-7.png" class="img-fluid" alt="Lenovo">
			</div>
        </div>
    </div>
</section><!-- End Clients Section -->