<section class="content-header">
    <h1>Gallery manager<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Gallery manager</li>
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
            <?
            	$act = $_POST['act'];
                $txt_ten = $db->escape($_POST['txt_ten']);
                $txt_ten_en = $db->escape($_POST['txt_ten_en']);
                $txt_hien_thi = $_POST['txt_hien_thi'];
                $txt_noi_bat = $_POST['txt_noi_bat'];
                $txt_hinh = $_POST['txt_hinh'];
                
                $func = $_POST['func'];
               
                include "templates/catgal.php";
            	if (empty($func)) $func = $_POST['func'];
                
            ?>
            <?php
            	$max_file_size	=	4048000;
            	$up_dir			=	"../uploads/catgal/";
                
            	$OK = false;
            	
            	if ($func == "new")
            	{
            		if (empty($txt_ten))
            			$error = "Bạn chưa nhập tên mục.";
            		else
            		{
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
            			$file_full_name = time().".".$file_type;
            			if ( ($file_size > 0) && ($file_size <= $max_file_size) )
            				if ($file_type != "unk")
            						if ( @move_uploaded_file($_FILES['txt_hinh']['tmp_name'],$up_dir.$file_full_name) )
            						{
            							$OK = true;
            							$hinh = true;
            						}
            						else
            							$error = "Unable to upload images.";
            				else
            				{
            					$error = "Wrong file format - Can not upload images.";
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
            			$id = $db->insert("vn_cat","id,ten,ten_en,hien_thi,noi_bat,_gallery","0,'".$txt_ten."','".$txt_ten_en."','".$txt_hien_thi."','".$txt_noi_bat."',1");
                            //admin_load("Đã thêm vào CSDL","?act=product_manager");
                            //$OK = true;
            				if ($hinh)
            				{
            				    $txt_hinh_1	= "list_".time().".".$file_type;
                                img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=30&h=30&zc=1");    
            					$db->update("vn_cat","hinh",$file_full_name,"id = '".$id."'");
            				}
            				admin_load("Đã thêm vào CSDL","?act=gallery_manager");
            			}
            		}
            	}
            	else
            	{
            		$txt_ten		=	"";
                    $txt_ten_en		=	"";
            		$txt_hien_thi	=	1;
            		$txt_noi_bat	=	0;
            	}
            	
            	if (!$OK)
            		template_edit("?act=catgal_new","new",0,$$txt_ten,$txt_ten_en,$txt_hien_thi,$txt_noi_bat,$txt_hinh,$error);
            ?>
                </div>
            </div>
        </div>
    </div>
</section>