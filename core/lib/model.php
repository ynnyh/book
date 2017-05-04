<?php
    namespace core\lib;
    class model extends \PDO {
        public function __construct()
        {
            $dsn="mysql:host=localhost;dbname=book;charset=utf8";
            $user='root';
            $password='';
            $option=array(
                parent::ATTR_DEFAULT_FETCH_MODE=>parent::FETCH_ASSOC
            );
            $db=parent::__construct($dsn, $user, $password,$option);
            return $db;
        }
    }