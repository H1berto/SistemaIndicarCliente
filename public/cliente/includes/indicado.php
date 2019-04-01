<?php 

	if (is_null($_SESSION['usercontato'])) { 
        header("location: ../index.php?");
    }
	use app\controllers\ClienteDAO;
  	require_once '../../vendor/autoload.php';
    $dao = new ClienteDAO;
 ?>
<div class="starter-template">
	<form class="form-group" action="">
	    <h1>Indicar contato de origem</h1>
	    <br>
	    <h1 class="lead mb-5">Você já indicou um contato de origem!</h1>
		<div class="card mb-5 ">
  			<div class="card-body">
    			<h2>Contato:</h2>
    			<p>
    			<?php
				
			
                $idAtual =$_SESSION['userid'];
        		$response=$dao->verificarContato($idAtual);                                  
                while($contato = $response->fetch(PDO::FETCH_ASSOC)){?>
                	<b>Nome:</b><?php echo $contato['nome']?><br>
    				<b>Email:</b><?php echo $contato['email']?>
            	<?php }?>
    				
    			</p>
 			 </div>
		</div>
		
	</form>
</div>