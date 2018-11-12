<?php
	include_once("Conexao.class.php");
	class Telefone{
		public function cadastrar($dd, $numero, $tipo, $id_cliente){
			try{
			    $pdo = conectar();
			    $pdo->exec("SET CHARACTER SET utf8");
		    //Isert seguro com validação PDO
				$insert = $pdo->prepare("INSERT INTO Tel_Cliente(dd, numero, tipo, id_cliente) 
													VALUES (:dd,:numero,:tipo,:id_cliente)");
				
				$insert->bindValue(":dd",$dd);
				$insert->bindValue(":numero",$numero);
				$insert->bindValue(":tipo",$tipo);
				$insert->bindValue(":id_cliente",$id_cliente);
				
					//validação do insert
				$valida=$pdo->prepare("SELECT * FROM Tel_Cliente WHERE numero = ?");
				$valida->execute(array($numero));
				if($valida->rowCount() == 0)
				{
				//Executa o cadastro
					$insert->execute();
					return "<p style='color: green; font-size: 2em;'> Telefone de Usuario cadastrado com sucesso!</p>".$pdo->lastInsertId();
				}else
				{
					return "<p style='color: red; font-size: 2em;'>este telefone de usuario ja esta cadastrado !</p>";		
				}
			
			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();				
			}
			
		}
		
		public function deletar($id_tel){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    $delete = $pdo->prepare("DELETE FROM Tel_Cliente WHERE id_tel = :id_tel");
		    $delete->bindValue(":id_tel",$id_tel);
		    $delete->execute();
		    echo $texto =" telefone deletado com sucesso ";
		}	
		
		public function alterar($dd, $numero, $tipo, $id_cliente){
		try {
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    //Isert seguro com validação PDO
			$altera = $pdo->prepare("UPDATE Tel_Cliente SET numero=:numero, dd=:dd, tipo=:tipo WHERE id_cliente=:id_cliente");
			$altera->bindValue(":numero",$numero);
			$altera->bindValue(":dd",$dd);
			$altera->bindValue(":tipo",$tipo);
			$altera->bindValue(":id_cliente",$id_cliente);
			$altera->execute();
			return "<p style='color: green; font-size: 2em;'>Usuario alterado com sucesso!</p>";
			
		} 
		
		catch (Exception $erro) 
		{
			
			echo $erro->getMessage();
		}
		
		}
	}		
	
	
?>	