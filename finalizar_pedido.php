<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Finalizar Pedido</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
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

	<div class="container">
		<?php
			session_start();
			if(!isset($_SESSION["logado"])){
				$url = "carrinho.php";
				header("Location: frm_login_cliente.php?page_last=".$url);
				//header("Location: frm_login_cliente.php");
				exit();
			}
		?>
		<div class="row">
			<h3 style="text-align:center">Falta pouco para finalizar sua compra!</h3>
			<br/>
			<div class="col-xs-12 col-sm-1">&nbsp;</div>
			<div class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<h3>Selecione seu endeço para entrega, ou Cadastre um novo endereço!</h3>
						<br/><br/>
					<table class="table table-striped">
							<tr>
								<th>Logradouro</th>
								<th class="text-center">Nº</th>
								<th class="text-center">Comp.</th>
								<th class="text-center">Bairro</th>
								<th class="text-center">Cep.</th>
								<th class="text-center">Cidade</th>
								<th class="text-center">UF</th>
								<th class="text-center">País</th>
								<th class="text-center">Tipo</th>
								<th class="text-center">Alterar</th>
							</tr>  
							<?php
								include_once("phpclass/Pedido.class.php");
								include_once("phpclass/Endereco.class.php");
								
								$end = new Endereco;
								$pedido = new Pedido;
								$valorTotal = 0;
								
								session_start();
								if(isset($_SESSION["logado"])){
									$id_user = $_SESSION["logado"]["id_user"];
									$id_cliente = $_SESSION["logado"]["id_cliente"];
									$end_cliente = $end->imprimir($id_cliente);
									if(isset($_POST["btn-alt-end"])){
										$pedido = new Pedido;
										$id_endereco = $_POST["tipo"];
										if(!empty($id_endereco)){
											echo $alter = $pedido->end_entrega($id_endereco, $id_cliente);
											echo "<meta HTTP-EQUIV='refresh' CONTENT='1;URL=finalizar_pedido.php'>";
										}else{
											$valor = $_SESSION["pedido"]["valor"];
											$cad_pedido = $pedido->cadastrar($valor);
											$insert_itens = $pedido->insertItens($cad_pedido);
											$baixa = $pedido->alt_qtd();
											$_SESSION["pedido"]["id_pedido"] = $cad_pedido;
											header( "refresh:0;url=boleto_bb.php");
										}
										
									}
								
									if(isset($_POST["new_end"])){
										session_start();
										$_SESSION['cliente']['id_cliente'] = $id_cliente;
										header( "refresh:0;url=frm_end_cliente.php" );
									}
									
									while($ln = $end_cliente->fetch(PDO::FETCH_ASSOC)):
										$id_cliente = $ln["id_cliente"];
								?>
								<tr>
									<td><?php echo $ln["logradouro"];?></td>
									<td><?php echo $ln["numero"];?></td>
									<td><?php echo $ln["complemento"];?></td>
									<td><?php echo $ln["bairro"];?></td>
									<td><?php echo $ln["cep"];?></td>
									<td><?php echo $ln["cidade"];?></td>
									<td><?php echo $ln["uf"];?></td>
									<td><?php echo $ln["pais"];?></td>
									<td><?php echo $ln["tipo"];?></td>
									<td>
										<form action method="post">
											<input type="radio" name="tipo" value="<?php echo $ln['id_endereco'];?>"> Entrega
									</td>
								</tr>
							<?php endwhile;} ?>
							<tfoot>
								<tr>
									<td class="text-center" colspan="10">
										<br/>
										<br/>
											<a  class="btn btn-danger" href="carrinho.php" style="float:left;"/>Voltar ao Carrinho</button></a>
											<!--<input class="btn btn-danger" type="submit" name="new_end" value="Cadastrar Novo Endereço"/>-->
											<a  class="btn btn-danger" href="frm_alt_end_cliente.php?id=<?php echo $id_cliente;?>"/>alterar Endereço de Entrega</button></a>
											<input class="btn btn-danger" type="submit" name="btn-alt-end" value="Salvar Alterações e emitir Boleto" style="float:right;"/>
										</form>
									</td>
								</tr>
								<tr>
									<td colspan="10" class="text-center">
										 <?php 
										// 	
										// ?>
									
									</td>
								</tr>
							</tfoot>
						</table>
						
						
					</div>
					<div class="col-xs-12 col-sm-6">
						
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-1">&nbsp;</div>
		</div>
	</div><!--Fechamento da div Class Conatainer-->
	<br>
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