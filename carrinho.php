<?php
    session_start();
    include_once("phpclass/Carrinho.class.php");
    $c = new Carrinho;
       
    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = array();
    }
      
    if(isset($_GET['acao'])){
         //ADICIONAR CARRINHO
        if($_GET['acao'] == 'add'){
           $id = intval($_GET['id']);
           $c->add($id);
    	}
          
        //REMOVER CARRINHO
        if($_GET['acao'] == 'del'){
            $id = intval($_GET['id']);
            $c->del($id);
         }
          
         //ALTERAR QUANTIDADE
        if($_GET['acao'] == 'up'){
            $id  = intval($_GET['id']);
            $qtd = intval($_GET['qtd']);
            $c->up($id, $qtd);
        }
    }
    
    if(isset($_POST['finalizar'])){
    	if(!isset($_SESSION['logado'])){
                 $url = "carrinho.php";
                 header("Location: frm_login_cliente.php?page_last=".$url);
             }else{
             	session_start();
             	$_SESSION["pedido"]["valor"] = $_POST["total"];
                $url = "finalizar_pedido.php";
				header("Location: $url");
				exit();
             }
    }
       
       
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Carrinho de Compras</title></title>
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
			 <li><a href="<?php echo $pagina;?>?page_last=index.php"><span class="glyphicon glyphicon-log-in" class="caret"></span> <?php echo $nome_pagina;?></a></li>
		  </ul>
		</div>
	 </div>
  	</nav>

	<div class="container">
		<div class="row">
			<h3 style="text-align:center"> <span class="glyphicon glyphicon-shopping-cart"></span>Carrinho de Compras</h3>
			<br/>
			<div class="col-xs-12 col-sm-1">&nbsp;</div>
			<div class="col-xs-12 col-sm-10">
				<div class="row">
					<div class="table-responsive">
						<table class="table table-striped">
						    <thead>
						      <tr>
						        <th class="text-center">Imagem</th>
						        <th class="text-center">Nome</th>
						        <th class="text-center">Descrição</th>
						        <th class="text-center" style="width:150px !important;">Quantidade</th>
						        <th class="text-center">Preço</th>
						        <th class="text-center">Subtotal</th>
						        <th class="text-center">Remover</th>
						      </tr>
						    </thead>
					    <tbody>
								<?php
					            	if(count($_SESSION['carrinho']) == 0){
					                     echo '<tr><td colspan="5"><h3>Ainda não há produtos no seu carrinho!</h3></td></tr>';
					                }else{
					                require_once("phpclass/Conexao.class.php");
					                $total = 0;
					                $pdo = conectar();
					                foreach($_SESSION['carrinho'] as $id => $qtd):
					                	$pdo = conectar();
									    $busca = $c->imprimir($id);
					                    $ln    = $busca->fetch(PDO::FETCH_ASSOC);
					                    $id_produto = $ln['id_produto'];           
					                    $nome  = $ln['nome'];
					                    $preco = number_format($ln['preco'], 2, ',', '.');
					                    //$qtd = $ln['qtd'];
					                    $descricao = $ln['descricao'];
					                    $foto = $ln['foto'];
					                    $sub   = $ln['preco'] * $qtd;
					                    //$total += $ln['preco'] * $qtd;
					                    $total += $sub;
					                    
					            ?>
                        	
                        		<tr>
						        <td class="muted center_text" style="margin: auto;">
								   	<img src="<?php echo $foto;?>" style="width:50px;" alt='Image'>
								 </td>
						        <td class="text-center"><p><?php echo $nome; ?></p></td>
						        <td class="text-center"><p><?php echo $descricao; ?></p></td>
						        <td class="text-center">
									<form action="?acao=up" method="get">
										<input type="hidden" name="acao" value="up"/>
										<input type="hidden" name="id" value="<?php echo $id_produto;?>"/>	
										<div class="input-group" style="margin:auto;">
											<input type="text" class="form-control" name="qtd" value="<?php echo $qtd;?>" style="width:45px;"/>
											<button class="form-control input-group-addon" style="width:35px;"><i class="glyphicon glyphicon-refresh"></i></button>
										</div>
									</form>
						        </td>
						        <td class="text-center"><p><?php echo $preco;?></p></td>
						        <td class="text-center"><p><?php echo $sub   = number_format($ln['preco'] * $qtd, 2, ',', '.');?></p></td>
						        <td class="text-center">
						        	<!--Btn remover produto do carrinho-->
									 <a href="carrinho.php?acao=del&id=<?php echo $id_produto;?>"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-trash"></span></button></a>
						        </td>
							</tr>
                        <?php endforeach;
					     } //Fehamento do que verifica se existe a condição
                        ?>
                           <tr>
                               	<td colspan="7" style="text-align: right;"><h3>Total R$: <?php echo $fomattotal = number_format($total, 2, ',', '.');?></h3></td>
                        	</tr>
               
						    </tbody>
						    <tfoot>
						        <td colspan="3">
						        	<form action="" method="post">
						        		<input type="hidden" name="total" value="<?php echo $total;?>"/>
						        		<button type="submit"  name="finalizar" class="btn btn-success" style="width: 200px; float: left;">Finalizar a Compra!</button></a>
						        	</form>
						        </td>
						        <td>&nbsp;</td>
						        <td colspan="3">
						        	<a href="tipo_produto.php"><button class="btn btn-success" style="float:right; width: 200px;">Continuar Comprando!</button></a>
						        </td>
						    </tfoot>
						 </table>
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