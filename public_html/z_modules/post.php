<!-- <?
$page		=	$page + 0;
$perpage	=	10;
    $r_all		=	$db->selectpost("hien_thi=1 and (cat='".$id_slug."' or cat1='".$id_slug."' or cat2='".$id_slug."') and lang_id='".$lang_code."'","");
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
?> -->
<div class="img_top">
    <?=get_single_image("8","postcat","avatar")?>
    <h1 class="hedding_title"><?=the_title?></h1>
</div>
<div class="container">
<div class="margin-top30 other_box">
    <ul class="block-list daily">
        <?php
        $dm=0;
        $q=$db->selectpostcat("cat=8 and hien_thi=1 and lang_id='".$lang_code."'","order by thu_tu");
        while($r=$db->fetch($q)){$dm++;
        ?>
        <li><a <?php if($dm==1){echo 'class="active"';}?> href="#tinhthanh<?=$r['postcat_id']?>"><?=$r['name']?></a></li>
        <?php }?>
        <div class="clear"></div>
    </ul>
    <?php
    $dm1=0;
    $q5=$db->selectpostcat("cat=8 and hien_thi=1 and lang_id='".$lang_code."'","order by thu_tu");
    while($r5=$db->fetch($q5)){$dm1++;
    ?>
    <div id="tinhthanh<?=$r5['postcat_id']?>" class="block-detail  <?php if($dm1==1){echo 'active';}?>">
         <div class="row danh_sach">
            <?
            $q = $db->selectpost("hien_thi=1 and (cat='".$r5['postcat_id']."' or cat1='".$r5['postcat_id']."' or cat2='".$r5['postcat_id']."') and lang_id='".$lang_code."'","order by thu_tu,post.id DESC");
            if($db->num_rows($q) != 0)
            {
            while($r=$db->fetch($q)){
            ?>
            <div class="item_news col-lg-6 col-md-6">
                <div class="row">
                <div class="col-md-5 col-sm-12 col-xs-5 col-479 item_news_img"><?=get_single_image($r['post_id'], 'post', 'avatar')?>
                </div>
                <div class="item_news_content col-md-7 col-sm-12 col-xs-7 col-479">
                    <h2 class="name"><?=$r['ten']?></h2>
                    
                    <div class="item_news_ct"><?=$r['noi_dung']?></div>
                </div>
                <div class="clear"></div>
                </div>
            </div>
            <?
            }
            //showPageNavigation($page, $pages, $root.'/'.$slugnew.'/');
            }
            else 
            {
               echo '<div style="padding:20px 15px;">'.$translate['Thông tin đang được cập nhật'][$lang_code].'...</div>';
            }
            ?>
        </div>
    </div>
    <?php }?>
   
</div>
</div>
