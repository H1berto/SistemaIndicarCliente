
<div class="starter-template">
	<form class="form-group" action="" method="POST">
	    <h1>Indicar contato de origem</h1>
	    <br>
	    <h2 class="lead mb-5">Aqui você poderá indicar outro cliente como seu contato de origem!</h2>
		<select class="custom-select mb-4" name="contato">
			<option selected value="0">Selecione um contato</option>
			<?php
				
				use app\controllers\ClienteDAO;
  				require_once '../../vendor/autoload.php';
                $dao = new ClienteDAO;
                $idAtual =$_SESSION['userid'];
        		$response=$dao->mostrarClientes($idAtual);                                  
                while($contatos = $response->fetch(PDO::FETCH_ASSOC)){?>
                	<option value="<?php echo $contatos['idCliente']?>"><?php echo $contatos['nome'] ?></option>';
            <?php }?>
        
		</select>
		<button class="btn btn-lg btn-primary" type="submit">Indicar</button>
	</form>
</div>