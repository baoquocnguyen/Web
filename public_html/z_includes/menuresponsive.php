<div class="menumobile">
    <div class="header">
    	<a href="#menu"></a>
        <div class="clear"></div>
    </div>
    
    <nav id="menu">
    	<ul>
          <li><a <?php if($post_type==''){echo 'class="active"';}?> href="<?=$root?>"><?=$translate['Trang chủ'][$lang_code]?></a></li>
          <!--<li><a <?php if($post_type=='about_us'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("about_us","slug","4")?>"><?=show_infopage("about_us","ten","4")?></a>

          </li>-->
          <?php
          $qtc1=$db->selectpostcat("postcat_id=1 and lang_id='".$lang_code."'","");
          $rtc1=$db->fetch($qtc1);
          ?>
          <li>
            <a <?php if($post_type=='catproduct'){echo 'class="active"';}?> href="javascript:;return false;"><?=show_infopage("sp","ten","14")?></a>
            <ul>
              <?php
              $q=$db->selectpostcat('hien_thi=1 and post_type="catproduct" and cat=0 and lang_id="'.$lang_code.'"','order by thu_tu');
              while ($r=$db->fetch($q)) {
                ?>
              <li><a href="<?=$root?>/<?=get_slug_postcat($r['postcat_id'])?>/"><?=$r['name']?></a>
                <?php

                $q1=$db->selectpostcat('hien_thi=1 and post_type="catproduct" and cat="'.$r['postcat_id'].'" and lang_id="'.$lang_code.'"','order by thu_tu');
                if($db->num_rows($q1)!=''){
                ?>
                <ul>
                <?php
                
                while ($r1=$db->fetch($q1)) {?>
                  <li><a href="<?=$root?>/<?=get_slug_postcat($r1['postcat_id'])?>/"><?=$r1['name']?></a>
                <?php }?>
                </ul>
                <?php }?>
              </li>
              <?php }?>
            </ul>
          </li>

          <li><a <?php if($post_type=='post'){echo 'class="active"';}?> href="<?=$root?>/<?=get_slug(8)?>/"><?=get_name(8)?></a>
            <!-- <ul>
              <li><a href="<?=$root?>/<?=show_infopage("contact","slug","11")?>"><?=$translate['Đăng ký trở thành đại lý'][$lang_code]?></a></li>
            </ul> -->
          </li>
          <li><a <?php if($post_type=='chinh_sach'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("chinh_sach","slug","20")?>"><?=show_infopage("chinh_sach","ten","20")?></a></li>
          <!-- <li><a <?php if($post_type=='bao_hanh'){echo 'class="active"';}?> href="javascript:;return false;"><?=get_name(30)?></a>
            <ul>
              <?php
              $q=$db->selectpost('hien_thi=1 and cat="30" and lang_id="'.$lang_code.'"','order by thu_tu');
              while ($r=$db->fetch($q)) {?>
              <li><a href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></li>
              <?php }?>
            </ul>
          </li> -->
          <!-- <li><a <?php if($post_type=='cs_dl'){echo 'class="active"';}?> href="javascript:;return false;">Trở thành nhà đại lý</a>
            <ul>
              <li><a href="javascript:;return false;"><?=get_name(31)?></a>
                <ul>
                <?php
                $q=$db->selectpost('hien_thi=1 and cat="31" and lang_id="'.$lang_code.'"','order by thu_tu');
                while ($r=$db->fetch($q)) {?>
                <li><a href="<?=$root?>/<?=$r['slug']?>"><?=$r['ten']?></a></li>
                <?php }?>
              </ul>
              </li>
              
            </ul>
          </li> -->
          <li><a <?php if($post_type=='thanh_toan'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("thanh_toan","slug","10")?>"><?=show_infopage("thanh_toan","ten","10")?></a></li>
          <li><a <?php if($post_type=='contact'){echo 'class="active"';}?> href="<?=$root?>/<?=show_infopage("contact","slug","11")?>"><?=show_infopage("contact","ten","11")?></a></li>
        </ul>
    </nav>
</div>
<!-- menu_left vip -->