<section class="content-header">
    <h1>Admin <span style="text-transform: uppercase;"><?=admin_url?></span><small>Version 2.0</small></h1>
    <ol class="breadcrumb">
        <li><a href="?act=home"><i class="fa fa-dashboard"></i> AdminCP</a></li>
        <li class="active">Home</li>
    </ol>
</section><!--/. content-header-->
<section class="content-header">
    <div class="alert alert-danger" role="alert"> Chú ý: Vui lòng đổi mật khẩu đăng nhâp bảo mật! </div>
</section><!--/. content-header-->
<section class="content">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-line-chart" aria-hidden="true"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Visits</span><br />
                    <span class="info-box-number">
                    <?php
                        $gia_tri = 0;
                        $r = $db->select("vn_online_daily","");
                        while ($row = $db->fetch($r))
                        $gia_tri += $row["bo_dem"];
                        echo $gia_tri;
                    ?>
                    <small>active</small></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-smile-o" aria-hidden="true"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Online</span><br />
                    <span class="info-box-number">
                    <?
                    $r =  $db->select("vn_online");
                    $gia_tri = $db->num_rows($r);
                    echo '0'.$gia_tri;
                    ?>
                    </span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Date & Time</span><br />
                    <span class="info-box-number"><div id="clock"></div></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-user" aria-hidden="true"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">User</span><br />
                    <span class="info-box-number">
                    <?
                    $r_us = $db->select("vn_user"," level <> 0 ","");
                    $sum_us = $db->num_rows($r_us); 
                    echo $sum_us;
                    ?>
                    <small>active</small></span>
                </div><!-- /.info-box-content -->
            </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-12 col-sm-12 col-xs-12">
        <section class="block-chart row">
            <div class="box-common box-danger collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Total Month</h3>
                    <div class="box-tools pull-right">
                        <span class="label label-danger">
                        <?php
                            $tong = 0;
                            $r2 = $db->select("vn_online_daily","");
                            while ($row2 = $db->fetch($r2))
                            $tong += $row2["bo_dem"];
                            echo $tong." active";
                        ?>
                        </span>
                        <button class="btn btn-box-tool" data-widget="collapse" id="hide-toggle"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <canvas id="thongke_home" width="1090" height="400"></canvas>
                    <?
                    $label1 =   array();
                    $data1  =   array();

                    $qh1      =   $db->select("vn_online_daily", "ngay like '%".lg_date::vn_other(time(),"m")."/".lg_date::vn_other(time(),"Y")."%'","order by ngay asc");
                    
                    if($db->num_rows($qh1)>1){
                        while ($rh1 = $db->fetch($qh1))
                        {
                            $label1[]   =   str_replace("/".lg_date::vn_other(time(),"Y"),"", $rh1["ngay"]);
                            $data1[]    =   $rh1["bo_dem"];
                        }
                    }else{
                        $k=$db->fetch($qh1);
                        $r1      =   $db->select("vn_online_daily","ngay like '%".lg_date::vn_other(strtotime ("-1 month"),"m")."/".lg_date::vn_other(time(),"Y")."%'","order by ngay asc");
                        while ($row1 = $db->fetch($r1))
                        {
                            $label1[]   =   str_replace("/".lg_date::vn_other(time(),"Y"),"", $row1["ngay"]);
                            $data1[]        =   $row1["bo_dem"];
                        }
                        $label1[]   =   str_replace("/".lg_date::vn_other(time(),"Y"),"", $k["ngay"]);
                        $data1[]        =   $k["bo_dem"];
                    }
                    ?>
                    </tbody>
                </table>
                <script type="text/javascript">
                    var thongke_data = {
                        labels : [<?for($i=0;$i<count($label1);$i++){
                            if($i==count($label1)-1){
                                echo '"'.$label1[$i].'"';
                            }else{
                                echo '"'.$label1[$i].'",';
                            }
                        }?>],
                        datasets : [
                        {
                                fillColor : "rgba(172,194,132,0.4)",
                                strokeColor : "#ACC26D",
                                pointColor : "#fff",
                                pointStrokeColor : "#9DB86D",
                                data : [<?for($i=0;$i<count($data1);$i++){
                                    if($i==count($data1)-1){
                                        echo $data1[$i].'';
                                    }else{
                                        echo $data1[$i].',';
                                    }
                                }?>]
                            }
                        ]
                    }
                    
                    // get line chart canvas
                    var thongke_home = document.getElementById('thongke_home').getContext('2d');
                
                    // draw line chart
                    new Chart(thongke_home).Line(thongke_data);
                </script>
                </div>
            </div>
        </section><!-- /.block-chart-->
        </div>
    </div><!-- /.row -->
</section><!-- /.content-->

