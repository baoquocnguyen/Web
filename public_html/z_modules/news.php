<?
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
?>
<div id="content--content">
    <div class="container">
    <?=get_breadcums($id_slug)?>
<div class="margin-top30 other_box">
    <h1 class="content-title"><?=the_title?></h1>
    <div class="row">
    <div class="col-md-8">
        <?
        $q = $db->selectpost("hien_thi=1 and (cat='".$id_slug."' or cat1='".$id_slug."' or cat2='".$id_slug."') and lang_id='".$lang_code."'","order by post.id DESC LIMIT ".$min.", ".$max);
        if($db->num_rows($q) != 0)
        {
        while($r=$db->fetch($q)){
        ?>
        <div class="item_news row">
            <div>
            <div class="col-md-4 col-sm-4 col-xs-4 col-479 item_news_img"><a href="<?=$root?>/<?=$r['slug']?>"><?=get_single_image($r['post_id'], 'post', 'avatar')?></a>
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
    <div class="col-md-4 bottom">
        <div class="content_title"><span style="font-size: 18px;"><?=$translate['Bài viết nổi bật'][$lang_code]?></span></div>
        <ul class="ct_left_ul">
            <?
            $q = $db->selectpost("hien_thi=1 and (cat='".$id_slug."' or cat1='".$id_slug."' or cat2='".$id_slug."') and lang_id='".$lang_code."' and noi_bat=1","order by post.id DESC limit 8");
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
</div></div>
</div>
