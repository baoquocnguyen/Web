<?php
	$act = $_POST['act'];
    $txt_ten = addslashes($_POST['txt_ten']);
    $txt_hien_thi = $_POST['txt_hien_thi'];
    $txt_code = $_POST['txt_code'];
    $txt_order=$_POST['txt_order'];
    $func = $_POST['func'];
  
    include "templates/ngonngu.php";
?>
<section class="content-header">
    <h1>List<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li><a href="?act=ngonngu_list"><i class="fa fa-list-alt" aria-hidden="true"></i> List language</a></li>
        <li class="active">Add new</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Add new</h3>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                <?php
                    $OK = false;
                	
                	if ($func == "new")
                	{
                		if (empty($txt_ten))
                			$error = "Vui lòng nhập tên sản phẩm.";
                		else
                		{
                				$id = $db->insert("language","id,name,display,code,thu_tu","0,'".$txt_ten."','".($txt_hien_thi+0)."','".$txt_code."','".$txt_order."'");
                			
                				admin_load("","?act=ngonngu_list");
                			
                		}
                	}
                	else
                	{
                		$txt_ten		= "";
                		$txt_hien_thi	= 1;
                        $txt_code	= 0;
                        $txt_order='';
                       
                	}
                	
                	if (!$OK)
                		template_edit("?act=ngonngu_new", "new", 0 ,$txt_ten,$txt_hien_thi,$txt_code,$txt_order,$error)
                ?>
                </div>
            </div>
        </div>
    </div>
</section>