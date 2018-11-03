<?  $level_arr	=	array("Coder","Administrator","Moderator","Member"); ?>
<div id="fw_menu">
	<ul id="menu_1">
		<li class="<?=($act=='home')?'active':''?>" onclick="Forward('?act=home');">Trang chủ</li>
        <li class="<?=($act=='gallery_manager'|$act=='page_list'|$act=='postcat_list'|$act=='post_list')?'active':''?>"><a href="?act=home">Danh mục</a>
            <ul>
                <li><a href="?act=postcat_list">Quản lý nội dung</a></li>
                <li><a href="?act=gallery_manager">Hình ảnh</a></li>
                <!--<li><a href="?act=list_list&id=1">Video</a></li>-->
                <li><a href="?act=page_list">Thông tin website</a></li>
            </ul>
        </li>        
        <li class="<?=($act=='productcat_list'|$act=='sanpham_list'|$act=='hangsx_list')?'active':''?>"><a href="?act=productcat_list">Hệ thống phòng</a>
            <ul>
                <li><a href="?act=book_phong">Hồ sơ đặt phòng</a></li>
            </ul>
        </li>
        <!--<li class="<?=($act=='donhang_list')?'active':''?>" onclick="Forward('?act=donhang_list');">Đơn hàng</li>-->
        <li class="<?=($act=='lienhe_list')?'active':''?>" onclick="Forward('?act=lienhe_list');">Email liên hệ
        </li>
        <li class="<?=($act=='other')?'active':''?>"><a href="?act=other">Cấu hình hệ thống</a>
            <ul>
                <li><a href="?act=backup">Backup SQL</a></li>
            </ul>
        </li>
        <?
        if($_SESSION["level"]==0||$_SESSION["level"]==1)
        {
            ?> <li onclick="Forward('?act=member_list');">Thành viên</li> <?
        }
        ?>
	</ul>
	<a class="home" href="<?=$domain?>" target="_blank">Về trang chủ website</a>
    <div id="tool">
        <form action="<?=$url?>" enctype="multipart/form-data" method="GET" style="margin:0px;" />
            <input type="hidden" name="logout" value="OK" />
            <input name="submit" type="submit" class="button2" value="Logout" />
        </form>
	</div>
</div>
<div id="fw_menu_2">
    <div style="float: left; padding-left: 20px;">
        <a class="go_back" href="javascript:history.go(-1)"> Quay lại</a>
        Hôm nay: <?=date('d/m/Y - g:i s A');?> | Đã có
        <b>
        <?php
            $gia_tri = 0;
            $r = $db->select("tgp_online_daily","");
            while ($row = $db->fetch($r))
            $gia_tri += $row["bo_dem"];
            echo $gia_tri;
        ?></b> số lượt truy cập website | Hiện có: <b>
        <?
            $r = mysql_query("SELECT * FROM tgp_online");
            $gia_tri = mysql_num_rows($r);
            echo '0'.$gia_tri;
        ?> </b> người online
    </div>
   Chào  <b><?=$_SESSION["username"]?></b> - Cấp độ: <b><?=$level_arr[$_SESSION["level"]]?></b> - <a href="?act=member_edit&id=<?=$_SESSION["id"]?>">Thông tin cá nhân</a>
</div>

<div id="searchbox">
    <form method="get" style="display: inline-block;">
        <p>Tìm nội dung trên hệ thống</p>
        <input type="hidden" name="act" value="search_list" />
        <span><strong>Tên:</strong></span>
        <input style="padding: 5px;border:1px solid #bababa;width: 150px;" name="key" placeholder="Tên.." value="<?=$key?>" />
        <span><strong>Mã:</strong></span>
        <input style="text-transform:uppercase; padding: 5px;border:1px solid #bababa;width: 100px;" name="masp" placeholder="Mã..." value="<?=$masp?>" />
        <span><strong>Mục:</strong></span>
        <select name="cat">
            <option value="0">Tất cả</option>
            <?
            $q=$db->select("productcat","cat=0","order by thu_tu, id");
            while($r=$db->fetch($q))
            {
                ?>
                <option value="<?=$r['id']?>" <?if(($act=='sanpham_list'&&$_GET['id']==$r['id'])|($act=='search_list'&&$_GET['cat']==$r['id'])){echo 'selected';}?>><?=$r['ten']?></option>
                <?
                $q1=$db->select("productcat","cat=".$r['id'],"order by thu_tu, id");
                while($r1=$db->fetch($q1))
                {
                ?>
                <option value="<?=$r1['id']?>" <?if(($act=='sanpham_list'&&$_GET['id']==$r1['id'])|($act=='search_list'&&$_GET['cat']==$r1['id'])){echo 'selected';}?>>&mdash;&nbsp;<?=$r1['ten']?></option>
                    <?
                    $q2=$db->select("productcat","cat=".$r1['id'],"order by thu_tu, id");
                    while($r2=$db->fetch($q2))
                    {
                    ?>
                    <option value="<?=$r2['id']?>" <?if(($act=='sanpham_list'&&$_GET['id']==$r2['id'])|($act=='search_list'&&$_GET['cat']==$r2['id'])){echo 'selected';}?>>&mdash;&mdash;&mdash;&nbsp;<?=$r2['ten']?></option>
                    <?
                    }
                }
            }
            ?>
        </select>
        <span><strong>Từ </strong></span><input style="width:  130px;" type="date" name="date" value="<?=$date?>" />
        <span> đến </span><input style="width:  130px;" type="date" placeholder="" name="date2" value="<?=$date2?>"/>
        
        <button style="padding: 5px 10px;" type="submit">Tìm</button>
        <a style="display: inline-block;text-decoration: none; cursor: pointer;background: brown;color:#fff;padding: 5px 10px;" onclick="Forward('?act=productcat_list');">Reset</a>
    </form>
<script type="text/javascript">
$(document).off("click","a.nhay").on("click","a.nhay",function(event){
    event.preventDefault();
    window.open($(this).attr('rel')+document.frm3.keyw.value,'_blank');
    });
</script>
    <div style="clear: both;"></div>
</div>
<style>
#searchbox
{
    padding: 15px;
}
#searchbox p
{
    display: inline-block;
    padding: 0px 10px;
    line-height: 30px;
    background: #27ae60;
    margin-right: 10px;
    font-weight: bold;
    color: #fff;
}
.nhay{text-decoration: none;
    display: inline-block;
    padding: 0px 10px;
    line-height: 30px;
    background: #686BCC;
    margin-right: 10px;
    font-weight: bold;
    color: #fff;}
</style>