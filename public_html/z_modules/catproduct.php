<?
$q22=$db->selectpostcat("postcat_id='".the_parent."' and lang_id='".$lang_code."'","");
$r22=$db->fetch($q22);
$q33=$db->selectpostcat("postcat_id='".$r22['cat']."' and lang_id='".$lang_code."'","");
$r33=$db->fetch($q33);

$page		=	$page + 0;
$perpage	=	12;
$r_all		=	$db->selectpost("hien_thi=1 and (cat = '".$id_slug."' or cat1 = '".$id_slug."' or cat2 = '".$id_slug."') and lang_id='".$lang_code."'","");
$sum		=	$db->num_rows($r_all); 
$pages		=	($sum-($sum%$perpage))/$perpage;
	if ($sum % $perpage <> 0)
		{
			$pages = $pages + 1;
		}
$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
$min 		= 	abs($page-1) * $perpage;
$max 		= 	$perpage;
$count=0;
?>
<div class="img_top">
    <?=get_single_image($id_slug,"postcat","avatar")?>
</div>
<div class="content__wrapper other_box">
    <div class="content_wrapper container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=$root?>"><i class="fa fa-home" aria-hidden="true"></i></a></li>
            <li class="breadcrumb-item"><a href="javascription:;return false;"><?=show_infopage("sp","ten","14")?></a></li>
            <?php
            if($r33['id']!=''){?>
                <li class="breadcrumb-item"><a href="<?=$root?>/<?=get_slug(7)?>/"><?=$r33['name']?></a></li>
                <li class="breadcrumb-item"><a href="<?=$root?>/<?=$r22['slug']?>/"><?=$r22['name']?></a></li>
                <li class="breadcrumb-item"><h1 style="display: inline;"><?=the_title?></h1></li>
            <?php }elseif($r22['id']!=''){?>
                <li class="breadcrumb-item"><a href="<?=$root?>/<?=get_slug(7)?>/"><?=$r22['name']?></a></li>
                <li class="breadcrumb-item"><h1 style="display: inline;"><?=the_title?></h1></li>
            <?php }else{?>
                <li class="breadcrumb-item"><h1 style="display: inline;"><?=the_title?></h1></li>
            <?php }?>
            <div class="clear"></div>
        </ul>
        <div class="row">
            <div class="col-md-3 hidden-sm hidden-xs">
                <ul class="content_left_ul">
                    <?php
                    $q=$db->selectpostcat("cat=0 and lang_id='".$lang_code."' and post_type='catproduct'","order by thu_tu");
                    while($r=$db->fetch($q)){
                        $qh2=$db->selectpostcat("cat='".$r['postcat_id']."' and lang_id='".$lang_code."'","order by thu_tu");
                    ?>
                    <li><a rel="<?=$r['postcat_id']?>" <?php if($id_slug==$r['postcat_id']|the_parent==$r['postcat_id']){echo 'class="active"';}?> href="<?php if($db->num_rows($qh2)!=0){ echo 'javascript:;return false;'; }else{ echo $root.'/'.get_slug_postcat($r['postcat_id']).'/';}?>"><?=$r['name']?></a>
                        <?php if($db->num_rows($qh2)!=0){?>
                        <ul class="ul_<?=$r['postcat_id']?> hhhh <?php if($id_slug==$r['postcat_id']|the_parent==$r['postcat_id']){echo 'active';}?>">
                            <?php
                                while($rh2=$db->fetch($qh2)){
                            ?>
                            <li><a <?if($id_slug==$rh2['postcat_id']){echo 'class="active"';}?> href="<?=$root?>/<?=get_slug_postcat($rh2['postcat_id'])?>/"><i class="fa fa-caret-right" aria-hidden="true"></i> <?=$rh2['name']?></a></li>
                            <?php }?>
                        </ul>
                        <?php }?>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div class="col-md-9">
                <ul class="row ul_sanpham">
                <?php
                $q=$db->selectpost("hien_thi=1 and (cat = '".$id_slug."' or cat1 = '".$id_slug."' or cat2 = '".$id_slug."') and lang_id='".$lang_code."'","order by thu_tu,time desc LIMIT ".$min.", ".$max);
                if($db->num_rows($q) != 0)
                {
                while ($r=$db->fetch($q)) {
                ?>
                    <li class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
                        <div class="boc"><a href="<?=$root?>/<?=$r['slug']?>"><?=get_single_image($r['post_id'],"post","avatar")?></a></div>  
                        <div class="media">
                            <div class="media-body">
                                <h2 class="home-product-title"><a href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></h2>
                                <div class="product-price">
                                <?php if($r['old_price']==''){?>
                                    <span class="product-price-sell">Liên hệ</span>
                                <?php }elseif($r['old_price']!=''&&$r['new_price']==''){?>
                                    <span class="product-price-sell"><?=lg_number::fix_number($r['old_price'])?> đ</span>
                                <?php }else{?>
                                    <span class="product-price-normal"><?=lg_number::fix_number($r['old_price'])?> đ</span>
                                    <span class="product-price-sell"><?=lg_number::fix_number($r['new_price'])?> đ</span>
                                <?php }?>
                                </div>
                            </div>
                            <div class="media-right">
                                <a href="#" class="add-cart" rel="<?=$r['post_id']?>">
                                    <img class="media-object" src="<?=$domain?>/public/images/icon-cart.png" alt="Add to cart">
                                </a>
                            </div>
                        </div>                      
                    </li>
                <?php }
                showPageNavigation($page, $pages, $root.'/'.$slugnew.'/');
                }
                else 
                {
                   echo '<div class="col-lg-12" style="margin-top:15px"> '.$translate['Thông tin đang được cập nhật'][$lang_code].'...</div>';
                }?>
                </ul>
             </div>   
        </div>
    </div>
</div>