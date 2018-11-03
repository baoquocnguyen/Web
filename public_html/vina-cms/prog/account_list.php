<?php

    $id = $_POST['id'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("tv_gianhang","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa dữ liệu thành công.","?act=account_list");
		die();
	}
?>
<section class="content-header">
    <h1>Thành viên<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Thành viên</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Thành viên</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("tv_gianhang"," ","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                    <form action="?act=account_list" method="post" onsubmit="return confirm('Bạn có muốn xóa ?');">
                    <input type="hidden" name="func" value="del" />
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                        	<th>Họ và Tên</th>
                        	<th>Email</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đăng ký</th>
                        	<th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $page		=	$page + 0;
                    $perpage	=	20;
                    $r_all		=	$db->select("tv_gianhang","trang_thai=1");
                    $sum		=	$db->num_rows($r_all);
                    $pages		=	($sum-($sum%$perpage))/$perpage;
                    if ($sum % $perpage <> 0 )	$pages = $pages+1;
                    $page		=	($page==0)?1:(($page>$pages)?$pages:$page);
                    $min 		= 	abs($page-1) * $perpage;
                    $max 		= 	$perpage;
                    
                    $dem	=	$min;
                    
                    $q	=$db->select("tv_gianhang","kiem_duyet=1","order by id desc limit $min, $max");
                    while ($r = $db->fetch($q))
                    {
                        $dem++;
                    ?>
                    <tr>
                        <th scope="row"><?=$dem?></th>
                    	<td style="font-weight: bold;"><?=$r["ten"]?></td>
                    	<td><?=$r["email"]?></td>
                        <td><?=$r["dien_thoai"]?></td>
                    	<td><?=$r["dia_chi"]?></td>
                    	<td><?=lg_date::vn_time($r["time"])?></td>
                    	<td><input name="tik[]" type="checkbox" value="<?=$r["id"]?>" /></td>
                    </tr>
                    <?
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                        	<td colspan="6">
                        		<strong>Trang : </strong>
                        		<?php
                        			if ($pages==0) echo ":1:";
                            		for($i=1;$i<=$pages;$i++) {
                            			if ($i==$page) echo "<b>[".$i."]</b>";
                            			else {
                        					echo "<a href='?act=account_list&page=$i'>-$i-</a>";
                        				}
                        			}
                            	?>
                        	</td>
                            <td colspan="1"><input type="submit" value="Xóa" class="btn btn-success" /></td>
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