<?php
	$act = $_POST['act'];
    $txt_cat = $_GET['txt_cat'];
    $txt_hien_thi = $_POST['txt_hien_thi'];
    $txt_noi_bat = $_POST['txt_noi_bat'];
    $txt_hinh = $_POST['txt_hinh'];
    $txt_file = $_POST['txt_file'];
    $txt_option1 = $_POST['txt_option1'];
    $txt_option2 = $_POST['txt_option2'];
    $giang_vien=$_POST['giang_vien'];
    $media_id  =   $_POST['media_id'];
    
    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $ten = str_replace($kitu1,$kitu2,$_POST['ten']);
    $tenslug = $_POST['ten'];

    $chu_thich = str_replace($kitu1,$kitu2,$_POST['chu_thich']);
    $noi_dung = $_POST['noi_dung'];
    $meta_key = $_POST['meta_key'];
    
    $old_price = $_POST['old_price'];
    $new_price = $_POST['new_price'];
    $wholesale_price = $_POST['wholesale_price'];
    
    $title_seo = str_replace($kitu1,$kitu2,$_POST['title_seo']);
    $keywords = str_replace($kitu1,$kitu2,$_POST['keywords']);
    $description = str_replace($kitu1,$kitu2,$_POST['description']);

    $func = $_POST['func'];
    
    if ($_POST["func"]=="new") 
    {
        $post_type = $_POST['post_type'];    
        $id = $_POST["id"]; 
    }
    else 
    {
        $post_type = $_GET['post_type']; 
        $id = $_GET['id'];
    }
    $post_type_cha=str_replace("_detail","",$post_type);

    $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
    $rcheck=$db->fetch($qcheck);
    $qcat1 = $db->select("postcat","id='".$txt_cat."'"," ");
    $rcat1=$db->fetch($qcat1);
    $qlang	= $db->select("postcat_lang","postcat_id = 1","order by id limit 1");
    $rlang = $db->fetch($qlang);
    echo $func;
    include "templates/post.php";
    
?>
<section class="content-header">
    <h1>Post new<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=postcat_list&post_type=<?=$post_type_cha?>"><span>[ <i>Categories</i> ]</span> Post</a></li>
        <li><a href="?act=post_list&id=<?=$txt_cat?>&post_type=<?=$post_type?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>[ <i>Post</i> ]</span> <?=$rlang['name']?></a></li>
        <li class="active">Thêm mới</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
            <div class="paddinglr10">
            <?php
                $error= array();
            	if ($func == "new")
            	{
                    $txt_cat = $_POST['txt_cat'];
            		if (empty($ten[$rcheck['code']]))
            			$error[] = "Vui lòng nhập tên.";
            		else
            		{
                        $qcat11 = $db->select("postcat","id=".$txt_cat,"");
                        $rcat11=$db->fetch($qcat11);
                        $qcat21 = $db->select("postcat","id='".$rcat11['cat']."'","order by id limit 1");
                        $rcat21=$db->fetch($qcat21);
                        $qcat31 = $db->select("postcat","id='".$rcat21['cat']."'","order by id limit 1");
                        $rcat31=$db->fetch($qcat31);
                        if($rcat11['cat']==0)
                        {
                            $cat = $rcat11['id'];
                        }
                        elseif($rcat21['id']==0)
                        {
                            $cat = $rcat11['id'];
                            $cat1 = $rcat21['id'];
                        }
                        else
                        {
                            $cat = $rcat11['id'];
                            $cat1 = $rcat21['id'];
                            $cat2 = $rcat31['id'];
                        }
                        // Insert post into database
        				$id = $db->insert("post","cat,cat1,cat2,hien_thi,noi_bat,time,time_edit,user,user_edit,post_type,option1,option2","'".$cat."','".$cat1."','".$cat2."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".time()."','".time()."','".$thanh_vien["id"]."','".$thanh_vien["id"]."','".$post_type."','".$txt_option1."','".$txt_option2."'");
                        
                        // Insert language
                        $q=$db->select("language","display=1","order by thu_tu"); 
                        while($r=$db->fetch($q)){
                            if($ten[$r['code']]!=''){
                                $getslug=lg_string::slug($tenslug[$r['code']]).'.html';
                                $checkslug=$db->select("post_lang","slug='".$getslug."'","");
                                $checkslugk=$db->select("vn_page_lang","slug='".$getslug."'","");
                                if($db->num_rows($checkslug)==1||$db->num_rows($checkslugk)==1){
                                    $getslug=lg_string::slug($tenslug[$r['code']]).'-s'.$id.'.html';
                                }else{
                                    $getslug=lg_string::slug($tenslug[$r['code']]).'.html';
                                }
                                $db->insert("post_lang","post_id,lang_id,ten,ten_kd,chu_thich,chu_thich_kd,noi_dung,noi_dung_kd,old_price,new_price,wholesale_price,title_seo,keywords,description,slug","'".$id."','".$r['code']."','".$ten[$r['code']]."','".lg_string::bo_dau($ten[$r['code']])."','".$chu_thich[$r['code']]."','".lg_string::bo_dau($chu_thich[$r['code']])."','".$noi_dung[$r['code']]."','".lg_string::bo_dau($noi_dung[$r['code']])."','".$old_price[$r['code']]."','".$new_price[$r['code']]."','".$wholesale_price[$r['code']]."','".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."','".$getslug."'");
                                $db->insert("slug","cat,slug,post_type","'".$id."','".$getslug."','".$post_type."'");
                            }
                            
                            // Insert into  Option field
                            $qqop1=$db->select("post_meta_key","post_type='".$post_type."'","order by thu_tu");
                            while($rrop1=$db->fetch($qqop1)){
                                if($meta_key[$rrop1['meta_key']][$r['code']]!=''){
                                    $db->insert("post_meta","post_id,lang_id,meta_key,meta_value","'".$id."','".$r['code']."','".$rrop1['meta_key']."','".$meta_key[$rrop1['meta_key']][$r['code']]."'");
                                }
                            }
                        }
                        // Insert into table media_relationship
                        if(!empty($media_id)){
                            $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','post','avatar'");
                        }
                        
                        // Redirect into post edit after insert site
                        admin_load("","?act=post_edit&id=".$id.'&post_type='.$post_type);
            		}
            	}
            	else
            	{
            		$txt_hien_thi	= 1;
                    $txt_noi_bat    = 0;
                    $txt_option1    = 0;
                    $txt_option2    = 0;
            	}
           		template_edit("?act=post_new", "new", 0 ,$txt_cat,$txt_hien_thi,$txt_noi_bat,$post_type,$txt_option1,$txt_option2,$error)
            ?>
                </div>
            </div>
        </div>
    </div>
</section>