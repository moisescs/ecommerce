<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Alteração de Prodtutos</title>
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
        		<br/>
        		<?php 
        			include_once("phpclass/Produto.class.php");
        			include_once("phpclass/Upload.class.php");
        			include_once("phpclass/Categoria.class.php");
        			
        			$categoria = new Categoria;
        			$c = $categoria->buscar();
        			$produto = new Produto;
        			
        			if(isset($_GET["id_up"]) and !empty($_GET["id_up"])){
        				$id_produto = $_GET["id_up"];
        				$mostrar = $produto->detalhar($id_produto);
        				$ln = $mostrar->fetch(PDO::FETCH_ASSOC);
        				$data_cad = date("Y/m/d");
        				if(isset($_POST["btn_alterar"])){
        					
	        				$upload = new Upload($_FILES["frm_foto"], 1000, 800, "img/");
	        				$foto = $upload->salvar();
	        				$id_categoria = $_POST["frm_categoria"];
	        				$nome = $_POST["frm_nome"];
	        				$preco = $_POST["frm_preco"];
	        				$qtd = $_POST["frm_qtd"];
	        				$descricao = $_POST["frm_descricao"];
	        				$data_cad;
	        				echo $alterar = $produto->alterar($id_produto, $id_categoria, $nome, $preco, $qtd, $descricao, $foto, $data_cad);
	        				header( "refresh:5;url=opc_produto.php" );
	        				
        				}	
        			}
        		?>
        		<div class="row">
        			<form name="alt_produto" action="" method="post" enctype="multipart/form-data">
        				
			            <div class="col-xs-12 col-sm-12">
			            	<h2>Alteração de  Produtos.</h2>
			            	<br/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Foto do Produto:
			            	<img src="<?php echo $ln['foto'];?>"  class="img-responsive" style="width:80%" style="align-img-center" alt="Image"/>
			            </div>
			            <div class="col-xs-12 col-sm-6">
			            	Novo Nome:<input class="form-control" type="text" name="frm_nome" maxlength="100" value="<?php echo $ln['nome']; ?>"/>
			            	Nova Categoria:
			            	<select class="form-control" name="frm_categoria"/>
			            		<option selected disabled value=""></option>
			            		<?php 
			            		while($linha = $c->fetch(PDO::FETCH_ASSOC)):
			            		?>
			            			<option value="<?php echo $id_cate = $linha['id_categoria'];?>">&nbsp;<?php echo $nome = $linha['nome'];?></option>
			            		<?php endwhile; ?>
			            	</select>
			            	Novo Preço:<input class="form-control" type="number" step=0.01  name="frm_preco" value="<?php echo $ln['preco']; ?>"/>
				        	Nova Qtd.:<input class="form-control" type="number" name="frm_qtd" min="1" max="999" value="<?php echo $ln['qtd']; ?>"/>
				        	Nova Descrição:<input class="form-control" type="text" name="frm_descricao" maxlength="100" value="<?php echo $ln['descricao']; ?>"/>
				        	Nova Foto:<input class="form-control" type="file" name="frm_foto" required/>
				        </div>
						<div class="col-xs-12 col-sm-12 text-center">
				        	<br/><br/><br/>
				            <input type="reset" class="btn btn-primary" value="Cancelar" name="frm_cancelar">
				            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				            <input type="submit" class="btn btn-primary" value="Salvar Alteração" name="btn_alterar">
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