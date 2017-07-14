<?php

namespace core\base;


class View
{
    protected $_layout = 'app/views/layout/main.php';
    private $_css = [];
    private $_js = [];

    public function render($tpl, $data){
        extract($data);
        $path = 'app/views/' . $tpl . '.php';
        if(!file_exists($path)){
            throw new \Exception('View file: ' . $path . ' not found');
        }
        ob_start('ob_gzhandler');
        include $path;
        $content = ob_get_clean();
        ob_start('ob_gzhandler');
        include $this->_layout;
        return ob_get_clean();
    }

    public function addCss($file){
        $this->_css[] = $file;
    }

    public function renderCss(){
        foreach ($this->_css as $css){
            echo '<link rel="stylesheet" href="assets/css/' . $css . '">';
        }
    }

    public function addJs($file){
        $this->_js[] = $file;
    }

    public function renderJs(){
        foreach ($this->_js as $js){
            echo "<script src='assets/js/$js'></script>";
        }
    }

}