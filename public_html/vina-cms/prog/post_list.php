<script>
function thutu(id,so)
{   
$.ajax({
    type:'GET',
    url:'<?=$domain?>/<?=admin_url?>/sort.php',
    data:{ id : id, so : so},
    //beforeSend:  function() {                
    //    $(".loader").show();
    //},
    //success:function(server_response){
    //    $(".loader").hide();
	//	window.location.reload()
    //}
});
};
/*Xep thu tu*/
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
/*Hien thi, noi bat...*/
$(function() {
$('#sortable').sortable({
    axis: 'y',
    opacity: 0.7,
    cursor: 'move',
    update: function(event, ui) {
        var data_id = $(this).sortable('toArray').toString();
		// change order in the database using Ajax
        $.ajax({
            url: '<?=$domain?>/<?=admin_url?>/order.php',
            type: 'POST',
            data: {list_order:data_id},
            success: function(data) {
                //finished
                //$(".concho").html(data);
            }
        });
    }
});
});/*Keo,tha drag and drop*/
</script>

<?php
$id = $_GET['id'];
$page = $_GET['page'];
$func = $_POST['func'];
$tik = $_POST['tik'];
$r	= $db->select("post","id = '".$id."'");            
if ($_POST["func"]=="del") 
{
    $id = $_POST["id"];
    $post_type = $_POST['post_type']; 
}
else 
{
    $id = $_GET['id'];
    $post_type = $_GET['post_type'];
}
//if($post_type=='post'){ $post_type_cha='catpost'; }else{ $post_type_cha='catproduct'; }
$post_type_cha=str_replace("_detail","",$post_type);
if ($func == "del")
{
	for ($i = 0; $i < count($tik); $i++)
	{
        $qdel = $db->select("post","id = '".$tik[$i]."'","");
        $rdel = $db->fetch($qdel);
        $fileanh1='../uploads/'.$rdel['dir'].$rdel['hinh'];
		if(!is_dir($fileanh1))
		{
			unlink($fileanh1); 
		}else{
			echo 'Không xóa được hình ảnh';
		}
        $r = $db->select("post_album","cat ='".$tik[$i]."'","order by id");
        while($row = $db->fetch($r))
        {
			$fileanh2='../uploads/'.$row['dir'].$row['hinh'];
			if(!is_dir($fileanh2))
			{
				unlink($fileanh2); 
			}else{
				echo 'Không xóa được hình ảnh';
			}
            $db->delete("post_album","id = '".$row['id']."'");
        }
        $r2 = $db->select("post_album_menu","sp_id ='".$tik[$i]."'","order by id");
        while($row2 = $db->fetch($r2))
        {
            $fileanh3='../uploads/'.$row2['dir'].$row2['hinh'];
            if(!is_dir($fileanh3))
            {
                unlink($fileanh3); 
            }else{
                echo 'Không xóa được hình ảnh';
            }
            $db->delete("post_album_menu","id = '".$row2['id']."'");
        }
        $db->delete("media_relationship","parent_id ='".$tik[$i]."' and parent_type='post'");
		$db->delete("post","id = '".$tik[$i]."'");
        $db->delete("slug","cat = '".$tik[$i]."' and post_type='".$post_type."'");
        $db->delete("post_lang","post_id = '".$tik[$i]."'");
	}
	admin_load("","?act=post_list&id=".$id.'&post_type='.$post_type);
	die();
}
?>
<section class="content-header">
    <h1>Post list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=postcat_list&post_type=<?=$post_type_cha?>">Categories Post</a></li>
        <li class="active">list</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">list</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                            <a href="?act=post_new&txt_cat=<?=$id?>&post_type=<?=$post_type?>">Thêm mới</a>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form action="?act=post_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
                        <input type="hidden" name="func" value="del" />
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <input type="hidden" name="post_type" value="<?=$post_type?>" />
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            	<th>#</th>
                                <th>Sort</th>
                                <th>Images</th>
                            	<th>Tên</th>
                                <th class="text-center">Hiển thị</th>
                                <th class="text-center">Nổi bật</th>
                            	<th>Ngày đăng</th>
                            	<th>Người đăng</th>
                            	<th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        
                        $page		=	$page + 0;
                        $perpage	=	20;
                        $r_all		=	$db->select("post","cat = '".$id."'");
                        $sum		=	$db->num_rows($r_all);
                        $pages		=	($sum-($sum%$perpage))/$perpage;
                        if ($sum % $perpage <> 0 )	$pages = $pages+1;
                        $page		=	($page==0)?1:(($page>$pages)?$pages:$page);
                        $min 		= 	abs($page-1) * $perpage;
                        $max 		= 	$perpage;
                        
                        $count	=	$min;
                        $r		=	$db->select("post","cat = '".$id."'","order by thu_tu,id desc LIMIT ".$min.", ".$max);
                        if($db->num_rows($r) != 0)
                        {
                        while ($row = $db->fetch($r))
                        {
                            $qc	= $db->select("postcat","id = '".$row['cat']."'");
                        	$rc = $db->fetch($qc);
                            $qlang	= $db->select("post_lang","post_id = '".$row['id']."'","order by id limit 1");
                        	$rlang = $db->fetch($qlang);
                            $cat = $rc['ten'];
                            if($row['cat']==0){$cat='Chưa phân loại';}
                            
                        	$count++;
                        ?>
                        <tr class="list_detail">
                            <th scope="row"><?=$count?></th>
                            <th scope="row">
								<select class="select_down" onchange="thutu(<?=$row['id']?>,this.value)">
								<?php
									for ($i = 0; $i <= $sum; $i++)
									{
										echo "<option value=".$i;
										if ($row['thu_tu'] == $i) echo " selected ";
										echo ">".$i."</option>";
									}
								?>
								</select>
                                <div class="loader" style="display: none"></div>
                            </th>
                            <td class="img-post"><?php echo get_image_avata($row["id"],'post','avatar')?></td>
                            <td style="width: 200px;"><strong><a class="url cat1" href="?act=post_edit&id=<?=$row["id"]?>&post_type=<?=$post_type?>"><?=$rlang["ten"]?></a>
                                    <span>
                                        <a href="?act=post_edit&id=<?=$row["id"]?>&post_type=<?=$post_type?>">Edit</a> &nbsp;|&nbsp; 
                                        <!--<a class="url cat1" href="?act=postfile_manager&cat=<?=$row["id"]?>&post_type=<?=$post_type?>">Up video</a>&nbsp;|&nbsp;-->
                                        <!-- <a class="url cat1" href="?act=album_manager&cat=<?=$row["id"]?>&post_type=<?=$post_type?>">Album</a> -->
                                        <a class="url cat1" href="?act=album_mana_list&cat=<?=$row["id"]?>&post_type=<?=$post_type?>&type=album&parent_type=post">Album</a>
                                    </span>
                                </strong>
                            </td>
                        	<td class="text-center"><p style="cursor: pointer;" class="showhide<?=$row["id"]?>hien_thi"><img onclick="showhide('post','hien_thi',<?=$row["id"]?>)" src="images/<?=$row["hien_thi"]==1?'true':'false'?>.png" /></p></td>
                            <td class="text-center"><p style="cursor: pointer;" class="showhide<?=$row["id"]?>noi_bat"><img onclick="showhide('post','noi_bat',<?=$row["id"]?>)" src="images/<?=$row["noi_bat"]==1?'true':'false'?>.png" /></p></td>
                        	<td><?=date('d/m/Y',$row['time_edit'])?></td>
                        	<td><?if(get_user($row["user"],"username")==''){echo "Incognito";}else{?><?=get_user($row["user"],"username")?><?}?></td>
                        	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                        </tr>
                        <?
                        }}else{?>
                        </tbody>
                        <tfoot>
                            <tr>
                            	<td colspan="12" style="color: #DD4B39;">Không có nội dung</td>
                            </tr>
                        </tfoot>
                        <?
                        }
                        ?>
                        <tfoot>
                        <tr>
                        	<td colspan="8" style="text-align:left;">
                        		<strong>Trang : </strong>
                        		<?php
                        			if ($pages==0) echo ":1:";
                            		for($i=1;$i<=$pages;$i++) {
                            			if ($i==$page) echo "<b>[".$i."]</b>";
                            			else {
                        					echo "<a href='?act=post_list&id=".$id."&page=$i&post_type=".$post_type."'>-$i-</a>";
                                            //"<a href='?act=post_list&id=".$id."&post_type=".$post_type."&page=$i'>-$i-</a>";
                        				}
                        			}
                            	?>
                        	</td>
                        	<td colspan="1"><input type="submit" value="Xóa" class="btn btn-success"/></td>
                        </tr>
                        </tfoot>
                        </table>
                        </form>
                    </div>
                    
                    
                    
                    <!--
                    <div style="background: #000;">
                        <ul id="sortable" style="padding: 10px;">
                        <?
                        $q = $db->select("post","cat = '".$id."'","order by thu_tu");
                        while($r = $db->fetch($q)){
                            $ql	= $db->select("post_lang","post_id = '".$r['id']."'","order by id limit 1");
                        	$rl = $db->fetch($ql);
                        ?>
                        <li id="<?=$r['id'];?>" style="background:#7CB342;color: #fff;list-style: none;display: block;padding:10px;margin: 10px 0px;"><span class="nut_nho"><?=$rl['ten']?></span></li>
                        <?}?>
                        </ul>
                    </div>
                    -->
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>