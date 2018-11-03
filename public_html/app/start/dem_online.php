<?php
global $db;
$timexpired = 600;
$timeout = time() - $timexpired;

$db->delete("vn_online","time < ".$timeout."");
$db->optimize("vn_online");

if (empty($HTTP_X_FORWARDED_FOR)) $IP_NUMBER = getenv("REMOTE_ADDR");
else $IP_NUMBER = $HTTP_X_FORWARDED_FOR;
$url	=	getenv("QUERY_STRING");

$result = $db->select("vn_online","ip='".$IP_NUMBER."' and user=".$THANHVIEN["id"]."","");
$num_rows = $db->num_rows($result);
if($num_rows != 0){
	$db->update("vn_online","time,site","'".time()."','".$url."'","ip='".$IP_NUMBER."' and user='".$THANHVIEN["id"]."'");

}else{
	$db->insert("vn_online","ip,time,site,agent,user","'$IP_NUMBER','".time()."','".$url."','".getenv("HTTP_USER_AGENT")."',".$THANHVIEN["id"]."");
	// Bat dau dem theo ngay 
	$result = $db->select("vn_online_daily","ngay='".lg_date::vn_other(time(),"d/m/Y")."'","");
	$num_rows = $db->num_rows($result);
	if($num_rows != 0) $db->query("UPDATE vn_online_daily SET bo_dem = bo_dem+1 WHERE `ngay`='".lg_date::vn_other(time(),"d/m/Y")."'");
	else $db->insert("vn_online_daily","ngay,bo_dem","'".lg_date::vn_other(time(),"d/m/Y")."',1");
	// Ket thuc
}
?>