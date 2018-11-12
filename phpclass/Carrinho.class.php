<?php 
    require_once("Conexao.class.php");
    class Carrinho{
        public function add($id){
            $pdo = conectar();
            $buscar = $pdo->prepare("SELECT qtd FROM Produto WHERE id_produto =$id");
            $buscar->execute();
            $ln    = $buscar->fetch(PDO::FETCH_ASSOC);
            $qtd_banco = $ln['qtd'];
            
            if(!isset($_SESSION['carrinho'][$id])){
               $_SESSION['carrinho'][$id] = 1;
            }else{
                if($qtd_banco >  $_SESSION['carrinho'][$id]){
                    $_SESSION['carrinho'][$id] += 1;
                }else{
                     echo "<script> alert('Quntidade Indisponivel!');</script>";
                }
                
            }
        }
        
        public function del($id){
            if(isset($_SESSION['carrinho'][$id])){
               unset($_SESSION['carrinho'][$id]);
            }
        }
        
        public function up($id, $qtd){
            $pdo = conectar();
            $buscar = $pdo->prepare("SELECT qtd FROM Produto WHERE id_produto =$id");
            $buscar->execute();
            $ln    = $buscar->fetch(PDO::FETCH_ASSOC);
            $qtd_banco = $ln['qtd'];
            if($qtd > 0){
                if($qtd_banco >  $qtd){
                    $_SESSION['carrinho'][$id] = $qtd;
                }else{
                     echo "<script> alert('Quntidade Indisponivel!');</script>";
                }    
            }else{
                 unset($_SESSION['carrinho'][$id]);
            }
        }
        
    //     public function finalizarCompra(){
    //         if(!isset($_SESSION['logado'])){
    //             $url = "finalizar_pedido.php";
    //             header("Location: frm_login_cliente.php?page_last=".$url);
    //         }else{
    //             $url = "finalizar_pedido.php";
				// header("Location: $url");
				// exit();
    //         }
    //     }
        
        public function imprimir($id){
            $pdo = conectar();
            $pdo->exec("SET CHARACTER SET utf8");
			$busca = $pdo->prepare("SELECT *  FROM Produto WHERE id_produto= $id");
			$busca->execute();
			return $busca;
        }
        
    }
?>