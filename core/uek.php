<?php
namespace core;
class uek{
    public static function run(){
        include(CORE."lib/route.php");
        $o=new \core\lib\route();
        $controller=$o->controller;
        $action=$o->action;
        include(APP."controller/".$controller."Controller.php");
        $class_name="\\app\\controller\\{$controller}Controller";
        $t=new $class_name();
        $t->$action();  //可变函数
    }
    public $data=array();
//
    public function assign($key,$value){
        //extract帮助声明变量
        $this->data[$key]=$value;
    }
    public function display($file){
        extract($this->data);
        include($file);
    }

    public function json($value){
        header('Content-Type: text/json');
        echo json_encode($value);
    }

    public function redirect($url){
        header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'].$url);
    }
}
