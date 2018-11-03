<script>
function showhide(table,data,id)
{
$.ajax({
    type:'GET',
    url:'<?=$domain?>/<?=admin_url?>/showhide.php',
    data:{table : table,data : data,id : id},
    success	: function(sh)
    { 
        $(".showhide"+id+data).html(sh);
    }
});
};
</script>

<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
$id = htmlspecialchars($_REQUEST['id']);
?>
<?php
	//	Kiểm tra sự tồn tại của ID
    $func = $_POST['func'];
    $delete = $_GET['delete'];
    $order__ = $_POST['order__'];
    if ($_POST["func"]=="sort"){
        $id = $_POST["id"]; 
        $post_type = $_POST['post_type'];
    }else{
        $id = $_GET['id'];
        $post_type = $_GET['post_type'];
    }
    $post_type_con=$post_type.'_detail';
    $tik = $_POST['tik'];
    if ($delete != 0)
	{

        $qdel = $db->select("postcat","id = '".$delete."'","");
        $rdel = $db->fetch($qdel);
		$qdel3 = $db->select("post","(cat ='".$delete."' or cat1 ='".$delete."' or cat2 ='".$delete."')","");
		while($rdel3 = $db->fetch($qdel3))
        {
            $db->delete("post","id = '".$rdel3['id']."'");
            $db->delete("post_lang","post_id = '".$rdel3['id']."'");
            $db->delete("media_relationship","parent_id ='".$rdel3['id']."' and parent_type='postcat'"); 
        }
		$qdel2 = $db->select("postcat","cat ='".$delete."'","");
		while($rdel2 = $db->fetch($qdel2))
		{
			$db->delete("postcat","id = '".$rdel2['id']."'");
            $db->delete("postcat_lang","postcat_id = '".$rdel2['id']."'");
            $db->delete("media_relationship","parent_id ='".$rdel2['id']."' and parent_type='postcat'");
            $db->delete("vn_menu","post_type = 'postcat' and menu_id='".$rdel2['id']."'");  
		}
        $db->delete("media_relationship","parent_id ='".$delete."' and parent_type='postcat'");
		$db->delete("postcat","id = '".$delete."'");
        $db->delete("postcat_lang","postcat_id = '".$delete."'");
        $db->delete("vn_menu","post_type = 'postcat' and menu_id='".$delete."'");
		admin_load("","?act=postcat_list&post_type=".$post_type);
	}
	if ($func == "sort")
	{
		$r	=	$db->select("postcat","post_type='".$post_type."'");
		while ($row = $db->fetch($r))
		{
			$id1 = $row["id"];
			$db->update("postcat","thu_tu",$order__[$id1],"id = '".$id1."'");
		}
		admin_load("","?act=postcat_list&post_type=".$post_type);
	}
    
?>

