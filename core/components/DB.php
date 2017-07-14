<?php

namespace core\components;

/**
 * Class DB
 * @package core\components
 */
class DB
{
    public static $instance = null;
    protected $_config = [];
    private $_mysqli;

    public function __construct()
    {
        $this->_config = require 'core/config/db.php';
        $this->_mysqli = new \mysqli($this->_config['host'],
            $this->_config['user'],
            $this->_config['password'],
            $this->_config['db_name']);
        $this->_mysqli->set_charset('utf8');
    }

    public function __destruct()
    {
        $this->_mysqli->close();
        self::$instance = null;
    }


    /**
     * @return DB
     */
    static public function getDB()
    {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @param string $sql
     * @return bool|\mysqli_result
     * @throws \Exception
     */
    public function query($sql){
        $result = $this->_mysqli->query($sql);
        if(!$result){
            throw new \Exception($this->_mysqli->error . "<br> $sql");
        }
        return $result;
    }

    /**
     * @param string|integer|null $data
     * @return string
     */
    public function getSafeData($data){
        if(is_null($data)){
            return 'NULL';
        }
        if(is_string($data)){
            return "'" . $this->_mysqli->escape_string($data) . "'";
        }
        return $this->_mysqli->escape_string($data);
    }

    /**
     * @return integer|null
     */
    public function getLastInsertId(){
        return $this->_mysqli->insert_id;
    }

}
