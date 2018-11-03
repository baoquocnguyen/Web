<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
?>
<section class="content-header">
    <h1>Edit Đơn hàng<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Edit Đơn hàng</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Cập nhật</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
<?php
    $act = $_POST['act'];
    $txt_ten = $_POST['txt_ten'];
    $txt_tel = $_POST['txt_tel'];
    $txt_email = $_POST['txt_email'];
    $txt_address = $_POST['txt_address'];
    $txt_status = $_POST['txt_status'];
    $txt_time = $_POST['txt_time'];
    $txt_noi_dung = $_POST['txt_noi_dung'];
    $txt_congty = $_POST['txt_congty'];
    $txt_thanhtoan = $_POST['txt_thanhtoan'];
    $txt_ma = $_POST['txt_ma'];
    $txt_check = $_POST['txt_check'];
    
    $func = $_POST['func'];
    if ($_POST["func"]=="update"){
        $id = $_POST["id"];
    }else{
        $id = $_GET['id'];
    }
    
    include "templates/donhang.php";
?>
<?php
	//	Kiểm tra sự tồn tại của ID
    $id = $id+0;
	$r	= $db->select("donhang","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại trang này.","?act=donhang_list");

	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Tên khách hàng?.";
		else if (empty($txt_tel))
			$error = "Số điện thoại khách hàng?.";     
        else
		{
			$db->query("update donhang set ten = '".$db->escape($txt_ten)."', diachi = '".$db->escape($txt_address)."', tel = '".$txt_tel."', email = '".$txt_email."', status = '".$txt_status."', time = '".time()."',congty = '".$txt_congty."' where id = '".$id."'");
            /*
            if($txt_status==1){
                $r2	= $db->select("ma","ten = '".$txt_ma."'");
                $row2 = $db->fetch($r2);
                if($row2['so_lan_con']!=0&&($row2['so_lan_con']<$row2['so_lan_tong'])){
                    $db->update("ma","so_lan_con",$row2['so_lan_con']+1,"id = '".$row2['id']."'");   
                }
            }*/
			admin_load("Đã cập nhật thành công.","?act=donhang_list");	
		}
	}
	else
	{
		$r	= $db->select("donhang","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten		= $row["ten"];
            $txt_address	= $row["diachi"];
            $txt_tel		= $row["tel"];
            $txt_email		= $row["email"];
			$txt_status	    = $row["status"];
            $txt_noi_dung	= $row["noi_dung"];
            $txt_yeu_cau	= $row["yeu_cau"];
            $txt_time	    = $row["time"];
            $txt_congty      = $row["congty"];
            $txt_thanhtoan      = $row["thanh_toan"];
            $txt_ma      = $row["ma"];
		}
	}
	
	if (!$OK)
		template_edit("?act=donhang_edit","update",$_GET['id'],$txt_ten,$txt_address,$txt_tel,$txt_email,$txt_status,$txt_yeu_cau,$txt_noi_dung,$txt_time,$txt_congty,$txt_thanhtoan,$txt_ma,$error);
?>
                </div>
            </div>
        </div>
    </div>
</section>
<?}else{?>
<div>Bạn không có quyền truy cập</div>
<?}?>