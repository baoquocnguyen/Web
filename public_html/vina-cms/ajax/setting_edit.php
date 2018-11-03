<?
session_start();
@error_reporting(0);
@set_time_limit(0);
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

$query = '';// $ten ='';$giatri ='';$nhom ='';$lang ='';$key ='';
$value  = $_GET['value'];
$key    = $_GET['key'];
$lang    = $_GET['lang'];
$column = $_GET['column'];  // table có bao nhiêu column thì kiểm tra bấy nhiêu column

if($column=='ten'){
    $query .= "ten = '" .$value ."', ";
}else if($column=='gia_tri'){
    $query .= "gia_tri = '" .$value ."', ";
}else if($column=='nhom'){
    $query .= "nhom = '" .$value ."', ";
}else if($column=='lang'){
    $query .= "lang = '" .$value ."', ";
}else if($column=='type'){
    $query .= "type = '" .$value ."', ";
}else{
    $qs = "SELECT ten FROM vn_bien WHERE key_name='".$value."' and lang = '".$lang."'";
    $rs = $db->query($qs);
    if(($c = $db->num_rows($rs)) > 0){
        $query .= "key_name = '" .$value ."_HAD_ID_".$c."', "; 
    }else{
        $query .= "key_name = '" .$value ."', "; 
    }       
    
};
$query = rtrim($query, ', ');
$db->query("update vn_bien set ".$query." where key_name = '".$key."' and lang = '".$lang."'");  
?>