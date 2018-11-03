<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=get_title()?> </title>

<meta name="author" content="<?=get_author()?>" />
<meta name="keywords" content="<?=get_keywords()?>" />
<meta name="description" content="<?=get_description()?>" />
<meta name="copyright" content="<?=get_copyright()?>" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="expires" content="0" />
<meta name="resource-type" content="document" />
<meta name="distribution" content="global" />
<meta name="robots" content="index, follow" />
<meta name="revisit-after" content="1 days" />
<meta name="rating" content="general" />

<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta content="telephone=no" name="format-detection" />

<meta property="fb:app_id" content="151937525393193" />

<meta property="og:locale" content="vi_VN" />
<meta property="og:type" content="article" />
<meta property="og:site_name" content="<?=get_bien('title')?>" />
<meta property="article:tag" content="<?=get_bien('title')?>" />   

<?php
if($table == 'post'){
?>
<meta property="og:title" content="<?=title?>" />
<meta property="og:description" content="<?=the_note?>" />
<meta property="og:url" content="<?=the_slug?>" />
<meta property="og:image" content="<?=get_single_image($id_slug, 'post', 'avatar','link')?>" />
<?}else{?>
<meta property="og:title" content="<?=get_title('title')?>" />
<meta property="og:description" content="<?=get_description()?>" />
<meta property="og:url" content="<?=$root?>" />
<meta property="og:image" content="<?=$domain?>/public/images/share.jpg" />
<?php }?>

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,300italic,400italic,600italic,700italic,700,800,800italic' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?=$domain?>/public/images/favicon.png" type="image/x-icon"/>
<link href="<?=$domain?>/app/packages/font_awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$domain?>/public/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$domain?>/public/css/phan_trang.css" rel="stylesheet" type="text/css" />
<link href="<?=$domain?>/public/css/animation.css" rel="stylesheet" type="text/css" />
<link href="<?=$domain?>/public/css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?=$domain?>/public/css/nivo-slider.css" rel="stylesheet" type="text/css" />
<link href="<?=$domain?>/public/css/owl.carousel.css" rel="stylesheet" type="text/css" />
<link href="<?=$domain?>/public/css/slick.css" rel="stylesheet" type="text/css"/>
<link href="<?=$domain?>/public/css/slick-theme.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="<?=$domain?>/app/packages/menureponsive/jquery.mmenu.all.css" />
<link type="text/css" rel="stylesheet" href="<?=$domain?>/app/packages/menureponsive/demo.css" />
<link rel="stylesheet" type="text/css" href="<?=$domain?>/public/css/jquery.fullPage.css"/>
<link href="<?=$domain?>/public/css/common.css" rel="stylesheet" type="text/css" />
<!-- end css -->

