<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
?>
<section class="content-header">
    <h1>Edit Mã<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Edit Mã</li>
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
    $txt_loaima = $_POST['txt_loaima'];
    $txt_chietkhau = $_POST['txt_chietkhau'];
    $txt_solantong = $_POST['txt_solantong'];
    $txt_solancon = $_POST['txt_solancon'];
    $txt_thoigian = $_POST['txt_thoigian'];
    $func = $_POST['func'];
    if ($_POST["func"]=="update") $id = $_POST["id"]; else $id = $_GET['id'];
    include "templates/ma.php";
    
?>
<?php
	//	Kiểm tra tồn tại của id
	$id = $id + 0;
	$OK = false;
	if ($func == "update")
	{
	   $db->query("update ma set ten = '".$txt_ten."', loai_ma = '".$txt_loaima."', chiet_khau = '".$txt_chietkhau."', so_lan_tong = '".$txt_solantong."', so_lan_con = '".$txt_solancon."', thoi_gian = '".strtotime(str_replace('/', '-', $txt_thoigian."/00/00/00"))."' where id = '".$id."'");
	   admin_load("Cập nhật thành công !","?act=ma_list");
	}
	else
	{
		$r	= $db->select("ma","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten		= $row["ten"];
			$txt_loaima	= $row["loai_ma"];
			$txt_chietkhau	= $row["chiet_khau"];
			$txt_solantong	= $row["so_lan_tong"];
			$txt_solancon	= $row["so_lan_con"];
			$txt_thoigian	= $row["thoi_gian"];
		}
	}
	if (!$OK)        
		template_edit("?act=ma_edit","update",$id,$txt_ten,$txt_loaima,$txt_chietkhau,$txt_solantong,$txt_solancon,$txt_thoigian,$error);
?>
<?}else{?>
<div>Bạn không có quyền truy cập !</div>
<?}?>
                </div>
            </div>
        </div>
    </div>
</section>