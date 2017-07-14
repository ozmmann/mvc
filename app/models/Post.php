<?php
/**
 * Created by PhpStorm.
 * User: osman.ramazanov
 * Date: 14.07.2017
 * Time: 19:45
 */

namespace app\models;


use core\base\Model;

class Post extends Model
{
    protected static $tableName = 'posts';

    static public function className()
    {
        return __CLASS__;
    }

}