<?php 

class Route{
    
    private $_url;
    private $_route;

    public function __construct($_url)
    {
        $this->_url =  $_url;
        $base = basename($this->_url);
        $this->_route = $base;
    }

    public function getURL()
    {
        return $this->_url;
    }

    public function getRoute()
    {
        return $this->_route;
    }

   
}

