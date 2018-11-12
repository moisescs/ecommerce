<?php
	include_once("Conexao.class.php");
	class Cliente{
		public function cadastrar($cpf, $nome, $data_nasci, $rg, $sobrenome){
			try{
			    $pdo = conectar();
			    $pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$insert = $pdo->prepare("INSERT INTO Cliente(cpf, nome, data_nasci, rg, sobrenome) 
													VALUES (:cpf,:nome,:data_nasci,:rg,:sobrenome)");
				
				$insert->bindValue(":cpf",$cpf);
				$insert->bindValue(":nome",$nome);
				$insert->bindValue(":data_nasci",$data_nasci);
				$insert->bindValue(":rg",$rg);
				$insert->bindValue(":sobrenome",$sobrenome);
				
					//validação do insert
				$valida=$pdo->prepare("SELECT * FROM Cliente WHERE cpf = ?");
				$valida->execute(array($cpf));
				if($valida->rowCount() == 0){
				//Executa o cadastro
					$insert->execute();
					echo "<p style='color: green; font-size: 2em;'>Usuario cadastrado com sucesso!</p>";
					return $pdo->lastInsertId();
				}else{
					echo "<p style='color: red; font-size: 2em;'>Já existe um usuario cadastrado com este cpf!</p>";	
				
				}
			}catch(PDOException $erro){
				echo $erro->getMessage();				
			}
			
		}
		
		public function deletar($id_cliente){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    $delete = $pdo->prepare("DELETE FROM Cliente WHERE id_cliente = :id_cliente");
		    $delete->bindValue(":id_cliente",$id_cliente);
		    $delete->execute();
		    echo $texto ="usuario deletado com sucesso ";
		}	
			
		
		public function alterar($id_cliente, $cpf, $nome, $data_nasci, $rg, $sobrenome){
			try {
				$pdo = conectar();
			   	$pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$altera = $pdo->prepare("UPDATE Cliente SET cpf=:cpf, nome=:nome, data_nasci=:data_nasci, rg=:rg, sobrenome=:sobrenome WHERE id_cliente = :id_cliente");
				$altera->bindValue(":id_cliente",$id_cliente);
				$altera->bindValue(":cpf",$cpf);
				$altera->bindValue(":nome",$nome);
				$altera->bindValue(":data_nasci",$data_nasci);
				//$altera->bindValue(":email",$email);
				$altera->bindValue(":rg",$rg);
				$altera->bindValue(":sobrenome",$sobrenome);
				$altera->execute();
				return "<p style='color: green; font-size: 2em;'>Dados alterados com sucesso!</p>";
			} catch (Exception $erro ) {
				echo $erro->getMessage();
			}
		}
		
		
	     public function imprimir($id_cliente){
			$pdo = conectar();
			$pdo->exec("SET CHARACTER SET utf8");
			$busca = $pdo->prepare("SELECT * FROM Cliente WHERE id_cliente =:id_cliente");
			$busca->bindValue(":id_cliente",$id_cliente);
			$busca->execute();
			return $busca;
			
		}
		
		public function cont_cliente(){
			$pdo = conectar();
			$sql= $pdo->prepare("SELECT * FROM Cliente");
			$sql->execute();
			$total_registros = $sql->rowCount();
			return $total_registros;
		}
	}
?>			
