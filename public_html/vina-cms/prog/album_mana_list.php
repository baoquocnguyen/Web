<?php
    global $db;
    $cat            =   $_GET['cat'];
    $parent_type    =   $_GET['parent_type'];
    $type           =   $_GET['type'];
    $post_type           =   $_GET['post_type'];
	if($parent_type=='post'){
        $qt = $db->get_post_field("ten","post_id='".$cat."'");
        $rt = $db->fetch($qt);
        $name=$rt['ten'];
        $link='?act=post_edit&id='.$cat.'&post_type='.$post_type;
    }elseif($parent_type=='postcat'){
        $qt = $db->selectpostcat("postcat_id='".$cat."'","");
        $rt = $db->fetch($qt);
        $name=$rt['name'];
        $link='?act=postcat_list&post_type='.$post_type;
    }
    
?>
<section class="content-header">
    <h1>[ Album ] <?=$name?><small>Version 5.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li class="active"><a href="<?=$link?>"><i class="fa fa-sign-out fa-rotate-180" aria-hidden="true"></i> <?=$name?></a></li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <style type="text/css">
                        .btn-nav-media{padding: 0 20px}
                        .btn-nav-media ul li{list-style: none;}
                    </style>
                    <div class="paddinglr10">
                        <div class="btn-nav-media">
                            <a class="btn btn-info" title="<?=$name?>" href="<?=$link?>"><i class="fa fa-sign-out fa-rotate-180" aria-hidden="true"></i></a>
                            <a class="fancybox fancybox.ajax btn btn-danger" href="<?=$domain?>/<?=admin_url?>/prog/templates/block_media.php" id="set_single" data-key='multi' data-parent='<?=$cat?>' data-par-type='<?=$parent_type?>' data-type='<?=$type?>' data-act='album_mana_list'><i class="fa fa-cloud-upload" aria-hidden="true"></i> <span>Upload Image&hellip;</a> <!--#media contain on main.php-->
                        </div>
                        <div class="col-md-12 block-showfile">
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
                            		<div class='block-rs album_mana_list'>
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
                                        <label id='item-<?=$r1["id"]?>' class='intosub-cl' data-id='<?=$r1["id"]?>' data-act='album_mana_list'></label>
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
                                <a href="javascript:void(0)" class="btn btn-primary <?=($db->num_rows($qs)>0)?'visible':'hidden'?> media_selectall_album_mana_list">
                                    <label style="margin-bottom: 0; cursor: pointer;"  onclick="media_selectall('album_mana_list')">Select All</label>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-primary hidden media_cancelall_album_mana_list">
                                    <label style="margin-bottom: 0; cursor: pointer;"  onclick="media_cancelall('album_mana_list')">Cancel All</label>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-danger hidden media_remove_album_mana_list" onclick="album_remove('album_mana_list')">
                                    <label style="margin-bottom: 0; cursor: pointer;"><i class="fa fa-trash" aria-hidden="true"></i></label>
                                </a>
                            </div>
                            <?}?>
                            <div class="clear"></div>
                        </form>
                        </div>
                    </div>
                    <div class="col-md-4 show-info-media">
                            
                    </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
</section>