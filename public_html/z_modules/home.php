<div class="container">
	<div class="box-content">
		<div class="content--title"><?=$translate['Sản phẩm nổi bật'][$lang_code]?></div>
		<div>
			<?php
			$dem=0;
			$q=$db->selectpostcat("post_type = 'catproduct' and hien_thi = 1 and noi_bat = 1 and lang_id='".$lang_code."'","order by thu_tu");
			while ($r=$db->fetch($q)) {$dem++;
			?>
			<h3 class="title_slide"><?=$r['name']?></h3>
			<div>
				<ul class="row ul_sanpham slide<?=$dem?>home">
				<?php
				$q1=$db->selectpost("hien_thi=1 and (cat = '".$r['postcat_id']."' or cat1 = '".$r['postcat_id']."' or cat2 = '".$r['postcat_id']."') and noi_bat=1 and lang_id='".$lang_code."'","order by time desc limit 12");
				while ($r1=$db->fetch($q1)) {
				?>
					<li class="col-lg-12">
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
			<?php }?>
		</div>
	</div>
</div>
<?php
$qh2=$db->selectpage("alias='info_about' and lang_id='".$lang_code."'","");
$rh2=$db->fetch($qh2);
?>
<div class="info_aboutus" style="background: url(<?=get_single_image($rh2['page_id'],"info","avatar","link")?>);">
	<div class="">
		<div class="col-lg-6 col-lg-push-6 col-md-6 col-md-push-6 info_aboutus--right">
			<h4 class="title"><?=$rh2['ten']?></h4>
			<div class="desc">
				<?=$rh2['noi_dung']?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>