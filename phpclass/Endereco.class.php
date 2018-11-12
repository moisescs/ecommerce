<?php
	include_once("Conexao.class.php");
	class Endereco{

		public function cadastrar($id_cliente, $logradouro, $numero, $complemento, $bairro, $cep, $cidade ,$uf ,$pais ,$tipo){
			try{
			    $pdo = conectar();
			    $pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$insert = $pdo->prepare("INSERT INTO End_Cliente(id_endereco, id_cliente, logradouro, numero, complemento, bairro, cep, cidade, uf, pais, tipo) 
													VALUES (:id_endereco,:id_cliente, :logradouro, :numero, :complemento, :bairro, :cep, :cidade, :uf, :pais, :tipo)");
				
				$insert->bindValue(":id_endereco",$id_endereco);
				$insert->bindValue(":id_cliente",$id_cliente);
				$insert->bindValue(":logradouro",$logradouro);
				$insert->bindValue(":numero",$numero);
				$insert->bindValue(":complemento",$complemento);
				$insert->bindValue(":bairro",$bairro);
				$insert->bindValue(":cep",$cep);
				$insert->bindValue(":cidade",$cidade);
				$insert->bindValue(":uf",$uf);
				$insert->bindValue(":pais",$pais);
				$insert->bindValue(":tipo",$tipo);
				
				$insert->execute();
			    return "<p style='color: green; font-size: 2em;'>Endereco cadastrado com sucesso, <a href='tipo_produto.php'>clique aqui para iniciar as compras</a> ou aguarde o redirecionamento automático.</p>";
			    
			
			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();				
			}
		}
		
		
		
		public function alterar($id_endereco, $id_cliente, $logradouro, $numero, $complemento, $bairro, $cep, $cidade ,$uf ,$pais ,$tipo){
			try {
				$pdo = conectar();
			   	$pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$altera = $pdo->prepare("UPDATE End_Cliente SET id_endereco=:id_endereco, id_cliente=:id_cliente, logradouro=:logradouro, numero=:numero, complemento=:complemento, bairro=:bairro, cep=:cep, cidade=:cidade, uf=:uf, pais=:pais, tipo=:tipo WHERE id_cliente=:id_cliente");
				$altera->bindValue(":id_endereco",$id_endereco);
				$altera->bindValue(":id_cliente",$id_cliente);
				$altera->bindValue(":logradouro",$logradouro);
				$altera->bindValue(":numero",$numero);
				$altera->bindValue(":complemento",$complemento);
				$altera->bindValue(":bairro",$bairro);
				$altera->bindValue(":cep",$cep);
				$altera->bindValue(":cidade",$cidade);
				$altera->bindValue(":uf",$uf);
				$altera->bindValue(":pais",$pais);
				$altera->bindValue(":tipo",$tipo);
				$altera->execute();
				return "<p style='color: green; font-size: 2em;'>Endereço alterado com sucesso!</p>";
			} catch (Exception $erro ) {
				echo $erro->getMessage();
			}
		}
	
	
		public function deletar($id_cliente){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    $delete = $pdo->prepare("DELETE FROM End_Cliente WHERE id_cliente = :id_cliente");
		    $delete->bindValue(":id_cliente",$id_cliente);
		    $delete->execute();
		    echo $texto ="usuario deletado com sucesso ";
		}
			
		public function imprimir($id_cliente){
			$pdo = conectar();
			$pdo->exec("SET CHARACTER SET utf8");
			$busca = $pdo->prepare("SELECT * FROM End_Cliente WHERE id_cliente = :id_cliente");
			$busca->bindValue(":id_cliente",$id_cliente);
			$busca->execute();
			return $busca;
		}
		
	}
?>			