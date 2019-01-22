<?php 
/**
* 
*/
class parceirosModel{
	private $id;
	private $grupos_id;
	private $nome;
    private $pagina;


	
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
    public function _setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of grupos_id.
     *
     * @return mixed
     */
    public function getGruposId()
    {
        return $this->grupos_id;
    }

    /**
     * Sets the value of grupos_id.
     *
     * @param mixed $grupos_id the grupos id
     *
     * @return self
     */
    public function _setGruposId($grupos_id)
    {
        $this->grupos_id = $grupos_id;

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
    public function _setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Gets the value of pagina.
     *
     * @return mixed
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Sets the value of pagina.
     *
     * @param mixed $pagina the pagina
     *
     * @return self
     */
    public function _setPagina($pagina)
    {
        $this->pagina = $pagina;

        return $this;
    }
}
?>