<?php
	include_once("Conexao.class.php");
	class User_adm{
	    
	    //CADATRO DE USUARIO ADM
		public function cadastrar($cpf, $nome, $email, $rg, $senha, $status){
			try{
			    $pdo = conectar();
			    $pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$insert = $pdo->prepare("INSERT INTO User_Adm(cpf, nome, email, rg, senha, status ) 
													VALUES (:cpf,:nome,:email,:rg,:senha,:status)");
				
				$insert->bindValue(":cpf",$cpf);
				$insert->bindValue(":nome",$nome);
				$insert->bindValue(":email",$email);
				$insert->bindValue(":rg",$rg);
				$insert->bindValue(":senha",$senha);
				$insert->bindValue(":status",$status);
				
					//validação do insert
				$valida=$pdo->prepare("SELECT * FROM User_Adm WHERE email = ?");
				$valida->execute(array($email));
				if($valida->rowCount() == 0)
				{
				//Executa o cadastro
					$insert->execute();
					return 1;
					
				}else
				{
					return 0;		
				}
			
			}
			catch(PDOException $erro)
			{
				echo $erro->getMessage();				
			}
			
		}
		
		public function deletar($id_adm){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    $delete = $pdo->prepare("DELETE FROM User_Adm WHERE id_adm =:id_adm");
		    $delete->bindValue(":id_adm",$id_adm);
		    $delete->execute();
		}
		
		public function alterar($cpf, $nome, $email, $rg, $senha, $status, $id_adm){
			try {
				$pdo = conectar();
			    $pdo->exec("SET CHARACTER SET utf8");
			    //Isert seguro com validação PDO
				$altera = $pdo->prepare("UPDATE User_Adm SET cpf=:cpf, nome=:nome, email=:email, rg=:rg, status=:status WHERE id_adm =:id_adm");
				$altera->bindValue(":id_adm",$id_adm);
				$altera->bindValue(":cpf",$cpf);
				$altera->bindValue(":nome",$nome);
				$altera->bindValue(":email",$email);
				$altera->bindValue(":rg",$rg);
				$altera->bindValue(":status",$status);
				$altera->execute();
				return "<p style='color: green; font-size: 2em;'>Funcionário alterado com sucesso!</p>";
				
			} catch (Exception $erro) {
				
				echo $erro->getMessage();
			}
		
		}
		
		public function imprimir(){
			$pdo = conectar();
			$pdo->exec("SET CHARACTER SET utf8");
			$busca = $pdo->prepare("SELECT * FROM User_Adm");
			$busca->execute();
			return $busca;
		}	
		
		public function pesquisar($id_adm){
			$pdo = conectar();
			$pdo->exec("SET CHARACTER SET utf8");
			$busca = $pdo->prepare("SELECT * FROM User_Adm WHERE id_adm=:id_adm");
			$busca->bindValue(":id_adm",$id_adm);
			$busca->execute();
			return $busca;
		}
		
		public function cont_adm(){
			$pdo = conectar();
			$sql= $pdo->prepare("SELECT nome FROM User_Adm WHERE nome=:nome");
			$sql->execute();
			$total_registros = $sql->rowCount();
			return $total_registros;
		}
		
		//
		public function logar($email, $senha){
			$pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
			
			if (empty($email)and empty($senha)){
				echo "<p style='color: green; font-size: 2em;'> Preencha todos os campos!</p>";
			}
			else{
				$logar = $pdo->prepare("SELECT * FROM User_Adm Where email = '$email' AND senha ='$senha'");
				$logar->execute();
				$total_registros = $logar->rowCount();
				var_dump("$total_registros");
					if($total_registros > 0){
						session_start();
						$ln = $logar->fetch(PDO::FETCH_ASSOC);
						$_SESSION["logado_adm"]["id_adm"] = $ln["id_adm"];
						$_SESSION["logado_adm"]["nome"] = $ln["nome"];
						header("Location:index_adm.php");
						exit();
					}else{ 
						echo "<p style='color: red; font-size: 2em;'>Usuario ou senha invalída!<br/>Por gentileza tente novamente ou <br/> <a href='frm_cad_cliente.php'>clique aquí para se cadastrar</a></p>"	;
						header("Location:login_adm.php");
						exit();
				}
		
			}
			
		}
		
	}
?>			

		
