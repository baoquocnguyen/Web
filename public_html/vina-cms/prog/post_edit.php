<?php
	$act               = $_POST['act'];
    $txt_hien_thi      = $_POST['txt_hien_thi'];
    $txt_noi_bat       = $_POST['txt_noi_bat'];
    $txt_cat           = $_POST['txt_cat'];
    $txt_option1       = $_POST['txt_option1'];
    $txt_option2       = $_POST['txt_option2'];
    $giang_vien        = $_POST['giang_vien'];
    $media_id          = $_POST['media_id'];

    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $ten = str_replace($kitu1,$kitu2,$_POST['ten']);
    $tenslug = $_POST['ten'];
    $chu_thich = str_replace($kitu1,$kitu2,$_POST['chu_thich']);
    $noi_dung = $_POST['noi_dung'];
    $lang = $_POST['lang'];
    $meta_key = $_POST['meta_key'];
    
    $old_price = $_POST['old_price'];
    $new_price = $_POST['new_price'];
    $wholesale_price = $_POST['wholesale_price'];
    
    $title_seo = str_replace($kitu1,$kitu2,$_POST['title_seo']);
    $keywords = str_replace($kitu1,$kitu2,$_POST['keywords']);
    $description = str_replace($kitu1,$kitu2,$_POST['description']);
    
    $func = $_POST['func'];
    
    if ($_POST["func"]=="update") 
    {
    $id = $_POST["id"];
    $post_type = $_POST['post_type'];
    }
    else 
    {
    $id = $_GET['id'];
    $post_type = $_GET['post_type'];
    } 
   
    $post_type_cha=str_replace("_detail","",$post_type);
    
    $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
    $rcheck=$db->fetch($qcheck);
    
    include "templates/post.php";    
    
    $qcat1 = $db->select("post","id=".$id);
    $rcat1=$db->fetch($qcat1);
    $qcat2 = $db->select("postcat","id=".$rcat1['cat']);
    $rcat2=$db->fetch($qcat2);
    $qlang	= $db->select("postcat_lang","postcat_id = '".$rcat2['id']."'","order by id limit 1");
    $rlang = $db->fetch($qlang);
    $qlang1	= $db->select("post_lang","post_id = '".$rcat1['id']."'","order by id limit 1");
    $rlang1 = $db->fetch($qlang1);
    

