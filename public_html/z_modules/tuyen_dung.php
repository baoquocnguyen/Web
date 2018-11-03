<?
$id=$_GET['id'];
$q1=$db->select("tgp_cms_menu","id='".$id."'","");
$r1=$db->fetch($q1);
$page		=	$page + 0;
$perpage	=	12;
$r_all		=	$db->select("tgp_cms","hien_thi=1 and cat='".$id."'","");
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
<div class="container-fluid" style="margin: 20px 0;">
    <div class="container">
    <div class="row">
    <div class="bread">
       <a href="<?=$domain?>">Trang chủ</a> / <span><?=$r1['ten']?></span>
       </div>
    </div>
    </div>
</div>
<div class="container-fluid" style="min-height: 300px;">
    <div class="container">
    <div class="row">
    <div class="row">
        <div class="col-md-9">
            
            <h1 class="content_title" style="text-transform: uppercase;font-weight: bold;"><?=$r1['ten']?></h1>
            <ul style="margin: 0;padding: 0;list-style: none;">
            <?
                $q=$db->select("tgp_cms","hien_thi=1 and cat='".$id."'","order by id DESC LIMIT ".$min.", ".$max);
                 if($db->num_rows($q) != 0)
        {
                while($r=$db->fetch($q)){
            ?>
                <li style="margin-bottom: 15px;" class="haha">
                    <div style="background: #fff;border-radius: 2px;">
                        <div class="col-sm-4">
                            <div class="row">
                            <a href="<?=$domain?>/news-detail/<?=$r['id']?>/<?=lg_string::get_link($r['ten'])?>"><img src="<?=$domain?>/uploads/cms/tt_<?=$r['hinh']?>" class="img-responsive" style="margin: 0 auto;"  alt="<?=$r['ten']?>"/></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <a style="" href="<?=$domain?>/news-detail/<?=$r['id']?>/<?=lg_string::get_link($r['ten'])?>"><h2 class="tt_content" style="padding-bottom: 5px;"><?=$r['ten']?></h2></a>
                            <div style="padding-bottom: 10px;"><span style="color: #555;font-size: 13px;padding-right: 3px;" class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <span style="color: #8C8B8B;font-size: 12px;"><?=date('d/m/Y',$r['time'])?>   <span style="color: #555;font-size: 13px;padding-left: 20px;padding-right: 3px;" class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> <span style="color: #8C8B8B;font-size: 12px;"> <?=$r['luot_xem']?></span></div>
                            <div style="padding-bottom: 10px;color:#777">
                                <?=lg_string::crop($r['chu_thich'],50)?>
                            </div>
                            <div style="text-align: right;" class="xemtiep"><a href="<?=$domain?>/news-detail/<?=$r['id']?>/<?=lg_string::get_link($r['ten'])?>">Xem tiếp <img src="<?=$domain?>/public/images/more.png" /></a></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </li>
            <?}
            ?>
           
            
            
            </ul>
            <?
            	showPageNavigation($page, $pages, $domain.'/news/'.$id.'/');
            	}
            	else 
            	{
            	   echo '<div> Thông tin dang được cập nhật...</div>';
            	}
            ?>
            <div class="clear"></div>
            
        </div>
      
    </div>
    </div>
</div>
</div>