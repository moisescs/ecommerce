<?php
    include_once("Conexao.class.php");
    class Categoria{
        public function buscar(){
            $pdo = conectar();
            $pdo->exec("SET CHARACTER SET utf8");
            $busca = $pdo->prepare("SELECT * FROM Categoria");
            $busca->execute();
            return $busca;
        }
        
    }
?>