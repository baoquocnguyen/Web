<?php
    $act = $_POST['act'];
    $txt_alias = $_POST['txt_alias'];$option1 = $_POST['option1'];
    $txt_ten = str_replace('"',"&quot;",$_POST['txt_ten']);
    $txt_ten_slug = $_POST['txt_ten'];
    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $txt_chu_thich = str_replace($kitu1,$kitu2,$_POST['txt_chu_thich']);
    $txt_noi_dung = $_POST['txt_noi_dung'];
    $txt_url = $_POST['txt_url'];
    $media_id  =   $_POST['media_id'];
    
    $title_seo = $_POST['title_seo'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];
    
    $txt_hinh = $_POST['txt_hinh'];
    $func = $_POST['func'];
    if ($_POST["func"]=="new") $id = $_POST["id"]; else $id = $_GET['id'];
    $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
    $rcheck=$db->fetch($qcheck);
    include "templates/info.php";
?>
<section class="content-header">
    <h1>Info list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li><a href="?act=page_list"><i class="fa fa-list-alt" aria-hidden="true"></i> List</a></li>
        <li class="active">Info list</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm mới</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
            <?php
            	$max_file_size	=	6048000;
            	$up_dir			=	'../uploads/alias/';
                
            	if ($func == "new")
            	{
            		if (empty($txt_ten[$rcheck['code']]))
            			$error = "Vui lòng nhập tên trang.";
            		else if (empty($txt_alias))
            			$error = "Vui lòng nhập alias.";
            		else
            		{
            			$id = $db->insert("vn_page","id,alias,option1,time,user","0,'".$db->escape($txt_alias)."','".($option1+0)."','".time()."','".$thanh_vien["id"]."'");
                        $q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($txt_ten[$r['code']]!=''){
                                $db->insert("vn_page_lang","page_id,lang_id,ten,chu_thich,noi_dung,url,title_seo,keywords,description","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_chu_thich[$r['code']]."','".$txt_noi_dung[$r['code']]."','".$txt_url[$r['code']]."','".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."' ");
                                
                            }
                        }
                        if(!empty($media_id)){
                            $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','info','avatar'");
                        }
                        admin_load("","?act=info_list");
            		}
            	}
            	else
            	{
            		$id = $_POST['id'];
            		$txt_alias		= $_POST['txt_alias'];$option1	= 0;
            		$txt_ten		= $_POST['txt_ten'];
                    $txt_chu_thich  = $_POST['txt_chu_thich'];
            		$txt_noi_dung	= $_POST['txt_noi_dung'];
                    $txt_url        = $_POST['txt_url'];
            	}
            	
            	if (!$OK)
            		template_edit("?act=info_new","new",$id,$txt_alias,$option1,$txt_ten,$txt_chu_thich,$txt_noi_dung,$txt_url,$txt_hinh,$error)
            ?>
                </div>
            </div>
        </div>
    </div>
</section>