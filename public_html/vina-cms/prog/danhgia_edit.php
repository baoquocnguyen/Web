
<?php
    $act = $_POST['act'];
    $txt_ten = addslashes($_POST['txt_ten']);
    $txt_hoten = addslashes($_POST['txt_hoten']);
    $txt_noi_dung = ($_POST['txt_noi_dung']);
    $txt_traloi = ($_POST['txt_traloi']);
    $sanpham = $_POST['sanpham'];
    $txt_kiemduyet = $_POST['txt_kiemduyet'];
    $txt_email = $_POST['txt_email'];
    $txt_hien_thi = $_POST['txt_hien_thi'];
    $danhgia=$_POST['danhgia'];
    $txt_date = $_POST['txt_date'];
    $func = $_POST['func'];
    if ($_POST["func"]=="update") $id = $_POST["id"]; else $id = $_GET['id'];
    include "templates/danhgia.php";
    
?>
<section class="content-header">
    <h1>Gallery list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=danhgia_list">Danh sách đánh giá</a></li>
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
				<center>
				<?php
					//	Ki?m tra s? t?n t?i c?a ID
					$id = $id + 0;
					$r	= $db->select("vn_danhgia","id = '".$id."'");
					if ($db->num_rows($r) == 0)
						admin_load("This article does not exist.","?act=danhgia_list");
					
					$max_file_size	=	6048000;
					$up_dir			=	"../uploads/cms/";

					$OK = false;

					if ($func == "update")
					{
					
							
							
								$db->query("update vn_danhgia set cat = '".$sanpham."', ten = '".$txt_ten."', noi_dung = '".$txt_noi_dung."',traloi = '".$txt_traloi."', hien_thi = '".($txt_hien_thi+0)."',email  = '".$txt_email."',danhgia  = '".$danhgia."',kiem_duyet = '".($txt_kiemduyet+0)."' where id = '".$id."'");
							
								admin_load("Has been successfully updated.","?act=danhgia_list");
										
					
					}
					else
					{
						$r	= $db->select("vn_danhgia","id = '".$id."'");
						while ($row = $db->fetch($r))
						{
							$sanpham		= $row["cat"];
							$danhgia=$row['danhgia'];
							$txt_ten		= $row["ten"];
							$txt_noi_dung	= $row["noi_dung"];
				            $txt_traloi     = $row["traloi"];
							$txt_email	= $row["email"];
							$txt_hien_thi	= $row["hien_thi"];
				            $txt_kiemduyet=$row["kiem_duyet"];
							$txt_date		= lg_date::vn_other($row["time"],"d/m/Y");
						}
					}
					
					if (!$OK)        
						template_edit("?act=danhgia_edit","update",$id,$txt_ten,$txt_noi_dung,$txt_traloi,$txt_hien_thi,$txt_date,$txt_email,$txt_kiemduyet,$sanpham,$danhgia,$error);
				?>
				</center>
			</div>
            </div>
        </div>
    </div>
</section>