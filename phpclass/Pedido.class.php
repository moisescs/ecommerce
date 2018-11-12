<?php
    include_once("Conexao.class.php");
    include_once("Carrinho.class.php");
    class Pedido{
        public function cadastrar($valor){
            session_start();
            if(isset($_SESSION["logado"]) and isset($_SESSION["carrinho"])){
               $id_user = $_SESSION["logado"]["id_user"];
               $data = date('Y/m/d');
               $forma_pag = "Boleto";
               $status = "Pendente";
               $pdo = conectar();
               $pdo->exec("SET CHARACTER SET uft8");
               $insert = $pdo->prepare("INSERT INTO Pedido (id_user, data_pedido, forma_pag, valor, status) VALUES ($id_user, '$data', '$forma_pag', '$valor', 'Pendente')");
               $insert->execute();
               
               //validação do insert
				if($insert->rowCount() > 0){
				//Pedido cadastrado.
					echo "<p style='color: green; font-size: 2em;'>Pedido cadastrado com sucesso!</p>";
					return $pdo->lastInsertId();
				}else{
				    echo "<p style='color: red; font-size: 2em;'>Ops... Ocorreu um erro contate o Adminitrador</p>";
					return 	0;
				}
            }
        }
        
        public function insertItens($id_pedido){
            session_start();
            if(isset($_SESSION["logado"]) and isset($_SESSION["carrinho"])){
				foreach($_SESSION['carrinho'] as $id => $qtd):
				    $pdo = conectar();
					$pdo->exec("SET CHARACTER SET uft8");
                    $insert = $pdo->prepare("INSERT INTO Itens_Pedido (id_pedido, id_produto, qtd) VALUES ($id_pedido, $id, $qtd)");
                    $insert->execute();
				endforeach;
            }
        }
        
        public function end_entrega($id_endereco, $id_cliente){
            $pdo = conectar();
			$pdo->exec("SET CHARACTER SET utf8");
			
			$conferir = $pdo->prepare("Update End_Cliente SET tipo ='Outro' WHERE id_cliente = $id_cliente and tipo = 'Entrega'");
			$conferir->execute();
			
			$entrega = $pdo->prepare("UPDATE End_Cliente SET tipo ='Entrega' WHERE id_endereco = $id_endereco");
			$entrega->execute();
				echo "<p style='color: green; font-size: 2em;'>Endereço alterado com sucesso!</p>";
			return $busca;
        }
       
        public function emitir_boleto($id_pedido){
            try {
                $pdo = conectar();
                $pdo->exec("SET CHARACTER SET utf8");
                $sql = $pdo->prepare("SELECT nome, cpf, rg, id_pedido, valor, logradouro, numero, complemento, cep, cidade, uf, pais
                                FROM Pedido as P
                                INNER JOIN User_Cliente as U on P.id_user = U.id_user  
                                INNER JOIN Cliente as C on U.id_cliente = C.id_cliente
                                INNER JOIN End_Cliente as E on C.id_cliente = E.id_cliente 
                                WHERE id_pedido = $id_pedido and E.tipo='Entrega'");
                $sql->execute();
                return $sql;
                
            } catch (PDOException $e) {
                
            }
            
        }
        
        public function busca_qtd($id){
            if(isset($_SESSION["logado"]) and isset($_SESSION["carrinho"]) and $id > 0){
                $pdo = conectar();
                $buscar = $pdo->prepare("SELECT qtd FROM Produto WHERE id_produto =$id");
                $buscar->execute();
                $ln = $buscar->fetch(PDO::FETCH_ASSOC);
                $qtd_banco = $ln['qtd'];  
                return $qtd_banco;
            }
        }
        
        public function alter_pedido($id_pedido, $status){
            $pdo = conectar();
            $pdo->exec("SET CHARACTER SET utf8");
            $alterar = $pdo->prepare("UPDATE Pedido SET status = '$status' WHERE id_pedido = $id_pedido");
            $alterar->execute();
            echo "<h3 style='color:green'>Pedido ID ".$id_pedido." foi ".$status." com sucesso!</h3>";
        }
        
        public function alt_qtd(){
            session_start();
            if(isset($_SESSION["logado"]) and isset($_SESSION["carrinho"])){
				foreach($_SESSION['carrinho'] as $id => $qtd):
				    $qtd_banco = $this->busca_qtd($id);
				    $newqtd = $qtd_banco - $qtd;
				    $pdo = conectar();
					$pdo->exec("SET CHARACTER SET uft8");
                    $update = $pdo->prepare("UPDATE Produto SET qtd=$newqtd WHERE id_produto = $id");
                    $update->execute();
				endforeach;

            }
		}
		
		public function imprimir($cpf, $status){
		    $pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    if(!empty($cpf) and !empty($status)){
		        $buscar = $pdo->prepare("SELECT PD.id_pedido as id_pedido, PD.valor as valor_pedido, PD.data_pedido as data, PD.status as status, CL.nome as nome_cliente, CL.sobrenome as sobrenome_cliente, CL.cpf as cpf 
                                        FROM Pedido as PD
                                        INNER JOIN User_Cliente AS UC ON PD.id_user = UC.id_user
                                        INNER JOIN Cliente AS CL ON UC.id_cliente = CL.id_cliente
                                        WHERE CL.cpf = '$cpf' and PD.status = '$status'");
		    }else {
		        $buscar = $pdo->prepare("SELECT PD.id_pedido as id_pedido, PD.valor as valor_pedido, PD.data_pedido as data, PD.status as status, CL.nome as nome_cliente, CL.sobrenome as sobrenome_cliente, CL.cpf as cpf 
                                        FROM Pedido as PD
                                        INNER JOIN User_Cliente AS UC ON PD.id_user = UC.id_user
                                        INNER JOIN Cliente AS CL ON UC.id_cliente = CL.id_cliente");  
		    }
		    
		    $buscar->execute();
		    return $buscar;
		}
		
		public function detalhar($id_pedido){
		    $pdo = conectar();
		    $pdo->exec("SET CHARACTER SET utf8");
		    $buscar = $pdo->prepare("SELECT CL.nome as nome_cliente, CL.sobrenome as sobrenome_cliente, CL.cpf as cpf_cliente,PD.id_pedido as id_do_pedido, PR.id_produto as id_produto, PR.nome as nome_produto, PR.descricao as descricao_produto, IP.qtd as qtd_item, PD.status as status_pedido
                                        FROM Itens_Pedido AS IP
                                        INNER JOIN Pedido AS PD ON PD.id_pedido = IP.id_pedido
                                        INNER JOIN Produto as PR ON PR.id_produto = IP.id_produto
                                        INNER JOIN User_Cliente AS UC ON PD.id_user = UC.id_user
                                        INNER JOIN Cliente AS CL ON CL.id_cliente = UC.id_cliente
                                        WHERE PD.id_pedido = $id_pedido");
		    
		    $buscar->execute();
		    return $buscar;
		}
    }
?>