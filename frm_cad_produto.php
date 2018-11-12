<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro de Prodtutos</title>
  <meta charset="utf8">
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
				  <li><a href="#">Alteração</a></li>
				  <li><a href="#">Deletar</a></li>
				</ul>
			 </li>
			 <li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-gift"></span> Produtos<span class="caret"></span></a>
				<ul class="dropdown-menu">
				  <li><a href="frm_cad_produto.php">Novo Produto</a></li>
				  <li><a href="frm_alt_produto.php">Alteração</a></li>
				  <li><a href="#">Deletar</a></li>
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
        		<br/>
        		<?php 
        			include_once("phpclass/Produto.class.php");
        			include_once("phpclass/Upload.class.php");
        			include_once("phpclass/Categoria.class.php");
        			
        			$categoria = new Categoria;
        			$c = $categoria->buscar();
        			
        			if ((isset($_POST["frm_cadastrar"])) && (! empty($_FILES["frm_foto"]))){
		  				$upload = new Upload($_FILES["frm_foto"], 1000, 800, "img/");
		  				$produto = new Produto;
		  				
		  				$data_cad = date("Y/m/d");
		  				echo $cadastrar = $produto->cadastrar($_POST["frm_categoria"], $_POST["frm_nome"], $_POST['frm_preco'], $_POST["frm_qtd"], $_POST["frm_descricao"], $upload->salvar(), $data_cad);
		  			}
        			
        		?>
        		<div class="row">
        			<form name="cad_produto" action="" method="post" enctype="multipart/form-data">
			            <div class="col-xs-12 col-sm-12">
			        		<h2>Cadastro de Novo Produto.</h2>
			        		<br/>
			           		<h3>Dados do Produto:</h3>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Nome:<input class="form-control" type="text" name="frm_nome" maxlength="100" required>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Categoria:
			            	<select class="form-control" name="frm_categoria" required>
			            		<option selected disabled value=""></option>
			            		<?php 
			            		while($linha = $c->fetch(PDO::FETCH_ASSOC)):
			            		?>
			            			<option value="<?php echo $id = $linha['id_categoria']; ?>">&nbsp;<?php echo $nome = $linha['nome'];?></option>
			            		<?php endwhile; ?>
			            	</select>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Preço:<input class="form-control" type="number" step=0.01  name="frm_preco" required>
			            </div>
			            <div class="col-xs-12 col-sm-6">
				        	Qtd.:<input class="form-control" type="number" name="frm_qtd" min="1" max="999" required/>
				        </div>
				        <div class="col-xs-12 col-sm-6">
				        	Descrição:<input class="form-control" type="text" name="frm_descricao" maxlength="100" required/>
				        </div>
				        <div class="col-xs-12 col-sm-6">
				        	Foto:<input class="form-control" type="file" name="frm_foto" required/>
				        </div>
						<div class="col-xs-12 col-sm-12 text-center">
				        	<br/><br/><br/>
				            <input type="reset" class="btn btn-primary" value="Cancelar" name="frm_cancelar">
				            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				            <input type="submit" class="btn btn-primary" value="Cadastrar" name="frm_cadastrar">
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