<?php
$iduser=$_REQUEST['id'];
function online($user){
$f=file("http://opi.yahoo.com/online?u=$user&m=t");
if (strpos($f[0],"NOT ONLINE")!=0) return false;
return true;
}
function check($user)
{
header('Content-type: image/gif');

if (online($user))
{
	readfile("../images/on.png");
}
else{
	readfile('../images/off.png');
}
}
if (trim($iduser)!==""){
check($iduser);}
?>