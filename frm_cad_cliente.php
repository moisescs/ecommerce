<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro.NossaLoja</title>
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
			 <li class="active"><a href="frm_cad_cliente.php"><span class="glyphicon glyphicon-user"></span> Cadastro</a></li>
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
		<div class="row">
			<div class="col-xs-0 col-sm-2"></div>
			<div class="col-xs-12 col-sm-8">
				<h3>Novo Usuário? Realize seu cadastro no formulário abaixo:</h3>
        		<br/>
        		<div class="row">
        			<?php
        				if (isset($_POST['btn_cadastrar'])){
        					//Aqui vai a chamada de funcção de cadastro do cliente
        					include_once("phpclass/Cliente.class.php");
        					$cliente = new Cliente;
        					echo $cadastrar = $cliente->cadastrar($_POST["frm_cpf"], $_POST["frm_nome"], $_POST["frm_data_nasci"], $_POST["frm_rg"], $_POST["frm_sobrenome"]);
        					
        					if($cadastrar > 0){
        						session_start();
        						$_SESSION['cliente']['id_cliente']= $cadastrar;
        						//Depois redireciona para proxima pagina
        						header('Location: frm_user_cliente.php');	
        					}
        				
        				}
        			?>
        			<form name="cad_cliente" action="" method="post">
			            <div class="col-xs-12 col-sm-12">
			              <h3>Dados Pessoais:</h3>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Nome:<input class="form-control" type="text" name="frm_nome" maxlength="50" required>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Sobrenome:<input class="form-control" type="text" name="frm_sobrenome" maxlength="50" required>
			            </div>
			            <div class="col-xs-12 col-sm-6">
				        	RG:<input class="form-control" type="text" name="frm_rg" maxlength="13" required pattern="\d{2}\.\d{3}\.\d{3}-\d{1,2}" \ title="Digite um RG no formato: xx.xxx.xxx-x"/>
				        </div>
				        <div class="col-xs-12 col-sm-6">
				        	CPF:<input class="form-control" type="text" name="frm_cpf" maxlength="14"  required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" \ title="Digite um CPF no formato: xxx.xxx.xxx-xx"/>
				        </div>
				        <div class="col-xs-12 col-sm-6">
				        	Data de Nascimento:<input class="form-control" type="date" name="frm_data_nasci" required/>
				        </div>
						<div class="col-xs-12 col-sm-12 text-center">
				        	<br/><br/><br/>
				            <input type="reset" class="btn btn-primary" value="Cancelar" name="btn_cancelar">
				            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				            <input type="submit" class="btn btn-primary" value="Cadastrar" name="btn_cadastrar">
				            <br/><br/><br/>
				         </div>
				     </form>
        		</div>
			</div>
			<div class="col-xs-0 col-sm-2"></div>
		</div>	
	</div>
	
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