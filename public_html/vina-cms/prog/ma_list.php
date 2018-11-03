<?
if($_SESSION["level"]==0||$_SESSION["level"]==1)
{
$id = htmlspecialchars($_REQUEST['id']);
?>
<?php
	//	Kiểm tra sự tồn tại của ID
    $func = $_POST['func'];
    if ($_POST["func"]=="del") $id = $_POST["id"]; else $id = $_GET['id'];
    $tik = $_POST['tik'];
	
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("ma","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa","?act=ma_list");
		die();
	}
?>
<section class="content-header">
    <h1>Mã<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Mã</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Mã giảm giá</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                        	<?if($_SESSION["level"]==1||$_SESSION["level"]==0){?>
                            <a href="?act=ma_new">Thêm mã</a>    
                            <?}?>
                        </span>
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("ma","","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form action="?act=ma_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
                        <input type="hidden" name="func" value="del" />
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <table class="table">
                            <thead>
                                <tr>
                                	<th>#</th>
                                	<th>Mã</th>
                                	<th>Loại mã</th>
                                	<th>% chiết khấu</th>
                                	<th>Số lần sử dụng</th>
                                	<th>Số lần còn</th>
                                	<th>Ngày hết hạn</th>
                                	<th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?
                            $page		=	$page + 0;
                            $perpage	=	50;
                            $r_all		=	$db->select("ma","","");
                            $sum		=	$db->num_rows($r_all);
                            $pages		=	($sum-($sum%$perpage))/$perpage;
                            if ($sum % $perpage <> 0 )	$pages = $pages+1;
                            $page		=	($page==0)?1:(($page>$pages)?$pages:$page);
                            $min 		= 	abs($page-1) * $perpage;
                            $max 		= 	$perpage;
                            
                            $count	=	$min;
                            $r		=	$db->select("ma","","order by id desc limit $min, $max");
                            while ($row = $db->fetch($r))
                            {
                            	$count++;
                            ?>
                            <tr>
                            	<th scope="row"><?=$count?></th>
                            	<td><span style="color: #f00;"><?=$row["ten"]?></span></td>
                            	<td><?=$row["loai_ma"]==0?"Chiết khấu %":"Tính theo giá sỉ"?></td>
                            	<td><?=$row["chiet_khau"]?> %</td>
                            	<td><?=$row["so_lan_tong"]?></td>
                            	<td><?=$row["so_lan_con"]?></td>
                                <?
                                $ngayhientai = lg_date::time(time(),7);
                                $ngaydangbai = lg_date::date($row['thoi_gian'],"mm/dd/yy");
                                $date1=strtotime(str_replace('/', '-', $ngayhientai)); 
                                $date2=strtotime(str_replace('/', '-', $ngaydangbai));
                                $diff = $date1 - $date2;
                                $years = floor($diff / (365*60*60*24));
                                $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24) / (60*60*24));
                                ?>
                            	<td><?if($date1>=$date2){echo "<span style='color:red;font-size:16px'>Hết hạn</span><br/>".'<span class="sonho">'.lg_date::date($row['thoi_gian'],"mm/dd/yy").'</span>';}else{echo lg_date::date($row['thoi_gian'],"");}?></td>
                            	<td><a href="?act=ma_edit&id=<?=$row["id"]?>">Sửa</a></td>
                                <td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                            </tr>
                            <?
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                	<td colspan="8">
                                		<strong>Page : </strong>
                                		<?php
                                			if ($pages==0) echo ":1:";
                                    		for($i=1;$i<=$pages;$i++) {
                                    			if ($i==$page) echo "<b>[".$i."]</b>";
                                    			else {
                                					echo "<a href='?act=ma_list&page=$i'>-$i-</a>";
                                				}
                                			}
                                    	?>
                                	</td>
                                    <td><input type="submit" value="Del" class="btn btn-success" /></td>
                                </tr>
                            </tfoot>
                        </table>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?}else{?>
<div>Bạn không có quyền truy cập</div>
<?}?>
<script>
function reFresh() {
  window.open(location.reload(true))
}
window.setInterval("reFresh()",30000);
</script>
<style>
.sonho{font-size: 10px;}
</style>