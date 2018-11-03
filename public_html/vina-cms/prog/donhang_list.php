<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
?>
<?
$id = $_POST['id'];
$func = $_POST['func'];
$tik = $_POST['tik'];
if ($func == "del")
{
	for ($i = 0; $i < count($tik); $i++)
	{
        $magg = get_sql("select ma from donhang where id=".$tik[$i]);
		$db->delete("donhang","id = '".$tik[$i]."'");
        $db->query("update ma set so_lan_con=so_lan_con+1 where ten='".$magg."'");
	}
	admin_load("Đã xóa các Trang thông tin đã chọn.","?act=donhang_list");
	die();
}
$ma=$_GET['ma'];
$keyw='';
if($ma!=''){
    $keyw.="ma='".$ma."'";
}
?>
<script type="text/javascript">
function showhide(table,data,id)
{
$.ajax({
    type:'GET',
    url:'<?=$domain?>/<?=admin_url?>/showhide.php',
    data:{table : table,data : data,id : id},
    success : function(sh)
    { 
        $(".showhide"+id+data).html(sh);
    }
});
};
</script>
<section class="content-header">
    <h1>Đơn hàng<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Đơn hàng</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách Đơn hàng</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("donhang","","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form style="margin-bottom: 10px;" action="" method="get" class="search_smart"  enctype="multipart/form-data">
                            <input type="hidden" name="act" value="donhang_list" />
                            <label class="control-label">Mã: </label>
                            <input id="tu_khoa" placeholder="Nhập Mã đơn hàng" name="ma" type="text" value="<?=$tu_khoa?>" />
                            <button type="submit">Tìm kiếm</button>
                        </form>
                        <form action="?act=donhang_list" method="post" onsubmit="return confirm('Are you sure ?');">
                        <input type="hidden" name="func" value="del" />
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <table class="table table-striped">
                        <thead>
                        <tr>
                        	<th>#</th>
                            <th>Tên</th>
                        	<th>Số điện thoại</th>
                            <th>Ngày đặt hàng</th>
                            <th>Thành tiền</th>
                        	<th>Tình trạng</th>
                        	<th>Cập nhật</th>
                        	<th>Xóa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $page=$_GET['page'];
                        $page       =   $page + 0;
                        $perpage    =   12;
                        $r_all      =   $db->select("donhang",$keyw,"");
                        if($r_all){
                            $sum        =   $db->num_rows($r_all);
                        }
                        $pages      =   ($sum-($sum%$perpage))/$perpage;
                        if ($sum % $perpage <> 0 )  $pages = $pages+1;
                        $page       =   ($page==0)?1:(($page>$pages)?$pages:$page);
                        $min        =   abs($page-1) * $perpage;
                        $max        =   $perpage;
                        $r = $db->select("donhang",$keyw,"order by status asc, time desc LIMIT ".$min.", ".$max);
                        while ($row = $db->fetch($r))
                        {
                        	$count++;
                        ?>
                        <tr>
                        	<th scope="row"><?=$count?></th>
                            <td>
                                <strong style="padding-bottom: 5px;"><?=$row["ten"]?></strong>
                                Địa chỉ: <?=$row["diachi"]?><br/>
                                Email: <?=$row["email"]?>
                            </td>
                        	<td><?=$row["tel"]?></td>
                        	<td><?=lg_date::vn_time($row["time"])?></td>
                            <td style="font-weight: bold; font-size: 12px; color: #f00;"><?=lg_number::fix_number($row["tien"])?> <sup>đ</sup> </td>
                        	<td>
                                <?
                                if($row["status"] == '0') {
                                    echo '<a style="color: #f00; text-decoration: none;"> Đơn hàng mới (*) </a>';
                                } elseif ($row["status"] == '1') {
                                    echo '<a style="color: #0fc417; text-decoration: none;"> Đang xử lý </a>';
                                } else {
                                    echo '<a style="color: #878787; text-decoration: line-through;"> Đã xử lý </a>';
                                }
                                ?>
                            </td>
                            <td><a href="?act=donhang_edit&id=<?=$row["id"]?>">View/Edit</a></td>
                        	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                        </tr>
                        <?
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7" style="text-align: right;"><strong>Trang : </strong>
                                <?php
                                    if ($pages==0) echo ":1:";
                                    for($i=1;$i<=$pages;$i++) {
                                        if ($i==$page) echo "<b style='width:auto;'>[".$i."]</b>";
                                        else {
                                            echo "<a href='?act=donhang_list&page=$i'>-$i-</a>";
                                            //"<a href='?act=post_list&id=".$id."&post_type=".$post_type."&page=$i'>-$i-</a>";
                                        }
                                    }
                                ?></td>
                            	<td><input type="submit" value="Delete" class="btn btn-success" /></td>
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
<?}else{?>
<div>Bạn không có quyền truy cập</div>
<?}?>