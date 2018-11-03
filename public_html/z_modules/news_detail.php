<?
$db->query("update post set luot_xem=luot_xem+1 where id='".$id_slug."'");
?>
<div id="content--content">
    <div class="container">
    <?=get_breadcums($id_slug)?>
<div class="margin-top30 other_box">
    
<div class="row" style="padding-top: 20px;">
    <div class="col-md-8">
        
        <h1 class="item_news_name_ct"><?=the_title?></h1>
        <h2 class="chu_thich_detail"><span class="item_news_date_ct"><?=date('d.m.Y',the_time)?></span> - <?=the_note?></h2>
        <div class="noi_dung">
            <?=the_content?>
        </div>
        <div style="margin-top: 15px;">
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-comments" data-href="<?=$root?>/<?=the_slug?>" data-width="100%" data-numposts="5"></div>
        </div>
    </div>
    <div class="col-md-4 bottom">
        <div class="content_title"><span style="font-size: 18px;"><?=$translate['Bài viết nổi bật'][$lang_code]?></span></div>
        <ul class="ct_left_ul">
            <?
            $q = $db->selectpost("hien_thi=1 and (cat='".the_parent."' or cat1='".the_parent."' or cat2='".the_parent."') and lang_id='".$lang_code."' and noi_bat=1","order by post.id DESC limit 8");
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
</div>
</div>
