<?
function	admin_load_del($thong_bao,$url)
{
?>
<body  >
<center>
    <b style="color: #fff;"><font size="2"><?=$thong_bao?></font></b>
    <br /><img vspace="3" src="../../../loader.gif" />
	<br/><p style="color: #fff;">Vui lòng chờ đợi trong giây lát...</p>
</center>
<head>
	<meta http-equiv="Refresh" content="0; URL=<?=$url?>" />
</head>
</body>
<?
}
function	admin_load($thong_bao,$url)
{
?>
<body>
<center>
    <b style="color: #fff;"><font size="2"><?=$thong_bao?></font></b>
    <br /><img vspace="3" src="../camera-loader.gif" />
</center>
<head>
	<meta http-equiv="Refresh" content="3; URL=<?=$url?>" />
</head>
</body>
<?
}
function	admin_load_1($thong_bao,$url)
{
?>
<body>
<center>
    <b style="color: #fff;"><font size="2"><?=$thong_bao?></font></b>
    <br /><img vspace="3" src="../camera-loader.gif" />
</center>
<head>
	<meta http-equiv="Refresh" content="0; URL=<?=$url?>" />
</head>
</body>
<?
}


function showPageNavigation1($currentPage, $maxPage, $cat) {
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
				$navig .= '<span class="page_item"><a href="javascript:;" onclick=loadSubMenu1("1","'.$cat.'")>1</a></span>';
				$navig .= '<span class="current_page_item"><b>...</b></span>';
			}
		}
		// thêm nút "«"
		$navig .= '<span class="page_item"><a href="javascript:;" onclick=loadSubMenu1("'.($currentPage - 1).'","'.$cat.'")>«</a></span>';
	}

	for ($i=$start;$i<=$end;$i++) {
		// trang hiện tại
		if ($i == $currentPage) {
			$navig .= '<span class="current_page_item">'.$i.'</span>';
		}
		// trang khác
		else {
			$pg_link = $i;
			$navig .= '<span class="page_item"><a href="javascript:;" onclick=loadSubMenu1("'.$pg_link.'","'.$cat.'")>'.$i.'</a></span>';
		}
	}
	
	if ($currentPage <= $maxPage - 1) {
		// thêm nút "»"
		$navig .= '<span class="page_item"><a href="javascript:;" onclick=loadSubMenu1("'.($currentPage + 1).'","'.$cat.'")>»</a></span>';
		
		if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
			// thêm nút "Last"
			$navig .= '<span class="current_page_item">...</span>';
			$navig .= '<span class="page_item"><a href="javascript:;" onclick=loadSubMenu1("'.$maxPage.'","'.$cat.'")>'.$maxPage.'</a></span>';
		}
	}
	$navig .= '</div>';
	
	// hiển thị kết quả
	echo $navig;
}

