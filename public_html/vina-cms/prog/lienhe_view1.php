<?php
$id = $_GET['id'];
$func = $_POST['func'];
$tik = $_POST['tik'];
$r=$db->select("lienhe"," id='".$id."' ","");
$row=$db->fetch($r);
if($func=="del")
{
    $id = $_POST['id'];
	$db->delete("lienhe","id = '".$id."'");
	admin_load("","?act=lienhe_list");
	die();
}
if($func=="no_active")
{
    $id = $_POST['id'];
	$db->update("lienhe","view",'0',"id='".$id."'");	
	admin_load("","?act=lienhe_list");
	die();
}
$db->update("lienhe","view",'1',"id='".$row['id']."'");	
?>
<section class="content-header">
    <h1>Chi tiết liên hệ<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=lienhe_list">Danh sách liên hệ</a></li>
        <li class="active"> Liên hệ</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <form action="?act=lienhe_view1" method="post">
                <input type="hidden" name="id" value="<?=$id?>" />
                    <div class="detail-box">
                        <h4 class="text-center text-uppercase">Thông tin liên hệ của khách <?if($row['ten']!=''){?><span style="color:#dd4b39;"><?=$row['ten']?></span><?}?></h4>
                        <ul>
                            <?if($row['khoa_hoc']!=''){?><li><strong>Khóa học:</strong> <b style="text-transform: uppercase;"><?=$row['khoa_hoc']?></b></li><?}?>
                            <?if($row['ten']!=''){?><li><strong>Tên :</strong> <?=$row['ten']?></li><?}?>
                            <?if($row['email']!=''){?><li><strong>Email :</strong> <?=$row['email']?></li><?}?>
                            <?if($row['noi_dung']!=''){?><li><strong>Nội dung :</strong> <?=$row['noi_dung']?></li><?}?>
                            <?if($row['dia_chi']!=''){?><li><strong>Địa chỉ :</strong> <?=$row['dia_chi']?></li><?}?>
                            <?if($row['phone']!=''){?><li><strong>Điện thoại :</strong> <?=$row['phone']?></li><?}?>
                            <?if($row['company_name']!=''){?><li><strong>Công ty :</strong> <?=$row['company_name']?></li><?}?>
                        </ul>
                        <a class="btn btn-success" href="javascript:history.go(-1)">Quay về</a>
                        <button class="btn btn-group" name="func" value="no_active">Đánh dấu chưa đọc</button>
                        <button class="btn btn-danger" name="func" value="del" onclick="return confirm('Bạn có muốn xóa?')">Xóa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>