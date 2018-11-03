<?
$submit_dk = $_POST['submit_dk'];
$func = $_POST['func'];
if($submit_dk!=''||$func!=''){
$q1=$db->selectpost("post_type='lich_detail' and post_id='".$submit_dk."'","");
$r1=$db->fetch($q1);
$txtEmail = $_POST['txtEmail'];
$txtName = $_POST['txtName']; 	
$txtSubject = $_POST['txtSubject'];
$txtContent = $_POST['txtContent']; 
$txtTel = $_POST['txtTel'];
$txtAddress = $_POST['txtAddress'];
$txtCompany = $_POST['txtCompany'];
$khoa_hoc = $_POST['khoa_hoc'];
$baomat=$_POST['6_letters_code'];

?>
<?
if (!empty($func))
{
    if (empty($txtEmail)) $txtEmail = $_POST['txtEmail'];
    if (empty($txtName)) $txtName = $_POST['txtName']; 	
    if (empty($txtSubject)) $txtSubject = $_POST['txtSubject'];
    if (empty($txtContent)) $txtContent = $_POST['txtContent']; 
    if (empty($txtTel)) $txtTel = $_POST['txtTel'];
    if (empty($txtAddress)) $txtAddress = $_POST['txtAddress'];
    if (empty($txtCompany)) $txtCompany = $_POST['txtCompany'];
    if (empty($khoa_hoc)) $khoa_hoc = $_POST['khoa_hoc'];
    if (empty($func)) $func = $_POST['func'];
    if ($func=='send')
    {
        $CHECK = TRUE;
        if (!ereg("[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txtEmail)) {
            $CHECK=FALSE;
            $thongbao = "Your email incorrectly!";
        }
        else if (empty($txtName)){
            $CHECK=FALSE;
            $thongbao = "Name is not value!";
        }
        else if (empty($txtContent)){
            $CHECK=FALSE;
            $thongbao = "Content is not value!";
        }
        else if(empty($_SESSION['letters_code'] ) ||
            strcasecmp($_SESSION['letters_code'], $baomat) != 0)
        {
        //Note: the captcha code is compared case insensitively.
        //if you want case sensitive match, update the check above to
        // strcmp()
        $CHECK=FALSE;
        $thongbao = "The captcha code does not match!";
        }
        $contentemail .= "<br /> <b>THÔNG TIN  KHÁCH HÀNG:</b><br />".
            "------------------------------<br />".
            (($txtName)?"".$translate['Họ và tên'][$lang_code]." : ".$txtName."<br />":"").
            (($txtAddress)?"".$translate['Địa chỉ'][$lang_code]." : ".$txtAddress."<br />":"").
            (($txtTel)?"".$translate['Điện thoại'][$lang_code]." : ".$txtTel."<br />":"").
            (($txtEmail)?"Email : ".$txtEmail."<br />":"").
            (($khoa_hoc)?"Khóa học : ".$khoa_hoc."<br />":"").
            (($txtContent)?"".$translate['Ghi chú'][$lang_code]." : ".$txtContent."<br /><br /><br />":"").
            '<div style="color: #7e7e7e; font-size: 12px; text-align: left; font-weight: normal; line-height: 19px;" >'.$translate['Truy cập vào'][$lang_code].' <a target="_blank" href="'.$domain.'"> '.$domain.' </a> '.$translate['để biết thêm về sản phẩm - dịch vụ. Xin cảm ơn'][$lang_code].'.! <br/>Hotline: <b>  '.get_bien('GENERAL14',$lang_code).' </b>Email: <b> '.get_bien('MAIL1').' </b> <br/> '.$translate['Bạn cũng có thể đến trực tiếp theo địa chỉ'][$lang_code].': <b> '.get_bien('address_vn',$lang_code).' </b> </div>';
        // //Nội dung liên hệ về email
        if ($CHECK){
            $OK = $db->insert("lienhe","ten,email,noi_dung,phone,time,type,khoa_hoc","'".$txtName."','".$txtEmail."','".$txtContent."','".$txtTel."','".time()."','Đăng ký khóa học','".$khoa_hoc."'");
           if($OK)
           {    $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = '465';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Username = get_bien('email_transport');
                $mail->Password = get_bien('pass_transport');
                $emailFrom = get_bien("title_vn",$lang_code);
                $to = get_bien("MAIL1");
                $name = get_bien("title_vn",$lang_code);
                $mail->From = $txtEmail;
                $mail->FromName = get_bien("title_vn",$lang_code);
                $mail->AddAddress($to,$name);
                $mail->AddReplyTo($txtEmail,"Khách hàng");
                $mail->WordWrap = 50; // set word wrap
                $mail->IsHTML(true); // send as HTML
                $mail->Subject = "Đăng ký khóa học - ".$txtName;
                $mail->Body = $contentemail;
                $mail->AltBody = "Mail nay duoc gui bang PHP Mailer"; //Text Body
                //$mail->SMTPDebug = 2;
                if($mail->Send())
                {?>
                <style>
                    .andimay{display: none;}
                </style>
               <?
                    
                    $thongbao = "<i style='color:#6dd643;padding-right:10px' class='fa fa-check-circle' aria-hidden='true'></i><span style='color:#6dd643;'>".$translate['Gởi thành công. Cám ơn bạn'][$lang_code]."!</span><br/>";
               }else{
                    $thongbao = "<i style='color:yellow;padding-right:10px' class='fa fa-exclamation-triangle' aria-hidden='true'></i><span style='color:yellow;'>".$translate['Lỗi hệ thống máy chủ.<br/> Bạn vui lòng thử lại lần sau'][$lang_code].".</span>";
               }
           }
           
        }
    }
}
?>
<div id="content--content">
    <div class="container">
<div class="margin-top30 other_box">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 margintb10">
            <h1 class="content-title">Đăng ký khóa học: <span><?=$r1['ten']?></span></h1>
            <ul class="dang_ky">
                <li><label>Khai giảng: </label> <?=get_post_option($r1['post_id'],'khai_giang')?></li>
                <li><label>Địa điểm: </label> <?=get_post_option($r1['post_id'],'dia_diem')?></li>
                <li><label>Lịch học: </label> <?=get_post_option($r1['post_id'],'lich_hoc')?></li>
            </ul>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 margintb10">
        <div class="">
            <div class="box_form_lienhe">
                <?if($thongbao!=''){?><p class="alert alert-danger"><?=$thongbao?></p><?}?>
                <form action="<?=$root?>/dang-ky-khoa-hoc.html" method="post" class="form_contact andimay">
                    <input type="hidden" name="func" value="send" />
                    <input type="hidden" name="khoa_hoc" value="<?=$r1['ten']?>" />
                    <input type="hidden" name="submit_dk" value="<?=$r1['post_id']?>" />
                    <div class="row">
                    <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                	   <input required="" class="input_form" type="text" id="txtName" name="txtName" placeholder="<?=$translate['Họ và tên'][$lang_code]?>..." value="<?=$txtName?>"/>
                    </div>
                    <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                        <input required="" class="input_form" type="text" id="txtTel" name="txtTel" placeholder="<?=$translate['Điện thoại'][$lang_code]?>..." value="<?=$txtTel?>"/>
                    </div>
                    <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                	<input required="" class="input_form" type="email" id="txtEmail" name="txtEmail" placeholder="E-mail..." value="<?=$txtEmail?>"/>
                    </div>
                    <div class="width425 col-xs-12 col-sm-12 col-lg-12 col-md-12">
                	<textarea class="textarea_form" id="txtContent" rows="4" name="txtContent" placeholder="<?=$translate['Nội dung'][$lang_code]?>..."><?=$txtContent?></textarea>
                    </div>
                    </div>
                    <div style="border: 1px solid #bababa;padding: 10px;">
                    <span class="ma_captcha"><img class="img-responsive" style="float: left;margin-right:10px" src="<?=$domain?>/captcha_code_file.php?rand=<?php echo rand(); ?>" id="captchaimg" /></span>
                    <input id="captcha" placeholder="" class="input_captcha" name="6_letters_code" type="text"/><br />
                    <small style="display: inline-block;padding-top: 5px;" class="text-captcha"><?=$translate['Nhấp chuột'][$lang_code]?> <a style="color: #BC4949;" href='javascript: refreshCaptcha();'>Click</a> <?=$translate['để làm mới'][$lang_code]?></small>
                    </div>
                    <div class="clear"></div>
                	<div class="box_button">
                		<button type="submit" id="send" value="send"><?=$translate['Gửi'][$lang_code]?></button>
                	</div>
                </form>
                <div class="clear"></div>                
            </div>
        </div>
        </div>
    </div>
</div>
</div>
</div>
<?php }else{?>
<meta http-equiv="Refresh" content="0; URL=<?=$root?>" />
</head>
<?php }?>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
 var img = document.images['captchaimg'];
 img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>