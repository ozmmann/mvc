<?php

namespace core\base;


class View
{
    protected $_layout = 'app/views/layout.php';

    public function render($tpl, $data){
        $path = 'app/views/' . $tpl . '.php';
        if(!file_exists($path)){
            throw new \Exception('View file: ' . $path . ' not found');
        }
        $content = include $path;

        return include $this->_layout;
    }

}