<?
    $txtEmail = $_POST['txtEmail'];
    $txtName = $_POST['txtName'];   
    $txtSubject = $_POST['txtSubject'];
    $txtContent = $_POST['txtContent']; 
    $txtTel = $_POST['txtTel'];
    $txtAddress = $_POST['txtAddress'];
    $txtCompany = $_POST['txtCompany'];
    $func = $_POST['func'];
?>
<?
if (!empty($func))
{
    if ($func=='send')
    {
        $CHECK = TRUE;
        if (!ereg("[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txtEmail)) {
            $CHECK=FALSE;
            $thongbaoud = "<p class='alert alert-danger'>Email is not value!</p>";
        }
        else if (empty($txtName)){
            $CHECK=FALSE;
            $thongbaoud = "<p class='alert alert-danger'>Name is not value!</p>";
        }
        else if (empty($txtTel)){
            $CHECK=FALSE;
            $thongbaoud = "<p class='alert alert-danger'>Phone is not value!</p>";
        }
        $contentemail .= "<br /> <b>THÔNG TIN  KHÁCH HÀNG LIÊN HỆ:</b><br />".
            "------------------------------<br />".
            (($txtName)?"Họ tên : ".$txtName."<br />":"").
            (($txtAddress)?"Địa chỉ : ".$txtAddress."<br />":"").
            (($txtTel)?"Số điện thoại : ".$txtTel."<br />":"").
            (($txtEmail)?"Email : ".$txtEmail."<br />":"").
            (($txtContent)?"Ghi chú : ".$txtContent."<br /><br /><br />":"").
            '<div style="color: #7e7e7e; font-size: 12px; text-align: left; font-weight: normal; line-height: 19px;" >Truy cập vào <a target="_blank" href="'.$domain.'"> '.$domain.' </a> để biết thêm thông tin. Xin cảm ơn.! <br/>Hotline: <b>  '.get_bien("hotline").' </b>Email: <b> '.get_bien("email").' </b> <br/> Bạn cũng có thể đến trực tiếp theo địa chỉ: <b> '.get_bien("address").' </b> </div>';
        if ($CHECK){
            $OK = $db->insert("lienhe","ten,email,noi_dung,phone,dia_chi","'".$txtName."','".$txtEmail."','".$txtContent."','".$txtTel."','".$txtAddress."'");
           if($OK)
           {
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = '465';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Username = get_bien("email_transport",'none');
                $mail->Password = get_bien("pass_transport",'none');
                $to = get_bien("email",'none');
                $name = get_bien("title");
                $mail->From = $txtEmail;
                $mail->FromName = get_bien("title");
                $mail->AddAddress($to,$name);
                $mail->AddReplyTo($txtEmail,"Khách hàng");
                $mail->WordWrap = 50; // set word wrap
                $mail->IsHTML(true); // send as HTML
                $mail->Subject = "Khách hàng liên hệ - ".$txtName." - ".$txtTel;
                $mail->Body = $contentemail;
                $mail->AltBody = "Mail nay duoc gui bang PHP Mailer"; //Text Body
                //$mail->SMTPDebug = 2;
                if($mail->Send())
                {   
                ?>
                <style type="text/css">
                    .form_contact{display: none;}
                </style>
                <?
                    $thongbaoud = "<p class='alert alert-success'>".$translate['Cám ơn bạn chúng tôi sẻ liên hệ ngay'][$lang_code]."</p>";
                }
                else
                {
                    $thongbaoud = "<p class='alert alert-danger'>".$translate['Lỗi hệ thống máy chủ.<br/> Bạn vui lòng thử lại lần sau'][$lang_code].".</p>";
                }
            }
            else
            {
                $thongbaoud = "<p class='alert alert-danger'>Database not support!</p>";
            }
        }
    }
}
?>
<div class="img_top">
    <div>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHnNC04F9_o08K9ImoQivLJua1rv94IWY&callback=initMap" type="text/javascript"></script>
    <script type="text/javascript">
          var map;
        function initiadivze() {
              var myLatlng = new google.maps.LatLng(<?=get_bien('maps','none')?>);
              var myOptions = {
            zoom: 16,
            scrollwheel: false,
             center:new google.maps.LatLng(<?=get_bien('maps','none')?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP,            
             
             
        }
        map = new google.maps.Map(document.getElementById("div_id"), myOptions); 
          // Biến text chứa nội dung sẽ được hiển thị
            var text;
            text= "<b><?=get_bien('title')?></b> <br/> <?=get_bien('address')?>";
           var infowindow = new google.maps.InfoWindow(
            { content: text,
                size: new google.maps.Size(100,50),
                position: myLatlng
            });
               infowindow.open(map); 
            var marker = new google.maps.Marker({
              position: myLatlng, 
              map: map,
              title:""
          });
        }
    </script>
    <body onLoad="initiadivze()">
        <div  id="div_id" style="height: 405px; width: 100%; color: #333;padding: 2px;"></div>
    </body> 
    </div>
    <h1 class="hedding_title"><?=the_title?></h1>
</div>

<div class="other_box">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="margin-bottom: 20px;">
                
            </div>
            <div class="col-lg-7 col-md-7 col-sm-6 margintb10">
                <h2 class="content_right_title" style="margin-bottom: 15px;"><?=$translate['Liên hệ với chúng tôi'][$lang_code]?></h2>
                <style>
            ::-webkit-input-placeholder { color: #555;}
            ::-moz-placeholder {  color: #555;}
            :-ms-input-placeholder {   color: #555;}
            :-moz-placeholder {  color: #555;}
            </style>
                <div class="box_form_lienhe wow fadeInRight">
                    <div class="title_lh"><?=$translate['Vui lòng nhập đầy đủ thông tin bên dưới'][$lang_code]?>.</div>
                    <?if($thongbaoud!=''){?><?=$thongbaoud?><?}?>
                    <form style="padding-top: 10px;" name="form_dkud" action="<?=$root?>/<?=show_infopage("contact","slug","11")?>" method="post" class="form_contact">
                        <input type="hidden" name="func" value="send" />
                        <input style="margin-bottom: 20px;color: #555;width: 46%;float: left;" required="" class="input_form" type="text" id="txtName" value="<?=$txtName?>" name="txtName" placeholder="<?=$translate['Họ & tên'][$lang_code]?> *"/>
                        <input style="margin-bottom: 20px;color: #555;width: 46%;float: right;" required="" class="input_form" type="text" id="txtTel" value="<?=$txtTel?>" name="txtTel" placeholder="<?=$translate['SĐT'][$lang_code]?> *"/>
                        <div class="clear"></div>
                        <input style="margin-bottom: 20px;color: #555;width: 46%;float: left;" required="" class="input_form" type="email" id="txtEmail" value="<?=$txtEmail?>" name="txtEmail" placeholder="E-mail *"/>
                        <input style="margin-bottom: 20px;color: #555;width: 46%;float: right;" required="" class="input_form" type="text" id="txtEmail" value="<?=$txtAddress?>" name="txtAddress" placeholder="<?=$translate['Địa chỉ'][$lang_code]?> *"/>
                        
                        <textarea style="color: #555;" class="textarea_form" id="txtContent" rows="4" name="txtContent" placeholder="<?=$translate['Lời nhắn'][$lang_code]?>:"><?=$txtContent?></textarea>
                        <button style="margin-top: 20px;float: left;" class="buton2" type="submit" id="send" value="send"><?=$translate['Gửi đi'][$lang_code]?></button>
                    </form>
                    <div class="clear"></div>                
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 margintb10">
                <h2 class="content_right_title" style="margin-bottom: 15px;"><a href="<?=$root?>"><?=get_bien('title_'.$lang_code,$lang_code)?><img src="<?=$domain?>/public/images/logo.png" alt="<?=get_bien('title')?>" class="img-responsive"/></a></h2>
                <div>
                    
                    <ul class="tt_bot1">
                        <li class="home">
                            <span><i class="fa fa-home" aria-hidden="true"></i> <?php echo get_bien('address');?></span>
                        </li>
                        <li>
                        </li>
                        <li class="phone">
                            <span><i class="fa fa-phone-square" aria-hidden="true"></i> <?=get_bien('phone','none')?> - <?=get_bien('hotline','none')?></span>
                        </li>
                        <li class="mail">
                            <span><i class="fa fa-envelope" aria-hidden="true"></i> <?=get_bien('email','none')?></span>
                        </li>
                        
                        <div class="clear"></div>
                    <div id="fb-root"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) return;
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/<?php if($lang_code=='vn'){echo 'vi_VN';}else{echo 'en_US';}?>/sdk.js#xfbml=1&version=v2.9";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-follow" data-href="<?=get_bien('facebook','none')?>" data-layout="standard" data-size="small" data-show-faces="true"></div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
 var img = document.images['captchaimg'];
 img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>