function showPageNavigation($currentPage, $maxPage, $path = '',$search = '') {
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
	
	$navig = '<div class="navigation"><span class="current_page_item">Trang <b>'.$currentPage.'</b> trên <b>'.$maxPage.'</b></span>';
	if ($currentPage >= 2) {
		if ($currentPage >= $nav['left']) {
			if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
				// thêm nút "First"
				$navig .= '<span class="page_item"><a href="'.$path.$suffix.$search.'">1</a></span>';
				$navig .= '<span class="current_page_item"><b>...</b></span>';
			}
		}
		// thêm nút "«"
		if(($currentPage - 1)!=1){
		$navig .= '<span class="page_item"><a href="'.$path.'page-'.($currentPage - 1).$suffix.$search.'">«</a></span>';
        }else{
		$navig .= '<span class="page_item"><a href="'.$path.$search.'">«</a></span>';
        }
	}

	for ($i=$start;$i<=$end;$i++) {
		// trang hiện tại
		if ($i == $currentPage) {
			$navig .= '<span class="current_page_item">'.$i.'</span>';
		}
		// trang khác
		else {
            if($i==1){
                $pg_link = $path;
            }else{
                $pg_link = $path.'page-'.$i.$suffix;
            }
			
			$navig .= '<span class="page_item"><a href="'.$pg_link.$search.'">'.$i.'</a></span>';
		}
	}
	
	if ($currentPage <= $maxPage - 1) {
		// thêm nút "»"
		$navig .= '<span class="page_item"><a href="'.$path.'page-'.($currentPage + 1).$suffix.$search.'">»</a></span>';
		
		if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
			// thêm nút "Last"
			$navig .= '<span class="current_page_item">...</span>';
			$navig .= '<span class="page_item"><a href="'.$path.$maxPage.$suffix.$search.'">'.$maxPage.'</a></span>';
		}
	}
	$navig .= '</div>';
	
	// hiển thị kết quả
	echo $navig;
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
function get_breadcumb_page ($menu_id){
    global $db, $root;
    $q = $db->select("vn_menu","menu_id='".$menu_id."'");
    $r = $db->fetch($q);
    $array['page']['name'] = $r['name'];
    $array['page']['slug'] = $r['slug'];
    if($r['type_link']==2 || $r['menu_id'] == $menu_id){
    	$link = 'javascript:;return false;';
    }else {
       $link = $root.'/'.$array['page']['slug'];
    }
    if($db->num_rows($q) != 0) {
        get_breadcumb_page ($r['cat']);
        echo "<li><a href='".$link."'>".$array['page']['name']."</a></li>";
    }
}
function get_breadcums()
{
	global $db, $slugnew,$lang_code,$table, $root,$id_slug;
	$txt  =   "";
    if($table == 'post'){
        $q   =   $db->selectpost("post.id='".$id_slug."' and lang_id='".$lang_code."'","");
	    $r   =   $db->fetch($q);
        $id_slugn = $r['cat'];
        $q1   =   $db->selectpostcat("postcat_id=".$id_slugn." and lang_id='".$lang_code."'","");
    	$r1   =   $db->fetch($q1);
    	if($r1['level']==1)
    	{
    		$txt =   "<li><a href='".$root.'/'.get_slug_postcat($r1['postcat_id'])."/'>".$r1['name']."</a></li>";
    	}elseif($r1['level']==2){
    		$q2  =   $db->selectpostcat("postcat_id=".$r1['cat']." and lang_id='".$lang_code."'","");
    		$r2  =   $db->fetch($q2);
    		$txt =   "<li><a href='".$root.'/'.get_slug_postcat($r2['postcat_id'])."/'>".$r2['name']."</a></li>".
                     "<li><a href='".$root.'/'.get_slug_postcat($r1['postcat_id'])."/'>".$r1['name']."</a></li>";
    	}else{
    		$q2  =	 $db->selectpostcat("postcat_id=".$r1['cat']." and lang_id='".$lang_code."'","");
    		$r2  =   $db->fetch($q2);
    		$q3  =	 $db->selectpostcat("postcat_id=".$r2['cat']." and lang_id='".$lang_code."'","");
    		$r3  =   $db->fetch($q3);
    		$txt =   "<li><a href='".$root.'/'.get_slug_postcat($r3['postcat_id'])."/'>".$r3['name']."</a></li>".
                     "<li><a href='".$root.'/'.get_slug_postcat($r2['postcat_id'])."/'>".$r2['name']."</a></li>".
                     "<li><a href='".$root.'/'.get_slug_postcat($r1['postcat_id'])."/'>".$r1['name']."</a></li>";
    	}
        return "<ul class='breadcrumb'>"."<li><a href='".$root."'><i class='fa fa-home' aria-hidden='true'></i></a></li>".$txt."</ul>";
    }elseif($table == 'page'){
        echo "<ul class='breadcrumb'>"."<li><a href='".$root."'><i class='fa fa-home' aria-hidden='true'></i></a></li>";
        get_breadcumb_page("p".$id_slug);
        echo "</ul>";
    }
    if($table == 'postcat'){
        $q1   =   $db->selectpostcat("postcat_id=".$id_slug." and lang_id='".$lang_code."'","");
    	$r1   =   $db->fetch($q1);
    	if($r1['level']==1)
    	{
    		$txt =   "<li><a href='javascript:;return false;'>".$r1['name']."</a></li>";
    	}elseif($r1['level']==2){
    		$q2  =   $db->selectpostcat("postcat_id=".$r1['cat']." and lang_id='".$lang_code."'","");
    		$r2  =   $db->fetch($q2);
    		$txt =   "<li><a href='".$root.'/'.get_slug_postcat($r2['postcat_id'])."/'>".$r2['name']."</a></li>".
                     "<li><a href='javascript:;return false;'>".$r1['name']."</a></li>";
    	}else{
    		$q2  =	 $db->selectpostcat("postcat_id=".$r1['cat']." and lang_id='".$lang_code."'","");
    		$r2  =   $db->fetch($q2);
    		$q3  =	 $db->selectpostcat("postcat_id=".$r2['cat']." and lang_id='".$lang_code."'","");
    		$r3  =   $db->fetch($q3);
    		$txt =   "<li><a href='".$root.'/'.get_slug_postcat($r3['postcat_id'])."/'>".$r3['name']."</a></li>".
                     "<li><a href='".$root.'/'.get_slug_postcat($r2['postcat_id'])."/'>".$r2['name']."</a></li>".
                     "<li><a href='javascript:;return false;'>".$r1['name']."</a></li>";
    	}
        return "<ul class='breadcrumb'>"."<li><a href='".$root."'><i class='fa fa-home' aria-hidden='true'></i></a></li>".$txt."</ul>";
    }
    
}
function show_social()
{
	global $db, $slugnew,$lang_code,$root;
	$txt = '';
	$q = $db->select("vn_bien","nhom='SOCIAL'","order by sort");
	while($r=$db->fetch($q)){
		$txt .= '<a href="'.$r['gia_tri'].'"><i class="fa fa-'.$r['key_name'].'" aria-hidden="true"></i></a>';
	}
	return $txt;
}
function show_social1()
{
	global $db, $slugnew,$lang_code,$root;
	$txt = '';
	$q = $db->select("vn_bien","nhom='SOCIAL'","order by sort");
	while($r=$db->fetch($q)){
		$txt .= '<li><a target="_blank" class="hvr-pop" href="'.$r['gia_tri'].'"><i class="fa fa-'.$r['key_name'].'" aria-hidden="true"></i></a></li>';
	}
	return $txt;
}
function show_menu($class='',$menu_cat)
{
	global $db, $slugnew,$lang_code,$root;
	$link = '';
	$txt = '<ul class="'.$class.'">';
	$q = $db->select("vn_menu","menu_cat='".$menu_cat."' and cat = '0'","");
	while($r=$db->fetch($q)){
		$txt .= show_sub_menu($r['post_type'],$r['menu_id'],$menu_cat,$r['type_link']);
	}
	$txt .= '<div class="clear"></div>';
	$txt .= '</ul>';
	return $txt;
}
function show_sub_menu($post_type,$id,$menu_cat,$type)
{
	global $db, $slugnew,$lang_code,$root,$id_active;
	if($post_type=='page'){
		$idnew=str_replace('p','',$id);
		$qpage=$db->selectpage("page_id='".$idnew."' and lang_id='".$lang_code."'","");
		$rpage=$db->fetch($qpage);
		if($type==1){
			$link = $root;
			$active = '';
		}elseif($type==2){
			$link = 'javascript:;return false;';
			$active = $rpage['slug'];
		}else{
			$link = $root.'/'.$rpage['slug'];
			$active = $rpage['slug'];
		}
		if($slugnew==$active||$id_active==$id){
			$txt = '<li><a class="active" href="'.$link.'">'.$rpage['ten'].'</a>';
		}else{
			$txt = '<li><a href="'.$link.'">'.$rpage['ten'].'</a>';
		}
		$qcount = $db->select("vn_menu","cat='".$id."'","");
		if($qcount){$countchiren = $db->num_rows($qcount);}
		if($countchiren>0){
			$txt .= '<ul>';
				$q = $db->select("vn_menu","menu_cat='".$menu_cat."' and cat = '".$id."'","");
				while($r=$db->fetch($q)){
					$txt .= show_sub_menu($r['post_type'],$r['menu_id'],$menu_cat,$r['type_link']);
				}
			$txt .= '</ul>';
		}
		$txt .= '</li>';
	}elseif($post_type=='postcat'){
		$qpostcat=$db->selectpostcat("postcat_id='".$id."' and lang_id='".$lang_code."'","");
		$rpostcat=$db->fetch($qpostcat);
		$link = $root.'/'.get_slug_postcat($rpostcat['postcat_id']).'/';
		$active = $rpostcat['slug'];
		if($slugnew==$active||$id_active==$id){
			$txt = '<li><a class="active" href="'.$link.'">'.$rpostcat['name'].'</a>';
		}else{
			$txt = '<li><a href="'.$link.'">'.$rpostcat['name'].'</a>';
		}
		$qcount = $db->select("vn_menu","cat='".$id."'","");
		if($qcount){$countchiren = $db->num_rows($qcount);}
		if($countchiren>0){
			$txt .= '<ul>';
				$q = $db->select("vn_menu","menu_cat='".$menu_cat."' and cat = '".$id."'","");
				while($r=$db->fetch($q)){
					$txt .= show_sub_menu($r['post_type'],$r['menu_id'],$menu_cat,$r['type_link']);
				}
			$txt .= '</ul>';
		}
		$txt .= '</li>';
	}
	return $txt;
}
function get_slug_postcat($id_postcat)
{
	global $db, $slugnew,$lang_code;
	$txt='';
	$qq1	=	$db->selectpostcat("postcat_id=".$id_postcat." and lang_id='".$lang_code."'","");
	$rr1= $db->fetch($qq1);
	if($rr1['level']==1)
	{
		$txt = $rr1['slug'];
	}elseif($rr1['level']==2){
		$qq2	=	$db->selectpostcat("postcat_id=".$rr1['cat']." and lang_id='".$lang_code."'","");
		$rr2= $db->fetch($qq2);
		$txt = $rr2['slug'].'/'.$rr1['slug'];
	}else{
		$qq2	=	$db->selectpostcat("postcat_id=".$rr1['cat']." and lang_id='".$lang_code."'","");
		$rr2= $db->fetch($qq2);
		$qq3	=	$db->selectpostcat("postcat_id=".$rr2['cat']." and lang_id='".$lang_code."'","");
		$rr3= $db->fetch($qq3);
		$txt = $rr3['slug'].'/'.$rr2['slug'].'/'.$rr1['slug'];
	}
	return $txt;
}
function	get_info($filed,$alias)
{
	global $db , $_fix,$lang_code;
	
	$alias = $db->escape($alias);
	
	$db->query("UPDATE vn_page SET luot_xem = luot_xem + 1 WHERE alias = '".$alias."'");
	$r	=	$db->selectjoin("vn_page","vn_page_lang","vn_page.id=vn_page_lang.page_id","vn_page.alias = '".$alias."' and vn_page_lang.lang_id='".$lang_code."'");
	while ($row = $db->fetch($r))
	{
		return $row[$filed];
	}
	
	return "Unknown alias '".$alias."'";
}

