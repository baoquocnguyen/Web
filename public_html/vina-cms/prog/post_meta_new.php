<?php
	$act = $_POST['act'];
    $name = addslashes($_POST['name']);
    $meta_key = $_POST['meta_key'];
    $rows = $_POST['rows'];
    $type = $_POST['type'];
    $post_type = $_POST['post_type'];
    $idmenu = $_POST['idmenu'];
    $thu_tu=$_POST['thu_tu'];
    $width=$_POST['width'];
    $kitu1 = array('"',"'");
    $kitu2 = array('&quot;','&#39;');
    $chu_thich = str_replace($kitu1,$kitu2,$_POST['chu_thich']);
    $func = $_POST['func'];
  
    include "templates/post_meta.php";
?>
<section class="content-header">
    <h1>List<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li><a href="?act=post_meta_list"><i class="fa fa-list-alt" aria-hidden="true"></i>Option Field</a></li>
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
                		if (empty($name))
                			$error = "Vui lòng nhập tên field.";
                		else
                		{
                				$id = $db->insert("post_meta_key","id,name,meta_key,rows,type,post_type,thu_tu,width,chu_thich","0,'".$name."','".$meta_key."','".$rows."','".$type."','".$post_type."','".$thu_tu."','".$width."','".$chu_thich."'");
               			  
                				admin_load("","?act=post_meta_list");
                			
                		}
                	}
                	else
                	{
                		$name		= "";
                        $meta_key='';
                        $rows='';
                        $type=1;
                        $post_type='product';
                        $idmenu=0;
                        $thu_tu='';
                        $width='100';
                        $chu_thich='';
                       
                	}
                	
                	if (!$OK)
                		template_edit("?act=post_meta_new", "new", 0 ,$name,$meta_key,$rows,$type,$post_type,$idmenu,$thu_tu,$width,$chu_thich,$error)
                ?>
                </div>
            </div>
        </div>
    </div>
</section>