<?php
$act = "";
$act = (!empty($_GET['act']))?$_GET['act']:"cc";
if($act != "block_media"){
include "../../define.php";
include "../../function.php";
include "../../../_CORE/index.php";
include "../../../app/config/config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
}
if(!isset($page)){$page='';}
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

?>
<section class="content-header">
    <h1>MEDIA<small>Version 5.0 (Open beta)</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li class="active">Media</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="block-media">
                <div class="col-xs-12" style="padding: 0;">    
                    <div class="block-folder-new">
                        <span>
                            <a id="media-upload" class="btn btn-primary" onclick="media_upload()" href="javascript:void(0)"><i class="fa fa-upload" aria-hidden="true"></i> Uploads</a>
                        </span>
                        <span>
                            <?php
                            $rs_item = '';
                            $qs = $db->query("SELECT DISTINCT mine FROM media_file");
                            while($rs = $db->fetch($qs)){
                                $rs_item .= "<option value='".$rs['mine']."'>".$rs['mine']."</option>";
                            };
                            echo "<select class='btn btn-success' id='media_items' data-folder='' onchange='media_select()'><option value=''>All menu items</option>".$rs_item."</select>";
                            ?>
                        </span>
                        <span>
                            <?php 
                            $rs_folder = '';
                            $qs = $db->query("SELECT DISTINCT dir_folder FROM media_file");
                            while($rs = $db->fetch($qs)){
                                $rs_folder .= "<option value='".$rs['dir_folder']."'>".$rs['dir_folder']."</option>";
                            };
                            echo "<select class='btn btn-success' id='media_folder' data-item onchange='media_select()'><option value=''>All date</option>".$rs_folder."</select>";
                            ?>
                        </span>
                        <!-- 
                        <span>
                            <?php 
                            $rs_folder = '';
                            $qs = $db->query("SELECT DATE(time) AS ForDate FROM media_file GROUP BY DATE(time) ORDER BY ForDate");
                            while($rs = $db->fetch($qs)){
                                $rs_folder .= "<option value='".$rs['ForDate']."'>".$rs['ForDate']."</option>";
                            };
                            echo "<select class='btn btn-success' id='media_folder' data-item onchange='media_select()'><option value=''>All date</option>".$rs_folder."</select>";
                            ?>
                        </span> -->
                        
                        <span style="float: right;">
                            <?php
                            $qs = $db->select("media_file","","ORDER BY time DESC");
                            ?>
                            <a href="javascript:void(0)" class="btn btn-primary <?=($db->num_rows($qs)>0)?'visible':'hidden'?> media_selectall_block_media">
                                <label style="margin-bottom: 0; cursor: pointer;"  onclick="media_selectall('block_media')">Select All</label>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-primary hidden media_cancelall_block_media">
                                <label style="margin-bottom: 0; cursor: pointer;"  onclick="media_cancelall('block_media')">Cancel All</label>
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger hidden media_remove_block_media"  onclick="media_remove()">
                                <label style="margin-bottom: 0; cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></label>
                            </a>
                            
                            <?php if($act != 'block_media'){?>
                            <a href="javascript:void(0)" class="btn btn-danger" onclick="media_submit()">
                                <label style="margin-bottom: 0; cursor: pointer;">Insert</label>
                            </a>
                            <?php } ?>
                        </span>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0;">
                    <div class="block-upload-file" style="display: none;">
                        <div class="col-sm-4">
                            <span>
                                <h4 style="margin-bottom: 0"><label>Ghi chú:</label></h4>
                                <small>Chọn kích thước trước khi upload hình ảnh</small>
                                <?php
                                $qbien = $db->select("vn_bien","nhom='RESIZE'","ORDER BY sort");
                                while($rbien = $db->fetch($qbien)){
                                    echo "<p> <strong>+ ".$rbien['ten'].':</strong> '.$rbien['gia_tri']."</p>";
                                }
                                ?>
                            </span>
                        </div>
                        <div class="col-sm-8">
                        
                            <div class="block-upload-multi">
                                <div class='alert alert-info alert-dismissable' role='alert'>
                                    <form class="form-upload-multi" action="" method="POST"  enctype="multipart/form-data" style="width: 100%;">
                                        <span id="file-reset">
                                            <input type="file" id="multiFiles" name="files[]" multiple="multiple" style="margin-bottom: 10px;" />
                                        </span>
                                        <select id="media_size" class='btn btn-info' name="size">
                                            <option selected="" value="">Auto Size</option>
                                            <?php
                                            $q_vnbien = $db->select("vn_bien","NHOM = 'RESIZE'");
                                            while($r_vnbien = $db->fetch($q_vnbien)){
                                            ?>
                                            <option value="<?php echo $r_vnbien['gia_tri']?>"><?php echo $r_vnbien['gia_tri']?></option>
                                            <?php } ?>
                                        </select>
                                        <input readonly="" onclick="uploads()" class='btn btn-success' value="Upload" />
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div id="scroll-lazy" class="col-sm-12" style="padding: 0; overflow-y: scroll; max-height: 500px">
                        <div class="block-folder-rs" id="#selectable">
                            <span><?=showPage($page, $pages);?></span>
                            <?php
                            $qs = $db->select("media_file","","ORDER BY time DESC LIMIT ".$min.", ".$max);
                            if($qs->num_rows > 0){
                                while($rs = $db->fetch($qs)){
                                    $path_img   = $domain."/uploads/".$rs['dir_folder'].'/'.$rs['file_name'];
                                    $path_file  = 'images/file.png';
                                echo
                                "<div class='col-xs-2 padding-col'>
                                    <div class='block-rs block_media'>
                                        <label id='item-".$rs["id"]."' class='intosub-cl' data-id='".$rs["id"]."' data-act='block_media' data-type='".$rs['file_type']."' data-mine='".$rs['mine']."' data-name='".$rs['file_name']."' data-url='".(($rs['mine']=='image')?$path_img:$path_file)."'></label>";
                                        if($rs['mine']=='image'){
                                            echo "<div class='block-filetype'><img class='lazy img-responsive' data-original='".$path_img."' title='".$rs['file_name']."' /></div>";
                                        }else{
                                            echo "<div class='block-filetype'>
                                            <img class='lazy img-responsive' data-original='".$path_file."' title='".$rs['file_name']."' />
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
                        </div>
                    </div>
                </div>
                <div style="clear: both;"></div>
                <div id="block-loadding"><img style="display: none;" src="<?=$domain?>/<?=admin_url?>/images/load.gif" /></div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
!function(a,b,c,d){var e=a(b);a.fn.lazyload=function(f){function g(){var b=0;i.each(function(){var c=a(this);if(!j.skip_invisible||c.is(":visible"))if(a.abovethetop(this,j)||a.leftofbegin(this,j));else if(a.belowthefold(this,j)||a.rightoffold(this,j)){if(++b>j.failure_limit)return!1}else c.trigger("appear"),b=0})}var h,i=this,j={threshold:0,failure_limit:0,event:"scroll",effect:"show",container:b,data_attribute:"original",skip_invisible:!1,appear:null,load:null,placeholder:"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"};return f&&(d!==f.failurelimit&&(f.failure_limit=f.failurelimit,delete f.failurelimit),d!==f.effectspeed&&(f.effect_speed=f.effectspeed,delete f.effectspeed),a.extend(j,f)),h=j.container===d||j.container===b?e:a(j.container),0===j.event.indexOf("scroll")&&h.bind(j.event,function(){return g()}),this.each(function(){var b=this,c=a(b);b.loaded=!1,(c.attr("src")===d||c.attr("src")===!1)&&c.is("img")&&c.attr("src",j.placeholder),c.one("appear",function(){if(!this.loaded){if(j.appear){var d=i.length;j.appear.call(b,d,j)}a("<img />").bind("load",function(){var d=c.attr("data-"+j.data_attribute);c.hide(),c.is("img")?c.attr("src",d):c.css("background-image","url('"+d+"')"),c[j.effect](j.effect_speed),b.loaded=!0;var e=a.grep(i,function(a){return!a.loaded});if(i=a(e),j.load){var f=i.length;j.load.call(b,f,j)}}).attr("src",c.attr("data-"+j.data_attribute))}}),0!==j.event.indexOf("scroll")&&c.bind(j.event,function(){b.loaded||c.trigger("appear")})}),e.bind("resize",function(){g()}),/(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion)&&e.bind("pageshow",function(b){b.originalEvent&&b.originalEvent.persisted&&i.each(function(){a(this).trigger("appear")})}),a(c).ready(function(){g()}),this},a.belowthefold=function(c,f){var g;return g=f.container===d||f.container===b?(b.innerHeight?b.innerHeight:e.height())+e.scrollTop():a(f.container).offset().top+a(f.container).height(),g<=a(c).offset().top-f.threshold},a.rightoffold=function(c,f){var g;return g=f.container===d||f.container===b?e.width()+e.scrollLeft():a(f.container).offset().left+a(f.container).width(),g<=a(c).offset().left-f.threshold},a.abovethetop=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollTop():a(f.container).offset().top,g>=a(c).offset().top+f.threshold+a(c).height()},a.leftofbegin=function(c,f){var g;return g=f.container===d||f.container===b?e.scrollLeft():a(f.container).offset().left,g>=a(c).offset().left+f.threshold+a(c).width()},a.inviewport=function(b,c){return!(a.rightoffold(b,c)||a.leftofbegin(b,c)||a.belowthefold(b,c)||a.abovethetop(b,c))},a.extend(a.expr[":"],{"below-the-fold":function(b){return a.belowthefold(b,{threshold:0})},"above-the-top":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-screen":function(b){return a.rightoffold(b,{threshold:0})},"left-of-screen":function(b){return!a.rightoffold(b,{threshold:0})},"in-viewport":function(b){return a.inviewport(b,{threshold:0})},"above-the-fold":function(b){return!a.belowthefold(b,{threshold:0})},"right-of-fold":function(b){return a.rightoffold(b,{threshold:0})},"left-of-fold":function(b){return!a.rightoffold(b,{threshold:0})}})}(jQuery,window,document);
$(function() {
    $(":not(#scroll-lazy) img.lazy").lazyload({
        effect: "fadeIn"
    });
    $("img.lazy").lazyload({
        effect: "fadeIn",
        container: $("#scroll-lazy")
    });
});
</script>
<?php if ($act != "block_media"){?>
<script type="text/javascript">
$('.intosub-cl').click(function(){
    var act = $(this).data('act');
    var id = $(this).data('id');
    $(".media_remove_"+act).removeClass("hidden");
    $('.'+act).find("#item-"+id).toggleClass("selected");
});
</script>
<?}?>
<script type="text/javascript"> // media into post, page...

/**
* Nhập data-key tùy ý
* Dán đoạn code dưới vào vị trí muốn hiển thị Upload media
* <a class="fancybox btn btn-danger" href="#media" id="set_single" data-key='single'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <span>Upload Image&hellip;</a>
* Chọn từng images -> media_submit()
*/
$('.edit-item').click(function(){
    $(".block-showfile").addClass("col-md-8").removeClass("col-md-12");
    var act         = $(this).attr('data-act');
    var id          = $(this).attr('data-id');
    var size        = $(this).attr('data-size');
    var title       = $(this).attr('data-title');
    var note        = $(this).attr("data-note");
    var image       = $(this).attr('data-image');
    var url         = $(this).attr('data-url');
    var filetype    = $(this).attr('data-filetype');
    var filetime    = $(this).attr('data-filetime');
    var filesize    = $(this).attr('data-filesize');
        $(".show-info-media").hide().html('<div class="show-info-media-bg"><a onclick="close_showfile()" class="close-showfile" href="javascript:;void(0)"><i class="fa fa-chevron-right" aria-hidden="true"></i></a><div class="box-info"> <img class="img-responsive" src="'+image+'" /><p>File size: '+filesize+'</p><p>File type: '+filetype+'</p><p>Uploaded on: '+filetime+'</p><p>Dimensions: '+size+'</p></div><div class="box"><label>Link:</label> <input style="background-color: transparent;" type="text" readonly value="'+image+'"></div><div class="box"><label>Name:</label> <input id="rename" type="text" onchange="relationship_option('+"'rename'"+','+"'"+id+"'"+',this.value)" value="'+title+'"></div><div class="box"><label>Note:</label> <textarea id="renote" rows=3 onchange="relationship_option('+"'renote'"+','+"'"+id+"'"+',this.value)" >'+note+'</textarea></div><div class="box"><label>Url:</label> <input id="reurl" type="text" onchange="relationship_option('+"'reurl'"+','+"'"+id+"'"+',this.value)" value="'+url+'"></div></div>').addClass("col-md-4").removeClass("col-md-1").fadeIn(800); 
});


</script>