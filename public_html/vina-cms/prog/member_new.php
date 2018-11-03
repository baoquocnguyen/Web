<section class="content-header">
    <h1>News User<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">News User</li>
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
    
    if ($_POST["func"]=="new")
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
	$max_file_size	=	4048000;
	$up_dir			=	'../uploads/member/';

	$OK = false;

	if ($func == "new")
	{
		// kiểm tra user tồn tại
		$r = $db->select("vn_user","username = '".$db->escape($txt_username)."'");
		if ($db->num_rows($r) != 0)
			$error = "Đã tồn tại Username này! Vui lòng thử lại tên khác.";
		// kiểm tra username
		else if (empty($txt_username))
			$error = "Vui lòng nhập Username.";
		// kiểm tra chuẩn username
		else if (kt_user_dung($txt_username))
			$error = "Username không đúng chuẩn ( Only include characters a-z and 0-9, the sign -, _)";
		// xác thực về mật khẩu
		else if (empty($txt_password))
			$error = "Vui lòng nhập Mật khẩu.";
		else if ($txt_password != $txt_password2)
			$error = "Mật khẩu không đúng.";
		// kiểm tra email
		else if (kt_email_dung($txt_email))
			$error = "Email không đúng";
        else if (empty($txt_ten))
			$error = "Vui lòng nhập Họ tên.";
		// kiểm tra tên thành viên
		// OK all
		else
		{
			$id = $db->insert("vn_user","id,username,password,ten,email,dien_thoai,dia_chi,level,trang_thai,time","0,'".$db->escape($txt_username)."','".md5($txt_password)."','".$db->escape($txt_ten)."','".$db->escape($txt_email)."','".$db->escape($txt_dien_thoai)."','".$db->escape($txt_dia_chi)."','".($txt_level+0)."','".($txt_trang_thai+0)."','".time()."'");
		
            if(!empty($media_id)){
                $db->insert("media_relationship","media_id, parent_id, parent_type, type","'".$media_id."','".$id."','page','avatar'");
            }
            admin_load("","?act=member_list");
		}
	}
	else
	{
		$txt_username	=	"";
		$txt_email		=	"";
		$txt_ten 		=	"";
		$txt_dien_thoai =	"";
		$txt_dia_chi	=	"";
		$txt_level		=	1;
		$txt_trang_thai	=	1;
		$error			=	"";
	}
	
	if (!$OK)
		template_edit("?act=member_new", "new", 0 , $txt_username , $txt_email , $txt_ten , $txt_dien_thoai , $txt_dia_chi , $txt_level , $txt_trang_thai , $txt_images , $error);
?>
                </div>
            </div>
        </div>
    </div>
</section>