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
						<div class="table-responsive">
							
							
							<form class="form-inline text-center" action="" method="post">
								<div class="form-group">
								     <input type="search" name="cpf_pesquisa" class="form-control" placeholder="Nome do item" size=60%;>
								</div>
								<div class="form-group">
								    <select name="status_pesquisa" class="form-control">
								    	<option selected disabled value="">Status do Pedido</option>
								    	<option value="Pendente">Pendente</option>
								    	<option value="Aprovado">Aprovado</option>
								    	<option value="Cancelado">Cancelado</option>
								    </select>
								</div>
								<div class="form-group">
									<button type="submit" name="search_envia" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
								</div>
							</form>
							<br/>
							<table class="table table-striped">
							    <thead>
							      <tr>
							        <th class="text-center">Id</th>
							        <th class="text-center">Nome do Cliente</th>
							        <th class="text-center">CPF</th>
							        <th class="text-center">Valor</th>
							        <th class="text-center">Data Ped.</th>
							        <th class="text-center">Entrega</th>
							        <th class="text-center">Status</th>
							        <th class="text-center">Ação</th>
							      </tr>
							    </thead>
							    
							     <?php
							    	include_once("phpclass/Pedido.class.php");
							    	include_once("phpclass/Entrega.class.php");
							    	$pedido = new Pedido;
							    	$entrega = new Entrega;
							    	$por_pagina = 1000;//Quantidade de Itens por pagina
							    	
							    	if((isset($_GET['id_ped'])) and (isset($_GET['acao']))){
							    		$id = $_GET['id_ped'];
							    		$status = $_GET['acao'];
							    		$p = $pedido->alter_pedido($id, $status);
							    	}
							    	if(isset($_GET['acao']) and ($_GET['acao'] == "Aprovado") and isset($_GET['id_ped'])){
							    		$id_pedido = $_GET['id_ped'];
							    		$data_entraga = date('Y/m/d', strtotime('+8 days'));
							    		$numero_nf = "";
							    		$bos = "";
							    		$cad_entrega = $entrega->cadastrar($id_pedido, $data_entraga, $numero_nf, $obs);
							    	}
							    	
							    	
							    	if(isset($_POST["search_envia"])){
									    $cpf_pesquisa = $_POST["cpf_pesquisa"];
									    $status_pesquisa = $_POST["status_pesquisa"];
									    $busca = $pedido->imprimir($cpf_pesquisa,$status_pesquisa);
									    $x = $busca->rowCount();
									    echo "<h3>".$x." Pedido(s) encontrado(s)!</h3>";
									    if(isset($x) and $x < 1){
									    	echo "<h2>Nenhum pedido encontrado como os filtros abaixo:<br/> <em><strong>CPF:</strong></em> ".$cpf_pesquisa." <br/> <em><strong>Status:</strong></em> ".$status_pesquisa."<br/> Tente novamente usando outros valores! &nbsp;&nbsp;  :(</h2>";
									    }					    
									}else{
									    $busca = $pedido->imprimir("","");
									}
									
									while($ln = $busca->fetch(PDO::FETCH_ASSOC)):
							    ?>
							    <tbody>
		                        	<tr>
								        <td class="text-center"><p><?php echo $ln['id_pedido'];?></td>
								        <td class="text-center"><p><?php echo $ln['nome_cliente']." ".$ln['sobrenome_cliente'];?></p></td>
								        <td class="text-center"><p><?php echo $ln['cpf']; ?></p></td>
								        <td class="text-center"><p><?php echo "R$ ".$ln['valor_pedido']; ?></p></td>
								        <td class="text-center"><p><?php echo $ln['data'];?></p></td>
								        <td class="text-center"><p>&nbsp;</p></td>
								        <td class="text-center"><p><?php echo $ln['status'];?></p></td>
								        <td class="text-center">
								        	<!--Btns ações do pedido-->
								        	<a href="detalhe_pedido.php?id=<?php echo $ln['id_pedido'];?>"><button name="btn_cancelar" type="button" class="btn btn-primary" title="Detalhes do Pedido"><span class="glyphicon glyphicon-list-alt"></span></button></a>
								        	<a href="opc_pedido.php?acao=Aprovado&id_ped=<?php echo $ln['id_pedido'];?>"><button name="btn_aprovar" type="button" class="btn btn-success" title="Aprovar Pedido"><span class="glyphicon glyphicon-ok"></span></button></a>
								        	<a href="opc_pedido.php?acao=Cancelado&id_ped=<?php echo $ln['id_pedido'];?>"><button name="btn_cancelar" type="button" class="btn btn-danger" title="Cancelar Pedido"><span class="glyphicon glyphicon-remove"></span></button></a>
								        	
								        </td>
									</tr>
								</tbody>
								<?php endwhile; ?>
								<tfoot>
									<tr>
										<td colspan="3">
											<a href="index_adm.php"><button name="btn_voltar" type="button" class="btn btn-success" style="width: 180px; float: left;">Voltar</button></a>
										</td>
										<td colspan="4">
											
										</td>
									</tr>
								</tfoot>
							</table>
							
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