function	get_slug($cat)
{
	global $db, $slugnew,$lang_code;
	$txt	=	get_sql("select slug from postcat_lang where postcat_id=".$cat." and lang_id='".$lang_code."'");	
    if($txt=='SQL_NULL'){$txt=$slugnew;}else{$txt=$txt;}
	return $txt;
}

function	get_name($cat)
{
	global $db, $slugnew,$lang_code;
	$txt	=	get_sql("select name from postcat_lang where postcat_id=".$cat." and lang_id='".$lang_code."'");	
	return $txt;
}
function	get_namegal($cat)
{
	global $db, $slugnew,$lang_code;
	$txt	=	get_sql("select ten from vn_gallery_menu_lang where gallery_menu_id=".$cat." and lang_id='".$lang_code."'");	
	return $txt;
}

function	show_infopage($post_type,$field,$id)
{
	global $db, $slugnew,$lang_code;
	$q=$db->selectpage("post_type='".$post_type."' and lang_id='".$lang_code."' and page_id='".$id."'","");
	$r=$db->fetch($q);
	return $r[$field];
}
function	get_post_option($id,$option)
{
	global $db , $_fix,$lang_code;
	
	$qop=$db->select("post_meta","post_id='".$id."' and meta_key='".$option."' and lang_id='".$lang_code."'","");
	$rop=$db->fetch($qop);
	return $rop['meta_value'];
}
function	get_page_lang($id,$col = "noi_dung")
{
	global $db , $_fix,$lang_code;
	$id = $db->escape($id);
    $db->query("UPDATE vn_page SET luot_xem = luot_xem + 1 WHERE id = '".$id."'");
	$r	=	$db->select("vn_page_lang","page_id = '".$id."' and lang_id='".$lang_code."' ");
	while ($row = $db->fetch($r))
	{
		return $row[$col];
	}
	return "Unknown alias '".$id."'";
}

