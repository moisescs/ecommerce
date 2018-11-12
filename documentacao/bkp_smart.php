<!DOCTYPE html>
<html lang="en">
<head>
  <title>Nossa Loja.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">NossaLoja</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#" class="active">Produtos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">SmartPhones</a></li>
            <li><a href="#">Tv's</a></li>
            <li><a href="#">Notebooks/PC Desktop</a></li>
          </ul>
        </li>
        <li><a href="#">Sobre Nós</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="cadastro.html"><span class="glyphicon glyphicon-user"></span> Cadastro</a></li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in" class="caret"></span> Login</a>
            <ul class="dropdown-menu">        
                <li><a href="login_usuario.html">Usuário</a></li>
                <li><a href="login_func.html">Funcionário</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">

    <div class="row">
        <div class="col-sm-2">
            <nav class="nav-sidebar">
                <ul class="nav">
                    <li class="active"><a href="javascript:;">Iphones</a></li>
                    <li><a href="javascript:;">Samsung</a></li>
                    <li><a href="javascript:;">Motorola</a></li>
                    <li><a href="javascript:;">Asus</a></li>
                 </ul>
            </nav>
        </div>
        <div class="col-sm-2 col-sm-offset-8">
        </div>
    </div>
</div>

</body>
</html>
