<?php
    $act = $_POST['act'];
    $txt_alias = $_POST['txt_alias'];$option1 = $_POST['option1'];
    $txt_ten = str_replace('"',"&quot;",$_POST['txt_ten']);
    $txt_ten_slug = $_POST['txt_ten'];
    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $txt_chu_thich = str_replace($kitu1,$kitu2,$_POST['txt_chu_thich']);
    $txt_noi_dung = $_POST['txt_noi_dung'];
    $txt_url        =   $_POST['txt_url'];
    $media_id  =   $_POST['media_id'];
    
    $title_seo = $_POST['title_seo'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];
    
    $txt_hinh = $_POST['txt_hinh'];
    $func = $_POST['func'];
    if ($_POST["func"]=="update") $id = $_POST["id"]; else $id = $_GET['id'];
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
                    <h3 class="box-title">Cập nhật</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
            <?php
            	//	Kiểm tra sự tồn tại của ID
                $id = $id+0;
            	$r	= $db->select("vn_page","id = '".$id."'");
            	if ($db->num_rows($r) == 0)
            		admin_load("Không tồn tại trang này.","?act=page_list");
                    
            	$max_file_size	=	6048000;
            	$up_dir			=	'../uploads/alias/';
            
            	if ($func == "update")
            	{
            		if (empty($txt_ten[$rcheck['code']]))
            			$error = "Vui lòng nhập tên trang.";
            		else if (empty($txt_alias))
            			$error = "Vui lòng nhập alias.";
            		else
            		{
                    $db->query("update vn_page set alias = '".$db->escape($txt_alias)."',option1 = '".($option1+0)."',time = '".time()."' where id = '".$id."'");
                        $q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($txt_ten[$r['code']]!=''){
                                $qedit=$db->select("vn_page_lang","lang_id='".$r['code']."' and page_id='".$id."'","order by id");
                                $redit=$db->fetch($qedit);
                                if($redit['id']!=''){
                                    $db->query("update vn_page_lang set ten = '".$txt_ten[$r['code']]."',chu_thich = '".$txt_chu_thich[$r['code']]."', noi_dung = '".$txt_noi_dung[$r['code']]."',url = '".$txt_url[$r['code']]."',title_seo='".$title_seo[$r['code']]."',keywords='".$keywords[$r['code']]."',description='".$description[$r['code']]."' where id = '".$redit['id']."'");
                                }else{
                                    $db->insert("vn_page_lang","page_id,lang_id,ten,chu_thich,noi_dung,url,title_seo,keywords,description","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_chu_thich[$r['code']]."','".$txt_noi_dung[$r['code']]."','".$txt_url[$r['code']]."','".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."' ");
                                    
                                }
                            }
                        }
                        // Update into table media_relationship 
                        if(!empty($media_id)){             // check isset id value of input media_id
                            $demn=0;
                            $qmr = $db->query("SELECT id FROM media_relationship WHERE parent_id = '".$id."' and parent_type='info' and type='avatar'");
                            if($qmr){$demn=$db->num_rows($qmr);}
                            if($demn > 0){    // isset before, update
                                $rmr = $db->fetch($qmr);
                                $db->update("media_relationship","media_id",$media_id,"id = '".$rmr['id']."'" );
                            }else{                          // not isset before, insert
                                $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','info','avatar'");
                            }
                        }
                        admin_load("","?act=info_list");
            		}
            	}
            	else
            	{
            		$r	= $db->select("vn_page","id = '".$id."'");
            		while ($row = $db->fetch($r))
            		{
            			$txt_alias		= $row["alias"];$option1=$row['option1'];
            			$txt_ten		= $row["ten"];
                        $txt_chu_thich  = $row['chu_thich'];
            			$txt_noi_dung	= $row["noi_dung"];
                        $txt_url        = $row["url"];
            		}
            	}
            	
            	if (!$OK)
            		template_edit("?act=info_edit","update",$_GET['id'],$txt_alias,$option1,$txt_ten,$txt_chu_thich,$txt_noi_dung,$txt_url,$txt_hinh,$error);
            ?>
                </div>
            </div>
        </div>
    </div>
</section>