function	get_bien($id,$lang='')
{
	global $db,$lang_code;
	if($lang==''){$lang=$lang_code;}
	$r	=	$db->select("vn_bien","key_name = '".$id."' and lang = '".$lang."'");
	while ($row = $db->fetch($r))
		return $row["gia_tri"];
}
function gui_mail($nguoigoi,$nguoinhan,$tieude,$noidung)
{
	global $conf;
	
	if (ereg("(.*)<(.*)>", $nguoigoi, $regs)) {
	   $nguoigoi = '=?UTF-8?B?'.base64_encode($regs[1]).'?=<'.$regs[2].'>';
	}
	$header = "From: ".$nguoigoi."\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: text/html; charset=UTF-8\r\n";
	$noidung =	str_replace("\n"	, "<br>"	, $noidung);
	$noidung =	str_replace("  "	, "&nbsp; "	, $noidung);
	$noidung =	str_replace("<script>","&lt;script&gt;", $noidung);
	//$noidung =  $noidung;
	return (@mail($nguoinhan, $tieude, $noidung, $header));		
}

function	get_author()
{
	global $db,$lang_code;
	$txt	=	get_bien("meta_author");	
	return $txt;
}
function	get_copyright()
{
	global $db,$lang_code;
	$txt	=	get_bien("meta_copyright");	
	return $txt;
}
function	get_description()
{
	global $db,$post_type,$slugnew,$lang_code;
	$txt	=	get_bien("meta_description");
    
    if ($table == "post")
	{
	   $q = $db->select("post_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
		  if($row['description']==''){
		      $txt = $row["chu_thich"];
		  }else{
		      $txt = $row["description"];
		  }
			
		}
	}
    
    if ($table == "postcat")
	{
	   $q = $db->select("postcat_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
		  if($row['description']!=''){
		      $txt = $row["description"];
		  }
			
		}
	}	
	if ($table == "page")
	{
		$q = $db->select("vn_page_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
		  	if($row['description']==''){
		      $txt = $row["chu_thich"];
		    }else{
		      $txt = $row["description"];
		    }
		}	
	}
	return $txt;
}
function	get_keywords()
{
	global $db,$post_type,$slugnew,$lang_code;
	$txt	=	get_bien("meta_keywords");
 
    if ($table == "post")
	{
	   $q = $db->select("post_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
			$txt = $row["keywords"];
		}
	}		

    if ($table == "postcat")
	{
	   $q = $db->select("postcat_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
		  if($row['keywords']!=''){
		      $txt = $row["keywords"];
		  }
			
		}
	}	
	if ($table == "page")
	{
		$q = $db->select("vn_page_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
		  if($row['keywords']!=''){
		      $txt = $row["keywords"];
		  }
		}	
	}
	return $txt;
}
function	get_title()
{
	global $db,$slugnew,$post_type,$lang_code,$table;
	$txt = get_bien("title");
	
    if ($table == "postcat")
	{
        $q = $db->select("postcat_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
			if($row['title_seo']==''){
		      $txt = $row["name"].' - '.$txt;
		  }else{
		      $txt = $row["title_seo"].' - '.$txt;
		  }
		}
	}
	if ($table == "post")
	{
		$q = $db->select("post_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
		  if($row['title_seo']==''){
		      $txt = $row["ten"];
		  }else{
		      $txt = $row["title_seo"];
		  }
		}
	}
	if ($table == "page")
	{
		$q = $db->select("vn_page_lang", "slug = '".$slugnew."'");		  
		if  ($row = $db->fetch($q))
		{
		  if($row['title_seo']==''){
		      $txt = $row["ten"].' - '.$txt;
		  }else{
		      $txt = $row["title_seo"];
		  }
		}
	}
	return $txt;
}


