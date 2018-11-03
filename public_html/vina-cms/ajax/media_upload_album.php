<?php 
include "../function.php";
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
$parent_id      =   $_GET['data_parent'];
$parent_type    =   $_GET['data_par_type'];
$type           =   $_GET['data_type'];
$id_arr         =   $_GET['id_arr'];
foreach($id_arr as $media_id){
    // Insert into table media_relationship
    $title = get_sql("select name from media_file where id=".$media_id);
    $db->insert("media_relationship","media_id, parent_id, parent_type, type, title","'".$media_id."','".$parent_id."','".$parent_type."','".$type."','".$title."'");
}

?>