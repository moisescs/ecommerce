<?php
    include_once("Conexao.class.php");
    class Entrega{
        public function cadastrar($id_pedido, $data_entraga, $numero_nf, $obs){
            $status = "Pendente";
            $pdo = conectar();
            $pdo->exec("SET CHARACTER SET utf8");
            $end_entrega = $pdo->prepare("SELECT EC.id_endereco as endereco, CL.id_cliente as cliente
                                            FROM End_Cliente AS EC
                                            INNER JOIN Cliente AS CL ON CL.id_cliente = EC.id_cliente
                                            INNER JOIN User_Cliente AS UC ON UC.id_cliente = CL.id_cliente
                                            INNER JOIN Pedido AS PD ON PD.id_User = UC.id_User
                                            WHERE PD.id_pedido = $id_pedido and EC.tipo = 'Entrega'");
            
            $end_entrega->execute();
            $ln = $end_entrega->fetch(PDO::FETCH_ASSOC);
            $id_endereco = $ln['endereco'];
            $id_cliente = $ln['cliente'];
            $cad = $pdo->prepare("INSERT INTO Entrega (id_endereco, id_cliente, id_pedido, data_entrega, status, numero_nf, observacao) 
	                                                    VALUES ('$id_endereco', '$id_cliente', '$id_pedido','$data_entraga','$status','$numero_nf','$obs')");
            $valida = $pdo->prepare("SELECT * FROM Entrega WHERE id_pedido = $id_pedido");
            $valida->execute();
            if($valida->rowCount() == 0){
                $cad->execute();
                echo "<p style='color: green; font-size: 2em;'>Entrega cadastrada com sucesso!</p>";
            }else {
                echo "<p style='color: red; font-size: 2em;'>Entrega já cadastrada para este pedido!</p>";
            }
        }
        
        public function entregar($id_pedido, $status, $data_entraga, $obs){
            $pdo = conectar();
            $pdo->exec("SET CHARACTER SET utf8");
            $entregar = $pdo->prepare("UPDATE Entrega SET status = '$status', data_entrega = '$data_entraga', observacao = '$obs' WHERE id_pedido = $id_pedido");
            $entregar->execute();
        }
    
    }
?>