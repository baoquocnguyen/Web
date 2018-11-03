<?
    $func = $_POST['func'];
    if ($_POST["func"]=="del") $id = $_POST["id"]; else $id = $_GET['id'];
    $tik = $_POST['tik'];
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("vn_user","id = '".$tik[$i]."'");
		}
		admin_load("","?act=member_list");
		die();
	}
?>
<section class="content-header">
    <h1>User<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">User</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách Thành viên</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                        	<?if($_SESSION["level"]==1||$_SESSION["level"]==0){?>
                            <a href="?act=member_new">Thêm thành viên</a>    
                            <?}?>
                        </span>
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("vn_user","level <> 0","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form action="?act=member_list" method="post" onsubmit="return confirm('Are you sure ?');">
                        <input type="hidden" name="func" value="del" />
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Images</th>
                                    <th>Account</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Registration Date</th>
                                    <th>Status</th>
                                    <th>Level</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $level_arr	=	array("Coder","Administrator","Moderator","Member");
                                $count	=	0;
                                if($_SESSION["level"]==1||$_SESSION["level"]==2||$_SESSION["level"]==3)
                                { 
                                    $r		=	$db->select("vn_user","level <> 0","order by username asc"); 
                                }else{
                                    $r		=	$db->select("vn_user","","order by username asc");
                                }
                                while ($row = $db->fetch($r))
                                {
                                	$dem++;
                                ?>
                                <tr>
                                    <th scope="row"><?=$dem?></th>
                                    <td class="img-post"><?php echo get_image_avata($row["id"],'member','avatar')?></td>
                                    <td><?=$row["username"]?></td>
                                    <td><?=$row["ten"]?></td>
                                    <td><?=$row["dia_chi"]?></td>
                                    <td><?=$row["dien_thoai"]?></td>
                                    <td><?=lg_date::vn_time($row["time"])?></td>
                                    <td><p style="cursor: pointer;" class="showhide<?=$row["id"]?>trang_thai"><img onclick="showhide('vn_user','trang_thai',<?=$row["id"]?>)" src="images/<?=$row["trang_thai"]==1?'true':'false'?>.png" /></p></td>
                                    <td><?=$level_arr[$row["level"]]?></td>
                                    <td>
                                        <?if($_SESSION["level"]==1||$_SESSION["level"]==0){?>
                                            <a href="?act=member_edit&id=<?=$row["id"]?>">Edit</a>    
                                        <?}?>
                                    </td>
                                    <td>
                                        <?if($_SESSION["level"]==1||$_SESSION["level"]==0){?>
                                            <input name="tik[]" type="checkbox" value="<?=$row["id"]?>" />    
                                        <?}?>
                                    </td>
                                </tr>
                                <?}?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10"></td>
                                    <td>
                                        <?if($_SESSION["level"]==1||$_SESSION["level"]==0){?>
                                        <input type="submit" value="Xóa" class="btn btn-success" style="width:80%;" />    
                                        <?}?>                                    
                                    </td>
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