<?php
   /* Tantando o metodo cadastrar da classe produto*/
   
   
    include_once "phpclass/User_cliente.class.php";
   $logar = new User_cliente;
    
  $login ="jhonatas@hotmail.com"; 
  $senha = "123";
 /* echo $numero = "teste";
  echo $complemento= "teste";
  echo $bairro = "desativado";
  echo $cep = "desativado";
  echo $cidade = "desativado";
  echo $uf = "sp";
  echo $pais = "desativado";
  echo $tipo = "desativado";*/
  session_start();
  if(isset($_SESSION["logado"])){
    unset ($_SESSION["logado"]);
  }
    //echo $teste = $logar->logar($login, $senha, $page_last);

   
                              
    
    
    
   
?>


