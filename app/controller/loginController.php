<?php
namespace app\controller;
use \core\uek;
use \core\lib\model;

class loginController extends uek{

    public function index(){
        include CORE."lib/model.php";
        $this->display(VIEW."/login/lhh_load.html");
    }

    public function check_login(){
        ob_start();
        include CORE."lib/model.php";
        $pdo= new \core\lib\model();

        $sql="SELECT * FROM admin_user WHERE account=? AND password=?";
        $st=$pdo->prepare($sql);
        $st->bindValue(1,$_POST['account']);
        $st->bindValue(2,md5($_POST['password']));
        $st->execute();
        $r=$st->fetch();
        if(!empty($r)){
            session_start();
            $_SESSION['login']=true;
            $res=array(
                'state'=>200,
                'e_info'=>null
            );
            $this->json($res);
        }else{
            $res=array(
                'state'=>404,
                'e_info'=>"登录失败,请重新输入"
            );
            $this->json($res);
        }
    }

//    public function index(){
//        if(isset($_COOKIE['_userinfo'])){
//            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
//            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
//
//            $sql="SELECT * FROM admin_user WHERE hash=?";
//            $st=$pdo->prepare($sql);
//            $st->bindValue(1,$_COOKIE['_userinfo']);
//            $st->execute();
//            $r=$st->fetch();
//            if(!empty($r)){
//                session_start();
//                $_SESSION['login']=true;
//                $this->redirect('/index ');
//            }else{
//                $this->redirect('/login');
//            }
//        }else{
//            $num=rand(1000,9999);
//            session_start();
//            $_SESSION['check']=$num;
//            $this->assign('check',$_SESSION['check']);
//            $this->display(VIEW.'/login/lhh_load.html');
//        }
//    }
//    public function check_login(){
//        ob_start();
//        $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
//        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
//
//        $sql="SELECT * FROM admin_user WHERE account=? AND password=?";
//        $st=$pdo->prepare($sql);
//        $st->bindValue(1,$_POST['account']);
//        $st->bindValue(2,md5($_POST['password']));
//        $st->execute();
//        $r=$st->fetch();
//        session_start();
//        if(!empty($r)&&$_POST['check']==$_SESSION['check']){
//            $_SESSION['login']=true;
//            $res=array(
//                'state'=>200,
//                'e_info'=>null
//            );
//            $this->json($res);
//            if($_POST['remember']){
//                unset($_SESSION['check']);
//                setcookie('_userinfo','88468d8478342c7b664e011062129a10',time()+3600,'/');
//            }
//        }else{
//            $res=array(
//                'state'=>404,
//                'e_info'=>'登录失败,请重新输入'
//            );
//            $this->json($res);
//        }
//    }
//    public function logout(){
//        session_start();
//        unset($_SESSION['login']);
//        setcookie('_userinfo','',time()-3600,'/');
//        $this->redirect('/login');
//    }
////        验证账号
//    public function check_name(){
//        $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
//        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
//
//        $sql="SELECT * FROM admin_user WHERE account=?";
//        $stmt=$pdo->prepare($sql);
//        $stmt->bindValue(1,$_GET['y_name']);
//        $stmt->execute();
//        $result=$stmt->fetch();
//        if(!empty($result)){
//            $res=Array(
//                'state'=>200,
//                'e_info'=>null
//            );
//            $this->json($res);
//        }else{
//            $res=Array(
//                'state'=>404,
//                'e_info'=>'账号不存在'
//            );
//            $this->json($res);
//        }
//    }
////        验证密码
//    public function check_pass(){
//
//        $leng=($_POST['length']);
//        if($leng>=6){
//            $res=array(
//                'state'=>200,
//                'e_info'=>null
//            );
//            $this->json($res);
//        }else{
//            $res=array(
//                'state'=>404,
//                'e_info'=>'密码长度不足'
//            );
//            $this->json($res);
//        }
//    }
////        点击更换验证码
//    public function change_yan(){
//        $num=rand(1000,9999);
//        session_start();
//        $_SESSION['check']=$num;
//        $this->json($_SESSION['check']);
//    }
////        验证验证码
//    public function check_yan(){
//        $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
//        $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_ASSOC);
//
//        session_start();
//        $length=strlen($_SESSION['check']);
//        $leng=($_POST['length']);
//        $val=($_POST['value']);
//        if($length==$leng){
//            if($val==$_SESSION['check']){
//                $res=array(
//                    'state'=>200,
//                    'e_info'=>null
//                );
//                $this->json($res);
//            }else{
//                $res=array(
//                    'state'=>404,
//                    'e_info'=>'验证码错误'
//                );
//                $this->json($res);
//            }
//        }else{
//            $res=array(
//                'state'=>404,
//                'e_info'=>'验证码错误'
//            );
//            $this->json($res);
//        }
//
//    }
//
//

}