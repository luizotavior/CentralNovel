<?php 

class log_linkModel{
    private $id;
    private $grupo_id;
    private $ip;
    private $data;

    

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
     * Gets the value of grupo_id.
     *
     * @return mixed
     */
    public function getGrupoId()
    {
        return $this->grupo_id;
    }

    /**
     * Sets the value of grupo_id.
     *
     * @param mixed $grupo_id the grupo id
     *
     * @return self
     */
    public function _setGrupoId($grupo_id)
    {
        $this->grupo_id = $grupo_id;

        return $this;
    }

    /**
     * Gets the value of ip.
     *
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Sets the value of ip.
     *
     * @param mixed $ip the ip
     *
     * @return self
     */
    public function _setIp($ip)
    {
        $this->ip = $ip;

        return $this;
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

        return $this;
    }
}
 ?>