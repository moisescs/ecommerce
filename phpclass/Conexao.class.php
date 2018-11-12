<?php
	function conectar(){
		try{
			$pdo = new PDO("mysql:host=localhost;dbname=ecommerce","root","TecWeb@2016");
		}catch(PDOException $erro){
			echo $erro->getMessage();
		}
		return $pdo;
	}
?>