<?php
    $act            = $_POST['act'];
    $txt_tieude     = $_POST['txt_tieude'];
    $txt_hinh       = $_POST['txt_hinh'];
    $txt_yahoo      = $_POST['txt_yahoo'];
    $txt_skype      = $_POST['txt_skype'];
    $txt_facebook   = $_POST['txt_facebook'];
    $txt_tel        = $_POST['txt_tel'];
    $txt_email      = $_POST['txt_email'];
    $txt_hien_thi   = $_POST['txt_hien_thi'];
    $func           = $_POST['func'];
    if ($_POST["func"]=="new") $id = $_POST["id"]; else $id = $_GET['id'];   
    include "templates/support.php";	
?>
<section class="content-header">
    <h1>Support list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Thêm mới</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Support list</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
            <?php
                $max_file_size	=	2048000;
            	$up_dir			=	"../uploads/support/";
            
            	$OK = false;
            
                if ($func == "new")
                {
                    if (empty($txt_tieude))
            			$error = "Vui lòng nhập tên.";
            		else{
            			// kiểm tra file uploads.
            			$file_type = $_FILES['txt_hinh']['type'];
            			$file_name = $_FILES['txt_hinh']['name'];
            			$file_size = $_FILES['txt_hinh']['size'];
            			switch ($file_type)
            			{
            				case "image/pjpeg"	: $file_type = "jpg"; break;
            				case "image/jpeg"	: $file_type = "jpg"; break;
            				case "image/gif" 	: $file_type = "gif"; break;
            				case "image/x-png" 	: $file_type = "png"; break;
            				case "image/png" 	: $file_type = "png"; break;
            				default : $file_type = "unk"; break;
            			}
            			$file_full_name = "tmp_".time().".".$file_type;
            			if ( ($file_size > 0) && ($file_size <= $max_file_size) )
            				if ($file_type != "unk")
            						if ( @move_uploaded_file($_FILES['txt_hinh']['tmp_name'],$up_dir.$file_full_name) )
            						{
            							$OK = true;
            							$hinh = true;
            						}
            						else
            							$error = "Không thể upload hình ảnh.";
            				else
            				{
            					$error = "Sai định dạng file - Không thể upload hình ảnh.";
            				}
            			else
            			{
            				if ($file_size == 0)
            				{
            					$OK		= true;
            					$hinh	= false;
            				}
            				else
            					$error = "Hình của bạn chọn vượt quá kích thước cho phép.";
            			}
            			// Process xong
            			if ($OK)
            			{
            			$id = $db->insert("vn_support","id,tieude,yahoo,skype,facebook,tel,email,hien_thi,time,user","0,'".$db->escape($txt_tieude)."','".$db->escape($txt_yahoo)."','".$db->escape($txt_skype)."','".$db->escape($txt_facebook)."','".$db->escape($txt_tel)."','".$txt_email."','".($txt_hien_thi+0)."','".time()."','".$thanh_vien["id"]."'");
                        	if ($hinh)
            				{
                                $txt_hinh_1	= $id."-".lg_string::get_link($txt_tieude).'.'.$file_type;
                                img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=200&h=200&zc=1");
                                $db->query("update vn_support set hinh = '".$txt_hinh_1."' where id = '".$id."'");
            				}
            				admin_load("Đã thêm Trang vào CSDL","?act=support_list");
            			}
                    }
            	}
            	else
            	{
            		$id = $_POST['id'];
            		$txt_tieude		= $_POST['txt_tieude'];
            		$txt_yahoo		= $_POST['txt_yahoo'];
                    $txt_yahoo		= $_POST['txt_skype'];
                    $txt_facebook   = $_POST['txt_facebook'];
                    $txt_yahoo		= $_POST['txt_tel'];
            		$txt_email	    = $_POST['txt_email'];
                    $txt_hien_thi   = 1;
            	}
            	if (!$OK)
                template_edit("?act=support_new","new",$id,$txt_tieude,$txt_hinh,$txt_yahoo,$txt_skype,$txt_facebook,$txt_tel,$txt_email,$txt_hien_thi,$error)
                ?>
                </div>
            </div>
        </div>
    </div>
</section>