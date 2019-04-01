<?php 

namespace app\models;
/**
 * 
 */
class Cliente {
	
	private $idCliente;
	private $nome;
	private $email;
	private $senha;
	private $idClienteOrigem;

    /**
     * @return mixed
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setIdCliente($id)
    {
        $this->idCliente = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     *
     * @return self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdClienteOrigem()
    {
        return $this->idClienteOrigem;
    }

    /**
     * @param mixed $idClienteOrigem
     *
     * @return self
     */
    public function setIdClienteOrigem($idClienteOrigem)
    {
        $this->idClienteOrigem = $idClienteOrigem;

        return $this;
    }
}
