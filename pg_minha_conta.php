<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>UserPage</title>
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
			 <li class=""><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			 <li class="dropdown">
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
					
					if(!isset($_SESSION["logado"])){
						$url = "pg_minha_conta.php";
						header("Location: frm_login_cliente.php?page_last=".$url);
						//header("Location: frm_login_cliente.php");
						exit();
					}
			 ?>
			 <li class="active"><a href="<?php echo $pagina;?>?page_last=index.php"><span class="glyphicon glyphicon-log-in" class="caret"></span> <?php echo $nome_pagina;?></a></li>
		  </ul>
		</div>
	 </div>
  	</nav>
  	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-0 col-sm-2"></div>
			<div class="col-xs-12 col-sm-8">
          <br/><br/>
          <h1 class="text-center"class="text-info">BEM VINDO A SUA CONTA!</h1>
          <br/>
          <p class="text-center" class="text-warning">Aqui você pode realizar alterações em seus dados e rever suas compras!</p>
          <br/><br/>
          <div class="col-xs-12 col-sm-6">
	          <h4>MEUS DADOS</h4>
	          <ul>
	          	<li>Nome</li>
	          	<li>Sobrenome</li>
	          	<li>RG</li>
	          	<li>CPF</li>
	          	<li>Data de nascimento</li>
	          	<li>Email</li>
	          </ul>
	          <br/>
	          <a href=frm_alt_cliente.php?idCliente=$id_cliente><button type="button" class="btn btn-warning">Alterar Dados</button></a>
	       </div>
	       <div class="col-xs-12 col-sm-6">
		        <h4>MEUS PEDIDOS/COMPRAS</h4>
		        <p>Clique no botão abaixo para ver suas compras.</p>
		        <br/>
		        <a href="carrinho.php"><button type="button" class="btn btn-info">Minhas Compras</button></a>
	       </div> <br/>
	       <div class="col-xs-12 col-sm-6">
		        <h4></h4><br/><br/>
		        <p>Clique no botão abaixo para fazer o logout de sua conta.</p>
		        <br/>
		        <?php
		        	include_once("phpclass/User_cliente.class.php");
		        	if(isset($_POST["sair"])){
			        	$logout = new User_cliente;
			        	$sair=$logout->logout();
		        	}
		        ?>
		        <form action="" method="POST"> 
		       	 <button type="submit" name="sair" class="btn btn-info"> Logout</button>
		        </form>
		        
	       </div>
	    </div>    
	    <br/><br/><br/>
	 </div>
	 <br/><br/><br/><br/>
	    
	    
		
	</div>
	
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