function hashString($string)
{
	return md5('qweasdzxc'.$string);
}

function numberFormatVN($number)
{
	return number_format($number, 0, ',', '.');
}
/**
 * This function to get link || html that image
 * $id: contain id images
 * $parent_type: gallery || post || page || postcat
 * $type: avatar || gallery 
 * $kind: html || link
*/
function get_single_image($id, $parent_type, $type, $kind ='html',$class='',$note=''){
    global $db, $domain;
    $result = "";
    $sql = "SELECT name, dir_folder, file_name, title FROM media_file INNER JOIN media_relationship ON media_file.id = media_relationship.media_id WHERE parent_id='".$id."' and parent_type='".$parent_type."' and type='".$type."'";
    $q      = $db->query($sql);
    $r      = $db->fetch($q);
    $title = '';
    if($r['title']==''){$title=get_sql("select ten from post_lang where post_id=".$id);}else{$title=$r['title'];}
    if(!empty($r['file_name'])){
        if( $kind == 'html'){
        	if( $class == 'lazy'){
            	$result = "<img class='img-responsive lazy' data-original='".$domain."/uploads/".$r['dir_folder']."/".$r['file_name']."' alt='".$r['name']."' title='".$title."' ".$note."/>";
            }else{
            	$result = "<img class='img-responsive ".$note."' src='".$domain."/uploads/".$r['dir_folder']."/".$note.$r['file_name']."' alt='".$r['name']."' title='".$title."' />";
            }
        }elseif($kind == 'link'){
            $result = $domain."/uploads/".$r['dir_folder']."/".$r['file_name'];
        }   
    }else{
    	$result = "";
    }
    return $result;
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
?>
