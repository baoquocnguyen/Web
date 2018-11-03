<?php 
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
$id_arr        =   $_GET['id_arr'];
$cc = '';
foreach($id_arr as $id){
	$db->delete("media_relationship","media_id = '".$id."'");
    $qs = $db->select("media_file","id = $id");
    $rs = $db->fetch($qs);
    $pathfile= '../../uploads/'.$rs['dir_folder'].'/'.$rs['file_name'];
    $cc .= $pathfile;
    $db->delete("media_file","id = $id");
    unlink($pathfile);//trash file from folder
}
?>