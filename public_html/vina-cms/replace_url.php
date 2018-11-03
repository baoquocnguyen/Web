<?
@session_start();
include ("../_CORE/index.php");
include ("../app/config/config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include ("../app/start/func.php");
$url = $_GET['url'];
$id = $_GET['id'];
$lng = $_GET['lng'];
$urlnew=$url.'.html';
// $q1=$db->select("post","id='".$id."'","");
// $r1=$db->fetch($q1);
$checkslug=$db->select("post_lang","slug='".$urlnew."' and post_id<>'".$id."' ","");
$checkslugk=$db->select("vn_page_lang","slug='".$urlnew."'","");
if($db->num_rows($checkslug)==1||$db->num_rows($checkslugk)==1){
    $getslug=lg_string::slug($url).'-s'.$id.'.html';
}else{
    $getslug=lg_string::slug($url).'.html';
}
$db->query("update post_lang set slug='".$getslug."' where post_id = '".$id."' and lang_id = '".$lng."'");
//$db->query("update slug set slug = '".$getslug."' where cat = '".$id."' and post_type='".$r1['post_type']."'");
echo $getslug;
?>
