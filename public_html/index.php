<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_STRICT ^ E_PARSE ^ E_ERROR);
ob_start();
include "_CORE/index.php";
include("app/config/config.php");
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
$THANHVIEN["id"] = 0;
include("app/start/dem_online.php");
include("app/config/route.php");

if($post_type=='404'){
   //header('location: /404.html');
}else{
include("app/start/func.php");
include "app/packages/mail/class.phpmailer.php"; 
include "app/packages/mail/class.smtp.php";
include "app/packages/shopping-cart/cart_item.class.php"; 
include "app/packages/shopping-cart/shopping_cart.class.php";
?>
<!DOCTYPE html>
<html lang="vi-vn">
<head>
<?php include "z_includes/_html_head.php"; ?>
<?php include "app/lang/translate.php"; ?>
</head>
<body>
<div id="fullpage">
	<div class="visible-xs"><? include 'z_includes/menuresponsive.php';?></div>
  <section id="section1">
    <div class="container">
      <div class="logo">
        <?if($post_type==''|$post_type=='home'){?>
        <h1 style="font-size: 0;"><a class="logo-img" href="<?=$root?>"><?=get_bien('title_'.$lang_code,$lang_code)?><img src="<?=$domain?>/public/images/logo.png" alt="<?=get_bien('title')?>" class="img-responsive"/></a></h1>
        <?}else{?>
        <h6 style="font-size: 0;"><a class="logo-img" href="<?=$root?>"><?=get_bien('title_'.$lang_code,$lang_code)?><img src="<?=$domain?>/public/images/logo.png" alt="<?=get_bien('title')?>" class="img-responsive"/></a></h6>
        <?}?>
      </div>
      <div class="menu_top">
        <?php
          $cart  = ShoppingCart::getInstance();
          $total = $cart->getTotal();
          $_SESSION["total"] = $cart->getTotal();
          $so_luong = $cart->countItems();
          $_SESSION["so_luong7"] = $cart->countItems();
        ?>
        <div class="info_top">
          <span class="lang"><a href="<?=$domain?>">VN</a> | <a href="<?=$domainen?>">EN</a></span>
          <a class="cart" href="<?=$root?>/<?=show_infopage("cart","slug","15")?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <em><?=$translate['Giỏ hàng'][$lang_code]?></em> <i id="count-cart"><?=($_SESSION["so_luong7"])?$_SESSION["so_luong7"]:'0';?></i></a>
        </div>
        <ul class="hidden-xs">
          <li><a <?php if($post_type==''){echo 'class="active"';}?> href="<?=$root?>"><?=$translate['Trang chủ'][$lang_code]?></a></li>
          <!--<li><a <?php if($post_type=='about_us'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("about_us","slug","4")?>"><?=show_infopage("about_us","ten","4")?></a>

          </li>-->
          <?php
          $qtc1=$db->selectpostcat("postcat_id=1 and lang_id='".$lang_code."'","");
          $rtc1=$db->fetch($qtc1);
          ?>
          <li>
            <a <?php if($post_type=='catproduct'){echo 'class="active"';}?> href="javascript:;return false;"><?=show_infopage("sp","ten","14")?></a>
            <ul>
              <?php
              $q=$db->selectpostcat('hien_thi=1 and post_type="catproduct" and cat=0 and lang_id="'.$lang_code.'"','order by thu_tu');
              while ($r=$db->fetch($q)) {
                ?>
              <li><a href="<?=$root?>/<?=get_slug_postcat($r['postcat_id'])?>/"><?=$r['name']?></a>
                <?php

                $q1=$db->selectpostcat('hien_thi=1 and post_type="catproduct" and cat="'.$r['postcat_id'].'" and lang_id="'.$lang_code.'"','order by thu_tu');
                if($db->num_rows($q1)!=''){
                ?>
                <ul>
                <?php
                
                while ($r1=$db->fetch($q1)) {?>
                  <li><a href="<?=$root?>/<?=get_slug_postcat($r1['postcat_id'])?>/"><?=$r1['name']?></a>
                <?php }?>
                </ul>
                <?php }?>
              </li>
              <?php }?>
            </ul>
          </li>

          <li><a <?php if($post_type=='post'){echo 'class="active"';}?> href="<?=$root?>/<?=get_slug(8)?>/"><?=get_name(8)?></a>
            <!-- <ul>
              <li><a href="<?=$root?>/<?=show_infopage("contact","slug","11")?>"><?=$translate['Đăng ký trở thành đại lý'][$lang_code]?></a></li>
            </ul> -->
          </li>
          <li><a <?php if($post_type=='chinh_sach'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("chinh_sach","slug","20")?>"><?=show_infopage("chinh_sach","ten","20")?></a></li>
          <!-- <li><a <?php if($post_type=='bao_hanh'){echo 'class="active"';}?> href="javascript:;return false;"><?=get_name(30)?></a>
            <ul>
              <?php
              $q=$db->selectpost('hien_thi=1 and cat="30" and lang_id="'.$lang_code.'"','order by thu_tu');
              while ($r=$db->fetch($q)) {?>
              <li><a href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></li>
              <?php }?>
            </ul>
          </li> -->
          <!-- <li><a <?php if($post_type=='cs_dl'){echo 'class="active"';}?> href="javascript:;return false;">Trở thành nhà đại lý</a>
            <ul>
              <li><a href="javascript:;return false;"><?=get_name(31)?></a>
                <ul>
                <?php
                $q=$db->selectpost('hien_thi=1 and cat="31" and lang_id="'.$lang_code.'"','order by thu_tu');
                while ($r=$db->fetch($q)) {?>
                <li><a href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></li>
                <?php }?>
              </ul>
              </li>
              
            </ul>
          </li> -->
          <li><a <?php if($post_type=='thanh_toan'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("thanh_toan","slug","10")?>"><?=show_infopage("thanh_toan","ten","10")?></a></li>
          <li><a <?php if($post_type=='contact'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("contact","slug","11")?>"><?=show_infopage("contact","ten","11")?></a></li>
        </ul>
      </div>
    </div>
  </section>
  <?php if($slugnew==''){?>
  <section id="section3">
    <div id="slide-home" style="position: relative;">
      <div class="slider-wrapper theme-default">
          <div id="slider" class="nivoSlider">
            <?
            $count=0;
            $q=$db->selectmedia("hien_thi=1 and parent_id=1 and parent_type='gallery'","order by thu_tu");
            while($r=$db->fetch($q)){$count++;
            ?>
            <a href="<?=$r['url']?>"><img src="<?=$domain?>/uploads/<?=$r['dir_folder']?>/<?=$r['file_name']?>" alt="" title="#caption<?=$count?>" />
            </a>
            <?}?>
          </div> 
          <!-- <?
          $count1=0;
          $q=$db->selectmedia("hien_thi=1 and parent_id=1 and parent_type='gallery'","order by thu_tu");
          while($r=$db->fetch($q)){$count1++;
          ?>
          <div id="caption<?=$count1?>" class="nivo-html-caption">
            <div class="box-captionnv">
              <p href="" class="p1-caption animated <?if($count1%2=='0'){echo 'fadeInLeft';}else{echo 'fadeInRight';}?>"><a href="<?=$r['url']?>"><?=$r['title']?></a></p>
              <p  class="p2-caption animated <?if($count1%2=='0'){echo 'fadeInLeft';}else{echo 'fadeInRight';}?>"><?=$r['note']?></p>
              <a class="a-caption animated hidden-600 <?if($count1%2=='0'){echo 'fadeInRight';}else{echo 'fadeInLeft';}?>" href="<?=$r['url']?>"><?=$translate['Chi tiết'][$lang_code]?></a>
            </div>
          </div>
          <?}?> -->
      </div>
  </div>
</section>
<?php }?>
  <section id="content_wrapper">
  <?
  if($callpage!=''){
    include "z_modules/".$callpage.".php";
  }else{
    if($slugnew=='')   
      {
          include "z_modules/home.php";
      }
      else
      {
          include "z_modules/".$post_type.".php";
      }
  }
  ?>
  </section>
  <section id="copyright_wrapper">
    <div class="container">
        <div class="footer__top">
          <div class="row">
          <div class="col-lg-3 col-md-3 item-box info-bot">
            <a class="logo-bot" href="<?=$root?>"><img src="<?=$domain?>/public/images/logo.png"></a>
            <ul>
              <li><i class="fa fa-map-marker" aria-hidden="true"></i> <?=get_bien('address')?></li>
              <li><i class="fa fa-phone" aria-hidden="true"></i> <?=get_bien('phone','none')?> - <?=get_bien('hotline','none')?></li>
              <li><i class="fa fa-envelope" aria-hidden="true"></i> <?=get_bien('email','none')?></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-3 item-box categories_bot hidden-xs">
            <div class="footer--title"><?=$translate['Danh mục sản phẩm'][$lang_code]?></div>
            <ul>
              <?php
              $q=$db->selectpostcat("cat=0 and post_type='catproduct' and hien_thi=1 and lang_id='".$lang_code."'","order by thu_tu");
              while($r=$db->fetch($q)){
              ?>
              <li><a href="<?=$root?>/<?=get_slug_postcat($r['postcat_id'])?>"><?=$r['name']?></a></li>
              <?php }?>
            </ul>
          </div>
          <?php
          $qtc2=$db->selectpage("alias='phuong_thuc' and lang_id='".$lang_code."'","");
          $rtc2=$db->fetch($qtc2);
          ?>
          <div class="col-lg-3 col-md-3 item-box">
            <div class="footer--title"><?=$rtc2['ten']?></div>
            <div><?=$rtc2['noi_dung']?></div>
          </div>
          <div class="col-lg-3 col-md-3 item-box">
            <div class="footer--title"><?=$translate['Đăng ký nhận khuyến mãi'][$lang_code]?></div>
            <script>
            function CheckForm1 ()
            {
                email=document.formdk.txt_mail.value;
                if (!email.match(/^([-\d\w][-.\d\w]*)?[-\d\w]@([-\w\d]+\.)+[a-zA-Z]{2,6}$/)){
                    alert('Email is not value.');
                    document.formdk.txt_mail.focus();
                    return false;
                }else{
                    alert('Success. Thank you!');
                }
                return true;
            }
            </script>
            <?
              $txt_mail = '';
              $func = '';
                $txt_mail=$_POST['txt_mail'];
                $func=$_POST['func'];
                if($func=='')
                {
                    $thongbao1 = "";
                }
                 if ($func=='sendmail')
                    {
                        $db->insert("lienhe","ten,time,type","'".$txt_mail."','".time()."','đăng ký'"); 
                    }
            ?>
            <form name="formdk" class="form3" method="post" onsubmit="return CheckForm1();" >
                <input type="hidden" value="sendmail" name="func" />
                <input required="" class="sea1" name="txt_mail" type="text" id="email" placeholder="<?=$translate['Đăng ký nhận email'][$lang_code]?>..."  />

                <button class="bt1" type="submit"><img src="<?=$domain?>/public/images/icon-s.png" alt=""/></button>

                <div class="clear"></div>

            </form>
            <div class="footer--title" style="padding-bottom: 15px;">Follow us</div>
            <span class="social"><?=show_social()?></span>
          </div>
          </div>
        </div>
        <div class="footer__bot">
          <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 col-479"><?=get_bien("meta_copyright")?></div>
          <div class="col-md-6 col-sm-6 col-xs-12 col-479 vina">Developed by Vina<a target="_blank" href="http://vinadesigndanang.vn/"> Design</a></span></div>
          </div>
        </div>
    </div>
  </section>
</div>
<?php 
   $qtc10=$db->selectpage("alias='qc' and lang_id='".$lang_code."' and option1=1","");
   
 if($slugnew==''&&$db->num_rows($qtc10)!=0){
?>
<div id="popup_qc" style="display: none;">
  <?php
   
    $rtc10=$db->fetch($qtc10);
    ?>
  <a href="<?=$rtc10['chu_thich']?>"><?=get_single_image($rtc10['page_id'],"info","avatar")?></a>
</div>
<?php }?>
<div id="socialList" class="content hidden-xs">
<ul class="socialList">
  <?=show_social1()?>
  <!-- <li><a class="hvr-pop" href="" target="_blank"><i class="fa fa-facebook">&nbsp;</i></a></li>
  <li><a class="hvr-pop" href="" target="_blank"><i class="fa fa-google-plus">&nbsp;</i></a></li>
  <li><a class="hvr-pop" href="" target="_blank"><i class="fa fa-youtube">&nbsp;</i></a></li>
  <li><a class="hvr-pop" href="" target="_blank"><i class="fa fa-twitter">&nbsp;</i></a></li> --><!-- 
    <li><a class="hvr-pop" href="/feeds/"><i class="fa fa-rss">&nbsp;</i></a></li> -->
</ul>
</div>
<div id="support" class="hotline-ef">
    <div class="hovicon effect-8">
        <a href="tel:<?=get_bien('hotline','none')?>"><i class="fa fa-phone" aria-hidden="true"></i></a>
    </div>
</div>
</body>
<?include "z_includes/_html_footer.php";?>
</html>
<?php }?>