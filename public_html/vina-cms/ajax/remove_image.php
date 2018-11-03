<?php 
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
$parent_id      =   $_GET['id'];
$type           =   $_GET['type'];
$parent_type      =   $_GET['parent_type'];
echo $parent_type;
$db->delete("media_relationship","parent_id = '".$parent_id."' and parent_type='".$parent_type."' and type='".$type."'");
?>