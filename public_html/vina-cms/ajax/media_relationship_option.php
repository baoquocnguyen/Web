<?php
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
$event  =   $_GET['event'];
$id     =   $_GET['id'];
$value  =   $_GET['value']; 

if($event=='rename'){
    $field = 'title';
} elseif($event=='renote'){
    $field = 'note';
} elseif($event=='reurl'){
    $field = 'url';
};  
$OK=$db->update("media_relationship",$field,$value,"id ='".$id."'");
if($OK){echo $value;}
?>