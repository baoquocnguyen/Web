<? 
$keyword1 = $_POST['query'];
$keyword = 	trim($_POST['query']) ;		// Cắt bỏ khoảng trắng
$keyword = lg_string::bo_dau($keyword);

$page		=	$page + 0;
$perpage	=	24;
$r_all		=	$db->selectpost("hien_thi=1 and (post_type='catproduct_detail' or post_type='other_detail' or post_type='post_detail') and lang_id='".$lang_code."' and (ten_kd like '%$keyword%' or chu_thich_kd like '%$keyword%')","");
if($r_all){$sum     =   $db->num_rows($r_all); }

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

<style>
.product_hover ul li{font-size: 12px;
    padding: 0px 0 2px;
    line-height: 14px;
}
.sosanh {
    font-size: 14px;
    padding: 4px 10px;
}
.lienhe {
    font-size: 14px;
    padding: 4px 10px;
}
@media (max-width: 991px){
.box .img {
    display: block;
    padding: 10px 15px!important;
}
}
</style>

<div id="content--content">
    <div class="container">
        
<h1 class="sea_title"><?=$translate['Kết quả tìm kiếm cho từ khóa'][$lang_code]?>: <?=$keyword1?></h1>

<ul class="search">
    <?
    $q = $db->selectpost("hien_thi=1 and (post_type='catproduct_detail' or post_type='post_detail') and lang_id='".$lang_code."' and (ten_kd like '%$keyword%' or chu_thich_kd like '%$keyword%')","order by post.id DESC LIMIT ".$min.", ".$max);
    while($r=$db->fetch($q)){
    ?>
    <li class="">
        <div class="boc">
            <div class="content_content">
               <h2 class="ten"><a href="<?=$root?>/<?=$r['slug']?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i> <?=$r['ten']?></a></h2>
               <p class="linkne"><?=$root?>/<?=$r['slug']?></p>
               <p class="ctnema"><?=lg_string::crop($r['chu_thich'],20)?></p>
            </div>
        </div>
    </li>
    <?
    }
    ?>
    </ul>
    <div class="clear"></div>
</div>
</div>
