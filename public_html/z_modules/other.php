<?
$q1=$db->select("postcat_lang","slug='".$slugnew."'","");
$r1=$db->fetch($q1);
$page		=	$page + 0;
$perpage	=	10;
    $r_all		=	$db->selectpost("hien_thi=1 and (cat='".$r1['postcat_id']."' or cat1='".$r1['postcat_id']."' or cat2='".$r1['postcat_id']."') and lang_id='".$lang_code."'","");
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
    <?
    $qk=$db->select("vn_gallery","hien_thi=1 and id=31","");
    if($db->num_rows($qk)!=0){
    $rk=$db->fetch($qk);
    ?>
        <img src="<?=$domain?>/uploads/<?=$rk['dir']?><?=$rk['hinh']?>" alt="<?=get_bien('title')?>" class="img-responsive" style="margin: 0 auto;width: 100%;" />
    <?}?>
    <?php include('menu_banner.php');?>
</div>
<section id="main_wrapper" class="contact">
<div class="container">
        <div class="row">
        <div class="col-md-8">
            <h1 class="content_title" style="margin-bottom: 30px;"><span><?=$r1['name']?></span></h1>
            <?
            $q = $db->selectpost("hien_thi=1 and (cat='".$r1['postcat_id']."' or cat1='".$r1['postcat_id']."' or cat2='".$r1['postcat_id']."') and lang_id='".$lang_code."'","order by post.id DESC LIMIT ".$min.", ".$max);
            if($db->num_rows($q) != 0)
            {
            while($r=$db->fetch($q)){
            ?>
            <div class="item_news row">
                <div>
                <div class="col-md-4 col-sm-4 col-xs-4 col-479 item_news_img"><a href="<?=$root?>/<?=$r['slug']?>"><img src="<?=$domain?>/uploads/<?=$r['dir']?><?=$r['hinh']?>" class="img-responsive"/></a>
                    <span class="item_news_date"><?=date('d.m.Y',$r['time'])?></span>
                </div>
                <div class="item_news_content col-md-8 col-sm-8 col-xs-8 col-479">
                    <h2><a class="item_news_name" href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></h2>
                    
                    <div class="item_news_ct"><?=str_replace("\n","<br/>",lg_string::crop($r['chu_thich'],100))?></div>
                </div>
                <div class="clear"></div>
                </div>
            </div>
            <?
            }
        	showPageNavigation($page, $pages, $root.'/'.$slugnew.'/');
        	}
        	else 
        	{
        	   echo '<div style="padding:20px 0;">'.$translate['Thông tin đang được cập nhật'][$lang_code].'...</div>';
        	}
            ?>
        </div>
        <div class="col-md-4">
            <div class="content_title"><span style="font-size: 18px;"><?=$translate['Bài viết nổi bật'][$lang_code]?></span></div>
            <ul class="ct_left_ul">
                <?
                $q = $db->selectpost("hien_thi=1 and (cat='".$r1['postcat_id']."' or cat1='".$r1['postcat_id']."' or cat2='".$r1['postcat_id']."') and lang_id='".$lang_code."' and noi_bat=1","order by post.id DESC limit 8");
                while($r=$db->fetch($q)){
                ?>
                <li>
                    <h3><a class="item_news_name_left" href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></h3>
                    <span class="item_news_date_left"><?=date('d.m.Y',$r['time'])?></span>
                </li>
                <?}?>
            </ul>
        </div>
        </div>
    </div>
</section>