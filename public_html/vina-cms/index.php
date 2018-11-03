<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);
@error_reporting(0);
@set_time_limit(0);
ob_start();
include "../_CORE/index.php";
//date_default_timezone_set('Asia/Ho_Chi_Minh');
$domain="http://".$_SERVER['HTTP_HOST']."/vn";
$act = $_GET['act'];
$logout = $_GET['logout'];
$post_type = $_GET['post_type'];
include "define.php";
include "../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_login.php";
//if($_COOKIE['int_login']<=3){
    include "kt_admin.php";
//}
include "function.php";

if(!is_dir('../uploads/images')){
     @mkdir('../uploads/images');
     chmod('../uploads/images', 0777);
}
//if($_COOKIE['int_login']<=3){
    if ($da_dang_nhap)
    {
        include "tpl/skin/header.php";
        include "tpl/skin/main.php";
        include "tpl/skin/footer.php";
    }
    else include "login.php";
//}else{
//    include "login_error.php";
//}
?>