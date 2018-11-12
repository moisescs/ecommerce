<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Teste Modal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css" type="text/css"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
  </script>
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
			 <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
			 <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Produtos <span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="tipo_produto.php?tipo=1"><span class="glyphicon glyphicon-phone"></span> SmartPhones</a></li>
				  <li><a href="tipo_produto.php?tipo=2"><span class="glyphicon glyphicon-film"></span> Tv's</a></li>
				  <li><a href="tipo_produto.php?tipo=3"><span class="glyphicon glyphicon-hdd"></span> Notebooks/PC Desktop</a></li>
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
  	
	<div class="container-fluid">
		<br/>
		<div class="row">
			<div class="col-xs-0 col-sm-1"></div>
			<div class="col-xs-12 col-sm-10"> <!--Inicio da lista de produtos-->
				
				<h3>Teste com Bootstrap para caixa de confirmação!</h3>
				<br/><br/><br/><br/>
				
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mymodal">
									Click me
							</button>
							
							<div class="modal fade" id="mymodal">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h3>Confirmação</h3>
										</div>
										<div class="modal-body">
											<h3 class="text-center">Seu endereço foi cadastrado com sucesso!</h3>
											<h3 class="text-center">Deseja cadastrar mais um endereço?</h3>
										</div>
										<div class="modal-footer">
											<div class="row">
												<div class="col-xs-6">
													<button type="button" class="btn btn-primary" data-dismiss="modal" style="float: right;">&nbsp;&nbsp;&nbsp;Sim&nbsp;&nbsp;&nbsp;</button>
												</div>
												<div class="col-xs-6">
													<button type="button" class="btn btn-primary" style="float:left;">&nbsp;&nbsp;&nbsp;Não&nbsp;&nbsp;&nbsp;</button>
												</div>
											</div>
										</div>
									</div>
								</div>	
							</div>
							
						</div>
					</div>
				</div>
				
				
				
			</div><!--Fim da lista de produtos-->
			<div class="col-xs-0 col-sm-1"></div>
		</div>	
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