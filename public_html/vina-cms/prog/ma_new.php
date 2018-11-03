
<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
?>
<section class="content-header">
    <h1>News Mã<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">News Mã</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm mới</h3>
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
    if ($_POST["func"]=="new") 
    {
    $id = $_POST["id"];
    }
    else 
    {
    $id = $_GET['id'];
    }
    include "templates/ma.php";
?>
<?php
	$OK = false;
	if ($func == "new")
	{			
        $db->insert("ma","ten,loai_ma,chiet_khau,so_lan_tong,so_lan_con,thoi_gian","'".$txt_ten."','".$txt_loaima."','".$txt_chietkhau."','".$txt_solantong."','".$txt_solantong."','".strtotime(str_replace('/', '-', $txt_thoigian."/00/00/00"))."'");
        admin_load("Cập nhật thành công","?act=ma_list");
	}
	else
	{
        global $rand;
        for($i=0;$i<100;$i++){
            $rand = passGen(8,4);
            $qrand=$db->select("ma","ten='".$rand."'","");
            if($db->num_rows($qrand)==0){
                $txt_ten		= $rand;
                break;
            }
        }
        $txt_loaima		= 0;
        $txt_chietkhau		= '';
        $txt_solantong		= '';
        $txt_solancon		= '';
        $txt_thoigian		= '';    
	}
	if (!$OK)
        template_edit("?act=ma_new", "new", 0 ,$txt_ten,$txt_loaima,$txt_chietkhau,$txt_solantong,$txt_solancon,$txt_thoigian,$error)
?>
</center>
<?}else{?>
<div>Bạn không có quyền truy cập</div>
<?}?>
                </div>
            </div>
        </div>
    </div>
</section>