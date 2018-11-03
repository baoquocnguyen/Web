<?
session_start();
error_reporting(0);
set_time_limit(0);
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

$list_order     = $_POST['list_order'];
$table          = $_POST['table'];
$list = explode(',',$list_order);
$count = count($list);
for($i = 0; $i < $count; $i++)
{
    $db->query("update ".$table." set sort = '".$i."' where id = '".$list[$i]."'");  
} 
$q1 = $db->select("vn_bien","id ='".$list[0]."'","");
$r1 = $db->fetch($q1);
echo "?act=setting&tab=".$r1['nhom']."_".$r1['lang'];
?>