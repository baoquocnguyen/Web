<?php
    $id = $_POST['id'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("lienhe","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa dữ liệu thành công.","?act=lienhe_list1");
		die();
	}
?>
<section class="content-header">
    <h1>Liên hệ list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active"> Liên hệ</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Khách hàng liên hệ</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("lienhe","type=''","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form action="?act=lienhe_list1" method="post" onsubmit="return confirm('Bạn có muốn xóa ?');">
                        <input type="hidden" name="func" value="del" />
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Khóa học</th>
                                <th>Tên khách</th>
                            	<th>Email</th>
                                <th>Điện thoại</th>
                                <th>Time</th>
                                <th>-</th>
                            	<th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $q=$db->select("lienhe","type='Đăng ký khóa học'","order by id desc");
                        while ($r = $db->fetch($q))
                        {
                        ?>
                        <tr style="background-color:<?if($r['view']==1){echo 'rgba(243,243,243,.85)';}?>">
                            <td>
                                <b style="text-transform: uppercase;"><?=$r["khoa_hoc"]?></b>
                            </td>
                            <td>
                                <?=$r["ten"]?>
                            </td>
                        	<td><?=$r["email"]?></td>
                            <td><?=$r["phone"]?></td>
                            <td><?=lg_date::vn_time($r["time"])?></td>
                            <td><a onclick="setview('lienhe',<?=$r["id"]?>)" href="?act=lienhe_view1&id=<?=$r["id"]?>">Xem chi tiết</a></td>
                        	<td><input name="tik[]" type="checkbox" value="<?=$r["id"]?>" /></td>
                        </tr>
                        <?
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            	<td colspan="6"></td>
                            	<td><input type="submit" value="Xóa" class="btn btn-success" /></td>
                            </tr>
                        </tfoot>
                        </table>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>