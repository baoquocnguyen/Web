<script>
function showhide(table,data,id)
{
$.ajax({
    type:'GET',
    url:'<?=$domain?>/<?=admin_url?>/showhide.php',
    data:{table : table,data : data,id : id},
    success	: function(sh)
    { 
        $(".showhide"+id+data).html(sh);
    }
});
};
</script>
<?php
    $id = $_GET['id'];
    $page = $_GET['page'];
    $func = $_POST['func'];
    $tik = $_POST['tik'];
	
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("language","id = '".$tik[$i]."'");
		}
		admin_load("","?act=ngonngu_list");
		die();
	}
    
?>
<section class="content-header">
    <h1>list<small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">List language</li>
    </ol>
</section><!--/. content-header-->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box-common box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">list</h3>
                    <div class="box-tools pull-right">
                        <span class="function">
                            <a href="?act=ngonngu_new">Add new</a>
                        </span>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="paddinglr10">
                    <div class="table-responsive">
                        <form action="?act=ngonngu_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
                        <input type="hidden" name="func" value="del" />
                        <table  class="table table-striped">
                        <thead>
                            <tr>
                            	<th>#</th>
                            	<th>Name</th>
                                <th>Code</th>
                            	<th>Display</th>
                                <th>Edit</th>
                            	<th>Del</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $r		=	$db->select("language","","order by thu_tu");
                            while ($row = $db->fetch($r))
                            {
                            	$count++;
                            ?>
                            <tr>
                            	<th><?=$count?></th>
                                <td><?=$row["name"]?></td>
                                <td><?=$row["code"]?></td>
                                <td><p style="cursor: pointer;" class="showhide<?=$row["id"]?>display"><img onclick="showhide('language','display',<?=$row["id"]?>)" src="images/<?=$row["display"]==1?'true':'false'?>.png" /></p></td>
                            	<td><a href="?act=ngonngu_edit&id=<?=$row["id"]?>">Edit</a></td>
                            	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
                            </tr>
                            <?
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            	<td colspan="5">
                            		<strong>Page ::1:</strong>
                            		
                            	</td>
                            	<td colspan="1"><input type="submit" value="Del" class="btn btn-success" /></td>
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