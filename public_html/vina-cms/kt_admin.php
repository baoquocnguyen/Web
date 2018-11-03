<?php
$da_dang_nhap		=	true;
$thanh_vien["id"]	=	0;

$cookie_name = 'BaoTran';
$cookie_time = (3600 * 24 * 30);
$cookie_name1 = 'Cafe';
$cookie_time1 = 180;
if(!isset($_COOKIE['int_login'])){
	setcookie("int_login",1,time() + $cookie_time1);
}
$remember=((isset($_POST['remember'])!=0)?1:"");

if (empty($login_admin_user))
{
	$da_dang_nhap	=	false;
	$error_text		=	'<p class="susess_text">Vui lòng đăng nhập vào hệ thống!</p>';
}
else{
	if ( !kt_admin($login_admin_user,$login_admin_pass) )
	{
		$_SESSION["login_admin_user"] = "";
		$_SESSION["login_admin_pass"] = "";
		$da_dang_nhap	=	false;
		$int_login = $_COOKIE['int_login']+1;
		setcookie("int_login",$int_login,time() + $cookie_time1);
		$error_text		=	'<p class="error_text"><b>Tên đăng nhập</b> or <b>Mật khẩu</b> không đúng!</p>';
	}
}
if ($da_dang_nhap)
{
	$r = $db->select("vn_user","username = '".$db->escape($login_admin_user)."'");
	$row = $db->fetch($r);
    $thanh_vien	=	$row;
    $_SESSION["id"]	        =	$row['id'];
	$_SESSION["username"]	=	$row['username'];
    $_SESSION["level"]	    =	$row['level'];
    
    $_SESSION["member_ok"]  =   true;
    if($remember==1){
        setcookie("member_ok",1,time() + $cookie_time);
        setcookie("username",$login_admin_user,time() + $cookie_time);
        setcookie("password",$login_admin_pass,time() + $cookie_time);
    }
    else{
        setcookie("member_ok",0,time() - $cookie_time);
        setcookie("username",$login_admin_user,time() - $cookie_time);
        setcookie("password",$login_admin_pass,time() - $cookie_time);
    }    
         
}
	
function	kt_admin($user , $pass)
{
	global $db;
	
	$r	=	$db->select("vn_user","username = '".$db->escape($user)."' and password = '".md5($pass)."' and trang_thai = 1 ");
	if ($db->num_rows($r) == 0)
		return	false;
	else
		return	true;
}
?>