?>
<section class="content-header">
    <h1>Edit<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=postcat_list&post_type=<?=$post_type_cha?>">Danh mục</a></li>
        <li><a href="?act=post_list&id=<?=$rcat2['id']?>&post_type=<?=$post_type?>"></span>[ <i>Post</i> ]</span> <?=$rlang['name']?></a></li>
        <li class="active"><?=$rlang1['ten']?></li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">

            <div class="box-header with-border">
                <h3 class="box-title">Edit</h3>
                <div class="box-tools pull-right">
                    <span class="function">
                        <a href="?act=post_new&txt_cat=<?=$rcat2['id']?>&post_type=<?=$post_type?>">Thêm mới</a>
                    </span>
                </div>
                <div class="clear"></div>
            </div>
            <div class="paddinglr10">
            <?php
            	//	Kiểm tra sự tồn tại của ID
            	$id = $id + 0;
            	$r	= $db->select("post","id = '".$id."'");
            	if ($r->num_rows == 0)
            		admin_load("Không tồn tại mục này.","?act=postcat_list&post_type=".$post_type_cha);
            	
                $error= array();                
            
            	if ($func == "update")
            	{
            		if (empty($ten[$rcheck['code']]))
            			$error[] = "Vui lòng nhập tên.";
            		else
            		{
                        $qcat11 = $db->select("postcat","id=".$txt_cat);
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
                        
        				$db->query("update post set cat = '".$cat."',cat1 = '".$cat1."',cat2 = '".$cat2."',hien_thi = '".($txt_hien_thi+0)."' , noi_bat = '".($txt_noi_bat+0)."' ,option1 = '".($txt_option1+0)."' ,option2 = '".($txt_option2+0)."' ,user_edit='".$thanh_vien["id"]."',time_edit='".time()."' where id = '".$id."'");
                        
                        $q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($ten[$r['code']]!=''){
                                $qedit=$db->select("post_lang","lang_id='".$r['code']."' and post_id='".$id."'","order by id");
                                $redit=$db->fetch($qedit);
                                $getslug=lg_string::slug($tenslug[$r['code']]).'.html';
                                $checkslug=$db->select("post_lang","slug='".$getslug."' and post_id<>'".$id."' ","");
                                $checkslugk=$db->select("vn_page_lang","slug='".$getslug."'","");
                                if($db->num_rows($checkslug)==1||$db->num_rows($checkslugk)==1){
                                    $getslug=lg_string::slug($ten[$r['code']]).'-s'.$id.'.html';
                                }else{
                                    $getslug=lg_string::slug($ten[$r['code']]).'.html';
                                }
                                if($redit['id']!=''){
                                    $db->query("update post_lang set ten = '".$ten[$r['code']]."',ten_kd = '".lg_string::bo_dau($ten[$r['code']])."',chu_thich = '".$chu_thich[$r['code']]."',chu_thich_kd = '".lg_string::bo_dau($chu_thich[$r['code']])."' , noi_dung = '".$noi_dung[$r['code']]."' ,noi_dung_kd='".lg_string::bo_dau($noi_dung[$r['code']])."', old_price = '".$old_price[$r['code']]."' , new_price = '".$new_price[$r['code']]."' , wholesale_price = '".$wholesale_price[$r['code']]."' ,title_seo='".$title_seo[$r['code']]."',keywords='".$keywords[$r['code']]."',description='".$description[$r['code']]."' where id = '".$redit['id']."'");
                                    
                                    //$qcat3 = $db->select("slug","slug='".$redit['slug']."' and post_type='".$post_type."'");
                                    //$rcat3=$db->fetch($qcat3);
                                    //$db->query("update slug set slug = '".$getslug."' where id = '".$rcat3['id']."'");
                                }else{
                                    $db->insert("post_lang","post_id,lang_id,ten,ten_kd,chu_thich,chu_thich_kd,noi_dung,noi_dung_kd,old_price,new_price,wholesale_price,title_seo,keywords,description,slug","'".$id."','".$r['code']."','".$ten[$r['code']]."','".lg_string::bo_dau($ten[$r['code']])."','".$chu_thich[$r['code']]."','".lg_string::bo_dau($chu_thich[$r['code']])."','".$noi_dung[$r['code']]."','".lg_string::bo_dau($noi_dung[$r['code']])."','".$old_price[$r['code']]."','".$new_price[$r['code']]."', '".$wholesale_price[$r['code']]."' ,'".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."','".$getslug."'");
                                    //$db->insert("slug","cat,slug,post_type","'".$id."','".$getslug."','".$post_type."'");
                                }
                            }
                            //option post
                            $qqop=$db->select("post_meta_key","post_type='".$post_type."'","order by thu_tu");
                            while($rrop=$db->fetch($qqop)){
                                    $qedit1=$db->select("post_meta","post_id = '".$id."' and meta_key='".$rrop['meta_key']."' and lang_id='".$r['code']."'","order by id");
                                    $redit1=$db->fetch($qedit1);
                                    if($redit1['id']!=''){
                                        $db->query("update post_meta set meta_value = '".$meta_key[$rrop['meta_key']][$r['code']]."' where id = '".$redit1['id']."'");
                                    }else{
                                        $db->insert("post_meta","post_id,lang_id,meta_key,meta_value","'".$id."','".$r['code']."','".$rrop['meta_key']."','".$meta_key[$rrop['meta_key']][$r['code']]."'");
                                    }
                                
                            }
                        }
                        
                        // Update into table media_relationship 
                        if(!empty($media_id)){             // check isset id value of input media_id
                            $demn=0;
                            $qmr = $db->query("SELECT id FROM media_relationship WHERE parent_id = '".$id."' and parent_type='post' and type='avatar'");
                            if($qmr){$demn=$db->num_rows($qmr);}
                            if($demn > 0){    // isset before, update
                                $rmr = $db->fetch($qmr);
                                $db->update("media_relationship","media_id",$media_id,"id = '".$rmr['id']."'" );
                            }else{                          // not isset before, insert
                                $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','post','avatar'");
                            }
                        }
                        admin_load("","?act=post_edit&id=".$id.'&post_type='.$post_type);
            		}
            	}
            	else
            	{
            		$r	= $db->select("post","id = '".$id."'");
            		while ($row = $db->fetch($r))
            		{
            			$txt_cat		= $row["cat"];;
            			$txt_hien_thi	= $row["hien_thi"];
                        $txt_noi_bat    = $row["noi_bat"];
                        $txt_option1    = $row["option1"];
                        $txt_option2    = $row["option2"];
            		}
            	}
           		template_edit("?act=post_edit","update",$id,$txt_cat,$txt_hien_thi,$txt_noi_bat,$post_type,$txt_option1,$txt_option2,$error)
            ?>
                </div>
            </div>
        </div>
    </div>
</section>