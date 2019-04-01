<?php
  session_start();
  use app\controllers\ClienteDAO;
  require_once '../vendor/autoload.php';

  //login
  if (isset($_POST['login'])&&!empty($_POST['email'])&&!empty($_POST['senha'])){    
        $dao = new ClienteDAO;
        $email = $_POST['email'];
        $senha =$_POST['senha'];
        $dao->setEmail($email);
        $dao->setSenha($senha);
        $response=$dao->login();
        if(!is_null($response)){
          $_SESSION['username'] = $response["nome"];
          $_SESSION['userid'] = $response['idCliente'];
          header("location: cliente/index.php");
        }
    }
  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login no sistema</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/signin.css" rel="stylesheet">
  <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/sign-in/">
  <script type="text/javascript" src="https://gc.kis.v2.scr.kaspersky-labs.com/9FDDA016-C9E4-004D-B3CE-160F79E16C88/main.js" charset="UTF-8"></script>
</head>

<body class="text-center" cz-shortcut-listen="true">
    <form class="form-signin" class="needs-validation" action = "" method = "POST" novalidate>
        <h1 class="h3 mb-3 font-weight-normal">Login</h1>
        <div class="mb-4">
          <label for="inputEmail" class="sr-only">Email</label>
          <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        </div>
        <div class="mb-4">
          <label for="inputPassword" class="sr-only">Senha</label>
          <input name="senha" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        </div>
        <button name="login" class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <br><p>Ou</p>
        <div class="mb-3">
          <a class="h5" href="cadastro.php">Cadastre-se</a>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>

  </body>


	

</html>