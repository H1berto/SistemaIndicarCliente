<?php
  session_start();
  use app\controllers\ClienteDAO;
  require_once '../vendor/autoload.php';

  //cadastro
  if (isset($_POST['cadastro'])&&!empty($_POST['nome'])&&!empty($_POST['email'])&&!empty($_POST['senha'])&&!empty($_POST['senha2'])&&$_POST['senha']==$_POST['senha2']){    
        $dao = new ClienteDAO;
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha =$_POST['senha'];
        $dao->setNome($nome);
        $dao->setEmail($email);
        $dao->setSenha($senha);
        $response=$dao->cadastro();
        if(!is_null($response)&&$response!=false){
          $_SESSION['username'] = $response["nome"];
          $_SESSION['userid'] = $response['idCliente'];
          $_SESSION['usercontato']=$response['idClienteOrigem'];
          header("location: cliente/index.php");
        }
    }
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro no sistema</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/signin.css" rel="stylesheet">
  <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/sign-in/">
  <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/9FDDA016-C9E4-004D-B3CE-160F79E16C88/main.js" charset="UTF-8"></script>
</head>

<body class="text-center" cz-shortcut-listen="true">
    <form class="form-signin" class="needs-validation" action = "" method = "POST" novalidate>
        <h1 class="h3 mb-3 font-weight-normal">Cadastro</h1>

        <div class="mb-4">
          <label for="validationTooltip01" class="sr-only">Nome</label>
          <input name="nome" type="text" class="form-control" id="validationTooltip01" class="form-control" placeholder="Digite seu nome " required autofocus>
          <div class="invalid-tooltip">
              Digite seu nome.
          </div>
        </div>
        <div class="mb-4">
          <label for="validationTooltip02" class="sr-only">Email</label>
        <input name="email" type="email" class="form-control" id="inputEmail" id="validationTooltip02" class="form-control" placeholder="Digite seu email" required autofocus>
        <div class="invalid-tooltip">
            Digite um email valido.
          </div>
        </div>
        <div class="mb-4">
            <label for="validationTooltip03" class="sr-only">Senha</label>
        <input name="senha" type="password" class="form-control" id="inputPassword" id="validationTooltip03" class="form-control" placeholder="Digite sua senha" required>
        <div class="invalid-tooltip">
            Digite uma senha.
          </div>
        </div>
     
        <div class="mb-4">
            <label for="validationTooltip04" class="sr-only">Senha</label>
          <input name="senha2" type="password" class="form-control" id="inputPassword" id="validationTooltip03" class="form-control" placeholder="Digite sua senha novamente" required>
          <div class="invalid-tooltip">
              Digite a senha correspondente com a anterior.
            </div>
        </div>
        
        <button name="cadastro" class="btn btn-lg btn-primary btn-block" type="submit">Cadastro</button>
        <br>
        <div class="mb-3">
          <a class="h5" href="index.php">Já possui cadastro?</a>
        </div>
         <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
   
  </body>


	

</html>