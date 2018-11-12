<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Index ADM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css" type="text/css"/>
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
			 <li class="active"><a href="index_adm.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			 <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-book"></span> Funcionários<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="frm_cad_adm.php">Novo Cadastro</a></li>
				  <li><a href="opc_adm.php">Alteração</a></li>
				  <li><a href="opc_adm.php">Deletar</a></li>
				</ul>
			 </li>
			 <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Produtos<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="frm_cad_produto.php">Novo Produto</a></li>
				  <li><a href="opc_produto.php">Alteração</a></li>
				  <li><a href="opc_produto.php">Deletar</a></li>
				</ul>
			 </li>
		  </ul>
		 <ul class="nav navbar-nav navbar-right">
			<?php
				session_start();
				if(isset($_SESSION['logado_adm'])){
					$nome_pagina = "Logout";
					$pagina = "login_adm.php?logout=logout";
				}else{
					header("Location:login_adm.php");
				}
					
			 ?>
			 <li class="active"><a href="<?php echo $pagina;?>"><span class="glyphicon glyphicon-log-in" class="caret"></span> <?php echo $nome_pagina;?></a></li>
		</ul>
		</div>
	 </div>
  	</nav>
  	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-sm-1"></div>
			<div class="col-xs-12 col-sm-10">
				<h2 style="text-align: center;">Aréa de Admistração do site NossaLoja.com.br</h2>
				<br/>
				<br/>
				<div class="container-fluid text-center"><!--Inicio da Lista de Produtos-->
					<div class="row">
						<div class="col-sm-4">
							<div class="thumbnail">
								<h2>Produtos</h2>
								<span class="glyphicon glyphicon-gift custom"></span>
								<div class="caption">
									<h3>Ações</h3>
									<a href="frm_cad_produto.php"><button type="button" class="btn btn-danger"style="width: 40%;">Cadastrar</button></a>
									<a href="opc_produto.php"><button type="button" class="btn btn-danger"style="width: 40%;">Consultar</button></a>
									<br/>
									<br/>
									<a href="opc_produto.php"><button type="button" class="btn btn-danger"style="width:auto">Editar</button></a>
								</div>
							</div>
					 	</div>
					 	
					 	<div class="col-sm-4">
							<div class="thumbnail">
								<h2>Pedidos</h2>
								<span class="glyphicon glyphicon-tags custom"></span>
								<div class="caption">
									<h3>Ações</h3>
									<a href="opc_pedido.php"><button type="button" class="btn btn-danger"style="width: 40%;">Editar</button></a>
									<br/>
									<br/>
									<a href="opc_pedido.php"><button type="button" class="btn btn-danger"style="width: 40%;">Consultar</button></a>
								</div>
							</div>
					 	</div>
					 	
					 	<div class="col-sm-4">
							<div class="thumbnail">
								<h2>Usuário ADM</h2>
								<span class="glyphicon glyphicon-gift custom"></span>
								<div class="caption">
									<h3>Ações</h3>
									<a href="frm_cad_adm.php"><button type="button" class="btn btn-danger"style="width: 40%;">Cadastrar</button></a>
									<a href="opc_adm.php"><button type="button" class="btn btn-danger"style="width: 40%;">Consultar</button></a>
									<br/>
									<br/>
									<a href="opc_adm.php"><button type="button" class="btn btn-danger"style="width:auto">Editar</button></a>
								</div>
							</div>
					 	</div>
					</div>
				</div><!--Final da Lista de Produtos-->
			</div>
			<div class="col-xs-12 col-sm-1"></div>
		</div>
	</div><!--Fim da Div container-->
	<footer class="container-fluid text-center">
		<div class="row">
			<div class="col-sm-4">
				<h4><Contato:<br/> Tel.:(11) 5555-5555 <br/>E-mail: contato@nossaloja.com.br</h4>		
			</div>
			<div class="col-sm-4">
				<p>Nossa Loja e comercio LTDA, CNPJ: 00-000-000/0001-00, estamos localizados na Av. Drº José de Alencar, nº 156, Nosso Horário de atendimento é das 09h00 as 18h00 de segunda a sexta-feira</p>
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