<?
session_start();
@error_reporting(0);
@set_time_limit(0);
include "../_CORE/index.php";
include "../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "function.php";
$list_order = $_POST['list_order'];
$table = $_POST['table'];
//echo $list_order;echo $table;
$list = explode(',',$list_order);
$count = count($list);
for($i = 0; $i < $count; $i++)
{
    $db->query("update $table set thu_tu = '".$i."' where id = '".$list[$i]."'");  
} 
?>