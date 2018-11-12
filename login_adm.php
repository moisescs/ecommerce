<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Login ADM</title>
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
		  <a class="navbar-brand" href="#"; class="active">NossaLoja</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<?php
				session_start();
				if(isset($_SESSION['logado_adm'])){
					$nome_pagina = "Logout";
					$pagina = "login_adm.php?logout=logout";
				}else{
					$nome_pagina = "Login";
					$pagina = "login_adm.php";
				}
					
			 ?>
			 <li><a href="<?php echo $pagina;?>"><span class="glyphicon glyphicon-log-in" class="caret"></span> <?php echo $nome_pagina;?></a></li>
		  </ul>
		</div>
	 </div>
  	</nav>
	  	
  	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-0 col-sm-2"></div>
			<div class="col-xs-12 col-sm-8">
          <br/><br/>
          <h1 class="text-center"class="text-info">BEM VINDO ADMINISTRADOR!</h1>
          <br/>
	         <?php 
	        	
		          if(isset($_POST['btn_entrar'])){
		            include_once('phpclass/User_adm.class.php');
		            $logar = new User_adm;
		            $user = $_POST['frm_email_func'];
		            $pass = $_POST['frm_senha_func'];
		            echo $teste = $logar->logar($user, $pass);
		          }else if(isset($_POST['btn_sair'])){
		            echo "<h3>Obrigado, volte sempre!</h3>";
		          }
		          
		          if(isset($_GET['logout']) and $_GET['logout'] == 'logout'){
		          	session_start();
		        	unset($_SESSION['logado_adm']);
		        	header("Refresh:0; url=login_adm.php");
		        	exit();
		          }
		  	?>
          <p class="text-center" class="text-warning">Esta é uma área exclusiva apenas para funcionários responsáveis.</p>
          <p class="text-center" class="text-warning">Realize o Login à direita para ter acesso ao administrativo.</p>
          <br/><br/>
          <div class="col-xs-12 col-sm-6">
	          <p>Utilize o menu acima para:</p>
	          <p>Área Funcionários</p>
	          <ul>
	          	<li>Cadastrar novo funcionário;</li>
	          	<li>Alterar dados do funcionário;</li>
	          	<li>Deletar funcionário.</li>
	          </ul>
	          <p>Área Produtos</p>
	          <ul>
	          	<li>Cadastras novo produto;</li>
	          	<li>Alterar dados do produto;</li>
	          	<li>Deletar produto.</li>
	          </ul>
	        </div>
	        <div class="col-xs-12 col-sm-6">
		        <h4>Login Exclusivo para Administrador.</h4>
		        <br/>
		        <form class="form-horizontal" method="post">
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="cod">Email:</label>
		            <div class="col-sm-7">
		              <input type="email" class="form-control" id="email" placeholder="Enter email" name="frm_email_func">
		            </div>
		          </div>
		          <div class="form-group">
		            <label class="control-label col-sm-2" for="pwd">Senha:</label>
		            <div class="col-sm-7">
		              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="frm_senha_func">
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-sm-offset-2 col-sm-10">
		              <div class="checkbox">
		                <label><input type="checkbox"> Remember me</label>
		              </div>
		            </div>
		          </div>
		          <div class="form-group">
		            <div class="col-sm-offset-2 col-sm-10">
		              <button type="submit" class="btn btn-default" name="btn_entrar" style="float:center">Entrar</button>
		            </div>
		          </div>
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