<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Opções Pedidos</title>
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
			 <li class="dropdown">
				  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in" class="caret"></span> Login</a>
				  <ul class="dropdown-menu">
						<li><a href="login_adm.php">Funcionário/ADM</a></li>
				  </ul>
			 </li>
		  </ul>
		</div>
	 </div>
  	</nav>
  	
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-6 col-sm-1"></div>
			<div class="col-xs-12 col-sm-10">
				<h2 style="text-align: center;">Aréa de Admistração do site NossaLoja.com.br</h2>
				<br/>
				<div class="row">
					<div class="col-sx-12 col-md-1">&nbsp;</div>
					<div class="col-sx-12 col-md-10"><!--Inico do layout da page-->
					<h3>Detalhes do Pedido</h2>
						<div class="table-responsive">
							<table class="table table-striped">
							    <thead>
							      <tr>
							        <th class="text-center">Cod.</th>
							        <th class="text-center">Nome do Produto</th>
							        <th class="text-center">Descrição</th>
							        <th class="text-center">Qtd</th>
							      </tr>
							    </thead>
							    
							     <?php
							    	include_once("phpclass/Pedido.class.php");
							    	$pedido = new Pedido;
							    	$detalhe = $pedido->detalhar($_GET['id']);
							    	$dados = $detalhe->fetch(PDO::FETCH_ASSOC);
							    	echo "<h4>Cod. do Pedido: ".$dados['id_do_pedido']." - Status do Pedido: ".$dados['status_pedido']."</h4>";
							    	echo "<h4>Nome do Cliente: ".$dados['nome_cliente']." ".$dados['sobrenome_cliente']." - CPF: ".$dados['cpf_cliente']."</h4>";
									$detalhe = $pedido->detalhar($_GET['id']);
									while($ln = $detalhe->fetch(PDO::FETCH_ASSOC)):
							    ?>
							    <tbody>
		                        	<tr>
								        <td class="text-center"><p><?php echo $ln['id_produto'];?></td>
								        <td class="text-center"><p><?php echo $ln['nome_produto'];?></p></td>
								        <td class="text-center"><p><?php echo $ln['descricao_produto']; ?></p></td>
								        <td class="text-center"><p><?php echo $ln['qtd_item']; ?></p></td>
									</tr>
								</tbody>
								<?php endwhile; ?>
								<tfoot>
									<tr>
										<td colspan="6"></td>
									</tr>
								</tfoot>
							</table>
							<?php
								include_once("phpclass/Entrega.class.php");
								$entrega = new Entrega();
								if($_POST['btn_fim_entrega']){
									$e = $entrega->entregar($_GET['id'], $_POST['frm_status'], $_POST['frm_data_entrega'], $_POSt['frm_obs']);
								}
							?>	
							<form action="" method="post">
								<h3>Pedido foi entregue?</h3>
								<div class="col-sx-12 col-md-6">
									<p>
										Data de Entrega:
										<input class="form-control" type="date" name="frm_data_entrega" required/>
									</p>
								</div>
								<div class="col-sx-12 col-md-6">
									<p>
										Status:
										<select class="form-control" name="frm_status" required>
											<option selected disabled value=""></option>
											<option value="Entregue">Entregue</option>
											<option value="Cancelada">Cancelada</option>
										</select>
									</p>
								</div>
								<div class="col-sx-12 col-md-12">
									<p>
										Observações:
										<textarea class="form-control" name="frm_obs" required></textarea>	
									</p>
								</div>
								<div class="col-sx-12 col-md-12">
									<br/>
									<br/>
									<a href="opc_pedido.php"><button name="btn_voltar" type="button" class="btn btn-success" style="width: 180px; float: left;">Voltar</button></a>
									<input class="btn btn-success" type="submit" value="Finalizar" name="btn_fim_entrega" style="float:right;"/>
									<br/>
									<br/>
									<br/>
									<br/>
								</div>
							</form>
						</div><!--Fim da Div Class table Reponsiva-->
					</div><!--Fim do layout da page-->
					<div class="col-sx-12 col-md-1">&nbsp;</div>
				</div><!--Fim roww-->
			</div>
			<div class="col-xs-12 col-sm-1"></div>
		</div>
	</div><!--Fim da Div container-->
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