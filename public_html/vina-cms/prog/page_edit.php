<?php
    $act = $_POST['act'];
    $post_type = $_POST['post_type'];
    if($post_type==''){$post_type = 'page_none';}
    $option1 = $_POST['option1'];
    $home = $_POST['home'];
    $txt_ten_slug = $_POST['txt_ten'];
    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $txt_chu_thich = str_replace($kitu1,$kitu2,$_POST['txt_chu_thich']);
    $txt_ten = str_replace($kitu1,$kitu2,$_POST['txt_ten']);
    $txt_noi_dung = $_POST['txt_noi_dung'];
    $txt_url        =   $_POST['txt_url'];
    $txt_hien_thi        =   $_POST['txt_hien_thi'];
    $media_id  =   $_POST['media_id'];
    
    $title_seo = $_POST['title_seo'];
    $keywords = $_POST['keywords'];
    $description = $_POST['description'];
    
    $func = $_POST['func'];
    if ($_POST["func"]=="update") $id = $_POST["id"]; else $id = $_GET['id'];
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
            	if ($func == "update")
            	{
            		if (empty($txt_ten[$rcheck['code']]))
            			$error = "Vui lòng nhập tên trang.";
            		else
            		{
            			$db->query("update vn_page set post_type = '".$post_type."',option1 = '".($option1+0)."',home = '".($home+0)."',hien_thi = '".$txt_hien_thi."',time = '".time()."' where id = '".$id."'");
                        $q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($txt_ten[$r['code']]!=''){
                                $qedit=$db->select("vn_page_lang","lang_id='".$r['code']."' and page_id='".$id."'","order by id");
                                $redit=$db->fetch($qedit);

                                $getslug=lg_string::slug($txt_ten_slug[$r['code']]).'.html';
                                $checkslug=$db->select("vn_page_lang","slug='".$getslug."' and page_id <> '".$id."'","");
                                $checkslugk=$db->select("post_lang","slug='".$getslug."'","");
                                if($db->num_rows($checkslug)==1||$db->num_rows($checkslugk)==1){
                                    $getslug=lg_string::slug($txt_ten_slug[$r['code']]).'-p'.$id.'.html';
                                }else{
                                    $getslug=lg_string::slug($txt_ten_slug[$r['code']]).'.html';
                                }

                                if($redit['id']!=''){
                                    $db->query("update vn_page_lang set ten = '".$txt_ten[$r['code']]."',chu_thich = '".$txt_chu_thich[$r['code']]."', noi_dung = '".$txt_noi_dung[$r['code']]."',url = '".$txt_url[$r['code']]."',title_seo='".$title_seo[$r['code']]."',keywords='".$keywords[$r['code']]."',description='".$description[$r['code']]."',slug='".$getslug."' where id = '".$redit['id']."'");
                                }else{
                                    $db->insert("vn_page_lang","page_id,lang_id,ten,chu_thich,noi_dung,url,title_seo,keywords,description,slug","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_chu_thich[$r['code']]."','".$txt_noi_dung[$r['code']]."','".$txt_url[$r['code']]."','".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."','".$getslug."'");
                                }
                                if($r['code']==$rcheck['code']){
                                    $qmenu=$db->select("vn_menu","menu_id='p".$id."' and post_type='page'","");
                                    $rmenu=$db->fetch($qmenu);
                                    if($rmenu['menu_id']!=''){
                                        if($home==1){
                                            $type_link=1;
                                        }elseif($option1==1){
                                            $type_link=2;
                                        }else{
                                            $type_link=0;
                                        }
                                        $db->query("update vn_menu set name = '".$txt_ten[$r['code']]."',slug = '".$getslug."', type_link = '".$type_link."' where menu_id = '".$rmenu['menu_id']."'");
                                    }
                                }
                            }
                        }
                        // Update into table media_relationship 
                        if(!empty($media_id)){             // check isset id value of input media_id
                            $demn=0;
                            $qmr = $db->query("SELECT id FROM media_relationship WHERE parent_id = '".$id."' and parent_type='page' and type='avatar'");
                            if($qmr){$demn=$db->num_rows($qmr);}
                            if($demn > 0){    // isset before, update
                                $rmr = $db->fetch($qmr);
                                $db->update("media_relationship","media_id",$media_id,"id = '".$rmr['id']."'" );
                            }else{                          // not isset before, insert
                                $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','page','avatar'");
                            }
                        }
                        admin_load("","?act=page_edit&id=".$id);
                        
            		}
            	}
            	else
            	{
            		$r	= $db->select("vn_page","id = '".$id."'");
            		while ($row = $db->fetch($r))
            		{
            			$post_type		= $row["post_type"];
                        $option1=$row['option1'];
            			$txt_ten		= $row["ten"];
                        $txt_chu_thich  = $row['chu_thich'];
            			$txt_noi_dung	= $row["noi_dung"];
                        $txt_url        = $row["url"];
                        $txt_hien_thi        = $row["hien_thi"];
                        $home        = $row["home"];
            		}
            	}
            	
           		template_edit("?act=page_edit","update",$_GET['id'],$post_type,$option1,$txt_ten,$txt_chu_thich,$txt_noi_dung,$txt_url,$txt_hien_thi,$home,$error);
            ?>
                </div>
            </div>
        </div>
    </div>
</section>