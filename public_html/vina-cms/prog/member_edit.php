<section class="content-header">
    <h1>Edit User<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Edit User</li>
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
<?
    $act = $_POST['act'];
    $txt_cat = $_POST['txt_cat'];
    $func = $_POST['func'];
    
    $txt_username = $_POST['txt_username'];
    $txt_password = $_POST['txt_password'];
    $txt_password2 = $_POST['txt_password2'];
    $txt_email = $_POST['txt_email'];
    $txt_ten = $_POST['txt_ten'];
    $txt_dien_thoai = $_POST['txt_dien_thoai'];
    $txt_dia_chi = $_POST['txt_dia_chi'];
    $txt_level = $_POST['txt_level'];
    $txt_trang_thai = $_POST['txt_trang_thai'];
    $txt_images = $_POST['txt_images'];
    $media_id  =   $_POST['media_id'];
    
    if ($_POST["func"]=="update")
    {
    $id = $_POST["id"];
    $txt_cat = $_POST['txt_cat'];
    }
    else
    {
    $id = $_GET['id'];
    $txt_cat = $_GET['txt_cat'];
    }
    
	include "templates/member.php";
?>
<?
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	=	$db->select("vn_user","id = '".$id."'");
	if ($db->num_rows($r) == 0)
	{
		Admin_Load("Tài khoản này không tồn tại.","?act=member_list");
		$OK = true;
	}

	$max_file_size	=	4048000;
	$up_dir			=	'../uploads/member/';
    
	$OK = false;

	if ($func == "update")
	{
		//xác thực về mật khẩu
		if (empty($txt_password))
		{
			//kiểm tra email
			if (kt_email_dung($txt_email))
				$error = "Email sai";
			//kiểm tra tên thành viên
			else if (empty($txt_ten))
				$error = "Vui lòng nhập họ tên";
			//OK all
			else
			{
			    $db->query("update vn_user set ten = '".$db->escape($txt_ten)."', email = '".$db->escape($txt_email)."', dien_thoai = '".$db->escape($txt_dien_thoai)."', dia_chi = '".$db->escape($txt_dia_chi)."', level = '".($txt_level+0)."', trang_thai = '".($txt_trang_thai+0)."' where id = '".$id."'"); 
				
            	// Update into table media_relationship 
                if(!empty($media_id)){             // check isset id value of input media_id
                    $demn=0;
                    $qmr = $db->query("SELECT id FROM media_relationship WHERE parent_id = '".$id."' and parent_type='member' and type='avatar'");
                    if($qmr){$demn=$db->num_rows($qmr);}
                    if($demn > 0){    // isset before, update
                        $rmr = $db->fetch($qmr);
                        $db->update("media_relationship","media_id",$media_id,"id = '".$rmr['id']."'" );
                    }else{                          // not isset before, insert
                        $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','member','avatar'");
                    }
                }
			    admin_load("","?act=member_list");
			}
		}
		else
		{
			if ($txt_password != $txt_password2)
				$error = "Mật khẩu không khớp.";
			else
			{
				$db->query("update vn_user set password = '".md5($txt_password)."' where id = '".$id."'");
				$OK = true;
				admin_load("Thông tin đã được chỉnh sửa.","?act=member_list");
			}
		}
	}
	else
	{
		$r	=	$db->select("vn_user","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_username	=	$row["username"];
			$txt_email		=	$row["email"];
			$txt_ten 		=	$row["ten"];
			$txt_dien_thoai =	$row["dien_thoai"];
			$txt_dia_chi	=	$row["dia_chi"];
			$txt_level		=	$row["level"];
			$txt_trang_thai	=	$row["trang_thai"];
		}
		$error			=	"";
	}
	
	if (!$OK)
		template_edit("?act=member_edit", "update", $id , $txt_username , $txt_email , $txt_ten , $txt_dien_thoai , $txt_dia_chi , $txt_level , $txt_trang_thai , $txt_images , $error);
?>
                </div>
            </div>
        </div>
    </div>
</section>