<section class="content-header">
    <h1>Post manager<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li class="active">Post manager</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-push-4">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Posts categories</h3>
                    <div class="box-tools pull-right">
                        
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                    <form action="?act=postcat_list" method="post">
                    <input type="hidden" name="func" value="sort" />
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <input type="hidden" name="post_type" value="<?=$post_type?>" />
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <td class="an767">Image</td>
                            <td class="nametitle">Name</td>
                            <td>Sort</td>
                        	<td>Show</td>
                        	<td>Highlights</td>
                        	<td class="an767">Count</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=0;
                    $q		=	$db->select("postcat","cat=0 and post_type='".$post_type."'","order by thu_tu, id desc");
                    while ($r = $db->fetch($q))
                    {
                        $q1		=	$db->select("post","cat=".$r['id'],"");
                        $demsl = $db->num_rows($q1);
                    	$count++;
                        $qlang	= $db->select("postcat_lang","postcat_id = '".$r['id']."'","order by id limit 1");
                    	$rlang = $db->fetch($qlang);
                    ?>
                    <tr>
                        <td class="an767 img-post"><?php echo get_image_avata($r["id"],'postcat','avatar')?></td>
                    	<td><strong><a class="url cat1" href="?act=postcat_edit&id=<?=$r["id"]?>&post_type=<?=$post_type?>"><?=$rlang["name"]?></a>
                            <span><a href="?act=postcat_edit&id=<?=$r["id"]?>&post_type=<?=$post_type?>">Edit</a> &nbsp;|&nbsp; <a href="?act=post_list&id=<?=$r['id']?>&post_type=<?=$post_type_con?>">View</a> &nbsp;|&nbsp; <a href="?act=album_mana_list&cat=<?=$r["id"]?>&post_type=<?=$post_type?>&type=album&parent_type=postcat">Album</a><a style="color: red;float: right;" href="?act=postcat_list&delete=<?=$r["id"]?>&post_type=<?=$post_type?>" onclick="return confirm('Are you sure ?');">Delete</a></span>

                        </strong> 
                        </td>
                        <td><span class="soft"><?=show_order("order__[".$r["id"]."]",$db->num_rows($q),$r["thu_tu"],"100%",1);?></span></td>
                    	<td><p style="cursor: pointer;" class="showhide<?=$r["id"]?>hien_thi"><img onclick="showhide('postcat','hien_thi',<?=$r["id"]?>)" src="images/<?=$r["hien_thi"]==1?'true':'false'?>.png" /></p></td>
                        <td><p style="cursor: pointer;" class="showhide<?=$r["id"]?>noi_bat"><img onclick="showhide('postcat','noi_bat',<?=$r["id"]?>)" src="images/<?=$r["noi_bat"]==1?'true':'false'?>.png" /></p></td>
                        <td class="an767"><span><?=$demsl?></span></td>
                    </tr>
                        <?php
                        $q2		=	$db->select("postcat","cat=".$r['id']." and post_type='".$post_type."'","order by thu_tu, id desc");
                        while ($r2 = $db->fetch($q2))
                        {
                            $q1		=	$db->select("post","cat=".$r2['id'],"");
                            $demsl = $db->num_rows($q1);
                            $qlang1	= $db->select("postcat_lang","postcat_id = '".$r2['id']."'","order by id limit 1");
                        	$rlang1 = $db->fetch($qlang1);
                        ?>
                        <tr>
                            <td class="an767 img-post"><?php echo get_image_avata($r2["id"],'postcat','avatar')?></td>
                            <td><strong><a class="url cat2" href="?act=postcat_edit&id=<?=$r2["id"]?>&post_type=<?=$post_type?>"> &mdash; <?=$rlang1["name"]?></a>
                                <span><a href="?act=postcat_edit&id=<?=$r2["id"]?>&post_type=<?=$post_type?>">Edit</a> &nbsp;|&nbsp; <a href="?act=post_list&id=<?=$r2['id']?>&post_type=<?=$post_type_con?>">View</a> &nbsp;|&nbsp; <a href="?act=album_mana_list&cat=<?=$r["id"]?>&post_type=<?=$post_type?>&type=album&parent_type=postcat">Album</a><a style="color: red;float: right;" href="?act=postcat_list&delete=<?=$r2["id"]?>&post_type=<?=$post_type?>" onclick="return confirm('Are you sure ?');">Delete</a></span>
                            </strong> 
                            </td>
                            <td><span class="soft"><?=show_order("order__[".$r2["id"]."]",$db->num_rows($q2),$r2["thu_tu"],"100%",0);?></span></td>
                        	<td><p style="cursor: pointer;" class="showhide<?=$r2["id"]?>hien_thi"><img onclick="showhide('postcat','hien_thi',<?=$r2["id"]?>)" src="images/<?=$r2["hien_thi"]==1?'true':'false'?>.png" /></p></td>
                            <td><p style="cursor: pointer;" class="showhide<?=$r2["id"]?>noi_bat"><img onclick="showhide('postcat','noi_bat',<?=$r2["id"]?>)" src="images/<?=$r2["noi_bat"]==1?'true':'false'?>.png" /></p></td>
                            <td class="an767"><span><?=$demsl?></span></td>
                        </tr>
                            <?php
                            $q3		=	$db->select("postcat","cat=".$r2['id']." and post_type='".$post_type."'","order by thu_tu, id desc");
                            while ($r3 = $db->fetch($q3))
                            {
                                $q1		=	$db->select("post","cat=".$r3['id'],"");
                                $demsl = $db->num_rows($q1);
                                $qlang2	= $db->select("postcat_lang","postcat_id = '".$r3['id']."'","order by id limit 1");
                            	$rlang2 = $db->fetch($qlang2);
                            ?>
                            <tr>
                                <td class="an767 img-post"><?php echo get_image_avata($r3["id"],'postcat','avatar')?></td>
                                <td><strong><a class="url cat3" href="?act=postcat_edit&id=<?=$r3["id"]?>&post_type=<?=$post_type?>"> &mdash; &mdash; <?=$rlang2["name"]?></a>
                                <span><a href="?act=postcat_edit&id=<?=$r3["id"]?>&post_type=<?=$post_type?>">Edit</a> &nbsp;|&nbsp; <a href="?act=post_list&id=<?=$r3['id']?>&post_type=<?=$post_type_con?>">View</a> &nbsp;|&nbsp; <a href="?act=album_mana_list&cat=<?=$r["id"]?>&post_type=<?=$post_type?>&type=album&parent_type=postcat">Album</a><a style="color: red;float: right;" href="?act=postcat_list&delete=<?=$r3["id"]?>&post_type=<?=$post_type?>" onclick="return confirm('Are you sure ?');">Delete</a></span>
                                </strong></td>
                                <td><span class="soft"><?=show_order("order__[".$r3["id"]."]",$db->num_rows($q3),$r3["thu_tu"],"100%",0);?></span></td>
                            	<td><p style="cursor: pointer;" class="showhide<?=$r3["id"]?>hien_thi"><img onclick="showhide('postcat','hien_thi',<?=$r3["id"]?>)" src="images/<?=$r3["hien_thi"]==1?'true':'false'?>.png" /></p></td>
                                <td><p style="cursor: pointer;" class="showhide<?=$r3["id"]?>noi_bat"><img onclick="showhide('postcat','noi_bat',<?=$r3["id"]?>)" src="images/<?=$r3["noi_bat"]==1?'true':'false'?>.png" /></p></td>
                                <td class="an767"><span><?=$demsl?></span></td>
                            </tr>
                            <?
                            }
                        }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                    	<td>
                    		<strong>Page : </strong>
                    		<?php
                    			if ($pages==0) echo ":1:";
                        		for($i=1;$i<=$pages;$i++) {
                        			if ($i==$page) echo "<b>[".$i."]</b>";
                        			else {
                    					echo "<a href='?act=postcat_list&page=$i'>-$i-</a>";
                    				}
                    			}
                        	?>
                    	</td>
                        <td><input style="width: 70px" type="submit" value="Sort" class="btn btn-success" /></td>
                    	<td colspan="5"></td>
                    </tr>
                    </tfoot>
                    </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-pull-8">
            <div>
            <div class="addcate">Add New Category</div>
            <?php
                $act = $_POST['act'];
                $kitu1 = array('"',"'");
                $kitu2 = array('&quot;','&#39;');
                $txt_ten = str_replace($kitu1,$kitu2,$_POST['txt_ten']);
                $tenslug = $_POST['txt_ten'];
                $txt_note = str_replace($kitu1,$kitu2,$_POST['txt_note']);
                $txt_url = $_POST['txt_url'];
                $txt_thu_tu = $_POST['txt_thu_tu'];
                $txt_showhang = $_POST['txt_showhang'];
                $txt_hien_thi = $_POST['txt_hien_thi'];
                $txt_noi_bat = $_POST['txt_noi_bat'];
                $media_id  =   $_POST['media_id'];
                
                $title_seo = str_replace($kitu1,$kitu2,$_POST['title_seo']);
                $keywords = str_replace($kitu1,$kitu2,$_POST['keywords']);
                $description = str_replace($kitu1,$kitu2,$_POST['description']);
                
                $func = $_POST['func'];
                if ($_POST["func"]=="new") 
                { 
                $id = $_POST["id"];
                $cat = $_POST['cat'];
                $post_type = $_POST['post_type']; 
                }
                else 
                {
                $id = $_GET['id'];
                $cat = $_GET['cat'];
                $post_type = $_GET['post_type']; 
                }
                include "templates/postcat.php";
                
                $qcheck=$db->select("language","display=1","order by thu_tu limit 1");
                $rcheck=$db->fetch($qcheck);

            	if ($func == "new")
            	{
                    $txt_cat = $_POST['txt_cat'];
                    $level=1;
                    if($txt_cat=='0'){
                        $level=1;
                    }else{
                        $q1=$db->select("postcat","id='".$txt_cat."'","");
                        $r1=$db->fetch($q1);
                        $q2=$db->select("postcat","id='".$r1['cat']."'","");
                        $r2=$db->fetch($q2);
                        if($r2['id']==''){
                            $level=2;
                        }else{
                            $level=3;
                        }
                    }
                    $id = $db->insert("postcat","cat,hien_thi,noi_bat,thu_tu,level,post_type","'".$txt_cat."','".$txt_hien_thi."','".$txt_noi_bat."','".$txt_thu_tu."','".$level."','".$post_type."'");
                    $q=$db->select("language","display=1","order by thu_tu");
                        while($r=$db->fetch($q)){
                            if($txt_ten[$r['code']]!=''){
                                
                                if($txt_url[$r['code']]==''){$txt_url[$r['code']] = $tenslug[$r['code']];}

                                $getslug=lg_string::slug($txt_url[$r['code']]);
                                $checkslug=$db->select("postcat_lang","slug='".$getslug."'","");
                                if($db->num_rows($checkslug)==1){
                                    $getslug=lg_string::slug($txt_url[$r['code']]).'-'.$id;
                                }else{
                                    $getslug=lg_string::slug($txt_url[$r['code']]);
                                }
                                
                                $db->insert("postcat_lang","postcat_id,lang_id,name,note,slug,title_seo,keywords,description","'".$id."','".$r['code']."','".$txt_ten[$r['code']]."','".$txt_note[$r['code']]."','".$getslug."','".$title_seo[$r['code']]."','".$keywords[$r['code']]."','".$description[$r['code']]."' ");
                                //$db->insert("slug","cat,slug,post_type","'".$id."','".$getslug."','".$post_type."'");
                            }
                    }
                    if(!empty($media_id)){
                        $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','postcat','avatar'");
                    }
                    admin_load("","?act=postcat_list&post_type=".$post_type);
            	}
            	else
            	{
            		$txt_cat = $_GET['txt_cat'];
                    $txt_hien_thi = 1;
                    $txt_showhang = 0;
                    $txt_thu_tu = '';
                    $txt_noi_bat = 0;
                    $level = 3;
            	} 
           		template_edit("?act=postcat_list","new",$id,$txt_cat,$txt_thu_tu,$txt_hien_thi,$txt_noi_bat,$level,$post_type,$error);
            ?>
            </div>
        </div>
    </div>
</section>
<?}else{?>
<div>Bạn không có quyền truy cập !</div>
<?}?>
<script>

</script>