<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>LoginUser.NossaLoja</title>
	<link rel="stylesheet" href="css/bootstrap.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
					
			 ?>
			 <li class="active"><a href="<?php echo $pagina;?>?page_last=index.php"><span class="glyphicon glyphicon-log-in" class="caret"></span> <?php echo $nome_pagina;?></a></li>
		  </ul>
		</div>
	 </div>
  	</nav>

<div class="container-fluid">
<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6">
      <div class="jumbotron">
        <h3>Faça login para continuar com  sua compra.</h3>
        <br/>
        <?php 
          if(isset($_POST['btn-entrar'])){
            include_once('phpclass/User_cliente.class.php');
            $logar = new User_cliente;
            $user = $_POST['frm_user'];
            $pass = $_POST['frm_pass'];
            $page_last = $_GET['page_last'];
            $logar->logar($user, $pass, $page_last );
          }else if(isset($_POST['btn-sair'])){
            echo "<h3>Obrigado, volte sempre!</h3>";
          }else{
            
          }
        
        ?>
        <form class="form-horizontal" active="" method="post">
          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-5">
              <input type="email" class="form-control" id="email" name="frm_user" placeholder="Enter email" name="frm_email_usuario">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Senha:</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" id="pwd" name="frm_pass" placeholder="Enter password" name="frm_senha_usuario">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <a href="frm_cad_cliente.php">Ainda não tenho cadastro no site!</a>
              <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" name="btn-sair" class="btn  btn-success" style="width: 90px;">Sair</button>
              &nbsp;&nbsp;&nbsp;&nbsp;
              <button type="submit" name="btn-entrar" class="btn  btn-success" style="width: 90px;">Entrar</button>
            </div>
          </div>
        </form>
      </div>  
    </div>
  </div>

  <div class="col-sm-3"></div>

</body></html>