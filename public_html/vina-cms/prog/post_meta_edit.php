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
    if ($_POST["func"]=="update") 
    {
    $id = $_POST["id"];
    }
    else 
    {
    $id = $_GET['id'];
    } 
    include "templates/post_meta.php";
?>
<section class="content-header">
    <h1>List<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li><a href="?act=post_meta_list"><i class="fa fa-list-alt" aria-hidden="true"></i>Option Field</a></li>
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
            		if (empty($name))
            			$error = "Name not value!";
            		else
            		{
            				$db->query("update post_meta_key set name = '".$db->escape($name)."',meta_key = '".$meta_key."',rows = '".$rows."',type = '".$type."',post_type = '".$post_type."',thu_tu='".$thu_tu."',width='".$width."',chu_thich='".$chu_thich."' where id = '".$id."'");
            				admin_load("","?act=post_meta_list");
            						
            		}
            	}
            	else
            	{
            		$r	= $db->select("post_meta_key","id = '".$id."'");
            		while ($row = $db->fetch($r))
            		{
            			$name		= $row["name"];
            			$meta_key	= $row["meta_key"];
                        $rows	= $row["rows"];
                        $type	= $row["type"];
                        $post_type=$row['post_type'];
                        $idmenu=$row['idmenu'];
                        $thu_tu=$row['thu_tu'];
                        $width=$row['width'];
                        $chu_thich=$row['chu_thich'];
            		
            		}
            	}
            	
            	if (!$OK)
            		template_edit("?act=post_meta_edit","update",$id,$name,$meta_key,$rows,$type,$post_type,$idmenu,$thu_tu,$width,$chu_thich,$error)
            ?>
            </div>
            </div>
        </div>
    </div>
</section>