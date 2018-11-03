<?php
    $act = $_POST['act'];
    $post_type = $_POST['post_type'];
    if($post_type==''){$post_type = 'page_none';}
    $option1 = $_POST['option1'];
    $home = $_POST['home'];
    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $txt_ten = str_replace($kitu1,$kitu2,$_POST['txt_ten']);
    $txt_ten_slug = $_POST['txt_ten'];
    $txt_chu_thich = str_replace($kitu1,$kitu2,$_POST['txt_chu_thich']);
    $txt_noi_dung = $_POST['txt_noi_dung'];
    $txt_url = $_POST['txt_url'];
    $txt_hien_thi = $_POST['txt_hien_thi'];
    $media_id  =   $_POST['media_id'];
    
    $title_seo = $_POST['title_seo'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];
    
    $txt_hinh = $_POST['txt_hinh'];
    $func = $_POST['func'];
    $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
    $rcheck=$db->fetch($qcheck);
    include "templates/page.php";
?>
<section class="content-header">
    <h1>Page list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li><a href="?act=page_list"><i class="fa fa-list-alt" aria-hidden="true"></i> List</a></li>
        <li class="active">Page list</li>
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
            	if ($func == "new")
            	{
            		if (empty($txt_ten[$rcheck['code']]))
            			$error = "Vui lòng nhập tên trang.";
            		else
            		{
            			$id = $db->insert("vn_page","id,post_type,option1,time,user,hien_thi,home","0,'".$post_type."','".($option1+0)."','".time()."','".$thanh_vien["id"]."','".$txt_hien_thi."','".$home."'");
                        $q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($txt_ten[$r['code']]!=''){
                                $getslug=lg_string::slug($txt_ten_slug[$r['code']]).'.html';
                                $checkslug=$db->select("vn_page_lang","slug='".$getslug."'","");
                                $checkslugk=$db->select("post_lang","slug='".$getslug."'","");
                                if($db->num_rows($checkslug)==1||$db->num_rows($checkslugk)==1){
                                    $getslug=lg_string::slug($txt_ten_slug[$r['code']]).'-p'.$id.'.html';
                                }else{
                                    $getslug=lg_string::slug($txt_ten_slug[$r['code']]).'.html';
                                }
                                $db->insert("vn_page_lang","page_id,lang_id,ten,chu_thich,noi_dung,url,title_seo,keywords,description,slug","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_chu_thich[$r['code']]."','".$txt_noi_dung[$r['code']]."','".$txt_url[$r['code']]."','".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."','".$getslug."'");
                            }
                        }
                        // Insert into table media_relationship
                        if(!empty($media_id)){
                            $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','page','avatar'");
                        }
                        admin_load("","?act=page_list");
                        
            		}
            	}
            	else
            	{
            		$id = $_POST['id'];
            		$post_type		= $_POST['post_type'];
                    $option1	= 0;
            		$txt_ten		= $_POST['txt_ten'];
                    $txt_chu_thich  = $_POST['txt_chu_thich'];
            		$txt_noi_dung	= $_POST['txt_noi_dung'];
                    $txt_url        = $_POST['txt_url'];
                    $txt_hien_thi = 1;
                    $home = 0;
            	}
            	
            	if (!$OK)
            		template_edit("?act=page_new","new",$id,$post_type,$option1,$txt_ten,$txt_chu_thich,$txt_noi_dung,$txt_url,$txt_hien_thi,$home,$error)
            ?>
                </div>
            </div>
        </div>
    </div>
</section>