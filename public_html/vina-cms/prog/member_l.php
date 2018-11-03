<?if($_SESSION["level"]==0||$_SESSION["level"]==1|get_phanquyen(17,$_SESSION["id"])==1){?>
<?
    $func = $_POST['func'];
    $tu_khoa=$_GET['tu_khoa'];
    if ($_POST["func"]=="del") $id = $_POST["id"]; else $id = $_GET['id'];
    $tik = $_POST['tik'];
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("vn_thanh_vien","id = '".$tik[$i]."'");
		}
		admin_load("","?act=member_list");
		die();
	}
    if($tu_khoa!=''){
    $keyw.="ten like '%$tu_khoa%' or email like '%$tu_khoa%' or dien_thoai like '%$tu_khoa%' or facebook like '%$tu_khoa%' or yahoo like '%$tu_khoa%' or skype like '%$tu_khoa%' or id = ".$tu_khoa;
    }
?>
<section class="content-header">
    <h1>User<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">User</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách Thành viên</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                        	<?if($_SESSION["level"]==1||$_SESSION["level"]==0){?>
                            <a href="?act=member_n">Thêm thành viên</a>    
                            <?}?>
                        </span>
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("vn_user","level <> 0","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form action="" method="get" class="search_smart"  enctype="multipart/form-data">
                            <input type="hidden" name="act" value="member_l" />
                            <div class="form-group">
                                <div>
                                <input name="tu_khoa" type="text" value="<?=$tu_khoa?>"  placeholder="Nhập tù khóa..."/>
                                </div>
                                <button type="submit">Tìm kiếm</button>
                            </div>
                        </form>
                        <form action="?act=member_l" method="post" onsubmit="return confirm('Are you sure ?');">
                        <input type="hidden" name="func" value="del" />
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Account</th>
                                    <th style="min-width: 200px;">Thông tin cá nhân</th>
                                    <th>Trạng thái</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                $r		=	$db->select("vn_thanh_vien",$keyw,"order by time asc");
                                while ($row = $db->fetch($r))
                                {
                                	$dem++;
                                ?>
                                <tr>
                                    <th scope="row"><?=$dem?></th>
                                    <td><?=$row["email"]?></td>
                                    <td style="vertical-align: top;"><strong style="padding-bottom: 5px;"><?=$row["ten"]?></strong>
                                        <?if($row["dia_chi"]!=''){?>Địa chỉ: <?=$row["dia_chi"]?><br /><?}?>
                                        SĐT: <?=$row["dien_thoai"]?>
                                    
                                    </td>
                                    
                                    <td><a onclick="ajaxoption(<?=$row['id']?>,'vn_thanh_vien','trang_thai')" href="javascrpit:;" id="trang_thai<?=$row['id']?>"><?=$row['trang_thai']==1?"<img src=\"images/true.png\" />":"<img src=\"images/false.png\" />"?></a></td>
                                    <td><?=lg_date::vn_time($row["time"])?></td>
                                    <td>
                                            <a href="?act=member_e&id=<?=$row["id"]?>">Edit</a>   
                                    </td>
                                    <td style="text-align: center;">
                                            <input name="tik[]" type="checkbox" value="<?=$row["id"]?>" />    
                                    </td>
                                </tr>
                                <?}?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6"></td>
                                    <td>
                                        <input type="submit" value="Xóa" class="btn btn-success" style="width:80%;" />                            
                                    </td>
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
<?}else{echo 'Bạn không có quyền truy cập';}?>