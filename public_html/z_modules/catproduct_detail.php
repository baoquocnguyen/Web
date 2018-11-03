<?
$db->update("post","luot_xem",the_view+1," id='".$id_slug."' ");
?>
<div class="img_top">
    <?=get_single_image(the_parent,"postcat","avatar")?>
</div>
<div class="content__wrapper other_box">
    <div class="content_wrapper container">
        <ul class="breadcrumb">
            <li><a href="<?=$root?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li class="breadcrumb-item"><a href="javascription:;return false;"><?=show_infopage("sp","ten","14")?></a></li>
            <li><a href="<?=$root?>/<?=get_sql("select slug from postcat_lang where postcat_id='".the_parent."' and lang_id='".$lang_code."'")?>/"><?=get_sql("select name from postcat_lang where postcat_id='".the_parent."' and lang_id='".$lang_code."'")?></a></li>
            <li><?=the_title?></li>
        </ul>
        <div class="row">
            <div class="col-md-4">
                <div class="slider-for">
                    <div><a class="fancybox" rel="group<?=$r['post_id']?>" href="<?=get_single_image($id_slug,'post','avatar','link')?>" title="<?=the_title?>"><img class="img-responsive" src="<?=get_single_image($id_slug,'post','avatar','link')?>" /></a></div>
                    <?
                    $q=$db->selectmedia("parent_id='".$id_slug."' and type='album' and parent_type='post'","order by thu_tu"); 
                    while($r=$db->fetch($q)){
                    ?>
                    <div><a class="fancybox" rel="group<?=$r['post_id']?>" href="<?=$domain?>/uploads/<?=$r['dir_folder']?>/<?=$r['file_name']?>" title="<?=the_title?>"><img class="img-responsive" src="<?=$domain?>/uploads/<?=$r['dir_folder']?>/<?=$r['file_name']?>" /></a></div>
                    <?}?>
                </div>
                <div class="slider-nav" style="margin: 0 -2px;">
                    <div class="slick-item"><img title="<?=the_title?>" class="img-responsive" src="<?=get_single_image($id_slug,'post','avatar','link')?>" /></div>
                    <?
                    $q=$db->selectmedia("parent_id='".$id_slug."' and type='album' and parent_type='post'","order by thu_tu"); 
                    while($r=$db->fetch($q)){
                    ?>
                    <div class="slick-item"><img title="<?=the_title?>" class="img-responsive" src="<?=$domain?>/uploads/<?=$r['dir_folder']?>/<?=$r['file_name']?>" /></div>
                    <?}?>
                </div>
            </div>
            <div class="col-md-8">
                 <h1 class="da_detail_name"><?=the_title?></h1>
                 <div class="product-price-ct">
                    <?php if(the_price==''){?>
                        <span class="product-price-sell"><?=$translate['Liên hệ'][$lang_code]?></span>
                    <?php }elseif(the_price!=''&&the_price1==''){?>
                        <span class="product-price-sell"><?=lg_number::fix_number(the_price)?> đ</span>
                    <?php }else{?>
                        <span class="product-price-normal"><?=lg_number::fix_number(the_price)?> đ</span>
                        <span class="product-price-sell1"><?=lg_number::fix_number(the_price1)?> đ</span>
                    <?php }?>
                </div>
                 <div class="box_right_ct">
                    <?=str_replace("\n","<br/>",the_note)?>
                 </div>
                 <div class="box_right_ct dat_hang">
                    <form name="frm3">
                        <div><input min="1" type="number" class="sl" name="so_luong" style="background: #fff;width: 100px;margin-right: 25px;padding: 7px 10px 11px;border-radius: 2px;border: 1px solid #bababa;text-align: center;float: left;"  value="1" id="number"/><a style="display: inline-block;background: #eb3828;color: #fff;padding: 12px 20px;float: left;border-radius: 2px;text-transform: uppercase;" rel="<?php echo $id_slug;?>" class="cartbt botton" href="javascrip:;return false;"><?=$translate['Đặt hàng'][$lang_code]?></a></div>
                    </form>
                 </div>
            </div>
            <div class="clear"></div>
            <div class="col-md-12">
                <div class="title_sp_detail">Chi tiết sản phẩm</div>
                <div class="noi_dung">
                    <?=the_content?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="title_sp_detail">Sản phẩm khác</div>
                <ul class="row ul_sanpham khac_khac">
                <?php
                $q1=$db->selectpost("hien_thi=1 and cat = '".the_parent."' and post_id<>'".$id_slug."' and lang_id='".$lang_code."'","order by time desc limit 10");
                while ($r1=$db->fetch($q1)) {
                ?>
                    <li class="">
                        <div class="boc"><a href="<?=$root?>/<?=$r1['slug']?>"><?=get_single_image($r1['post_id'],"post","avatar")?></a></div>  
                        <div class="media">
                            <div class="media-body">
                                <h2 class="home-product-title"><a href="<?=$root?>/<?=$r1['slug']?>"><?=$r1['ten']?></a></h2>
                                <div class="product-price">
                                <?php if($r1['old_price']==''){?>
                                    <span class="product-price-sell"><?=$translate['Liên hệ'][$lang_code]?></span>
                                <?php }elseif($r1['old_price']!=''&&$r1['new_price']==''){?>
                                    <span class="product-price-sell"><?=lg_number::fix_number($r1['old_price'])?> đ</span>
                                <?php }else{?>
                                    <span class="product-price-normal"><?=lg_number::fix_number($r1['old_price'])?> đ</span>
                                    <span class="product-price-sell"><?=lg_number::fix_number($r1['new_price'])?> đ</span>
                                <?php }?>
                                </div>
                            </div>
                            <div class="media-right">
                                <a href="javascript:;return false;" class="add-cart" rel="<?=$r1['post_id']?>">
                                    <img class="media-object" src="<?=$domain?>/public/images/icon-cart.png" alt="Add to cart">
                                </a>
                            </div>
                        </div>                      
                    </li>
                <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>

