<div class="news_block_left">
    <h2 class="news_title_left2">Lượt truy cập</h2>
    <div style="padding: 10px 0">
        <table cellpadding="10" class="table_online" >
            <tr>
                <td><strong>Online:&nbsp;</strong></td>
                <td>
                <span>
                <i>
                <?
                    $r = mysql_query("SELECT * FROM vn_online");
                    $gia_tri = mysql_num_rows($r);
                    
                    $x = 8 - strlen($gia_tri);
                	for ($i = 1; $i <= $x; $i++)
                	{
                	$gia_tri = "0" . $gia_tri;
                	}
                
                	for ($i = 0; $i < strlen($gia_tri); $i++)
                	{
                	    echo "<img style='width:15px; height: 20px;' src='".$domain."/images/dem/".$gia_tri[$i].".png' >";
                        //echo $gia_tri[$i];
                    }
                    //echo $gia_tri;
                ?>
                </i>
                </span>
                </td>
            </tr>
            <tr>
                <td><strong>Total:&nbsp;</strong></td>
                <td>
                <span> 
                <i>
                <?php
            	$gia_tri = 1000;
            	$r = $db->select("vn_online_daily","");
            	while ($row = $db->fetch($r))
            	$gia_tri += $row["bo_dem"];
            
            	$x = 8 - strlen($gia_tri);
            	for ($i = 1; $i <= $x; $i++)
            	{
            	$gia_tri = "0" . $gia_tri;
            	}
            
            	for ($i = 0; $i < strlen($gia_tri); $i++)
            	{
            	    echo "<img style='width:15px; height: 20px;' src='".$domain."/images/dem/".$gia_tri[$i].".png' >";
                    //echo $gia_tri[$i];
                }
                ?>
                </i>
                </span>
                </td>
            </tr>
        </table>  
    </div>
</div>