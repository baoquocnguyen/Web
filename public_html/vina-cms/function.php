<?
function	toenlish ( $text )
{
	$UNI	= array ( "á","à","ả","ã","ạ","ắ","ằ","ẳ","ẵ","ặ","ấ","ầ","ẩ","ẫ","ậ","é","è","ẻ","ẽ","ẹ","ế","ề","ể","ễ","ệ","í","ì","ỉ","ĩ","ị","ó","ò","ỏ","õ","ọ","ố","ồ","ổ","ỗ","ộ","ớ","ờ","ở","ỡ","ợ","ú","ù","ủ","ũ","ụ","ứ","ừ","ử","ữ","ự","ý","ỳ","ỷ","ỹ","ỵ","Á","À","Ả","Ã","Ạ","Ắ","Ằ","Ẳ","Ẵ","Ặ","Ấ","Ầ","Ẩ","Ẫ","Ậ","É","È","Ẻ","Ẽ","Ẹ","Ế","Ề","Ể","Ễ","Ệ","Í","Ì","Ỉ","Ĩ","Ị","Ó","Ỏ","Õ","Ọ","Ố","Ồ","Ổ","Ỗ","Ộ","Ơ","Ớ","Ờ","Ở","Ỡ","Ợ","Ú","Ù","Ủ","Ũ","Ụ","Ứ","Ừ","Ử","Ữ","Ự","Ý","Ỳ","Ỷ","Ỹ","Ỵ","ă","â","ê","ô","ơ","ư","đ","Ă","Â","Ê","Ô","Ò","Ư","Đ");
	$TXT	= array ( "a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","e","e","e","e","e","e","e","e","e","e","i","i","i","i","i","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","u","u","u","u","u","u","u","u","u","u","y","y","y","y","y","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","E","E","E","E","E","E","E","E","E","E","I","I","I","I","I","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","U","U","U","U","U","U","U","U","U","U","Y","Y","Y","Y","Y","a","a","e","o","o","u","d","A","A","E","O","O","U","D");

	for ($i = 0; $i < count($UNI); $i++)
	{
		$text = str_replace($UNI[$i], $TXT[$i], $text);
	}
	return $text;
}
function	relink($txt)
{
	$text	=	toenlish($txt);
	$text	=	strtolower($text);
	$text	=	str_replace(" ","-",$text);
	$src	=	array ( "?", "." , "," , "\"", "'", ":", "%", "/", "&", "#");
	for ($i = 0; $i < count($src); $i++)
		$text	=	str_replace($src[$i],"",$text);
    return $text;
}


function get_sql($sql)
{
	global $db;
	$get_sql_query_statement = $db->query($sql);
	if ($result_get_sql_query = $db->fetch($get_sql_query_statement))
	{
		return $result_get_sql_query[0];
	}
	else
	{
		return "SQL_NULL";
	}
}
function	get_user($id,$value)
{
	global $db;
	
	$r	=	$db->select("vn_user","id = '".$id."' and level<>0");
	while ($row = $db->fetch($r))
		return $row[$value];
}

function	kt_user_dung($txt_username)
{
	return (!ereg("(^[a-z]+([a-z\_0-9\-]*))$", $txt_username));
}

function	get_bien($id)
{
	global $db;
	
	$r	=	$db->select("vn_bien","ten = '".$id."'");
	while ($row = $db->fetch($r))
		return $row["gia_tri"];
}

function	get_style($id)
{
	global $db;
	
	$r	=	$db->select("vn_style","name = '".$id."'");
	while ($row = $db->fetch($r))
		return $row["value"];
}
/**
 * Unit input is byte
 */
