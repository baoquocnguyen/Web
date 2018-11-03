<?php
include "../define.php";
include "../function.php";
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

if (isset($_FILES['files']) && !empty($_FILES['files'])&&isset($_POST['size'])) {
    $resize = $_POST['size']; //get size when isset size, default = ""
    $errors="";
    $valid_format     = array("jpg", "png", "gif", "jpeg","doc","docx","pdf","txt","xls","xlsx","mp3","AMR");
    foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
        $file_name    = $key.$_FILES['files']['name'][$key];
        $file_size    = $_FILES['files']['size'][$key];
        $file_tmp     = $_FILES['files']['tmp_name'][$key];
        $file_type    = $_FILES['files']['type'][$key];
        $format_file  = pathinfo($file_name,PATHINFO_EXTENSION); //png, jpg, ...
        if($file_size > 10485760)//$max_file_size = 1024*100; //100 kb
        {
            $errors="<div class='alert alert-warning alert-dismissable' role='alert'>
              <button type='button' class='close' data-dismiss='alert' style='right: 0'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
              <strong>Thất bại!</strong> Kích thước file phải <= 10MB
            </div>";
            //continue; // Skip large files
        }elseif($file_size==0){
            $errors="<div class='alert alert-warning alert-dismissable' role='alert'>
              <button type='button' class='close' data-dismiss='alert' style='right: 0'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
              <strong>Lỗi!</strong> Chưa chọn file.
            </div>";
            //continue; // Skip large files
        }elseif(!in_array($format_file,$valid_format))//Kiểm tra định dạng file
        {
            $errors="<div class='alert alert-warning alert-dismissable' role='alert'>
          <button type='button' class='close' data-dismiss='alert' style='right: 0'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
          <strong>Thất bại!</strong> File ('.$file_type.$format_file.') không được hỗ trợ.
        </div>";
            //continue; // Skip invalid file formats
        };
        $mine_file = '';
        $valid_image = array("jpg", "png", "gif", "jpeg","JPG", "PNG", "GIF", "JPEG");
        (in_array($format_file,$valid_image)==1)?$mine_file = 'image':$mine_file = 'file';//kiểm tra file upload là image hay file. Tùy biến nếu thêm audio, video.
        $media_folder = date("m").'-'.date("Y");
        $name = str_replace(".".$format_file,"",$_FILES['files']['name'][$key]);
        $media_name = lg_string::get_link($name);
        $media_file_name = $media_name.".".$format_file;
        
        if(empty($errors)==true){
            $get_file_name = $db->select("media_file","file_name='".$media_file_name."'");
            $count = $db->num_rows($get_file_name); // kiểm tra tồn tại $media_file_name
            $id = $db->insert("media_file","name, dir_folder, file_name, file_size, file_type,mine","'".$name."','".$media_folder."','".$media_file_name."','".$file_size."','".$format_file."','".$mine_file."'"); //insert and get $id insert
            if(!is_dir("../../uploads/".$media_folder)){
                mkdir("../../uploads/".$media_folder, 0777);        // Create directory if it does not exist
            }
            
            if(($count) == 0){// Kiem tra da co file chưa
                move_uploaded_file($file_tmp,"../../uploads/".$media_folder.'/'.$media_file_name);
                if($mine_file=='image'){
                    resize_px("../../uploads/".$media_folder.'/'.$media_file_name,$resize,$format_file);
                }
            }else{ // đã tồn tại thì qua bước này
                $out_file_name = $media_name.'-'.$id.'.'.$format_file;
                move_uploaded_file($file_tmp,"../../uploads/".$media_folder.'/'.$out_file_name);
                if($mine_file=='image'){
                    resize_px("../../uploads/".$media_folder.'/'.$out_file_name,$resize,$format_file);
                }
                $db->query("update media_file set file_name = '".$out_file_name."' where id = '".$id."'");
            }
         //mysql_query($query);         
        }else{
            //print_r($errors);
            echo "<p class='text-error'>".$errors."<p>";
        }
    }
    if(empty($errors)){
        echo "
        <div class='alert alert-success alert-dismissable' role='alert'>
          <button type='button' class='close' data-dismiss='alert' style='right: 0'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
          <strong>Thành công!</strong> Đã upload file.
        </div>
        ";
    }
}else{
    echo "<div class='alert alert-warning alert-dismissable' role='alert'>
          <button type='button' class='close' data-dismiss='alert' style='right: 0'><span aria-hidden='true'>&times;</span><span class='sr-only'>Close</span></button>
          <strong>Thất bại!</strong> Chưa chọn file.
        </div>";
};


$page=1;
$page       =   $page + 0;
$perpage    =   18;
$r_all      =   $db->select("media_file","","");
$sum        =   $db->num_rows($r_all); 
$pages      =   ($sum-($sum%$perpage))/$perpage;
    if ($sum % $perpage <> 0)
        {
            $pages = $pages + 1;
        }
$page       =   ($page==0)?1:(($page>$pages)?$pages:$page);
$min        =   abs($page-1) * $perpage;
$max        =   $perpage;
showPage($page, $pages);

$qs = $db->select("media_file","","ORDER BY time DESC LIMIT ".$min.", ".$max);
if($db->num_rows($qs) > 0){
    while($rs = $db->fetch($qs)){
        $path_img   = $domain."/uploads/".$rs['dir_folder'].'/'.$rs['file_name'];
        $path_file  = 'images/file.png';
        echo
        "<div class='col-xs-2 padding-col'>
            <div class='block-rs block_media'>
                <label id='item-".$rs["id"]."' class='intosub-cl' data-id='".$rs["id"]."' data-act='block_media' data-type='".$rs['file_type']."' data-mine='".$rs['mine']."' data-name='".$rs['file_name']."' data-url='".(($rs['mine']=='image')?$path_img:$path_file)."'></label>";
                if($rs['mine']=='image'){
                    echo "<div class='block-filetype'><img class='img-responsive' src='".$path_img."' title='".$rs['file_name']."' /></div>";
                }else{
                    echo "<div class='block-filetype'>
                    <img class='img-responsive' src='".$path_file."' title='".$rs['file_name']."' />
                    <span class='block-textfile'>.".$rs['file_type']."</span> 

                    </div>";
                };
                echo "<span class='block-rs-info ".(($rs['mine']=='image')?'':'info-img')."'>
                        <p class='hide' id='url-".$rs['id']."'>".$domain.'/uploads/'.$rs['dir_folder'].'/'.$rs['file_name']."</p>
                        <p id='name-".$rs['id']."'><input onchange=\"media_option('rename','".$rs['id']."',this.value)\" value='".$rs['name']."' /></p>
                        <p>".$rs['time']."<a onclick=notify('url-".$rs['id']."') href='javascript:void(0)' title='Copy link'><i class='fa fa-link' aria-hidden='true'></i></a></p>
                        <p class='size'>".get_size_image($domain.'/uploads/'.$rs['dir_folder'].'/'.$rs['file_name'])."</p>".(($rs['mine']!='file')?' - ':'')."<p class='size'>".file_size($rs['file_size'])."</p>
                    </span>
            </div>
        </div>";
        }
    
    }else{
        echo "<div style='height: 480px'><img class='no-img' src='../".admin_url."/images/no-img.png' /></div>";
    }
?>
<script type="text/javascript">
$('.intosub-cl').click(function(){
    var act = $(this).data('act');
    var id = $(this).data('id');
    $(".media_remove_"+act).removeClass("hidden");
    $('.'+act).find("#item-"+id).toggleClass("selected");
});
</script>