<?php
    namespace app\controller;
    use \core\uek;
    use \core\lib\model;

    class indexController extends uek{

        public function __construct(){
            session_start();
            if(!isset($_SESSION['login'])){
                $this->redirect('/login');
            }
        }

        public function h_aboutme(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_aboutme.html');
        }
        public function h_aboutme_sex(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_aboutme_sex.html');
        }
        public function h_aboutme_touxiang(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_aboutme_touxiang.html');
        }
        public function h_banben(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_banben.html');
        }
        public function h_loveSelect(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_loveSelect.html');
        }
        public function h_myinform(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_myinform.html');
        }
        public function h_personal_center(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_personal_center.html');
        }
        public function h_set(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_set.html');
        }
        public function h_set_clear(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_set_clear.html');
        }
        public function h_set_read(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_set_read.html');
        }
        public function h_suggest(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_suggest.html');
        }
        public function h_sysInform(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_sysInform.html');
        }
        public function h_update(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/h_update.html');
        }
        public function lhh_allview(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_allview.html');
        }
        public function lhh_bookpage1(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_bookpage1.html');
        }
        public function lhh_bookpage2(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_bookpage2.html');
        }
        public function lhh_booktag(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_booktag.html');
        }
        public function lhh_comment(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_comment.html');
        }
        public function lhh_note(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_note.html');
        }
        public function lhh_notetag(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_notetag.html');
        }
        public function lhh_passwd(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/lhh_passwd.html');
        }
        public function y_bookmark(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_bookmark.html');
        }
        public function y_bright(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_bright.html');
        }
        public function y_catalog(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_catalog.html');
        }
        public function y_cut(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_cut.html');
        }
        public function y_note(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_note.html');
        }
        public function y_noteall(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_noteall.html');
        }
        public function y_read(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_read.html');
        }
        public function y_section(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_section.html');
        }
        public function y_word(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/y_word.html');
        }
        public function z_bangdan(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_bangdan.html');
        }
        public function z_fenlei(){
            include CORE . 'lib/model.php';
            $db = new model();
            $con = $db->prepare('select * from categories');
            $con->execute();
            $r = $con->fetchAll();
            $sql = 'SELECT a.list_name,a.list_id,b.cate_name,b.cate_id FROM list as a,categories as b WHERE a.cate_id=b.cate_id';
            $cons = $db->prepare($sql);
            $cons->execute();
            $m = $cons->fetchAll();
            $this->assign('cats', $r);
            $this->assign('list', $m);
            $this->display(VIEW.'/user/z_fenlei.html');
        }
        public function z_hot(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_hot.html');
        }
        public function z_jingxuan(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_jingxuan.html');
        }
        public function z_mybook(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_mybook.html');
        }
        public function z_newbook(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_newbook.html');
        }
        public function z_search(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_search.html');
        }
        public function z_search_list(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_search_list.html');
        }
        public function z_shaixuan(){
            include CORE . 'lib/model.php';
            $this->display(VIEW.'/user/z_shaixuan.html');
        }
    }