function file_size($bytes) {
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );
    foreach($arBytes as $arItem) {
        if($bytes >= $arItem["VALUE"]) {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}
/**
 * exp: echo get_image($id, postcat, avatar) this function to get avatar img of postcat follow Id
 * $id: Current id of site (parent_id)
 * $parent_type: post, postcat, gallery...
 * $type: Include group avatar [ Method single ], album [ Method multi ]...
 * $allow: allow had button delete
 */
function get_image($id, $parent_type, $type, $allow=true) {
    global $db;
    $text = '';
    $q1=$db->selectmedia("parent_id='".$id."' and parent_type='".$parent_type."' and type='".$type."'");
    if($db->num_rows($q1)!=0){
	    $r1=$db->fetch($q1);
	    if($r1['mine']=='image'){
	    	$text .= "<div id='set_img' style='position: relative;'><img src='/uploads/".$r1['dir_folder']."/".$r1['file_name']."' style='max-width: 100%;' alt='".$r1['ten']."' />";
	    }else{
	    	$text .= "<div id='set_img' style='position: relative;'><div class='block-filetypeshow'><img class='img-responsive' src='images/file.png'><span class='block-textfile'>.".$r1['file_type']."</span><p>".$r1['file_name']."</p></div>";
	    }
	    if($allow){
	    	$text .= "<a style='position: absolute;top: 0;right: 0;font-size: 2em;padding: 0 8px;color: #AAAAAA;' href='javascript:;void(0)' onclick=\"remove_image('$id','$parent_type','$type')\"><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
	    }
	    $text .= '</div>';
	}else{
		$text .= "<div id='set_img'><img src='images/no-img.png' style='max-width: 100%;margin-top:10px;' alt='' /></div>";
	}
    return $text;
}
function get_image_avata($id, $parent_type, $type) {
    global $db;
    $text = '';
    $q1=$db->selectmedia("parent_id='".$id."' and parent_type='".$parent_type."' and type='".$type."'");
    if($db->num_rows($q1)!=0){
	    $r1=$db->fetch($q1);
	    if($r1['mine']=='image'){
	    	$text .= "<div style='position: relative;'><img src='/uploads/".$r1['dir_folder']."/".$r1['file_name']."' style='max-width: 100%;' alt='".$r1['ten']."' />";
	    }else{
	    	$text .= "<div style='position: relative;'><div class='block-filetypeavata'><img class='img-responsive' src='images/file.png'><span class='block-textfile'>.".$r1['file_type']."</span></div>";
	    }
	    
	    $text .= '</div>';
	}else{
		$text .= "<div><img src='images/no-img.png' style='max-width: 100%;margin-top:10px;' alt='' /></div>";
	}
    return $text;
}
function get_image_user($id, $parent_type, $type, $allow=true) {
    global $db;
    $text = '';
    $q1=$db->selectmedia("parent_id='".$id."' and parent_type='".$parent_type."' and type='".$type."'");
    if($db->num_rows($q1)!=0){
	    $r1=$db->fetch($q1);
	    $text .= "<img src='/uploads/".$r1['dir_folder']."/".$r1['file_name']."' style='max-width: 100%;' alt='".$r1['ten']."' />";
	    if($allow){
	    $text .= "<a style='position: absolute;top: 0;right: 0;font-size: 2em;padding: 0 8px;color: #AAAAAA;' href='javascript:;void(0)' onclick=\"remove_image('$id','$parent_type','$type')\"><i class='fa fa-trash-o' aria-hidden='true'></i></a>";
	    };
	}else{
		$text .= "<img src='images/no-img.png' style='max-width: 100%;margin-top:10px;' alt='' />";
	}
    return $text;
}

function	kt_email_dung($txt_email)
{
	return (!ereg("[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txt_email));	
}
function	show_order($name,$sum,$pos,$width,$style=1)
{
?>
<select name="<?=$name?>" style="width:<?=$width?>;<?=$style==1?"":""?>">
<?php
	for ($i = 1; $i <= $sum; $i++)
	{
		echo "<option value=".$i;
		if ($pos == $i) echo " selected ";
		echo ">".$i."</option>";
	}
?>
</select>
<?php
}
// admin_load
function admin_load($thong_bao,$url)
{
?>
<div class="admin-block-loading">
    <div class="admin-loading1">
        <div class="admin-loading2">
            <div class="admin-loading">
            	<b><font size="2"><?=$thong_bao?></font></b>
            	<br /><img vspace="3" src="images/load.gif" style="width: 40px;" />
            </div>
        </div>
    </div>
</div>
<head>
	<meta http-equiv="Refresh" content="0; URL=<?=$url?>"/>
</head>
<?php
	die();
}
//function resise images//

function resize_px($src, $size,$filetype='jpg'){ //resize pixel
    require_once('../../app/packages/phpthumb/phpthumb.class.php');
 	$phpThumb = new phpThumb();
 	$phpThumb->src = $src;
	if (!empty($size))
    {
        $r = explode( "x" , $size ); //500x300 | tách mảng
    	$phpThumb->w = $r[0];
    	$phpThumb->h = $r[1];
    	$phpThumb->zc = '1';// crop image follow width and height
    }
	$phpThumb->q = 100; // quality output image
	$phpThumb->config_output_format = $filetype; //file type output exp: png, jpg ...
	$phpThumb->config_error_die_on_error = true;
	if ($phpThumb->GenerateThumbnail())
	{
		$phpThumb->RenderToFile($src);
  	}
  	else
	{
	   echo 'Failed: '.implode("\n", $phpThumb->debugmessages);
  	}
}

//END function resise images//
// resize hình ảnh bất kỳ
function img_resize($src,$dis,$par,$filetype='jpg')
{
 	require_once('../app/packages/phpthumb/phpthumb.class.php');
 	$phpThumb = new phpThumb();
 	$phpThumb->src = $src;
		$r = explode("&",$par);
		for ($i = 0; $i <= count($r); $i++)
		{
			if ($r[$i] != "")
			{
				$q = explode("=",$r[$i]);
				if ($q[0] == 'h') 
					$phpThumb->h = $q[1];
				if ($q[0] == 'w') 
					$phpThumb->w = $q[1];
					
				if ($q[0] == 'zc')
				{
					$phpThumb->zc = $q[1];
				}
				
				if ($q[0] == 'fltr[]')
				{
					$phpThumb->fltr[] = $q[1];
				}
			}
		}
	$phpThumb->q = 90;
	$phpThumb->config_output_format = $filetype;
	$phpThumb->config_error_die_on_error = true;
	if ($phpThumb->GenerateThumbnail())
	{
		$phpThumb->RenderToFile($dis);
  	}
  	else
	{
  	}
}
/** 
 * Position function at block_media.php
 * This function is get size image
 * Use function: getimagesize(), explode(), trim()
 */
function get_size_image($pathdir){
    $result     = "";
    $size       = getimagesize ($pathdir); // This is an array
    if(!empty($size)){
        $result     = $size[0].'x'.$size[1];
    }
    return ($result);
}
function passGen($length,$nums){
$lowLet = "abcdefghijklmnopqrstuvwxyz";
$highLet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$numbers = "123456789";
$pass = "";
$i = 1;
While ($i <= $length){
$type = rand(0,1);
if ($type == 0){
if (($length-$i+1) > $nums){
$type2 = rand(0,1);
if ($type2 == 0){
$ran = rand(0,25);
$pass .= $lowLet[$ran];
}else{
$ran = rand(0,25);
$pass .= $highLet[$ran];
}
}else{
$ran = rand(0,8);
$pass .= $numbers[$ran];
$nums--;
}
}else{
if ($nums > 0){
$ran = rand(0,8);
$pass .= $numbers[$ran];
$nums--;
}else{
$type2 = rand(0,1);
if ($type2 == 0){
$ran = rand(0,25);
$pass .= $lowLet[$ran];
}else{
$ran = rand(0,25);
$pass .= $highLet[$ran];
}
}
}
$i++;
}
return $pass;
}
function showPage($currentPage, $maxPage) {
	if ($maxPage <= 1)
	{
		return;
	}
	//$suffix = '/tinhve.html';
    $suffix = '/';
	
	$nav = array(
		// bao nhiêu trang bên trái currentPage
		'left'	=>	3,
		// bao nhiêu trang bên phải currentPage
		'right'	=>	3,
	);
	
	// nếu maxPage < currentPage thì cho currentPage = maxPage
	if ($maxPage < $currentPage) {
		$currentPage = $maxPage;
	}
	
	// số trang hiển thị
	$max = $nav['left'] + $nav['right'];
	
	// phân tích cách hiển thị
	if ($max >= $maxPage) {
		$start = 1;
		$end = $maxPage;
	}
	elseif ($currentPage - $nav['left'] <= 0) {
		$start = 1;
		$end = $max + 1;
	}
	elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
		$start = $maxPage - $max;
		$end = $maxPage;
	}
	else {
		$start = $currentPage - $nav['left'];
		if ($start == 2) {
			$start = 1;
		}
		
		$end = $start + $max;
		if ($end == $maxPage - 1) {
			++$end;
		}
	}
	
	$navig = '<div class="navigation">';
	if ($currentPage >= 2) {
		if ($currentPage >= $nav['left']) {
			if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
				// thêm nút "First"
				$navig .= '<span class="page_item"><a href="javascript:;return false;" onclick=media_select("1")>1</a></span>';
				$navig .= '<span class="current_page_item"><b>...</b></span>';
			}
		}
		// thêm nút "«"
		$navig .= '<span class="page_item"><a href="javascript:;return false;" onclick=media_select("'.($currentPage - 1).'")>«</a></span>';
	}

	for ($i=$start;$i<=$end;$i++) {
		// trang hiện tại
		if ($i == $currentPage) {
			$navig .= '<span class="current_page_item">'.$i.'</span>';
		}
		// trang khác
		else {
			$pg_link = $i;
			$navig .= '<span class="page_item"><a href="javascript:;return false;" onclick=media_select("'.$pg_link.'")>'.$i.'</a></span>';
		}
	}
	
	if ($currentPage <= $maxPage - 1) {
		// thêm nút "»"
		$navig .= '<span class="page_item"><a href="javascript:;return false;" onclick=media_select("'.($currentPage + 1).'")>»</a></span>';
		
		if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
			// thêm nút "Last"
			$navig .= '<span class="current_page_item">...</span>';
			$navig .= '<span class="page_item"><a href="javascript:;return false;" onclick=media_select("'.$maxPage.'")>'.$maxPage.'</a></span>';
		}
	}
	$navig .= '</div>';
	
	// hiển thị kết quả
	echo $navig;
}
?>