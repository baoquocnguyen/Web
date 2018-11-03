<?php
if ($logout == "OK")
{
	$_SESSION["login_admin_user"] = "";
	$_SESSION["login_admin_pass"] = "";
	if (isset($_COOKIE['int_login'])) {
		unset($_COOKIE['int_login']);
	    setcookie('int_login', null, -1, '/');
	}
	header('Location: '.$domain.'/'.admin_url);
}
// session
if (empty($_SESSION["login_admin_user"]))
	$login_admin_user	=	"";
else
	$login_admin_user	=	$_SESSION["login_admin_user"];

if (empty($_SESSION["login_admin_pass"]))
	$login_admin_pass	=	"";
else
	$login_admin_pass	=	$_SESSION["login_admin_pass"];

// post

if (!empty($_POST["log_admin_user"]))
{
	$login_admin_user				=	$_POST["log_admin_user"];
	$_SESSION["login_admin_user"]	=	$login_admin_user;
}
if (!empty($_POST["log_admin_pass"]))
{
	$login_admin_pass				=	$_POST["log_admin_pass"];
	$_SESSION["login_admin_pass"]	=	$login_admin_pass;
}
?>