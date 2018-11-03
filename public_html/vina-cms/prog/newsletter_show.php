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
                    <div class="table-responsive">

<font size="2" face="Tahoma"><b>List email<img src="images/bl3.gif" border="0" /> </b></font>
<hr size="1" color="#cadadd" />
<center>
<?php

    $id = $_POST['id'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	
?>
<form action="?act=email_list" method="post" onsubmit="return confirm('B?n có mu?n xóa ?');">
<input type="hidden" name="func" value="del" />
<input type="hidden" name="id" value="<?=$id?>" />
    <table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr class="tb_head">
            
            	<td>Email</td>
            	
            	
            </tr>
            <tr class="tb_content">
            	<td>
        <?php
        $r		=	$db->select("lienhe","type='đăng ký'","");
        while ($row = $db->fetch($r))
        {
        	$count++;
                echo $row["ten"].", ";
        }
        ?>
                </td>
        
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