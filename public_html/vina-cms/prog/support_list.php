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
<?php

    $id = $_POST['id'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("vn_support","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các Trang thông tin đã chọn.","?act=support_list");
		die();
	}
?>
<section class="content-header">
    <h1>Support list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Support list</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Nhân viên hỗ trợ</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                            <a href="?act=support_new">Thêm mới</a>
                        </span>
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("vn_support"," ","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                    <form action="?act=support_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
                    <input type="hidden" name="func" value="del" />
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <table class="table table-striped">
                    <thead>
                        <tr>
                        	<th>#</th>
                        	<th>Name</th>
                            <th>Tel</th>
                            <th>Skype</th>
                            <th>Facebook</th>
                            <th>Google</th>
                            <th>Hiển thị</th>
                        	<th>Chỉnh sửa</th>
                        	<th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r		=	$db->select("vn_support","","order by id desc");
                    while ($row = $db->fetch($r))
                    {
                    	$count++;
                    ?>
                    <tr>
                    	<th scope="row"><?=$count?></th>
                    	<td class="bold">
                            <img style="width: 60px;margin-right:10px" src="../uploads/support/<?=$row['hinh']?>" alt="<?=$row["tieude"]?>" />
                            <a href="?act=support_edit&id=<?=$row["id"]?>"><?=$row["tieude"]?></a></td>
                        <td><?=$row["tel"]?></td>
                        <td><?=$row["skype"]?></td>
                        <td><?=$row["facebook"]?></td>
                        <td><?=$row["yahoo"]?></td>
                        <td><p style="cursor: pointer;" class="showhide<?=$row["id"]?>hien_thi"><img onclick="showhide('vn_support','hien_thi',<?=$row["id"]?>)" src="images/<?=$row["hien_thi"]==1?'true':'false'?>.png" /></p></td>
                        <td><a href="?act=support_edit&id=<?=$row["id"]?>">Sửa</a></td>
                    	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                    </tr>
                    <?
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">&nbsp;</td>
                            <td><input type="submit" value="Xóa" class="btn btn-success" /></td>
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