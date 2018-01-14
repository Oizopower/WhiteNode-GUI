<?php
  
class DataManager 
{    
    private $_db;    
    private $_tablepath = "/var/www/public/";
    private $_tableself = "addressself";
    private $_tableother = "addressother";
    private $_tablepass = "password";
    private $_tablelang = "language";
    private static $_instance;    
    
    private function __construct()    
    {    
        $this->_db = new JsonDB($this->_tablepath);
        $this->_db->createTable($this->_tableself);
        $this->_db->createTable($this->_tableother);
        $this->_db->createTable($this->_tablepass);
        $this->_db->createTable($this->_tablelang);
    }
   
    private function __clone() {} 
    
    public static function getInstance()    
    {    
        if(! (self::$_instance instanceof self) ) {    
            self::$_instance = new self();    
        }    
        return self::$_instance;    
    }    
    
        
    public function newAddress($lablel,$address)
    {  
        $data = array
        (
            'label' => $lablel,
            'address' => $address,
        );
        $this->_db->insert ( $this->_tableself, $data , FALSE);
    }

    public function addAddress($lablel,$address)
    {
        $data = array
        (
            'label' => $lablel,
            'address' => $address,
        );
        $this->_db->insert ( $this->_tableother, $data , FALSE);
    }

    public function addPasswd($passwd)
    {
        $data = array
        (
            'user' => "pi",
            'passwd' => $passwd,
        );
        $this->_db->insert ( $this->_tablepass, $data , FALSE);
    }

    
    public function delAddressOther($address)
    {
        $this->_db->delete ( $this->_tableother, 'address' ,$address);
    }

    public function editAddress($lablel,$address)  
    {  
        $data = array
        (
            'label' => $lablel,
            'address' => $address,
        );
        $this->_db->update ( $this->_tableself,"address",$address , $data);
    }

    public function editPassword($passwd)  
    {  
        $data = array
        (
            'user' =>"pi",
            'passwd' => $passwd,
        );
        $this->_db->update ( $this->_tablepass,"user","pi" , $data);
    }

    public function getAddress()  
    {   
        return $this->_db -> selectAll ( $this->_tableself );
    }

    public function getAddressOther()
    {
        return $this->_db -> selectAll ( $this->_tableother );
    }

    public function getPassword()  
    {   
        return $this->_db -> select ( $this->_tablepass ,"user","pi");
    }

    public function initLanguage()
    {
        $data = array
        (
            'setting' => "language",
            'lang' => 'en_GB',
        );
        $this->_db->insert ( $this->_tablelang, $data , FALSE);
    }


    public function getLanguage()  
    {   
        return $this->_db -> select ( $this->_tablelang ,"setting","language");
    }

    public function setLanguage($para)  
    {  
        $data = array
        (
            'setting' => "language",
            'lang' => $para,
        );
        $this->_db->update ( $this->_tablelang,"setting","language" , $data);
    }
}  
?>