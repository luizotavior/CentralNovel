<?php 

class novelsModel{
	public $id;
	public $nome;
	public $chave;



    /**
     * Gets the value of id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the value of id.
     *
     * @param mixed $id the id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of nome.
     *
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Sets the value of nome.
     *
     * @param mixed $nome the nome
     *
     * @return self
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of chave.
     *
     * @return mixed
     */
    public function getChave()
    {
        return $this->chave;
    }

    /**
     * Sets the value of chave.
     *
     * @param mixed $chave the chave
     *
     * @return self
     */
    public function setChave($chave)
    {
        $this->chave = $chave;

        return $this;
    }
}
?>