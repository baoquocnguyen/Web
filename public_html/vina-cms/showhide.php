<?
session_start();
@error_reporting(0);
@set_time_limit(0);
ob_start();
include "../_CORE/index.php";
include "../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "function.php";

$table = $_GET['table'];
$data = $_GET['data'];
$id = $_GET['id'];

$q = $db->select("$table","id='".$id."'","");
$r = $db->fetch($q); 
if($r[$data]==1)
{
    $db->query("update $table set $data = 0 where id = '".$id."'");
    ?>
    <img onclick="showhide('<?=$table?>','<?=$data?>','<?=$id?>')"  src="images/false.png"/>
    <?
}
elseif($r[$data]==0)
{
    $db->query("update $table set $data = 1 where id = '".$id."'");
    ?>
    <img onclick="showhide('<?=$table?>','<?=$data?>','<?=$id?>')"  src="images/true.png"/>
    <?
}
?>