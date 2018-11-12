<?php
	include_once("Conexao.class.php");
	class Produto{
		public function cadastrar($id_categoria, $nome, $preco, $qtd, $descricao, $foto, $data_cad){
			try{
			    $pdo = conectar();
			    $pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$insert = $pdo->prepare("INSERT INTO Produto(id_categoria, nome, preco, qtd, descricao, foto, data_cad) 
													VALUES (:id_categoria,:nome,:preco,:qtd,:descricao,:foto,:data_cad)");
				
				$insert->bindValue(":id_categoria",$id_categoria);
				$insert->bindValue(":nome",$nome);
				$insert->bindValue(":preco",$preco);
				$insert->bindValue(":qtd",$qtd);
				$insert->bindValue(":descricao",$descricao);
				$insert->bindValue(":foto", $foto);
				$insert->bindValue(":data_cad",$data_cad);

				
				//validação do insert
				$valida=$pdo->prepare("SELECT * FROM Produto WHERE nome = ?");
				$valida->execute(array($nome));
				if($valida->rowCount() == 0){
				//Executa o cadastro
					$insert->execute();
					return "<p style='color: green; font-size: 2em;'>Produto cadastrado com sucesso!</p>";
				}else{
					return "<p style='color: red; font-size: 2em;'>Já existe um produto cadastrado com este nome!</p>";	
				}
			}catch(PDOException $erro){
				echo $erro->getMessage();				
			}
			
		}
		
		public function deletar($id_produto){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    $delete = $pdo->prepare("DELETE FROM Produto WHERE id_produto =:id_produto");
		    $delete->bindValue(":id_produto",$id_produto);
		    $delete->execute();
		}

	
		public function alterar($id_produto, $id_categoria, $nome, $preco, $qtd, $descricao, $foto, $data_cad){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    //Isert seguro com validação PDO
			$altera = $pdo->prepare("UPDATE Produto SET id_categoria=:id_categoria, nome=:nome, preco=:preco, qtd=:qtd, descricao=:descricao, foto=:foto_prod, data_cad=:data_cad WHERE id_produto=:id_produto");
			$altera->bindValue(":id_produto",$id_produto);
			$altera->bindValue(":id_categoria",$id_categoria);
			$altera->bindValue(":nome",$nome);
			$altera->bindValue(":preco",$preco);
			$altera->bindValue(":qtd",$qtd);
			$altera->bindValue(":descricao",$descricao);
			$altera->bindValue(":data_cad",$data_cad);
			$altera->bindValue(":foto_prod", $foto);
			$altera->execute();
			echo "<p style='color: green; font-size: 2em;'>Produto alterado com sucesso!</p>";;
		}
		
	//Continuara apartir daquí.......		
		
		public function imprimir($inicio, $offset, $condicao){
			$pdo= conectar();
			$pdo->exec("SET CHARACTER SET utf8");
			if($condicao == "tudo"){
				$busca = $pdo->prepare("SELECT p.id_produto, p.id_categoria as produto_id_categoria, p.nome as nome_produto, p.descricao, p.preco, p.qtd, c.nome as categoria, foto
										FROM Produto as p 
										JOIN Categoria as c
										ON p.id_categoria = c.id_categoria 
										GROUP BY c.id_categoria;");
			}else if($condicao == "listar"){
				$busca = $pdo->prepare("SELECT p.id_produto, p.id_categoria as produto_id_categoria, p.nome as nome_produto, p.descricao, p.preco, p.qtd, c.nome as categoria, foto
										FROM Produto as p 
										JOIN Categoria as c
										ON p.id_categoria = c.id_categoria");
			}
			else{
				$busca = $pdo->prepare("SELECT id_produto, id_categoria, nome, descricao, foto, preco FROM Produto WHERE id_categoria = $condicao and qtd <> 0 LIMIT $inicio OFFSET $offset");
			}
			$busca->execute();
			return $busca;
		}
		
		public function detalhar($id_produto){
			$pdo = conectar();
			$pdo->exec("SET CHARACTER SET utf8");
			$detalhe = $pdo->prepare("SELECT * FROM Produto WHERE id_produto =:id_produto");
			$detalhe->bindValue(":id_produto",$id_produto);
			$detalhe->execute();
			return $detalhe;
		}
		
		public function pesquisar($nome, $id_categoria){
			$pdo = conectar();
			$pdo->exec("SET CHARACTER SET utf-8");
			$busca = $pdo->prepare("SELECT id_produto, id_categoria as produto_id_categoria, nome as nome_produto, descricao, preco, qtd, foto
										FROM Produto WHERE id_categoria=:id_categoria AND nome LIKE :nome");
			$busca->bindValue(":nome","%".$nome."%");
			$busca->bindValue(":id_categoria",$id_categoria);
			$busca->execute();
			return $busca;
		}
		
		public function cont_produto(){
			$pdo = conectar();
			$sql= $pdo->prepare("SELECT * FROM Produto");
			$sql->execute();
			$total_registros = $sql->rowCount();
			return $total_registros;
		}
		
	}
?>