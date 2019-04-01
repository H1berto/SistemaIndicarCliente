<?php 

namespace app\controllers;

use config\database\DB;
use app\models\Cliente;
use PDO;
/**
 * 
 */
class ClienteDAO extends Cliente{
	
	/**
	 * [Função para mostrar clientes]
	 * @return [type] [description]
	 */
	public function mostrarClientes($id){
		try{
			$idCliente=$id;
			$pdo=DB::getConn()->prepare("SELECT * FROM cliente WHERE idCliente != :idCliente");
			$pdo->bindParam(':idCliente',$idCliente);
			$pdo->execute();
			if($pdo->rowCount()>=1){
					$user=$pdo;
			}	

		}catch(PDOException $e){
			dump($e->getMessage());
		}
		return $user;
	}

	/**
	 * [Função de login]
	 * @return [type] [description]
	 */
	function login(){
		
		$this->setSenha($this->crip());
		$email = $this->getEmail();
		$senha = $this->getSenha();
		$user = null;
		
		try{

			$sqlu = DB::getConn()->prepare("SELECT * FROM cliente WHERE email=:email AND senha=:senha");
			$sqlu->bindParam(':email',$email);
			$sqlu->bindParam(':senha',$senha);
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
	
	 * [Função para cadastro de um usuario]
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
	function indicarContato(){
		$idCliente = $this->getIdCliente();
		$idClienteOrigem = $this->getIdClienteOrigem();
		$indicado=false;
		try{

			    $sqln = DB::getConn()->prepare("UPDATE `cliente` SET idClienteOrigem= :idClienteOrigem WHERE idCliente=:idCliente;");
			    $sqln->bindParam(':idClienteOrigem',$idClienteOrigem);
			    $sqln->bindParam(':idCliente',$idCliente);
			    $sqln->execute();
			    if ($sqln->rowCount()>=1) {	
					//Usuario cadastrado com sucesso	
					$indicado= true;
				}       	
			

		}catch(PDOException $e){
			logErros($e);
		}
		return $indicado;
	}

	public function verificarContato($id){
		try{
			
			$query = "SELECT o.nome, o.email FROM cliente AS c JOIN cliente AS o ON c.idClienteOrigem = o.idCliente WHERE c.idCliente = :idCliente";
			$pdo=DB::getConn()->prepare($query);
			$pdo->bindParam(':idCliente',$id);
			$pdo->execute();
			if($pdo->rowCount()>=1){
				$contato=$pdo;
			}	
			
		}catch(PDOException $e){
			dump($e->getMessage());
		}
		return $contato;
	}
}