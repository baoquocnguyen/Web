<?
session_start();
@error_reporting(0);
@set_time_limit(0);
ob_start();
include "../_CORE/index.php";
include "../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "function.php";

$id = $_GET['id'];$table = $_GET['table'];
$db->update($table,"view",'1',"id='".$id."'");
echo get_sql("select COUNT(id) from '".$table."' where view=0");	
?>