<? $level_arr = array("Coder","Administrator","Moderator","Member"); ?>
<?
$label_lang = array
 (
 array("Tên","name","1111"),
 array("Hình","images","2222"),
 array("Hiển thị","Display","3333")
 );
?>
<div class="body-wrapper">
    <header class="main-header">
        <a href="?act=home" class="logo">
            <img src="<?=$domain?>/<?=admin_url?>/images/logo.png" class="img-responsive" style="margin: 0 auto;"/>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" id="toggle-menu">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </nav>
        <a class="click-home" href="<?=$domain?>" target="_blank">Go Homepage</a>
    </header>
    <div class="wrapper-block-left toggle-blmenu">
        <div class="left-menu">
            <div class="user-panel">
                <div class="pull-left image img-circle" style="overflow:hidden;">
                    <?php echo get_image_user($_SESSION["id"],"member","avatar",false)?> 
                </div>
                <div class="pull-left info">
                    <p><?=$_SESSION["username"]?></p>
                    <a>Level: <?=$level_arr[$_SESSION["level"]]?></a>
                </div>
                <div class="clear"></div>   
            </div>
            <br />
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header"><i class="fa fa-tachometer" aria-hidden="true"></i><span>MAIN NAVIGATION</span></li>
                    <li class="<?=($post_type=='post'||$post_type=='post_detail')?'active':''?>">
                        <a href="?act=postcat_list&post_type=post">
                            <i class="fa fa-book"></i>
                            <span>Danh sách cửa hàng</span>
                        </a>
                    </li>
                    <li class="<?=($post_type=='news'||$post_type=='news_detail')?'active':''?>">
                        <a href="?act=postcat_list&post_type=news">
                            <i class="fa fa-book"></i>
                            <span>Tuyển dụng</span>
                        </a>
                    </li>
                    <li class="<?=($post_type=='catproduct'||$post_type=='catproduct_detail')?'active':''?>">
                        <a href="?act=postcat_list&post_type=catproduct">
                            <i class="fa fa-book"></i>
                            <span>Sản phẩm</span>
                        </a>
                    </li>
                    <li class="<?=($post_type=='other'||$post_type=='other_detail')?'active':''?>">
                        <a href="?act=postcat_list&post_type=other">
                            <i class="fa fa-book"></i>
                            <span>Other</span>
                        </a>
                    </li>
                    <li class="<?=($act=='block_media')?'active':''?>">
                        <a href="?act=block_media">
                            <i class="fa fa-film" aria-hidden="true"></i>
                            <span>Media</span>
                        </a>
                    </li>
                    <!--
                    <li class="<?=($act=='danhgia_list'||$act=='danhgia_new'||$act=='danhgia_edit')?'active':''?>">
                        <a href="?act=danhgia_list">
                            <i class="fa fa-book"></i>
                            <span>Đánh giá</span>
                        </a>                        
                    </li>-->
                    <li class="<?=($act=='gallery_manager'|$act=='catgal_new'|$act=='catgal_edit'|$act=='gallery_menu_new'|$act=='gallery_menu_edit'|$act=='gallery_edit'|$act=='gallery_new'|$act=='gallery_list')?'active':''?>">
                        <a href="?act=gallery_manager&post_type=catgal">
                            <i class="fa fa-file-image-o" aria-hidden="true"></i>
                            <span>Gallery</span>
                        </a>
                    </li>
                    <li class="<?=($act=='page_list'|$act=='page_edit'|$act=='page_new')?'active':''?>">
                        <a href="?act=page_list">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                            <span>Page</span>
                        </a>
                    </li>
                    <li class="<?=($act=='info_list'|$act=='info_edit'|$act=='info_new')?'active':''?>">
                        <a href="?act=info_list">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                            <span>Info</span>
                        </a>
                    </li>
                    <li class="<?=($act=='donhang_list'|$act=='donhang_edit'|$act=='donhang_new')?'active':''?>">
                        <a href="?act=donhang_list">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                            <span>Đơn hàng</span>
                        </a>
                    </li>
                    <li class="treeview <?=($act=='lienhe_list'||$act=='lienhe_view')?'active':''?>">
                        <a href="?act=lienhe_list">
                            <i class="fa fa-comments-o" aria-hidden="true"></i>
                            <span>Search form</span>
                            <i style="margin-right: 20px;" class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu menu-open" style="<?=($act=='lienhe_list'||$act=='lienhe_view')?'display: block;':'display: none;'?>">
                            <li class="<?=($act=='lienhe_list'||$act=='lienhe_view')?'active':''?>">
                                <?
                                $demview = get_sql("select COUNT(id) from lienhe where view=0 and type!='đăng ký'");
                                $demview1 = get_sql("select COUNT(id) from lienhe where view=0 and type='' and post_id=0");
                                $demview2 = get_sql("select COUNT(id) from lienhe where view=0 and type='Đăng ký khóa học'");
                                ?>
                                <a href="?act=lienhe_list" style="position: relative;">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Liên hệ</span>
                                    <?if($demview1!=0){?><span style="top: 10px;right: 20px;" id="view_active_lienhe" class="view_active"><?=$demview1?></span><?}?>
                                </a>
                            </li>
                            <!-- <li class="<?=($act=='lienhe_list1'||$act=='lienhe_view1')?'active':''?>">
                                <a href="?act=lienhe_list1" style="position: relative;">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Đăng ký khóa học</span>
                                    <?if($demview2!=0){?><span style="top: 10px;right: 20px;" id="view_active_lienhe" class="view_active"><?=$demview2?></span><?}?>
                                </a>
                            </li>
                            <li class="<?=($act=='newsletter_list'||$act=='newsletter_list')?'active':''?>">
                                <a href="?act=newsletter_list" style="position: relative;">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Đăng ký nhận khuyến mãi</span>
                                </a>
                            </li> -->
                            
                            <!--<li class="<?if($act=='booking'||$act=='booking_view'){echo 'active';}?>">
                                <?
                                $demview2 = get_sql("select COUNT(id) from vn_booking where view=0");
                                ?>
                                <a href="?act=booking">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Đặt tour</span>
                                </a>
                                <?if($demview2!=0){?><span id="view_active_vn_booking" class="view_active"><?=$demview2?></span><?}?>
                            </li>-->
                        </ul>
                            <?if($demview!=0){?><span style="top: 10px;" id="view_active_lienhe" class="view_active"><?=$demview?></span><?}?>
                    </li>
                    <li class="<?=($act=='menu_list')?'active':''?>">
                        <a href="?act=menu_list">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                            <span>Custom menu</span>
                        </a>
                    </li>
                    <li class="header"><i class="fa fa-cogs" aria-hidden="true"></i><span>LABELS</span></li>
                    <?
                    if($_SESSION["level"]==0||$_SESSION["level"]==1)
                    {
                    ?>
                    <li class="<?=($act=='member_list'|$act=='member_edit'|$act=='member_new')?'active':''?>">
                        <a href="?act=member_list">
                            <i class="fa fa-circle-o text-info"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="<?=($act=='member_l'|$act=='member_e'|$act=='member_n')?'active':''?>">
                        <a href="?act=member_l">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span>QT user khách hàng</span>
                        </a>
                    </li>
                    <?}?>
                    <li class="<?=($act=='setting')?'active':''?>">
                        <a href="?act=setting">
                            <i class="fa fa-circle-o text-danger"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <!--<li class="<?=($act=='style')?'active':''?>">
                        <a href="?act=style">
                            <i class="fa fa-circle-o text-primary"></i>
                            <span>Style format</span>
                        </a>
                    </li>-->    
                    <!-- <?
                    if($_SESSION["level"]==0)
                    {
                    ?>
                    <li class="<?=($act=='slug_list')?'active':''?>">
                        <a href="?act=slug_list">
                            <i class="fa fa-circle-o text-danger"></i>
                            <span>Slug page</span>
                        </a>
                    </li>
                    <?}?> -->
                    <?
                    if($_SESSION["level"]==0)
                    {
                    ?>
                    <li class="<?=($act=='post_meta_list')?'active':''?>">
                        <a href="?act=post_meta_list">
                            <i class="fa fa-circle-o text-danger"></i>
                            <span>Option field</span>
                        </a>
                    </li>
                    <?}?>
                    <!--
                    <li class="treeview">
                        <a href="">
                            <i class="fa fa-circle-o text-danger"></i>
                            <span>Demo</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu menu-open" style="display: none;">
                            <li>
                                <a href="">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Demo 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Demo 2</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    -->
                    <!--<li class="<?=($act=='backup')?'active':''?>">
                        <a href="?act=backup">
                            <i class="fa fa-circle-o text-warning"></i>
                            <span>Backup DB</span>
                        </a>
                    </li>-->
                    <li class="treeview">
                        <a href="">
                            <i class="fa fa-circle-o text-warning"></i>
                            <span>Seo list</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu menu-open">
                            <li>
                                <a href="<?=$domain?>/sitemap.php" target="_blank">
                                    <i class="fa fa-circle-o"></i>
                                    <span>Cập nhật sitemap</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?
                    if($_SESSION["level"]==0)
                    {
                    ?>
                    <li class="<?=($act=='backup')?'active':''?>">
                        <a href="?act=ngonngu_list">
                            <i class="fa fa-circle-o text-warning"></i>
                            <span>Language</span>
                        </a>
                    </li>
                    <?}?>
                    <!--<li class="<?=($act=='game')?'active':''?>">
                        <a href="?act=game">
                            <i class="fa fa-circle-o text-warning"></i>
                            <span>Games</span>
                        </a>
                    </li>-->
                    <li class="header"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Logout</span></li>
                    <li>
                        <a href="?logout=OK">
                            <i class="fa fa-circle-o text-danger"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
        </div><!-- end left-menu-->
    </div>
    <div class="wrapper-block-right block-rcontent">
        
        <div class="full-wrapper">
        <?
        if (empty($act)) $act = "home";
        if (is_file("prog/".$act.".php")){
            include("../z_includes/fancybox.php");
        	include "prog/".$act.".php";
            // if($act!='block_media'){
            //     echo"<div id='media' style='width:1200px;display: none;'>";
            //     include("prog/templates/block_media.php");
            //     echo "</div>";
            // }
        }
        else{
        	echo "<b>This function is locked.</b>";
        }
        ?>
        </div>
        <div class="clear"></div>
        <?
        include "tpl/skin/copyright.php";
        ?>
        </div>
    </div>
    <div class="clear"></div>
    
    <div class="clear"></div>
</div>