<?php
   /* Tantando o metodo cadastrar da classe Telefone*/
   
   
   /*include "phpclass/Telefone.class.php";
   $cadastrar = new Telefone;
    

   echo $dd = "11";
   echo $numero = "1111-1113";
   echo $tipo= "casa";
   echo $id_cliente = 1;
   
   echo $teste = $cadastrar->cadastrar($dd, $numero, $tipo, $id_cliente)*/
   
//   include_once("phpclass/Endereco.class.php");
//   $cadastrar = new Endereco;
   
//   echo $id_cliente = "17"."<br/>"; 
//   echo $logradouro = "Rua c"."<br/>";
//   echo $numero = "100"."<br/>";
//   echo $complemento = "cs12333"."<br/>";
//   echo $bairro = "xbxbx"."<br/>";
//   echo $cep = "02855-180"."<br/>";
//   echo $cidade = "São Paulo" ."<br/>";
//   echo $uf  = "so"."<br/>";
//   echo $pais = "Brasil"."<br/>";
//   echo $tipo = "Residencial"."<br/>";

//   $insert = $cadastrar->cadastrar($id_cliente, $logradouro, $numero, $complemento, $bairro, $cep, $cidade ,$uf ,$pais ,$tipo); 
   
   // include_once("phpclass/User_cliente.class.php");
   // $logar = new User_cliente;
   // echo $logar->logar("jhonatas@hotmail.com","123");
   
   include_once("phpclass/Pedido.class.php");
//    $pedido = new Pedido;
   
//    $valor = 100;
//  $id_pedido = $pedido->cadastrar($valor);
//  if($id_pedido > 0){
//     echo   $itens = $pedido->insertItens($id_pedido);
//  }
   
  session_start();
//   if(isset($_SESSION["logado"])){
//     unset ($_SESSION["logado"]);
//   }

    //session_destroy();
// include_once("phpclass/User_cliente.class.php");
// $user = new User_cliente;
// $teste = $user->cadastrar(1, "moisescs1234@hotmail.com", "teste","Ativo");

    // include_once("phpclass/Pedido.class.php");
    // $pedido = new Pedido;
    // $p = $pedido->emitir_boleto(20);
    // var_dump($p);
    
    // while($linha = $p->fetch(PDO::FETCH_ASSOC)){
    //     echo $linha["nome"];
    //     echo $linha["cpf"];
    //     echo $linha["rg"];
    //     echo $linha["id_pedido"];
    //     echo $linha["valor"];
    //     echo $linha["logradouro"];
    //     echo $linha["numero"];
    //     echo $linha["complemento"];
    //     echo $linha["cep"];
    //     echo $linha["cidade"];
    //     echo $linha["uf"];
    //     echo $linha["pais"];;
    // }

//   include_once("phpclass/Entrega.class.php");
//   $entrega = new Entrega;
//   $id_pedido = 47;
//   $data_entraga = "2016/12/31";
//   $numero_nf = "00407";
//   $obs = "teste";
//   $e = $entrega->cadastrar($id_pedido, $data_entraga, $numero_nf, $obs)

echo date('Y/m/d', strtotime('+5 days'));
?>

