<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Produtos</title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse">
	 <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
			 <span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="#">NossaLoja</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav">
			 <li class=""><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			 <li class="dropdown" class="active">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Produtos <span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="tipo_produto.php?tipo=1"><span class="glyphicon glyphicon-phone"></span> SmartPhones</a></li>
				  <li><a href="tipo_produto.php?tipo=3"><span class="glyphicon glyphicon-blackboard"></span> Tv's</a></li>
				  <li><a href="tipo_produto.php?tipo=2"><span class="glyphicon glyphicon-hdd"></span> Notebooks</a></li>
				  <li><a href="tipo_produto.php?tipo=4"><span class="glyphicon glyphicon-hdd"></span> PC Desktop</a></li>
				  <li><a href="tipo_produto.php?tipo=5"><span class="glyphicon glyphicon-dashboard"></span> Outros</a></li>
				</ul>
			 </li>
			 <li><a href="#"><span class="glyphicon glyphicon-thumbs-up"></span> Sobre Nós</a></li>
			 <li><a href="frm_contato.php"><span class="glyphicon glyphicon-phone-alt"></span> Contato</a></li>
		  </ul>
		  <ul class="nav navbar-nav navbar-right">
			 <li><a href="frm_cad_cliente.php"><span class="glyphicon glyphicon-user"></span> Cadastro</a></li>
			 <?php
					session_start();
					if(isset($_SESSION['logado'])){
						$nome_pagina = "Minha Conta";
						$pagina = "pg_minha_conta.php";
					}else{
						$nome_pagina = "Login";
						$pagina = "frm_login_cliente.php";
					}
					
			 ?>
			 <li><a href="<?php echo $pagina;?>?page_last=index.php"><span class="glyphicon glyphicon-log-in" class="caret"></span> <?php echo $nome_pagina;?></a></li>
		  </ul>
		</div>
	 </div>
  	</nav>

	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-sm-1"></div>
			<div class="col-xs-12 col-sm-10">
				<div class="container-fluid text-center"><!--Inicio da Lista de Produtos-->
					<div class="row">
					 <?php
					  	include_once("phpclass/Produto.class.php");
					  	$p = new Produto;
						$por_pagina = 100;//Quantidade de Itens por pagina
						if(isset($_GET["tipo"])){
							$busca = $p->imprimir($por_pagina,0,$_GET["tipo"]);	
						}else{
							$busca = $p->imprimir($por_pagina,0,"tudo");
						}
						while($linha = $busca->fetch(PDO::FETCH_ASSOC)):
					?>
						<div class="col-sm-4">
							
							<?php if(isset($_GET["tipo"])): ?>
								<div class="thumbnail">
									<h2><?php echo $linha["categoria"]?></h2>
									<img src="<?php echo $linha["foto"];?>" class="img-responsive" style="width:50%" alt="Image">
									<div class="caption">
										<h3><?php echo $linha["nome"];?></h3>
										<p><?php echo $linha["descricao"]."<br/> Por Apenas R$: ".$linha["preco"];?>
										</p>
										<a href="detalhes.php?<?php echo "id=".$linha['id_produto'];?>"><button type="button" class="btn btn-danger"style="width: 100%;">Ver Detalhes</button></a>	
									</div>
								</div>
							<?php else: ?>
								<div class="thumbnail">
									<h2><?php echo $linha["categoria"]?></h2>
									<img src="<?php echo $linha["foto"];?>" class="img-responsive" style="width:50%" alt="Image">
									<div class="caption">
										<h3><?php echo $linha["nome"];?></h3>
										<p><?php echo $linha["descricao"]."<br/>Apartir de R$: ".$linha["preco"];?>
										</p>
										<a href="tipo_produto.php?<?php echo "tipo=".$linha['produto_id_categoria'];?>"><button type="button" class="btn btn-danger"style="width: 100%;">Ver Mais Produtos</button></a>
									</div>
								</div>
							<?php endif; ?>
							
					 	</div>
					 <?php endwhile; ?>	
					</div>
				</div><!--Final da Lista de Produtos-->
			</div>
			<div class="col-xs-12 col-sm-1"></div>
		</div>
	</div><!--Fechamento da div Class jumbotron-->
	<footer class="container-fluid text-center">
		<div class="row">
			<div class="col-sm-4">
				<h4><Contato:<br/> Tel.:(11) 5555-5555 <br/>E-mail: contato@nossaloja.com.br</h4>		
			</div>
			<div class="col-sm-4">
				<p>Nosa Loja e comercio LTDA, CNPJ: 00-000-000/0001-00, estamos localizados na Av. Drº José de Alencar, nº 156, Nosso Horário de atendimento é das 09h00 as 18h00 de segunda a sexta-feira</p>
			</div>
			<div class="col-sm-4">
				<nav class="navbar-inverse">
					<ul class="nav navbar-nav">
						<li><a href="#">Facebook</a></li>
						<li><a href="#">Twitter </a></li>
						<li><a href="#">Google+ </a></li>
						<li><a href="#">Instagram</a></li>
					</ul>
		  	</nav>	
			</div>
		</div>
	</footer>
</body>
</html>