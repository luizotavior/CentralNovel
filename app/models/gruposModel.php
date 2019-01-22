<?php 
/**
* 
*/
class gruposModel{
	public $id;
	public $nome;
    public $email;
	public $link;
	public $feed;
    public $pagina;
    public $clicks;
    public $ativo;
    public $data_nasc;
    public $data_last;

	

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
     * Gets the value of link.
     *
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Sets the value of link.
     *
     * @param mixed $link the link
     *
     * @return self
     */
    public function _setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Gets the value of feed.
     *
     * @return mixed
     */
    public function getFeed()
    {
        return $this->feed;
    }

    /**
     * Sets the value of feed.
     *
     * @param mixed $feed the feed
     *
     * @return self
     */
    public function _setFeed($feed)
    {
        $this->feed = $feed;

        return $this;
    }

    /**
     * Gets the value of ativo.
     *
     * @return mixed
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Sets the value of ativo.
     *
     * @param mixed $ativo the ativo
     *
     * @return self
     */
    public function _setAtivo($ativo)
    {
        $this->ativo = $ativo;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    public function _setEmail($email)
    {
        $this->email = $email;

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

    /**
     * Gets the value of clicks.
     *
     * @return mixed
     */
    public function getClicks()
    {
        return $this->clicks;
    }

    /**
     * Sets the value of clicks.
     *
     * @param mixed $clicks the clicks
     *
     * @return self
     */
    public function _setClicks($clicks)
    {
        $this->clicks = $clicks;

        return $this;
    }

    /**
     * Gets the value of data_nasc.
     *
     * @return mixed
     */
    public function getDataNasc()
    {
        return $this->data_nasc;
    }

    /**
     * Sets the value of data_nasc.
     *
     * @param mixed $data_nasc the data nasc
     *
     * @return self
     */
    public function _setDataNasc($data_nasc)
    {
        $this->data_nasc = $data_nasc;

        return $this;
    }

    /**
     * Gets the value of data_last.
     *
     * @return mixed
     */
    public function getDataLast()
    {
        return $this->data_last;
    }

    /**
     * Sets the value of data_last.
     *
     * @param mixed $data_last the data last
     *
     * @return self
     */
    public function _setDataLast($data_last)
    {
        $this->data_last = $data_last;

        return $this;
    }
}

 ?>