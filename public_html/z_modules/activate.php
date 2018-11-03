<?php
session_start();
if($_SESSION['lg_email']!=''){
    unset($_SESSION['direct']);
$cod = $_POST['cod']; 
$q1 = $db->select("kichhoat_kh","cod='".$cod."'","");
if($q1){$checkcod=$db->num_rows($q1);}
$r1 = $db->fetch($q1);
$func = $_POST['func'];


if ($func=='send')
{
    if($_SESSION['token']==$_POST['token']){
         if($cod=='') {
            $thongbao = "<i class='alert alert-danger' role='alert'>".$translate['Vui lòng nhập mã COD để kích hoạt'][$lang_code]."!</i>";
        }else if ($checkcod==0) {
            $thongbao = "<i class='alert alert-danger' role='alert'>".$translate['Mã COD không hợp lệ'][$lang_code]."!</i>";
        }else if ($r1['activate']==1) {
            $thongbao = "<i class='alert alert-danger' role='alert'>".$translate['Mã COD này đã được kích hoạt'][$lang_code]."!</i>";
        }else{
    	    
            $db->query("update kichhoat_kh set activate = 1,user_id = '".$_SESSION['lg_id']."',time_kh='".time()."' where cod = '".$cod."'");
            $thongbao = '<i class="alert alert-success role="alert" style="text-align: center;">'.$translate['Kích hoạt khóa học thành công. Vào'][$lang_code].' <a href="'.$root.'/'.get_slugpage('khoahoc',$lang_code).'">'.$translate['Khóa học của tôi'][$lang_code].'.</a></i>';
            
        }
    }else{?>
        <div class="show_e"><img style="display: inline-block;margin: 0 auto;" src="<?=$domain?>/public/images/loading.gif" /></div>
        <script type="text/javascript">
            setTimeout(function () {
               window.location.href = "<?=$root?>";
            }, 600);
        </script>
    <?}
}
$token = md5(uniqid(rand(), TRUE));
$_SESSION['token'] = $token;
?>
<style type="text/css">i{display: block;} i a{color: #096eba;text-decoration: underline;}</style>
<section id="main_wrapper" class="contact">
    <div class="container">
        <div class="breadcrumbk">
            <ul>
                <li><a href="<?=$root?>"><?=$translate['Trang chủ'][$lang_code]?> <i class="fa fa-angle-right" aria-hidden="true"></i> </a></li>
                <li><span><?=$translate['Kích hoạt cod'][$lang_code]?></span></li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="nd-signup">
            <h1 class="main-title icon-khnb" style="margin-top: 0;"><?=$translate['Kích hoạt cod'][$lang_code]?></h1>
            <form class="form_activate" style="border: 1px solid #e3e3e3;text-align: center;background: #fff;" name="frmContact" action="<?=$root?>/activate/" method="post">
                <div><?=!empty($thongbao)?$thongbao:""?></div>
                <input type="hidden" name="func" value="send" />
                <input type="hidden" name="token" value="<?=$token?>" />
                <div class="dsplay">
                    <h1><?=$translate['Kích Hoạt Khóa Học Của Bạn'][$lang_code]?></h1>
                    <p class="p"><?=$translate['Nhập mã mà bạn nhận được vào bên dưới'][$lang_code]?>:</p>
                    <div class="item">
                        <span class="erro-note" id="spanemail"></span>                
                        <input required="" placeholder="VD: AY6YTZ" autocomplete="off" name="cod" type="text" class="textbox" value="<?=$email?>"/>
                    </div>
                    <div class="item item-l">
                        <button class="button" type="submit"><?=$translate['Kích hoạt'][$lang_code]?></button>
                    </div>
                    <i><?=$translate['Lưu ý: Mỗi khoá học chỉ cần kích hoạt 1 lần duy nhất. Không lặp lại bước này ở lần vào học sau'][$lang_code]?>.</i>
                </div>
            </form>
            <div class="clear"></div>
    </div>
</div>
</section>
<?php }else{?>
<section id="main_wrapper" class="contact">
    <div class="container">
        <div class="breadcrumbk">
            <ul>
                <li><a href="<?=$root?>"><?=$translate['Trang chủ'][$lang_code]?> <i class="fa fa-angle-right" aria-hidden="true"></i> </a></li>
                <li><span><?=$translate['Kích hoạt cod'][$lang_code]?></span></li>
                <div class="clear"></div>
            </ul>
        </div>
        <div>
            <div class="erro"><?=$translate['Bạn cần'][$lang_code]?> <a href="<?=$root?>/<?=get_slugpage('dangnhap',$lang_code)?>"><?=$translate['Đăng nhập'][$lang_code]?></a> <?=$translate['để thực hiện chức năng này'][$lang_code]?>!</div>
            <?php
            $_SESSION['direct']='activate/';
            ?>
        </div>
    </div>
</section>
<?php }?>