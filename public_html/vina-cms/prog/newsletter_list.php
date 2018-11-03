
<?php

    $id = $_POST['id'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("vn_mail","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa thông tin đã chọn.","?act=newsletter_list");
		die();
	}
?>
<section class="content-header">
    <h1>Liên hệ list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active"> Liên hệ</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Danh sách mail đăng ký</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">
                        <?php
                            $rt = $db->select("lienhe","type='đăng ký'","");
                            $rowt = $db->num_rows($rt);
                            echo $rowt." active";
                        ?>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <a style="width:20%;display: block;font-size: 14px;font-weight: bold;text-decoration: none;color:#fff;background: #000;padding: 5px 0;margin: 20px auto;text-align: center;" href="?act=newsletter_show">Get all email </a>
                    <div class="table-responsive">
<form action="?act=newsletter_list" method="post" onsubmit="return confirm('Bạn có muốn xóa ?');">
<input type="hidden" name="func" value="del" />
<input type="hidden" name="id" value="<?=$id?>" />
    <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr class="tb_head">
            	<td>STT</td>
            	<td>Email</td>
            	<td>Time</td>
            	<td>Xóa</td>
            </tr>
        <?php
        $r		=	$db->select("lienhe","type='đăng ký'","");
        while ($row = $db->fetch($r))
        {
        	$count++;
        ?>
            <tr class="tb_content">
            	<td><?=$count?></td>

            	<td><?=$row["ten"]?></td>
                
                <td><?=date('d/m/Y',$row['time'])?></td>
              

            	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
            </tr>
        <?
        }
        ?>
            <tr class="tb_foot">
            	<td colspan="3" style="text-align:left;">&nbsp;</td>
            	<td><input type="submit" value="Xóa" class="button_action" style="width:80%;" /></td>
            </tr>
    </table>
</form>
</center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>