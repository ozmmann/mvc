<?php

namespace core\base;

use core\components\DB;

/**
 * Class Model
 * @package core\base
 */
abstract class Model
{
    protected static $tableName = 'userss';
    protected $_db;

    public function __construct($modelId = null)
    {
        $this->_db = DB::getDB();
        if(!empty($modelId) && !is_null($modelId)){
            $sql = "SELECT * FROM `" . static::$tableName . "` WHERE `id` = " . $this->_db->getSafeData($modelId);
            $mysqli_result = $this->_db->query($sql);
            if($mysqli_result->num_rows > 0){
                $data = $mysqli_result->fetch_object();
                foreach ($data as $key => $value){
                    $this->$key = $value;
                }
            }
        }
    }

    /**
     * @return mixed
     */
    abstract static public function className();

    /**
     * @return array|null
     */
    static public function findAll(){
        $db = DB::getDB();
        $sql = "SELECT * FROM " . static::$tableName;
        $mysqli_result = $db->query($sql);
        if($mysqli_result->num_rows > 0){
            $rows = [];
            while ($row = $mysqli_result->fetch_object(static::className())){
                $rows[] = $row;
            }
            return $rows;
        }
        return null;
    }

    /**
     * @param $condition
     * @return null|object|\stdClass
     */
    static public function findOne($condition){
        $db = DB::getDB();
        $sql = "SELECT * FROM " . static::$tableName . " WHERE ";
        $sql .= $condition[0] . $condition[1] . $db->getSafeData($condition[2]);
        $mysqli_result = $db->query($sql);
        if($mysqli_result->num_rows > 0){
            return $mysqli_result->fetch_object(static::className());
        }
        return null;
    }
    
    public function create($data){
        
    }
    
    public function update($data){
        
    }
    
    public function delete(){
        
    }

}