<?php 

/**
* 
*/
class guardar_feedModel{
	private $id;
	private $titulo;
	private $grupo;
    private $novel;
	private $data;
    private $link;
    private $volume;
    private $capitulo;
    private $parte;

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
    }

    /**
     * Gets the value of titulo.
     *
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Sets the value of titulo.
     *
     * @param mixed $titulo the titulo
     *
     * @return self
     */
    public function _setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * Gets the value of grupo.
     *
     * @return mixed
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Sets the value of grupo.
     *
     * @param mixed $grupo the grupo
     *
     * @return self
     */
    public function _setGrupo($grupo)
    {
        $this->grupo = $grupo;
    }

    /**
     * Gets the value of data.
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sets the value of data.
     *
     * @param mixed $data the data
     *
     * @return self
     */
    public function _setData($data)
    {
        $this->data = $data;
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
     * Sets the value of novel.
     *
     * @param mixed $novel the novel
     *
     * @return self
     */
    public function _setNovel($novel)
    {
        $this->novel = $novel;

        return $this;
    }

    /**
     * Gets the value of novel.
     *
     * @return mixed
     */
    public function getNovel()
    {
        return $this->novel;
    }

    /**
     * Gets the value of volume.
     *
     * @return mixed
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Sets the value of volume.
     *
     * @param mixed $volume the volume
     *
     * @return self
     */
    public function _setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Gets the value of capitulo.
     *
     * @return mixed
     */
    public function getCapitulo()
    {
        return $this->capitulo;
    }

    /**
     * Sets the value of capitulo.
     *
     * @param mixed $capitulo the capitulo
     *
     * @return self
     */
    public function _setCapitulo($capitulo)
    {
        $this->capitulo = $capitulo;

        return $this;
    }

    /**
     * Gets the value of parte.
     *
     * @return mixed
     */
    public function getParte()
    {
        return $this->parte;
    }

    /**
     * Sets the value of parte.
     *
     * @param mixed $parte the parte
     *
     * @return self
     */
    public function _setParte($parte)
    {
        $this->parte = $parte;

        return $this;
    }
}
 ?>