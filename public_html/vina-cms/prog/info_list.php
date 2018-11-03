<?php

    $id = $_POST['id'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("vn_page","id = '".$tik[$i]."'");
            $db->delete("vn_page_lang","page_id = '".$tik[$i]."'");
		}
		admin_load("","?act=info_list");
		die();
	}
?>
<section class="content-header">
    <h1>Info list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Info list</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Đoạn thông tin</h3>
                    <div class="box-tools pull-right">
                        <?php if($_SESSION["level"]==0){?>
                        <span class="function">
                            <a href="?act=info_new">Thêm mới</a>
                        </span>
                        <?php }?>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                    <form action="?act=info_list" method="post" onsubmit="return confirm('Bạn có muốn xóa không ?');">
                    <input type="hidden" name="func" value="del" />
                    <input type="hidden" name="id" value="<?=$id?>" />
                    <table class="table table-striped">
                    <thead>
                        <tr class="tb_head">
                        	<th>#</th>
                        	<th>Tên mục</th>
                        	<th>Alias</th>
                            <th>Images</th>
                        	<th>Lượt xem</th>
                        	<th>Ngày cập nhật</th>
                        	<th>Người đăng</th>
                        	<th>Sửa</th>
                        	<th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $r		=	$db->select("vn_page","post_type=''","order by option1,id desc");
                    while ($row = $db->fetch($r))
                    {
                        $qlang	= $db->select("vn_page_lang","page_id = '".$row['id']."'","order by id limit 1");
                       	$rlang = $db->fetch($qlang);
                    	$count++;
                    ?>
                    <tr>
                    	<th scope="row"><?=$count?></th>
                    	<td><span class="url cat1"><?=$rlang["ten"]?></span><br /></td>
                    	<td><span style="color: #DD4B39;">Langid <?=$row["id"]?> - <?=$row["alias"]?></span></td>
                        <td class="img-post"><?php echo get_image_avata($row["id"],'info','avatar')?></td>
                    	<td><?=$row["luot_xem"]?> views</td>
                    	<td><?=lg_date::vn_time($row["time"])?></td>
                    	<td><?=get_user($row["user"],"username")?></td>
                    	<td class="<?if($row['noi_dung']!=''){echo 'bg_tr';}?>"><a href="?act=info_edit&id=<?=$row["id"]?>">Sửa</a></td>
                    	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                    </tr>
                    <?
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                    	<td colspan="8">&nbsp;</td>
                    	<td><input type="submit" value="Xóa" class="btn btn-success"/></td>
                    </tr>
                    </tfoot>
                    </table>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>