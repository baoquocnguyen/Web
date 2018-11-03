<?php 
include "../function.php";
include "../../_CORE/index.php";
include "../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

$page = $_GET['page'];

$query = '';
$folder = ($_GET['folder'])?((empty($query))?($query.="dir_folder = '".$_GET['folder']."'"):($query.=" and dir_folder = '".$_GET['folder']."'")):($query);
$item = ($_GET['item'])?((empty($query))?($query.="mine = '".$_GET['item']."'"):($query.=" and mine = '".$_GET['item']."'")):($query);

$page       =   $page + 0;
$perpage    =   18;
$r_all      =   $db->select("media_file",$query,"");
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
$qs = $db->select("media_file",$query,"ORDER BY time DESC LIMIT ".$min.", ".$max);
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
    var id = $(this).data('id');
    $("#media_remove").removeClass("hidden");
    $("#item-"+id).toggleClass("selected");
    $(".show-info-media").html("");
});
</script>
