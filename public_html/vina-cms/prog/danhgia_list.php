<?
$id = htmlspecialchars($_REQUEST['id']);

	//	Kiểm tra sự tồn tại của ID
    $func = $_POST['func'];
    if ($_POST["func"]=="del") $id = $_POST["id"]; else $id = $_GET['id'];
    $tik = $_POST['tik'];
	
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("vn_danhgia","id = '".$tik[$i]."'");
		}
		admin_load("","?act=danhgia_list");
		die();
	}
?>
<section class="content-header">
    <h1>Đánh giá<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home">AdminCP</a></li>
        <li><a href="?act=gallery_manager&post_type=catgal">Đánh giá</a></li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Quản lý đánh giá</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                            <a href="?act=danhgia_new">Thêm mới</a>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
						<form action="?act=danhgia_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
						<input type="hidden" name="func" value="del" />
						<input type="hidden" name="id" value="<?=$id?>" />
						<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr class="tb_head">
							<td>Order <?=$tik?> </td>
							<td>Người đăng</td>
						    <td>Đánh giá sao</td>
							<td>Email</td>
						    <td>Sản phẩm</td>
							<td>Kiểm duyệt</td>
						    <td>Thời gian</td>
							<td>Vào duyệt</td>
						    <td>Xóa</td>
						</tr>
						<?php

						$page		=	$page + 0;
						$perpage	=	20;
						$r_all		=	$db->select("vn_danhgia","","");
						if($r_all){
						    $sum       =   $db->num_rows($r_all);
						}
						$pages		=	($sum-($sum%$perpage))/$perpage;
						if ($sum % $perpage <> 0 )	$pages = $pages+1;
						$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
						$min 		= 	abs($page-1) * $perpage;
						$max 		= 	$perpage;

						$count	=	$min;
						$r		=	$db->select("vn_danhgia","","order by id desc limit $min, $max");
						while ($row = $db->fetch($r))
						{
							$count++;
						?>
						<tr class="tb_content">
							<td><?=$count?></td>
						  
							<td><?=$row["ten"]?></td>
						    <td>
						        <?for($i=0;$i<$row["danhgia"];$i++){
						            ?>
						           <i style="color: #FFB400;" class="fa fa-star" aria-hidden="true"></i>
						            <?    
						            }
						        ?>
						    </td>
						    <td><?=$row["email"]?></td>
						    <?
						    global $db;
						    $q1=$db->selectpost("hien_thi=1 and post_id='".$row['cat']."'","");
						    $r1=$db->fetch($q1);
						    ?>
						    <td><?=$r1["ten"]?></td>
							<td><?=$row["kiem_duyet"]==1?"<img src=\"images/true.png\" />":"<img src=\"images/false.png\" />"?></td>

						    <td><?=date('d/m/Y',$row['time'])?></td>
							<td><a href="?act=danhgia_edit&id=<?=$row["id"]?>">Duyệt</a></td>
						    <td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
						</tr>
						<?
						}
						?>
						<tr class="tb_foot">
							<td colspan="8" style="text-align:left;">
								<strong>Page : </strong>
		<?php
			if ($pages==0) echo ":1:";
    		for($i=1;$i<=$pages;$i++) {
    			if ($i==$page) echo "<b>[".$i."]</b>";
    			else {
					echo "<a href='?act=danhgia_list&page=$i'>-$i-</a>";
				}
			}
    	?>
	</td>
    <td><input type="submit" value="Del" class="nut_button" style="width:80%;" /></td>
	
</tr>
</table>
</table>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>