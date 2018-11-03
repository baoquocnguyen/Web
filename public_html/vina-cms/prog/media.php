<?
global $db;
$txt_cat = $_GET['txt_cat'];$sp_id = $_GET["sp_id"];$post_type = $_GET['post_type']; 
$cat = $_GET['cat'];
$qlang	= $db->select("post_album_menu","id = '".$sp_id."'","");
$rlang = $db->fetch($qlang);
$q22 = $db->select("post"," id='".$sp_id."' ","");
$r22 = $db->fetch($q22);
$q23 = $db->select("post_lang"," post_id='".$r22['id']."' ","");
$r23 = $db->fetch($q23);
?>
<?php
    $act = $_GET['act'];
    $func = $_POST['func'];
    $delete = $_GET['delete'];
    $tik = $_POST['tik'];
    if ($delete != 0)
	{
        $qdel = $db->select("post_album_menu","id = '".$delete."'","");
        $rdel = $db->fetch($qdel);
        $fileanh='../uploads/'.$rdel['dir'].$rdel['hinh'];
		if(!is_dir($fileanh))
		{
			unlink($fileanh); 
		}
        $qdel1 = $db->select("post_album","cat ='".$delete."'","order by id");
        while($rdel1 = $db->fetch($qdel1))
        {
			$fileanh1='../uploads/'.$rdel1['dir'].$rdel1['hinh'];
			if(!is_dir($fileanh1))
			{
				unlink($fileanh1); 
			}
            $db->delete("post_album","id = '".$rdel1['id']."'");
        }
        $db->delete("post_album_menu","id = '".$delete."'");
		admin_load("","?act=media&txt_cat=".$txt_cat."&sp_id=".$sp_id."&post_type=".$post_type."");
	}
    if($_POST["func"]=="del") {$id = $_POST["id"];$txt_cat = $_POST["txt_cat"];$sp_id = $_POST["sp_id"];$post_type = $_POST['post_type'];} 
	if ($func == "del")
    {
    	for ($i = 0; $i < count($tik); $i++)
    	{
            $qds = $db->select("post_album_menu","id='".$tik[$i]."'","");
            $rds = $db->fetch($qds);
            $fileanh='../uploads/'.$rds['dir'].$rds['hinh'];
    		if(!is_dir($fileanh))
    		{
    			unlink($fileanh); 
    		}            
            $qds1 = $db->select("post_album","cat ='".$tik[$i]."'","order by id");
            while($rds1 = $db->fetch($qds1))
            {
    			$fileanh1='../uploads/'.$rds1['dir'].$rds1['hinh'];
    			if(!is_dir($fileanh1))
    			{
    				unlink($fileanh1); 
    			}
                $db->delete("post_album","id = '".$rds1['id']."'");
            }            
    		$db->delete("post_album_menu","id = '".$tik[$i]."'");
    	}
    	admin_load("","?act=media&txt_cat=".$txt_cat."&sp_id=".$sp_id."&post_type=".$post_type."");
    	die();
    }
?>
<section class="content-header">
    <h1>Uploading multiple<small>Version 4.4</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=album_manager&cat=<?=$sp_id?>&post_type=<?=$post_type?>"></span>[ <i>Album</i> ]</span> <?=$r23['ten']?></a></li>
        <li class="active">Album manager</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <ul class="list-sub">
                        <li><a href="?act=album_manager&cat=<?=$sp_id?>&post_type=<?=$post_type?>"></span>[ <i>Album</i> ]</span> <?=$r23['ten']?></a></li>
                        <li><a href="?act=media&txt_cat=<?=$txt_cat?>&sp_id=<?=$sp_id?>&post_type=<?=$post_type?>" class="active"><span></span>[ <i>Up multiple</i> ]</span> <?=$r23['ten']?></a></li>
                        <div class="clear"></div>
                    </ul>
                    <div class="paddinglr10">
                    

