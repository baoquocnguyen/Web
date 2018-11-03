<script>
function showhide(table,data,id)
{
$.ajax({
    type:'GET',
    url:'<?=$domain?>/<?=admin_url?>/showhide.php',
    data:{table : table,data : data,id : id},
    success	: function(sh)
    { 
        $(".showhide"+id+data+table).html(sh);
    }
});
};
</script>
<?php
    $id = htmlspecialchars($_REQUEST['id']);
	$func = $_POST['func'];
    $delete = $_GET['delete'];
    $order_ = $_POST['order_'];
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
        $r = $db->select("vn_gallery_menu","id ='".$delete."'","order by id");
        while($row = $db->fetch($r))
        {
            $db->delete("vn_gallery_menu","id = '".$row['id']."'");
            $rk = $db->select("vn_gallery_menu_lang","gallery_menu_id ='".$row['id']."'","order by id");
            while($rowk = $db->fetch($rk))
            {
                $db->delete("vn_gallery_menu_lang","id = '".$rowk['id']."'");
            }
            $rk2 = $db->select("slug","cat ='".$row['id']."'","order by id");
            while($rowk2 = $db->fetch($rk2))
            {
                $db->delete("slug","id = '".$rowk2['id']."'");
            }
            $rk1 = $db->select("vn_gallery","cat ='".$row['id']."'","order by id");
            while($rowk1 = $db->fetch($rk1))
            {
                $fileanh='../'.$rowk1['dir'].$rowk1['hinh'];
                if(!is_dir($fileanh))
                {
                    unlink($fileanh); 
                } 
                $db->delete("vn_gallery","id = '".$rowk1['id']."'");
            }

        }
		admin_load("","?act=gallery_manager&post_type=".$post_type);
	}
	if ($func == "sort")
	{
		$r1	=	$db->select("vn_cat");
		while ($row1 = $db->fetch($r1))
		{
			$id1 = $row1["id"];
			$db->update("vn_cat","thu_tu",$order_[$id1],"id = '".$id1."'");
		}
		$r	=	$db->select("vn_gallery_menu");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("vn_gallery_menu","thu_tu",$order__[$id],"id = '".$id."'");
		}
		admin_load("","?act=gallery_manager&post_type=".$post_type);
	}
?>
<section class="content-header">
    <h1>Gallery manager<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li class="active">Gallery manager</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh mục hình ảnh</h3>
                    <div class="box-tools pull-right">
                       
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                    <form action="?act=gallery_manager" method="post">
                    <input type="hidden" name="act" value="gallery_manager" />
                    <input type="hidden" name="func" value="sort" />
                    <input type="hidden" name="post_type" value="<?=$post_type?>" />
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Group</th>
                            <th>Catelog name</th>
                            <th>Sort</th>
                            <th>Display</th>
                            <th>Highlight</th>
                            <th>Add</th>
                            <th>Del</th>
                            <th>Edit</th>
                            <th>Content</th>
                            <th>Item</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $count=0;
                    $r	=	$db->select("vn_cat","_gallery = 1","order by thu_tu asc");
                    while ($row = $db->fetch($r))
                    {
                        $count++;
                    ?>
                    <tr>
                        <th scope="row"><?=$count?></th>
                        <td><?=$row["ten"]?></td>
                        <td>&nbsp;</td>
                        <td><span class="soft"><?=show_order("order_[".$row["id"]."]",$db->num_rows($r),$row["thu_tu"],"100%",0);?></span></td>
                    	<td><p style="cursor: pointer;" class="showhide<?=$row["id"]?>hien_thivn_cat"><img onclick="showhide('vn_cat','hien_thi',<?=$row["id"]?>)" src="images/<?=$row["hien_thi"]==1?'true':'false'?>.png" /></p></td>
                        <td><p style="cursor: pointer;" class="showhide<?=$row["id"]?>noi_batvn_cat"><img onclick="showhide('vn_cat','noi_bat',<?=$row["id"]?>)" src="images/<?=$row["noi_bat"]==1?'true':'false'?>.png" /></p></td>
                        <td><a href="?act=gallery_menu_new&txt_cat=<?=$row["id"]?>&post_type=<?=$post_type?>"><?if($row['id']!='album'){?>Add<?}?></a></td>
                        <td>-</td>
                        <td><a class="a_sang" href="?act=catgal_edit&id=<?=$row["id"]?>"><img src="images/repair.png" border="0" /></a></td>
                        <td colspan="2">-</td>
                    </tr>
                    <?php
                    $r2	=	$db->select("vn_gallery_menu","cat = '".$row["id"]."'","order by thu_tu asc");
                    while ($row2 = $db->fetch($r2))
                    {
                        $q4 = $db->select("media_relationship","parent_id='".$row2['id']."' and type='gallery' and parent_type='gallery'","");
                        $demsl = $db->num_rows($q4);
                        $qlang	= $db->select("vn_gallery_menu_lang","gallery_menu_id = '".$row2['id']."'","order by id limit 1");
                        $rlang = $db->fetch($qlang);
                    ?>
                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td><img src="images/node.gif" align="absmiddle" /> <img src="images/maps.png" align="absmiddle" /> <a class="url cat1" href="?act=media_gal&txt_cat=<?=$row2["id"]?>"><?=$rlang["ten"]?></a>
                        <br /><span> - <?=$row2["ten_en"]?></span>
                        <span class="notes">Notes: <?if($row2["chu_thich"]==""){echo "None";}else{echo $row2["chu_thich"];}?></span>
                        </td>
                        <td><span class="soft"><?=show_order("order__[".$row2["id"]."]",$db->num_rows($r2),$row2["thu_tu"],"100%",0);?></span></td>
                        <td><p style="cursor: pointer;" class="showhide<?=$row2["id"]?>hien_thivn_gallery_menu"><img onclick="showhide('vn_gallery_menu','hien_thi',<?=$row2["id"]?>)" src="images/<?=$row2["hien_thi"]==1?'true':'false'?>.png" /></p></td>
                        <td>-</td>
                        <td><!--<a class="add" href="?act=gallery_new&txt_cat=<?=$row2["id"]?>">Add image</a>--></td>
                        <td><a href="?act=gallery_manager&delete=<?=$row2["id"]?>&post_type=<?=$post_type?>" onclick="return confirm('All posts will be lost \nAre you sure?');">Delete</a></td>
                        <td><a href="?act=gallery_menu_edit&id=<?=$row2["id"]?>&post_type=<?=$post_type?>">Edit</a></td>
                        <td><a href="?act=media_gal&txt_cat=<?=$row2["id"]?>"><img src="images/go_right.png" border="0" /></a></td>
                        <td><?=$demsl?></td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td><input type="submit" value="Sort" class="btn btn-success"/></td>
                        <td colspan="7"></td>
                    </tr>
                    </tfoot>
                    </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>