<?php
	include_once("Conexao.class.php");
	class User_cliente{
	    
	    //CADASTRO DE USUARIO ADM
		public function cadastrar($id_cliente, $nome, $login, $senha,$status){
			try{
			    $pdo = conectar();
			    $pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$insert = $pdo->prepare("INSERT INTO User_Cliente(id_cliente, nome, login,  senha, status ) 
													VALUES (:id_cliente,:nome,:login,:senha,:status)");
				
				$insert->bindValue(":id_cliente",$id_cliente);
				$insert->bindValue(":nome",$nome);
				$insert->bindValue(":login",$login);
				$insert->bindValue(":senha",$senha);
				$insert->bindValue(":status",$status);
				
					//validação do insert
				$valida=$pdo->prepare("SELECT * FROM User_Cliente WHERE login = ?");
				$valida->execute(array($login));
				if($valida->rowCount() == 0)
				{
				//Executa o cadastro
					$insert->execute();
					return "<p style='color: green; font-size: 2em;'>Usuario cadastrado com sucesso!</p>";
				}else
				{
					return "<p style='color: red; font-size: 2em;'>Já existe um usuario cadastrado com este email!</p>";		
				}
			
			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();				
			}
			
		}
		
		public function deletar($id_cliente){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    $delete = $pdo->prepare("DELETE FROM User_Cliente WHERE id_cliente =:id_cliente");
		    $delete->bindValue(":id_cliente",$id_cliente);
		    $delete->execute();
		}	
			
		public function alterar($id_cliente, $nome, $login, $senha,$status,$id_user){
		try {
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    //Isert seguro com validação PDO
			$altera = $pdo->prepare("UPDATE User_Cliente SET  nome=:nome, login=:login,senha=:senha, status=:status WHERE id_user =:id_user");
			    $altera->bindValue(":id_user",$id_user);
				$altera->bindValue(":nome",$nome);
				$altera->bindValue(":login",$login);
				$altera->bindValue(":senha",$senha);
				$altera->bindValue(":status",$status);
			$altera->execute();
			return "<p style='color: green; font-size: 2em;'>Usuario alterado com sucesso!</p>";
			
		} catch (Exception $erro) {
			
			echo $erro->getMessage();
		}
		
		}
		
		
		
		public function logar($login, $senha){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
			
			if (empty($login)and empty($senha)){
				echo "<p style='color: green; font-size: 2em;'> preencha todos os campos!</p>";
			}
			else{
				$logar = $pdo->prepare("SELECT * FROM User_Cliente Where login = '$login' AND senha ='$senha' ");
				$logar->execute();
				$total_registros = $logar->rowCount();
				if($total_registros==1){
					echo "<p style='color: green; font-size: 2em;'>Usuario logado com sucesso!</p>"	;
					session_start();
					$session['usuario']="jhow viado";
					echo $session['usuario'];
					
				}
				else
				{ 
					echo "<p style='color: green; font-size: 2em;'>Usuario ou senha incorreta!</p>"	;
				}
		
			}
			
		}
		
		
	}
?>			
