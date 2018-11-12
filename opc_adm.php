<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Opções ADM</title>
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
			<div class="col-xs-6 col-sm-1"></div>
			<div class="col-xs-12 col-sm-10">
				<h2 style="text-align: center;">Aréa de Admistração do site NossaLoja.com.br</h2>
				<br/>
				
				
				
				<div class="row">
					<div class="col-sx-12 col-md-1">&nbsp;</div>
					<div class="col-sx-12 col-md-10"><!--Inico do layout da page-->
						<div class="table-responsive">
						
							<br/>
							<table class="table table-striped">
							    <thead>
							      <tr>
							      	<th class="text-center">ID_ADM</th>
							        <th class="text-center">Nome</th>
							        <th class="text-center">RG</th>
							        <th class="text-center">CPF</th>
							        <th class="text-center">Email</th>
							        <th class="text-center">Status</th>
							        <th class="text-center">Ação</th>
							      </tr>
							    </thead>
							    
							     <?php
							    	include_once("phpclass/User_adm.class.php");
							    	$adm = new User_adm;
							    	$por_pagina = 1000;//Quantidade de Itens por pagina
							    	
							    	if(isset($_POST["search_envia"])){
									    $nome_pesquisa = $_POST['nome_pesquisa'];
									   // $tipo_pesquisa = $_POST["id_adm"];
									    $busca = $adm->pesquisar($nome_pesquisa);
									    $x = $busca->rowCount();
									    echo "<h3>".$x." Funcionários encontrados!</h3>";
									    if(isset($x) and $x < 1){
									    	echo "<h3>Nenhum Funcionário encontrado como os filtros abaixo:<br/> <em><strong>Nome:</strong></em> ".$nome_pesquisa." "."<br/> Tente novamente usando outros valores! &nbsp;&nbsp;  </h3>";
									    }					    
									}else{
									    $busca = $adm->imprimir();
									}
									
									while($ln = $busca->fetch(PDO::FETCH_ASSOC)):
							    ?>
							    <tbody>
		                        	<tr>
								        <td class="text-center"><p><?php echo $ln['id_adm']; ?></p></td>
								        <td class="text-center"><p><?php echo $ln['nome']; ?></p></td>
								        <td class="text-center"><p><?php echo $ln['rg']; ?></p></td>
								        <td class="text-center"><p><?php echo $ln['cpf'];?></p></td>
								        <td class="text-center"><p><?php echo $ln['email'];?></p></td>
								        <td class="text-center"><p><?php echo $ln['status'];?></p></td>
								        <td class="text-center">
								        	<!--Btn alter produto-->
											 <a href="frm_alt_adm.php?id_up=<?php echo $ln['id_adm'];?>"><button name="btn_alterar" type="button" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span></button></a>
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
											<a href="frm_cad_adm.php"><button name="btn_cadastar" type="button" class="btn btn-success" style="width: 200px; float: right;">Cadastrar Novo Funcionário</span></button></a>
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