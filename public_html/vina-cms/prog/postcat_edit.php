<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
?>
<?php
    $act = $_POST['act'];
    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $media_id  =   $_POST['media_id'];
    $txt_ten = str_replace($kitu1,$kitu2,$_POST['txt_ten']);
    
    $tenslug = $_POST['txt_ten'];
    $txt_note = str_replace($kitu1,$kitu2,$_POST['txt_note']);
    $txt_cat = $_POST['txt_cat'];
    $txt_url = $_POST['txt_url'];
    $txt_thu_tu = $_POST['txt_thu_tu'];
    $txt_hien_thi = $_POST['txt_hien_thi'];
    $txt_noi_bat = $_POST['txt_noi_bat'];
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
    include "templates/postcat.php";
    $qcat1 = $db->select("postcat","id='".$id."'");
    $rcat1=$db->fetch($qcat1);
    $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
    $rcheck=$db->fetch($qcheck);
    function update_level($id,$level)
    {
        global $db;
        $count=3-$level;
        if($count!=0){
            $q=$db->select("postcat","cat='".$id."'","");
            while ( $r=$db->fetch($q)) {
                if($db->num_rows($q)!=0){
                    $db->query("update postcat set level = '".($level+1)."' where id = '".$r['id']."'");
                }else{
                    break;
                }
                $level=$level+1;
                update_level($r['id'],$level);
                $level=$level-1;
            } 
        }
    }
?>
<section class="content-header">
    <h1>Edit Post manager<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=postcat_list&post_type=<?php echo $post_type ?>">List categories</a></li>
        <li class="active">Edit</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
            <div class="paddinglr10">
            
            <?php
            	if ($func == "update")
            	{
                    if (empty($txt_ten[$rcheck['code']]))
            			$error = "Vui lòng nhập tên.";
            		else
            		{
                        $qlv1=$db->select("postcat","id='".$txt_cat."'","");
                        $rlv1=$db->fetch($qlv1);
                        $level = $rlv1['level']+1;
            	        $db->query("update postcat set cat = '".$txt_cat."', hien_thi = '".$txt_hien_thi."',noi_bat = '".($txt_noi_bat+0)."',level='".$level."' where id = '".$id."'");
                        
                        update_level($id,$level);
                        $q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($txt_ten[$r['code']]!=''){
                                $qedit=$db->select("postcat_lang","lang_id='".$r['code']."' and postcat_id='".$id."'","order by id");
                                $redit=$db->fetch($qedit);
                                
                                if($txt_url[$r['code']]==''){$txt_url[$r['code']] = $tenslug[$r['code']];}

                                $getslug=lg_string::slug($txt_url[$r['code']]);
                                $checkslug=$db->select("postcat_lang","slug='".$getslug."' and postcat_id <> '".$id."'","");
                                if($db->num_rows($checkslug)==1){
                                    $getslug=lg_string::slug($txt_url[$r['code']]).'-'.$id;
                                }else{
                                    $getslug=lg_string::slug($txt_url[$r['code']]);
                                }
                                
                                if($redit['id']!=''){
                                    $db->query("update postcat_lang set name = '".$txt_ten[$r['code']]."',note = '".$txt_note[$r['code']]."',slug='".$getslug."',title_seo='".$title_seo[$r['code']]."',keywords='".$keywords[$r['code']]."',description='".$description[$r['code']]."' where id = '".$redit['id']."'");
                                    
                                }else{
                                    $db->insert("postcat_lang","postcat_id,lang_id,name,note,slug,title_seo,keywords,description","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_note[$r['code']]."','".$getslug."','".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."' ");
                                    $db->insert("slug","cat,slug,post_type","'".$id."','".$getslug."','".$post_type."'");
                                }
                                $qmenu=$db->select("vn_menu","menu_id='".$id."' and post_type='postcat'","");
                                $rmenu=$db->fetch($qmenu);
                                if($rmenu['menu_id']!=''){
                                    $db->query("update vn_menu set name = '".$txt_ten[$r['code']]."',slug = '".$getslug."' where menu_id = '".$rmenu['menu_id']."'");
                                }
                            }
                        }
                        // Update into table media_relationship 
                        if(!empty($media_id)){             // check isset id value of input media_id
                            $demn=0;
                            $qmr = $db->query("SELECT id FROM media_relationship WHERE parent_id = '".$id."' and parent_type='postcat' and type='avatar'");
                            if($qmr){$demn=$db->num_rows($qmr);}
                            if($demn > 0){    // isset before, update
                                $rmr = $db->fetch($qmr);
                                $db->update("media_relationship","media_id",$media_id,"id = '".$rmr['id']."'" );
                            }else{                          // not isset before, insert
                                $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','postcat','avatar'");
                            }
                            
                        }
                        admin_load("","?act=postcat_edit&id=".$id."&post_type=".$post_type."");
                    }
            	}
            	else
            	{
            		$r	= $db->select("postcat","id = '".$id."'");
            		while ($row = $db->fetch($r))
            		{
            			$txt_cat	= $row["cat"];
            			$txt_thu_tu	= $row["thu_tu"];
            			$txt_noi_bat	= $row["noi_bat"];
            			$txt_hien_thi	= $row["hien_thi"];
                        $level=$row["level"];
            		}
            	}     
            		template_edit("?act=postcat_edit","update",$id,$txt_cat,$txt_thu_tu,$txt_hien_thi,$txt_noi_bat,$level,$post_type,$error);
            ?>
            <?}else{?>
            <div>Bạn không có quyền truy cập !</div>
            <?}?>
                </div>
            </div>
        </div>
    </div>
</section>