<div class="block-upload-multi">                    
<?php
session_start();
if(isset($_FILES['files'])){
    if(isset($_SESSION['token']) && $_POST['token'] == $_SESSION['token']){
    $errors="";
    $valid_formats = array("jpg", "png", "gif", "zip", "bmp", "jpeg");    
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];
        //echo var_dump($file_name);
        if($file_size > 10485760)//$max_file_size = 1024*100; //100 kb
        {
            $errors='Kích thước phải nhỏ hơn 10 MB!';
            //continue; // Skip large files
        }elseif($file_size==0){
            $errors='Vui lòng chọn file!';
            //continue; // Skip large files
        }elseif(!in_array(pathinfo($file_name,PATHINFO_EXTENSION),$valid_formats))//Kiểm tra định dạng file
        {
			$errors='Những file sai định dạng được bỏ qua!';
			//continue; // Skip invalid file formats
		};
        $desired_dir='../uploads/media/';$dir='media/';
        if(empty($errors)==true){
            $id = $db->insert("post_album_menu","id,cat,sp_id,ten,hien_thi,chu_thich,post_type","0,'".$txt_cat."','".$sp_id."','".GeraHash(6)."','1','".$txt_chu_thich."','".$post_type."'");
            if(!is_dir($desired_dir)){
                mkdir($desired_dir, 0700);		// Create directory if it does not exist
            }
            if(!is_dir("'$desired_dir'".$file_name)){// Kiem tra da co file chưa
                move_uploaded_file($file_tmp,$desired_dir.$id."-".$file_name);
            }else{//rename the file if another one exist
                $new_dir=$desired_dir.$id."-".$file_name;
                rename($file_tmp,$new_dir);			
            }
            $db->query("update post_album_menu set hinh = '".$id."-".$file_name."',dir='".$dir."' where id = '".$id."'");
		 //mysql_query($query);			
        }else{
            //print_r($errors);
            echo "<p class='text-error'>".$errors."<p>";
        }
    }
	if(empty($errors)){
		echo "<p class='text-error'>Cập nhật hình ảnh thành công!<p>";
	}
    }else{
        echo "<p class='text-error'>Vui lòng chọn file!<p>";
    }
}
$token = md5(uniqid(rand(),true));
$_SESSION['token'] = $token;
?>
<form class="form-upload-multi" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
	<input type="file" name="files[]" multiple/>
    <button type="submit" class="btn btn-success">Upload</button>
</form>                
<?php 
function GeraHash($qtd){ 
//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
$QuantidadeCaracteres = strlen($Caracteres); 
$QuantidadeCaracteres--; 
$Hash=NULL; 
    for($x=1;$x<=$qtd;$x++){ 
        $Posicao = rand(0,$QuantidadeCaracteres);
        $Hash .= substr($Caracteres,$Posicao,1);
    }
return $Hash; 
} 
//Here you specify how many characters the returning string must have 
//echo GeraHash(30);
?>
</div>
<div class="clear"></div>
<div class="block-showfile">
<form method="post" onsubmit="return confirm('Bạn có chắt không ?');">
    <input type="hidden" name="id" value="<?=$id?>" />
    <input type="hidden" name="post_type" value="<?=$post_type?>" />
    <input type="hidden" name="txt_cat" value="<?=$txt_cat?>" />
    <input type="hidden" name="sp_id" value="<?=$sp_id?>" />
<?php
    $qc = $db->select("vn_cat","_anhsp = 1","order by thu_tu desc");
    $rc = $db->fetch($qc);
    $qs	= $db->select("post_album_menu","cat='".$rc['id']."' and sp_id='".$sp_id."' and post_type='".$post_type."'","order by id desc");    
	while ($rs = $db->fetch($qs))
	{
    ?>
    <div class="list-showfile">
        <div class="box-showfile">
            <img class="img-responsive img-showfile" src="<?=$domain?>/uploads/<?=$rs['dir'].$rs['hinh']?>"/>
            <div class="action-showfile myElement">
                <a class="del-showfile" href="?act=media&delete=<?=$rs["id"]?>&txt_cat=<?=$txt_cat?>&sp_id=<?=$sp_id?>&post_type=<?=$post_type?>" onclick="return confirm('Bạn có chắc?');">Del</a>
                <a class="edit-showfile" href="?act=album_manager_edit&id=<?=$rs["id"]?>&sp_id=<?=$sp_id?>&post_type=<?=$post_type?>">Edit</a>
                <input name="tik[]" type="checkbox" value="<?=$rs["id"]?>" />
            </div>
        </div>
    </div>
    <?}?>
    <?if($db->num_rows($qs)!=0){?>
    <div class="button-del-showfile">
        <input type="checkbox" id="checkAll" />Chọn nhiều
        <button type="submit" class="btn btn-danger" name="func" value="del">Del</button>
    </div>
    <?}?>
    <div class="clear"></div>
</form>
</div>
<script>
$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>


                    
                          
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>