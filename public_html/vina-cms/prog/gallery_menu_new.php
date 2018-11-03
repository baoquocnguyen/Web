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
                    <h3 class="box-title">Thêm mới</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
            <?
            	$act = $_GET['act'];
                $id = $_GET['id'];
                $txt_cat = $_GET['txt_cat'];
                $txt_ten = $_GET['txt_ten'];
                $txt_chu_thich  = $_GET['txt_chu_thich'];
                $txt_hien_thi = $_GET['txt_hien_thi'];
                $func = $_GET['func'];
                
                if ($_POST["func"]=="new") 
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
                
                $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
                $rcheck=$db->fetch($qcheck);
                
            	$txt_cat = $db->escape($txt_cat);
            	//	Kiểm tra sự tồn tại của ID
            	$r	= $db->select("vn_cat","id = '".$txt_cat."' and _gallery = 1");
            	if ($db->num_rows($r) == 0)
            		admin_load("Không tồn tại Nhóm này.","?act=gallery_manager");
            ?>
            <?php
            	$OK = false;
            	
            	if ($func == "new")
            	{
            		if (empty($txt_ten[$rcheck['code']]))
            			$error = "Vui lòng nhập Tên mục.";
            		else
            		{
            			$id=$db->insert("vn_gallery_menu","id,cat,thu_tu,hien_thi,post_type","0,'".$db->escape($txt_cat)."','".(cat_count($txt_cat)+1)."','".($txt_hien_thi+0)."','".$post_type."' ");
                        
            			$q=$db->select("language","display=1","order by thu_tu");
                            while($r=$db->fetch($q)){
                                if($txt_ten[$r['code']]!=''){
                                    $db->insert("vn_gallery_menu_lang","gallery_menu_id,lang_id,ten,chu_thich,slug","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_chu_thich[$r['code']]."','".lg_string::get_link($txt_ten[$r['code']])."' ");
                                    $db->insert("slug","cat,slug,post_type","'".$id."','".lg_string::get_link($txt_ten[$r['code']])."','".$post_type."'");
                                }
                            }
                        
                        admin_load("","?act=gallery_manager&post_type=".$post_type);
            			$OK = true;
            		}
            	}
            	else
            	{
            		$txt_hien_thi	=	1;
            	}
            	
            	if (!$OK)
            		template_edit("?act=gallery_menu_new","new",0,$txt_cat,$txt_hien_thi,$post_type,$error);
            ?>
                </div>
            </div>
        </div>
    </div>
</section>