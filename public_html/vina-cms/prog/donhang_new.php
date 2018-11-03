<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
?>
<font size="2" face="Tahoma"><b>Đơn đặt hàng <img src="images/bl3.gif" border="0" /> Quản lý </b></font>
<hr size="1" color="#cadadd" />
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
    $func = $_POST['func'];
    if ($_POST["func"]=="new") $id = $_POST["id"]; else $id = $_GET['id'];
    
    include "templates/donhang.php";	
?>
<center>
<?php
	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên trang.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung.";
		else
		{
			$id = $db->insert("donhang","id,alias,ten,noi_dung,time,user,congty","0,'".$db->escape($txt_alias)."','".$db->escape($txt_ten)."','".$txt_noi_dung."','".time()."','".$thanh_vien["id"]."','".$txt_congty."'");
			admin_load("Đã thêm Trang vào CSDL","?act=donhang_list");
		}
	}
	else
	{
		$id = $_POST['id'];
		$txt_ten		= $_POST['txt_ten'];
        $txt_tel		= $_POST['txt_tel'];
        $txt_email		= $_POST['txt_email'];
        $txt_status		= $_POST['txt_status'];
        $txt_address		= $_POST['txt_address'];
		$txt_noi_dung	= $_POST['txt_noi_dung'];
        $txt_time	= $_POST['txt_time'];
        $txt_congty      = $_POST['txt_congty '];
	}
	
	if (!$OK)
		template_edit("?act=donhang_new","new",$id,$txt_ten,$txt_address,$txt_tel,$txt_email,$txt_status,$txt_noi_dung,$txt_time,$txt_congty,$txt_thanhtoan,$error)
?>
</center>
<?}else{?>
<div>Bạn không có quyền truy cập</div>
<?}?>