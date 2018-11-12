<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alterar Dados Adm</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css" type="text/css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	function validaSenha (input){ 
		if (input.value != document.getElementById('senha').value) {
			input.setCustomValidity('Repita a senha corretamente');
		} else {
			input.setCustomValidity('');
		}
	} 
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
					$nome_pagina = "Login";
					$pagina = "login_adm.php";
				}
					
			 ?>
			 <li class="active"><a href="<?php echo $pagina;?>"><span class="glyphicon glyphicon-log-in" class="caret"></span> <?php echo $nome_pagina;?></a></li>
		  </ul>
		</div>
	 </div>
  	</nav>
  	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-0 col-sm-2"></div>
			<div class="col-xs-12 col-sm-8">
				<h3>Alteração de Dados Do Funcionário.</h3>
        		<br/>
        		<div class="row">
        			<?php
        				$id_adm = $_SESSION["logado_adm"]["id_adm"];
						include_once("phpclass/User_adm.class.php");
        				$adm = new User_adm;
        			
        				if (isset($_POST['btn_alterar'])) {
	        				
	        					//alterar();
        						
	        					$cpf = $_POST['frm_cpf'];
	        					$nome = $_POST['frm_nome'];
	        					$rg = $_POST['frm_rg'];
	        					$status = $_POST['frm_status'];
	        					$id_adm = $_POST['id_adm'];
	        					$email = $_POST['frm_email'];
	        					
	        					//alterar($cpf, $nome, $email, $rg,$senha,$status,$id_adm){
	        					//echo $alterar = $cliente->alterar($_POST["id_cliente"], $_POST["frm_cpf"], $_POST["frm_nome"], $_POST["frm_data_nasci"], $_POST["frm_rg"], $_POST["frm_sobrenome"], $_POST["frm_email"]);
	        					echo $alterar = $adm->alterar($cpf, $nome, $email, $rg, $senha, $status, $id_adm);
	        					header( "refresh:5;url=opc_adm.php" );
        					
        						//header( "refresh:7;url=frm_alt_end_cliente.php" ); 
								//unset($_SESSION['cliente']);
        						
	        				}
	        				
	        					$mostrar = $adm->pesquisar($_GET['id_up']);
	        					
	        				
	        					$ln = $mostrar->fetch(PDO::FETCH_ASSOC);
	        					
        			?>
        			
        			
        			
        			<form name="alt_cad_adm" action="" method="post">
			            <div class="col-xs-12 col-sm-12">
			              <h3>Dados Pessoais do Funcionário:</h3>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	ID_ADM:<input class="form-control" type="text" name="id_adm" maxlength="50" value="<?php echo $ln['id_adm']; ?>" readonly="true"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Nome:<input class="form-control" type="text" name="frm_nome" maxlength="50" value="<?php echo $ln['nome']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
				        	RG:<input class="form-control" type="text" name="frm_rg" maxlength="13" pattern="\d{2}\.\d{3}\.\d{3}-\d{1,2}" \ title="Digite um RG no formato: xx.xxx.xxx-x" value="<?php echo $ln['rg']; ?>"/>
				        </div>
				        <div class="col-xs-12 col-sm-6">
				        	CPF:<input class="form-control" type="text" name="frm_cpf" maxlength="14"  pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" \ title="Digite um CPF no formato: xxx.xxx.xxx-xx" value="<?php echo $ln['cpf']; ?>"/>
				        </div>
				        <div class="col-xs-12 col-sm-6">
				        	Status:<input class="form-control" type="text" name="frm_status" value="<?php echo $ln['status']; ?>" />
				        </div>
				        <div class="col-xs-12 col-sm-6">
				        	E-mail:<input class="form-control" type="email" name="frm_email" maxlength="100" value="<?php echo $ln['email']; ?>"/>
				        </div>
				      
				       
				        
						<div class="col-xs-12 col-sm-12 text-center">
				        	<br/><br/><br/>
				            <input type="reset" class="btn btn-primary" value="Cancelar" name="frm_cancelar">
				            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				            <input type="submit" class="btn btn-primary" value="Alterar" name="btn_alterar">
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