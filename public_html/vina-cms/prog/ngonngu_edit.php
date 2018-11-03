<?php
	$act = $_POST['act'];
    $txt_ten = addslashes($_POST['txt_ten']);
    $txt_code = $_POST['txt_code'];
    $txt_hien_thi = $_POST['txt_hien_thi'];
    $txt_order=$_POST['txt_order'];
   
    $func = $_POST['func'];
    if ($_POST["func"]=="update") 
    {
    $id = $_POST["id"];
    }
    else 
    {
    $id = $_GET['id'];
    } 
    include "templates/ngonngu.php";
?>
<section class="content-header">
    <h1>List<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li><a href="?act=ngonngu_list"><i class="fa fa-list-alt" aria-hidden="true"></i> List language</a></li>
        <li class="active">Edit</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-green">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit</h3>
                    <div class="clear"></div>
                </div>
            <div class="paddinglr10">
            <?php
            
            	$OK = false;
            
            	if ($func == "update")
            	{
            		if (empty($txt_ten))
            			$error = "Name not value!";
            		else
            		{
            		
            				$db->query("update language set name = '".$db->escape($txt_ten)."',display = '".($txt_hien_thi+0)."',code = '".$txt_code."',thu_tu='".$txt_order."'  where id = '".$id."'");
            			
            				admin_load("","?act=ngonngu_list");
            						
            		}
            	}
            	else
            	{
            		$r	= $db->select("language","id = '".$id."'");
            		while ($row = $db->fetch($r))
            		{
            			$txt_ten		= $row["name"];
            			$txt_hien_thi	= $row["display"];
                        $txt_code	= $row["code"];
                        $txt_order=$row['thu_tu'];
            		
            		}
            	}
            	
            	if (!$OK)
            		template_edit("?act=ngonngu_edit","update",$id,$txt_ten,$txt_hien_thi,$txt_code,$txt_order,$error)
            ?>
            </div>
            </div>
        </div>
    </div>
</section>