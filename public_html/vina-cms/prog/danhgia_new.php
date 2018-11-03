
<?php
    $act = $_POST['act'];
    $txt_ten = addslashes($_POST['txt_ten']);
    $txt_noi_dung = ($_POST['txt_noi_dung']);
    $txt_traloi = ($_POST['txt_traloi']);
    $sanpham = $_POST['sanpham'];
    $txt_kiemduyet = $_POST['txt_kiemduyet'];
    $txt_email = $_POST['txt_email'];
    $txt_hien_thi = $_POST['txt_hien_thi'];
    $txt_date = $_POST['txt_date'];
    $danhgia = $_POST['danhgia'];

    $func = $_POST['func'];
    if ($_POST["func"]=="new") 
    {
        
    $id = $_POST["id"];
    $sanpham = $_POST['sanpham']; 
    }
    else 
    {
    $id = $_GET['id'];
    $sanpham = $_GET['sanpham'];
    } 
 
        include "templates/danhgia.php";
    
   
?>
<section class="content-header">
    <h1>Đánh giá<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=gallery_manager&post_type=catgal">Đánh giá</a></li>
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
                <center>
                <?php

                	$OK = false;
                	
                	if ($func == "new")
                	{
                		$time = time($txt_date);
                		$id = $db->insert("vn_danhgia","ten,cat,noi_dung,traloi,hien_thi,time,email,kiem_duyet,danhgia","'".$txt_ten."','".$sanpham."','".$txt_noi_dung."','".$txt_traloi."','".($txt_hien_thi+0)."','".$time."','".$txt_email."','".($txt_kiemduyet+0)."','".$danhgia."'");	
                		admin_load("Articles added to the database","?act=danhgia_list");
                	}
                	else
                	{
                        $sanpham        = 0;
                        $danhgia        = 5;
                        $txt_ten		= '';
                		$txt_noi_dung	= '';
                        $txt_traloi     = '';
                		$txt_email	= '';
                        $txt_hien_thi	= 1;
                        $txt_kiemduyet = 1;
                		$txt_date	= lg_date::vn_other(time(),"d/m/Y");
                	}
                	
                	if (!$OK)
                		template_edit("?act=danhgia_new", "new", 0 ,$txt_ten,$txt_noi_dung,$txt_traloi,$txt_hien_thi,$txt_date,$txt_email,$txt_kiemduyet,$sanpham,$danhgia,$error)
                ?>
                </center>
                </div>
            </div>
        </div>
    </div>
</section>