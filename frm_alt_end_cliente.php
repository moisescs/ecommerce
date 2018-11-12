<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alt End Cliente</title>
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
			<div class="col-xs-0 col-sm-2"></div>
			<div class="col-xs-12 col-sm-8">
				<h3>Alteração do seu Endereço no formulário abaixo</h3>
				<?php 
					if(!isset($_SESSION["logado"])){
						$url = "pg_minha_conta.php";
						header("Location: frm_login_cliente.php?page_last=".$url);
						//header("Location: frm_login_cliente.php");
						exit();
        			}
					
					$id_cliente = $_SESSION["logado"]["id_cliente"];
					include_once("phpclass/Endereco.class.php");
        			$end = new Endereco;
					
					if (isset($_POST['btn_alterar'])) {
						
						$id_endereco = $_POST['id_endereco'];
						$id_cliente = $_POST['id_cliente'];
						$logradouro = $_POST['frm_logradouro'];
	        			$numero = $_POST['frm_numero'];
	        			$complemento = $_POST['frm_complemento'];
	        			$bairro = $_POST['frm_bairro'];
	        			$cep = $_POST['frm_cep'];
	        			$cidade = $_POST['frm_cidade'];
	        			$uf = $_POST['frm_uf'];
	        			$pais = $_POST['frm_pais'];
	        			$tipo = $_POST['frm_tipo'];
						
						
						echo $alterar = $end->alterar($id_endereco, $id_cliente, $logradouro, $numero, $complemento, $bairro, $cep, $cidade ,$uf ,$pais ,$tipo);
						header( "refresh:5;url=pg_minha_conta.php" );
					}	
					
						$mostrar = $end->imprimir($id_cliente);
	        			//var_dump($mostrar);
	        				
	        			$ln = $mostrar->fetch(PDO::FETCH_ASSOC);
						//echo $id_cliente = $ln["id_cliente"];
					
					
					
				?>
        		<br/>
        		<div class="row">
        			<form name="alt_end_cliente" action="" method="post">
			            <div class="col-xs-12 col-sm-12">
			              <h3></h3>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              ID_Endereco:<input class="form-control" type="text" name="id_endereco" maxlength="100" value="<?php echo $ln['id_endereco']; ?>" readonly="true"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              ID_Cliente:<input class="form-control" type="text" name="id_cliente" maxlength="100" value="<?php echo $ln['id_cliente']; ?>" readonly="true"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Logradouro:<input class="form-control" type="text" name="frm_logradouro" maxlength="100" value="<?php echo $ln['logradouro']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Número:<input class="form-control" type="number" name="frm_numero" min="1" max="99999" value="<?php echo $ln['numero']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Complemento:<input class="form-control" type="text" name="frm_complemento" maxlength="100" value="<?php echo $ln['complemento']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Bairro:<input class="form-control" type="text" name="frm_bairro" maxlength="50" value="<?php echo $ln['bairro']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Cep:<input class="form-control" type="text" name="frm_cep" maxlength="9" pattern="\d{5}-\d{3}" \ title="Digite o CEP no formato: xxxx-xxx" value="<?php echo $ln['cep']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Cidade:<input class="form-control" type="text" name="frm_cidade" maxlength="100" value="<?php echo $ln['cidade']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Estado:<select class="form-control" name="frm_uf" value="<?php echo $ln['uf']; ?>">
			                <option selected disabled value="">Selecione um Estado</option>
			                <option value="AC">AC</option>
			                <option value="AP">AP</option>
			                <option value="AM">AM</option>
			                <option value="BA">BA</option>
			                <option value="CE">CE</option>
			                <option value="DF">DF</option>
			                <option value="ES">ES</option>
			                <option value="GO">GO</option>
			                <option value="MA">MA</option>
			                <option value="MT">MT</option>
			                <option value="MS">MS</option>
			                <option value="MG">MG</option>
			                <option value="PR">PR</option>
			                <option value="PB">PB</option>
			                <option value="PA">PA</option>
			                <option value="PE">PE</option>
			                <option value="PI">PI</option>
			                <option value="RJ">RJ</option>
			                <option value="RN">RN</option>
			                <option value="RS">RO</option>
			                <option value="RR">RR</option>
			                <option value="SC">SC</option>
			                <option value="SE">SE</option>
			                <option value="SP">SP</option>
			                <option value="TO">TO</option>
			              </select>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Pais:<input class="form-control" type="text" name="frm_pais" maxlength="50" value="<?php echo $ln['pais']; ?>"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			              Tipo de Endereço:
			              <select class="form-control" name="frm_tipo" value="<?php echo $ln['tipo']; ?>">
			                <option selected disabled value="">Selecione o Tipo de Endereço</option>
			                <option value="Residencial">Residencial</option>
			                <option value="Comercial">Comercial</option>
			                <option value="Cobrança">Cobrança</option>
			              </select>
			            </div>
						<div class="col-xs-12 col-sm-12 text-center">
				        	<br/><br/><br/>
 							<a  class="btn btn-primary" href="pg_minha_conta.php"/>cancelar</button></a>
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