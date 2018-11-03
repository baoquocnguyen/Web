<?php 
    include "../../_CORE/index.php";
    include "../../app/config/config.php";
    $db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
    
    $event      = $_GET['event'];           // get data form function media_option(event,folder)
    $pathdir    = $_GET['pathdir']; 
    $custom     = $_GET['custom'];          // $custom tùy chỉnh, có hay không cũng được, để lấy giá trị tham số thứ 3 trong hàm khi cần
if($event == 'rename') { 
                                                    // Rename Folder 
    $qs = $db->select("media_file","id = '".$pathdir."'","");
    $rs = $db->fetch($qs);
    
    
    $media_name = $custom;
    $media_file_type = pathinfo($rs['file_name'],PATHINFO_EXTENSION);
    $media_file_dir = lg_string::slug($custom).'-'.$pathdir.'.'.$media_file_type;
    $db->query("update media_file set name = '".$media_name."',file_name = '".$media_file_dir."' where id = '".$pathdir."'");
    
    rename('../../uploads/'.$rs['dir_folder'].'/'.$rs['file_name'],'../../uploads/'.$rs['dir_folder'].'/'.$media_file_dir);
};
?>