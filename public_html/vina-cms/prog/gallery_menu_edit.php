<section class="content-header">
    <h1>Gallery manager<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Gallery manager</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Cập nhật</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
            <?php
                $id = $_GET['id'];
                $txt_cat = $_GET['txt_cat'];
                $txt_ten = $_GET['txt_ten'];
                $txt_chu_thich  = $_GET['txt_chu_thich'];
                $txt_hien_thi = $_GET['txt_hien_thi'];
                $func = $_GET['func'];
                
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
                
            	include "templates/gallery_menu.php";
            	//	Kiểm tra sự tồn tại của ID
            	$r	= $db->select("vn_gallery_menu","id = '".$id."'");
            	if ($db->num_rows($r) == 0)
            		admin_load("Không tồn tại Mục này.","?act=gallery_manager");
              $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
                $rcheck=$db->fetch($qcheck);
            ?>
            <?php
            	$OK = false;
            	
            	if ($func == "update")
            	{
            		if (empty($txt_ten[$rcheck['code']]))
            			$error = "Please enter the directory name.";
            		else
            		{
            			$db->query("update vn_gallery_menu set cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."' where id = '".$id."'");
            			$q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($txt_ten[$r['code']]!=''){
                                $qedit=$db->select("vn_gallery_menu_lang","lang_id='".$r['code']."' and gallery_menu_id='".$id."'","order by id");
                                $redit=$db->fetch($qedit);
                                if($redit['id']!=''){
                                    $db->query("update vn_gallery_menu_lang set ten = '".$txt_ten[$r['code']]."',chu_thich = '".$txt_chu_thich[$r['code']]."',slug='".lg_string::get_link($txt_ten[$r['code']])."' where id = '".$redit['id']."'");
                                    $qcat3 = $db->select("slug","slug='".$redit['slug']."' and post_type='".$post_type."' ");
                                    $rcat3=$db->fetch($qcat3);
                                    $db->query("update slug set slug = '".lg_string::get_link($txt_ten[$r['code']])."' where id = '".$rcat3['id']."'");
                                }else{
                                    $db->insert("vn_gallery_menu_lang","gallery_menu_id,lang_id,ten,chu_thich,slug","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_chu_thich[$r['code']]."','".lg_string::get_link($txt_ten[$r['code']])."' ");
                                    $db->insert("slug","cat,slug,post_type","'".$id."','".lg_string::get_link($txt_ten[$r['code']])."','".$post_type."'");
                                }
                            }
                        }
                        admin_load("","?act=gallery_manager&post_type=".$post_type);
            			$OK = true;
            		}
            	}
            	else
            	{
            		$r	= $db->select("vn_gallery_menu","id = '".$id."'");
            		while ($row = $db->fetch($r))
            		{
            			
            			$txt_cat		=	$row["cat"];
            			$txt_hien_thi	=	$row["hien_thi"];
            		}
            	}
            	
            	if (!$OK)
            		template_edit("?act=gallery_menu_edit","update",$id,$txt_cat,$txt_hien_thi,$post_type,$error);
            ?>
                </div>
            </div>
        </div>
    </div>
</section>