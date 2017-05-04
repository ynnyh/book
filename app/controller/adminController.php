<?php
    namespace app\controller;

    use \core\uek;
    use \core\lib\model;

    class adminController extends uek{
        public function __construct(){
            session_start();
            if(!isset($_SESSION['login'])){
                $this->redirect('/login');
            }
        }

        //        分类界面//////////////////////////////////////////////////
        public function index()
        {
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql='SELECT * FROM categories';

            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $this->assign('categories',$result);
            $this->display(VIEW.'/admin/category.html');
        }
        //      增
        public function add_cats(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql="INSERT INTO categories (cate_name) VALUES ('')";
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $id=$pdo->lastInsertId();
            echo(json_encode($id));
        }
//      删
        public function delete_cats(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql="DELETE FROM categories WHERE cate_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,$_GET['aid']);
            $stmt->execute();
        }
//        改
        public function update_cat(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $sql="UPDATE categories SET cate_name=? WHERE cate_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,$_POST['cate_name']);
            $stmt->bindValue(2,$_POST['cate_id']);
            $stmt->execute();
        }

        //        作者增删改查界面/////////////////////////////////////////////////////
        public function author()
        {
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql='SELECT * FROM author';

            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            $this->assign('author',$result);
            $this->display(VIEW.'/admin/author.html');
        }
//增
        public function add_artist(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql="INSERT INTO author (author_name,author_age,author_sex,author_avarda) VALUES ('','',1,'')";
            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $id=$pdo->lastInsertId();
            echo json_encode($id);
        }
//删
        public function delete_artist(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql="DELETE FROM author WHERE author_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,$_GET['aid']);
            $stmt->execute();

        }

//        改
        public function update_artist(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql="UPDATE author SET author_name=?,author_sex=?,author_age=? WHERE author_id=? ";
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,$_POST['author_name']);
            $stmt->bindValue(2,$_POST['author_sex']);
            $stmt->bindValue(3,$_POST['author_age']);
            $stmt->bindValue(4,$_POST['author_id']);
            $stmt->execute();

        }
        //  上传修改作者封面
        public function update_avarta(){
            $src=$_FILES['file']['tmp_name'];
            $dist='/static/img/'.$_FILES['file']['name'];
            move_uploaded_file($src,UEK.$dist);

            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $sql="UPDATE author SET author_avarda=? WHERE author_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,'/music'.$dist);
            $stmt->bindValue(2,$_POST['id']);
            $stmt->execute();
            echo json_encode('/music'.$dist);
        }

        /////小分类/////////////////////////////////////////////////////////
        public function lists(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql='SELECT list_name,list_id,cate_name,categories.cate_id FROM list,categories WHERE list.cate_id=categories.cate_id';

            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();

            $sql='SELECT * FROM categories';
            $st=$pdo->prepare($sql);
            $st->execute();
            $re=$st->fetchAll();

            $this->assign('categories',$re);
            $this->assign('list',$result);
            $this->display(VIEW.'/admin/list.html');
        }
//        获取分类名
        public function get_category(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql='SELECT cate_id AS id,cate_name AS name FROM categories';

            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $result=$stmt->fetchAll();
            echo json_encode($result);
        }
//        添加
        public function add_list(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql='INSERT INTO list(list_name,list_pic,cate_id) VALUES (?,?,?)';
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,'');
            $stmt->bindValue(2,'');
            $stmt->bindValue(3,'1');
            if($stmt->execute()){
                $id=$pdo->lastInsertId();
                echo json_encode($id);
            }else{
                echo 500;
            }
        }

//  改
        public function update_list(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql='UPDATE list SET list_name=?,cate_id=? WHERE list_id=?';

            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,$_POST['list_name']);
            $stmt->bindValue(2,$_POST['cate_id']);
            $stmt->bindValue(3,$_POST['list_id']);
            $stmt->execute();
        }

//    删
        public function delete_list(){
            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

            $sql="DELETE FROM list WHERE list_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,$_GET['aid']);
            $stmt->execute();
        }
//  上传修改小分类封面
        public function update_pic(){
            $src=$_FILES['file']['tmp_name'];
            $dist='/static/img/'.$_FILES['file']['name'];
            move_uploaded_file($src,UEK.$dist);

            $pdo=new \PDO('mysql:host=localhost;dbname=book;charset=utf8','root','');
            $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $sql="UPDATE list SET list_pic=? WHERE list_id=?";
            $stmt=$pdo->prepare($sql);
            $stmt->bindValue(1,'/book'.$dist);
            $stmt->bindValue(2,$_POST['id']);
            $stmt->execute();
            echo json_encode('/book'.$dist);
        }

    }