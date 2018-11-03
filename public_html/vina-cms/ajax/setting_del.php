<?
session_start();
@error_reporting(0);
@set_time_limit(0);
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

$key    = $_GET['key'];

$db->delete("vn_bien","id = '".$key."'");
?>