<?php
namespace core\lib;
class route{
    public $controller;
    public $action;
    public function __construct(){
        $uri=$_SERVER["REQUEST_URI"];
//			地址中的每个字符串
        $tmp=explode("/",$uri);
//			地址中需要访问的第几个字符串
        $this->controller=$tmp[3];
        if(empty($tmp[4])){
            $this->action='index';
        }else{
            $this->action=$tmp[4];
        }


        if(isset($tmp[5])&&($tmp[6])){
            $_GET[$tmp[5]];
        }
    }
}

