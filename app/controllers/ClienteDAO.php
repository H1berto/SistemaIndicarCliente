<?php 

namespace app\controllers;

use Config\Database\DB;
use App\Models\Cliente;
/**
 * 
 */
class ClienteDAO extends Cliente{
	
	/**
	 * [mostrarClientes description]
	 * @return [type] [description]
	 */
	public function mostrarClientes(){
		try{
			$query = "SELECT * FROM cliente";
			$pdo=DB::getConn()->prepare($query);
			$pdo->execute();
			if($pdo->rowCount()>=1){

				while ($data = $pdo->fetchAll()) {
					
					$user=$data;
					
					return $user;
					
				}
			}	

		}catch(PDOException $e){
			dump($e->getMessage());
		}
	}

	/**
	 * [login description]
	 * @return [type] [description]
	 */
	function login(){
		
		$this->_setSenha($this->crip());
		$user = null;
		
		try{

			$sqlu = DB::getConn()->prepare("SELECT * FROM cliente WHERE email=:email AND senha=:senha");
			$sqlu->bindParam(':email',$this->getEmail());
			$sqlu->bindParam(':senha',$this->getSenha());
			$sqlu->execute();
			
			if($sqlu->rowCount()==1){

				while ($data = $sqlu->fetch(PDO::FETCH_ASSOC)) {
					
					$user=$data;
					// var_dump($user);
					
				}
			}	

		}catch(PDOException $e){
			logErros($e);

		}

		return $user;
	}
	

	/**
	 * [Função para encriptar a senha do usuario]
	 * @return $senha [é a senha encriptada do objeto Usuario]
	 */
	private function crip(){
		return md5($this->getSenha());
	}
	
	/**
	 * REQUEST METHOD POST(testes estão em GET)
	 * Função para cadastro de um usuario
	 * @param $nome [é o nome do objeto Usuario]
	 * @param $email [é o email do objeto Usuario]
	 * @param $senha [é o senha do objeto Usuario]
	 * @return $newuser [retorna um objeto Usuario com as informações do banco de dados]
	 */
	function cadastrar(){
		//variaveis padrões para cadastro
		$this->_setSenha($this->crip());
		$this->_setNome(ucfirst($this->getNome()));
		$newuser= array();
		try{

			$presql =DB::getConn()->prepare("SELECT `id` FROM `cliente` WHERE `email`=:email");
			$presql->bindParam(':email',$this->getEmail());
	        $presql->execute();

	        if($presql->rowCount()>=1){
	            //Já existe um usuario com esse email
	            $newuser= "ready";
			}else{

			    $sqln = DB::getConn()->prepare("INSERT INTO `cliente` SET  `nome`=:nome, `email`=:email, `senha`=:senha");
			    $sqln->bindParam(':nome',$this->getNome());
			    $sqln->bindParam(':email',$this->getEmail());
			    $sqln->bindParam(':senha',$this->getSenha());
			    $sqln->execute();
			    if ($sqln->rowCount()>=1) {	
					//Usuario cadastrado com sucesso	
					$newuser= "true";
				}       	
			}

		}catch(PDOException $e){
			logErros($e);
		}
		return $newuser;
	}

	/**
	 * REQUEST METHOD POST(testes estão em GET)
	 * Função para atualizar usuario de origem
	 * @param $contato [é o nome do objeto Usuario]
	 * @return $newuser [retorna um objeto Usuario com as informações do banco de dados]
	 */
	function indicarContato($idcontato){
		
		$newuser= array();
		try{

			$presql =DB::getConn()->prepare("SELECT idClienteOrigem FROM cliente WHERE idCliente = :idcliente");
			$presql->bindParam(':idCliente',$this->getIdCliente());
	        $presql->execute();

	        if($presql->rowCount()>=1){
	            //Já existe um usuario com esse email
	            $newuser= "ready";
			}else{

			    $sqln = DB::getConn()->prepare("UPDATE `cliente` SET idClienteOrigem= :idcontato WHERE idCliente=:idCliente;");
			    $sqln->bindParam(':idClienteOrigem',$this->getIdClienteOrigem());
			    $sqln->bindParam(':idCliente',$this->getIdCliente());
			    $sqln->execute();
			    if ($sqln->rowCount()>=1) {	
					//Usuario cadastrado com sucesso	
					$newuser= "true";
				}       	
			}

		}catch(PDOException $e){
			logErros($e);
		}
		return $newuser;
	}

	public function verificarContato(){

		try{
			$query = "SELECT idClienteOrigem FROM cliente WHERE idCliente=:idCliente";
			$pdo=DB::getConn()->prepare($query);
			$pdo->bindParam(':idCliente',$this->getIdCliente());
			$pdo->execute();
			if($pdo->rowCount()>=1){

				while ($data = $pdo->fetchAll()) {
					
					$user=$data;
					
					return $user;
					
				}
			}	

		}catch(PDOException $e){
			dump($e->getMessage());
		}
	}
}