<html>
<head>
	<meta charset="utf-8">
	<title>LoginFuncionario.NossaLoja</title>
	<link rel="stylesheet" href="css/bootstrap.css" >
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
        <li><a href="home.html">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Produtos <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Sobre Nós</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="cadastro.html"><span class="glyphicon glyphicon-user"></span> Cadastro</a></li>
        <li class="dropdown"  class="active">
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

<div class="container-fluid">
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
      <div class="jumbotron">
        <h3>Login Exclusivo para Funcionários.</h3>
        <br/>
        <form class="form-horizontal">
          <div class="form-group">
            <label class="control-label col-sm-2" for="cod">Código:</label>
            <div class="col-sm-5">
              <input type="email" class="form-control" id="email" placeholder="Enter code" name="frm_cod_func">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Senha:</label>
            <div class="col-sm-5">
              <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="frm_senha_func">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Entrar</button>
             
            </div>
          </div>
        </form>
      </div>
    </div>
    </div>

    <div class="col-sm-3"></div>
    
 

</body></html>
    