<?php 
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
$id_arr        =   $_GET['id_arr'];
foreach($id_arr as $id){
    $db->delete("media_relationship","id='".$id."'");
}
?>