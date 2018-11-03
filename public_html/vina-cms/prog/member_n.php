<?if($_SESSION["level"]==0||$_SESSION["level"]==1|get_phanquyen(17,$_SESSION["id"])==1){?>
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
    
    $txt_password = $_POST['txt_password'];
    $txt_password2 = $_POST['txt_password2'];
    $txt_email = $_POST['txt_email'];
    $txt_ten = $_POST['txt_ten'];
    $txt_dien_thoai = $_POST['txt_dien_thoai'];
    $txt_dia_chi = $_POST['txt_dia_chi'];
    $yahoo = $_POST['yahoo'];
    $facebook = $_POST['facebook'];
    $skype = $_POST['skype'];
    $txt_trang_thai = $_POST['txt_trang_thai'];
    $txt_images = $_POST['txt_images'];
    
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
    
    include "templates/memb.php";

?>
<?
	$max_file_size	=	4048000;
	$up_dir			=	'../uploads/'.date("Y").'-'.date("m").'-'.date("d").'/member/';

	$OK = false;

	if ($func == "new")
	{
		// kiểm tra user tồn tại
        $r = $db->select("vn_thanh_vien","email = '".$db->escape($txt_email)."'");
        if (kt_email_dung($txt_email))
			$error = "Email không đúng";
		elseif ($db->num_rows($r) != 0)
			$error = "Đã tồn tại email này! Vui lòng thử lại.";
		// kiểm tra username
		else if (empty($txt_dien_thoai))
			$error = "Vui lòng nhập số điện thoại.";
		// xác thực về mật khẩu
		else if (empty($txt_password))
			$error = "Vui lòng nhập Mật khẩu.";
		else if ($txt_password != $txt_password2)
			$error = "Mật khẩu không đúng.";
        else if (empty($txt_ten))
			$error = "Vui lòng nhập Họ tên.";
		// kiểm tra tên thành viên
		// OK all
		else
		{
            $OK = $db->insert("vn_thanh_vien","id,password,ten,email,dien_thoai,dia_chi,trang_thai,time,yahoo,facebook,skype,ngay","0,'".md5($txt_password)."','".$db->escape($txt_ten)."','".$db->escape($txt_email)."','".$db->escape($txt_dien_thoai)."','".$db->escape($txt_dia_chi)."','".$txt_trang_thai."','".time()."','".$yahoo."','".$facebook."','".$skype."','".date('d/m/Y',time())."'");
            if($OK)
            {admin_load("","?act=member_l");
            }else{
                $error = "Lổi";
            }
		}
	}
	else
	{
		$txt_username	=	"";
		$txt_email		=	"";
		$txt_ten 		=	"";
		$txt_dien_thoai =	"";
		$txt_dia_chi	=	"";
		$facebook	=	"";
		$yahoo	=	"";
		$skype	=	"";
		$error			=	"";
        $txt_trang_thai=1;
	}
	
	if (!$OK)
		template_edit("?act=member_n", "new", 0 , $txt_email,$txt_ten,$txt_dien_thoai,$txt_dia_chi,$yahoo,$facebook,$skype,$txt_trang_thai, $error);
?>
                </div>
            </div>
        </div>
    </div>
</section>
<?}else{echo 'Bạn không có quyền truy cập';}?>