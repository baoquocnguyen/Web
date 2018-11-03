<?
session_start();
@error_reporting(0);
@set_time_limit(0);
ob_start();
include "../_CORE/index.php";
include "../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "function.php";

$id = $_GET['id'];
$so = $_GET['so'];

$db->query("update post set thu_tu = '".$so."' where id = '".$id."'");  
?>