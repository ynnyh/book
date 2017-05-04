<?php
//整个框架所在的目录
define("UEK",realpath("./"));
//核心所在的目录
define("CORE",UEK."/core/");
//应用所在的目录
    define("APP",UEK."/app/");
    //视图所在的目录
    define("VIEW",APP."/views/");
    //是否开启调试模式
    define("DEBUG",true);
    //css所在的目录
    define("CSS_PATH","/book/static/css/");
    // icon所在的目录
    define("ICON_PATH","/book/static/iconfont");
    //js所在的目录
    define("JS_PATH","/book/static/js/");
    //img所在的目录
    define("IMG_PATH","/book/static/img/");
    //引用共用函数
//    include(CORE."lib/function.php");

    include(CORE."uek.php");
    \core\uek::run();