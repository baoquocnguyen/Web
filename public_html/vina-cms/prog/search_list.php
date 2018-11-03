<?php
    $id = $_GET['id'];
    $page = $_GET['page'];
    $func = $_POST['func'];
    if ($_POST["func"]=="del") $h_id = $_POST["h_id"]; else $h_id = $_GET['h_id'];
    $tik = $_POST['tik'];
    
    $date=$_GET['date'];
    $date2=$_GET['date2'];
    $key=$_GET['key'];
    $masp=$_GET['masp'];
    $cat=$_GET['cat'];
    $cat1=$cat;
    if($cat<>'0'){$scat = "cat='".$cat."' and ";}
    $keyw='';
        if($date!=''&&$date2=='')
        {
            $keyw=" and time >= ".strtotime($date);
        }
        if($date==''&&$date2!='')
        {
            $keyw=" and time <= ".strtotime($date2.' 23:59:59');
        }
        if($date!=''&&$date2!='')
        {
            $keyw=" and time >= ".strtotime($date)." && time <= ".strtotime($date2.' 23:59:59');
        }
        if($date==''&&$date2=='')
        {
            $keyw="";
        }
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("sanpham","id = '".$tik[$i]."'");
            $qxoa=$db->select("vn_danhgia","cat='".$tik[$i]."'","");
            while($rxoa=$db->fetch($qxoa)){
                $db->delete("vn_danhgia","id = '".$rxoa['id']."'");
            }
		}
        
		admin_load("Đã xóa xong.","?act=search_list");
		die();
	}
?>
<font size="2" face="Tahoma"><b>Kết quả tìm kiếm</b></font>

<hr size="1" color="#cadadd" />

<center>
<form action="?act=sanpham_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
<input type="hidden" name="func" value="del" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="h_id" value="<?=$h_id?>" />
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td  style="width: 35px;">STT</td>
	<td >Hãng Sản Xuất</td>
	<td style="text-align: left;">Tên / Mã</td>
    <td>Hình ảnh</td>
    <td>Hiển thị</td>
    <td>Nổi bật</td>
	<td>Ngày đăng</td>
	<td>Người đăng</td>
	<td>Chỉnh sửa</td>
	<td>Xóa</td>
</tr>
<?php

$page		=	$page + 0;
$perpage	=	50;
if($masp<>'')
{
    $r_all		=	$db->select("sanpham",$scat."ten like '%$key%' and ma='".$masp."'".$keyw);  
}
else
{
    $r_all		=	$db->select("sanpham",$scat."ten like '%$key%'".$keyw);
}
  
$sum		=	$db->num_rows($r_all);
$pages		=	($sum-($sum%$perpage))/$perpage;
if ($sum % $perpage <> 0 )	$pages = $pages+1;
$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
$min 		= 	abs($page-1) * $perpage;
$max 		= 	$perpage;

$count	=	$min;
if($masp<>'')
{
    $r		=	$db->select("sanpham",$scat."ten like '%$key%' and ma='".$masp."'".$keyw,"order by id desc limit $min, $max");  
}
else
{
    $r		=	$db->select("sanpham",$scat."ten like '%$key%'".$keyw,"order by id desc limit $min, $max");
}
if($db->num_rows($r) != 0)
{
while ($row = $db->fetch($r))
{
    $qc	= $db->select("productcat","id = '".$row['cat']."'");
	$rc = $db->fetch($qc);
    $cat = $rc['ten'];
    if($row['cat']==0){$cat='Chưa phân loại';}
    $qh	= $db->select("hangsx","id = '".$row['hangsx']."'");
	$rh = $db->fetch($qh);
    $hang = $rh['ten'];
    if($row['hangsx']==0){$hang='Chưa xác định';}
    
	$count++;
?>
<tr class="tb_content">
	<td><?=$count?></td>
    <td><strong><?=$hang?></strong> /</td>
    <td style="text-align: left;"><strong>(<?=$cat?>) <?=$row["ten"]?></strong><br />Mã: <?=$row["ma"]?></td>
    <td><img src="../uploads/product/<?=$row['hinh']?>" width="40px"  /> </td>
    
	<!--<td><a href="?act=album_manager&cat=<?=$row["id"]?>"><img src="images/go_right.gif" border="0" /></a></td>
	-->
    
    
    <td><?=$row["hien_thi"]==1?"<img src=\"images/true.png\" />":"<img src=\"images/false.png\" />"?></td>
    <td><?=$row["noi_bat"]==1?"<img src=\"images/true.png\" />":"<img src=\"images/false.png\" />"?></td>
	<td><?=lg_date::vn_time($row["time"])?></td>
	<td><?=get_user($row["user"],"username")?></td>
	<td><a href="?act=sanpham_edit&id=<?=$row["id"]?>">Sửa</a></td>
	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
</tr>
<?
}}else{?>
    <tr class="tb_content">
	<td colspan="9" style="color: red;">Không có sản phẩm nào phù hợp</td>
    
</tr>
<?
}
?>
<tr class="tb_foot">
	<td colspan="9" style="text-align:left;">
		<strong>Trang : </strong>
		<?php
			if ($pages==0) echo ":1:";
    		for($i=1;$i<=$pages;$i++) {
    			if ($i==$page) echo "<b>[".$i."]</b>";
    			else {
					echo "<a href='?act=search_list&key=".$key."&masp=".$masp."&cat=".$cat1."&date=".$date."&date2=".$date2."&page=$i'>-$i-</a>";
				}
			}
    	?>
	</td>
	<td colspan="2"><input type="submit" value="Xóa" class="nut_button" style="width:80%;" /></td>
</tr>
</table>
</form>
</center>