<div class="img_top">
    <?=get_single_image("11","post","avatar")?>
</div>
<div class="container">
    
    <div class="margin-top30 other_box">
        <div class="row">
        <div class="col-md-3 col-sm-3">
            <h2 class="content_title"><span><?=$translate['Giới thiệu'][$lang_code]?></span></h2>
            <ul class="content_left_ul">
                <?
                $q=$db->selectpage("post_type='about_us' and hien_thi=1 and lang_id='".$lang_code."'","");
                while($r=$db->fetch($q)){

                ?>
                <li><h3><a <?if($slugnew==$r['slug']){echo 'class="active"';}?> href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></h3></li>
                <?}?>
            </ul>
        </div>
        <div class="col-md-9 col-sm-9 content_right bottom">
            <h1 class="content--title1"><?=the_title?></h1>
            <div class="noi_dung">
                <?=the_content?>
            </div>
        </div>
        </div>
    </div>
</div>