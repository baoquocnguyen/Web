<?php
    $cat            =   $_GET['txt_cat'];
    $type           =   'gallery';
    $parent_type    =   'gallery';
    
    $func = $_POST['func'];
    $tik = $_POST['tik'];
    
	if ($func == "del")
    {
        foreach($tik as $id){
            $db->delete("media_relationship","id='".$id."' and parent_id='".$cat."' and type='gallery'");
        }
    	//admin_load("","?act=media_list&cat=".$cat."&catalog=".$catalog."&post_type=".$post_type."");
    }
    $qm = $db->select("vn_gallery_menu_lang","gallery_menu_id='".$cat."'");
    $rm = $db->fetch($qm);
?>
<section class="content-header">
    <h1>[ Gallery ] <?=$rm['ten']?><small>Version 4.4</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=gallery_manager&post_type=catgal">Manager</a></li>
        <li class="active"><?=$rm['ten']?></li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <div class="paddinglr10">
                        <div class="btn-nav-media">
                            <a class="btn btn-info" title="<?=$rm['ten']?>" href="?act=gallery_manager&post_type=catgal"><i class="fa fa-sign-out fa-rotate-180" aria-hidden="true"></i></a>
                            <a class="fancybox fancybox.ajax btn btn-danger" href="<?=$domain?>/<?=admin_url?>/prog/templates/block_media.php" id="set_single" data-key='multi' data-parent='<?=$cat?>' data-par-type='<?=$parent_type?>' data-type='<?=$type?>' data-act='media_gal'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <span>Upload Image&hellip;</a> <!--#media contain on main.php-->
                        </div>
                        <div class="block-showfile col-md-12">
                        <form method="post" onsubmit="return confirm('Bạn có chắt không ?');">
                            <input type="hidden" name="id" value="<?=$id?>" />
                            <ul id="sortable">
                            <?php
                            $q1=$db->selectmedia("parent_id='".$cat."' and parent_type='".$parent_type."' and type='".$type."'","ORDER BY thu_tu");
                            while($r1=$db->fetch($q1))
                            {
                                $path_img   = $domain."/uploads/".$r1['dir_folder'].'/'.$r1['file_name'];
                                $path_file  = $domain.'/'.admin_url.'/images/file.png';
                            ?>
                            	<li id="<?=$r1['id'];?>">
                            		<div class='block-rs media_gal'>
                                        <?php
                                        if($r1['mine']=='image'){
                                            echo "<div class='block-filetype'><img class='img-responsive' src='".$path_img."' title='".$r1['file_name']."' /></div>";
                                        }else{
                                            echo "<div class='block-filetypealbum'>
                                            <img class='img-responsive' src='".$path_file."' title='".$r1['file_name']."' />
                                            <span class='block-textfile'>.".$r1['file_type']."</span> 
                                            <p>".$r1['file_name']."</p>
                                            </div>";
                                        };?>
                                        <label id='item-<?=$r1["id"]?>' class='intosub-cl' data-id='<?=$r1["id"]?>' data-act='media_gal'></label>  
                                        <a data-filetype='<?=$r1["file_type"]?>' data-filesize='<?=file_size($r1["file_size"])?>' data-filetime='<?=$r1["time"]?>' data-image='<?php echo (($r1['mine']=='image')?$path_img:$path_file)?>' data-size='<?=get_size_image($domain.'/uploads/'.$r1['dir_folder'].'/'.$r1['file_name'])?>' data-id='<?=$r1["id"]?>' data-title='<?=$r1["title"]?>' data-note='<?=$r1["note"]?>' data-url='<?=$r1["url"]?>' class="edit-item block-btn-edit block-edit-<?=$r1["id"]?>" href="javascript:;void(0)"></a>
                            		</div>
                            		<input type="hidden" id="table_sortable" value="media_relationship" />
                            	</li>
                            <?}?>
                            </ul>
                            <?if($db->num_rows($q1)!=0){?>
                            <div class="button-del-showfile" style="top: -34px; right: 20px">
                                <?php
                                $qs = $db->select("media_file","","ORDER BY time DESC");
                                ?>
                                <a href="javascript:void(0)" class="btn btn-primary <?=($db->num_rows($qs)>0)?'visible':'hidden'?> media_selectall_media_gal">
                                    <label style="margin-bottom: 0; cursor: pointer;"  onclick="media_selectall('media_gal')">Select All</label>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-primary hidden media_cancelall_media_gal">
                                    <label style="margin-bottom: 0; cursor: pointer;"  onclick="media_cancelall('media_gal')">Cancel All</label>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger hidden media_remove_media_gal" onclick="album_remove('media_gal')">
                                    <label style="margin-bottom: 0; cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></label>
                                </a>
                            </div>
                            <?}?>
                            <div class="clear"></div>
                        </form>
                        </div>  
                        <div class="show-info-media col-md-1">
                            
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
.show-info-media a {
    
}
</script>