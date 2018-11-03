<?php
ob_start();
session_start();
//error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT);

ob_start();
include "../_CORE/index.php";
include "../app/config/config.php";
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("../app/start/func.php");
$lang_code=$_GET['lang_code'];
include "../z_includes/translate.php";
$danhgia=$_GET['danhgia'];
$binhluan=$_GET['binhluan'];
$cat=$_GET['cat'];

$OK=$db->insert("vn_danhgia","ten,email,danhgia,noi_dung,kiem_duyet,cat,time","'".$_SESSION['lg_name']."','".$_SESSION['lg_email']."','".$danhgia."','".$binhluan."',0,'".$cat."','".time()."'");
if($OK){?>
<div class="alert alert-success dg" role="alert"><?=$translate['Thành công. Cám ơn bạn đã đánh giá khóa học'][$lang_code]?>!</div>
<?php }else{?>
<div class="alert alert-danger dg" role="alert"><?=$translate['Lỗi hệ thống vui lòng thử lại sau. Cảm ơn'][$lang_code]?>!</div>
<?php }?>

