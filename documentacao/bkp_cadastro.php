<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro.NossaLoja</title>
	<link rel="stylesheet" href="css/bootstrap.css">
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
              <li><a href="smart.html">SmartPhones</a></li>
              <li><a href="#">TV's</a></li>
              <li><a href="#">Notebooks/PC</a></li>
            </ul>
          </li>
          <li><a href="#">Sobre Nós</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="cadastro.html"><span class="glyphicon glyphicon-user"></span> Cadastro</a></li>
          <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-log-in" class="caret"> Login</span></a>
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
      <div class="col-xs-0 col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
        <h3>Novo Usuário? Realize seu cadastro no formulário abaixo:</h3>
        <br/>
        <div class="row">
          <form name="cad_cliente" action="" method="get">
            <div class="col-xs-12 col-sm-12">
              <h3>Dados Pessoais:</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
              Nome:<input class="form-control" type="text" name="frm_nome" required>
            </div>
            <div class="col-xs-12 col-sm-6">
              Sobrenome:<input class="form-control" type="text" name="frm_sobrenome req" required>
            </div>
            <div class="col-xs-12 col-sm-6">
               RG:<input class="form-control" type="text" name="frm_rg" required pattern="\d{2}\.\d{3}\.\d{3}-\d{1,2}" \ title="Digite um RG no formato: xx.xxx.xxx-x"/>
            </div>
            <div class="col-xs-12 col-sm-6">
              CPF:<input class="form-control" type="text" name="frm_cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" \ title="Digite um CPF no formato: xxx.xxx.xxx-xx"/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Data de NAscimento:<input class="form-control" type="date" name="frm_data_nasci" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              E-mail:<input class="form-control" type="email" name="frm_email" required/>
            </div>
            
            <div class="col-xs-12 col-sm-12">
              <h3>Endereço Residêncial:</h3>
            </div>
            <div class="col-xs-12 col-sm-6">
              Logradouro:<input class="form-control" type="text" name="frm_logradouro" maxlength="100" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Número:<input class="form-control" type="number" name="frm_numero" min="1" max="99999" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Complemento:<input class="form-control" type="text" name="frm_complemento" maxlength="100" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Bairro:<input class="form-control" type="text" name="frm_bairro" maxlength="50" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Cep:<input class="form-control" type="text" name="frm_cep" maxlength="9" pattern="\d{5}-\d{2}" \ title="Digite o CEP no formato: xxxx-xxx" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Cidade:<input class="form-control" type="text" name="frm_cidade" maxlength="100" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Estado:<select class="form-control" name="frm_uf" required>
                <option selected disabled value="">Selecione um Estado</option>
                <option value="AC">AC</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="MG">MG</option>
                <option value="PR">PR</option>
                <option value="PB">PB</option>
                <option value="PA">PA</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SE">SE</option>
                <option value="SP">SP</option>
                <option value="TO">TO</option>
              </select>
            </div>
            <div class="col-xs-12 col-sm-6">
              Pais:<input class="form-control" type="text" name="frm_pais" maxlength="50" required/>
            </div>
            <div class="col-xs-12 col-sm-6">
              Tipo de Endereço:
              <select class="form-control" name="frm_tipo" required>
                <option selected disabled>Selecione o Tipo de Endereço</option>
                <option value="Residencial">Residencial</option>
                <option value="Comercial">Comercial</option>
                <option value="Cobrança">Cobrança</option>
              </select>
            </div>
            <div class="col-xs-12 col-sm-12 text-center">
              <br/><br/><br/>
              <input type="reset" class="btn btn-primary" value="Cadastrar">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="submit" class="btn btn-primary" value="Cadastrar">
            </div>
          </form>
        </div><!--Fim da Row Form-->
      <div class="col-xs-0 col-sm-1"></div>
    </div><!--Fim da Row pricipal-->
	</div>
	<br><br>
</body>
</html>