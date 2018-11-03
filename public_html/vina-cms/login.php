<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta content="telephone=no" name="format-detection" />

<link rel="stylesheet" type="text/css" media="screen, projection" href="tpl/bootstrap.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="tpl/reset.css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="tpl/login.css" />
<title>Administration Control Panel - Đăng nhập</title>
<!--[if lte IE 6]>
<style type="text/css">
.clearfix {height: 1%;}
</style>
<![endif]-->

<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {display: inline-block;}
</style>
<![endif]-->
</head>
<body>

<div class="box-table">
<div id="particles-js"><canvas class="particles-js-canvas-el" style="width: 100%; height: 100%;"></canvas></div>
<div class="box-table-cell">
    <div class="box-form">
        <div class="box-con"> 
        <div class="login_heading">
            <div class="user_avatar"></div>
        </div>
        <form method="post">
            <input type="hidden" id="da_dang_nhap" value="<?=$da_dang_nhap?>" />
            <fieldset>
                <!--<label>Username</label>-->
                <input type="text" name="log_admin_user" value="<?=$_COOKIE['username']?>" onclick="this.value='';this.style.color='#000'" autocomplete="off" placeholder="Username" required/>
            </fieldset>
            <fieldset>
                <!--<label>Password</label>-->
                <input type="password" name="log_admin_pass" onclick="this.value=''" value="<?=$_COOKIE['password']?>" placeholder="Password" required/>
            </fieldset>
            <fieldset>
                <button type="submit" name="submit">Sign in</button>
            </fieldset>
            <fieldset>
        		<div class="checkbox">
        			<input id="check1" type="checkbox" name="remember" <?if($_COOKIE['member_ok']==1){echo 'checked="checked"';}?> value="1">
        			<label for="check1">Keep me Signed in</label>
        		</div>
            </fieldset>
            <fieldset>
                <?=$error_text?>
            </fieldset>
            <fieldset class="vinadesign">
                <p><?=admin_company?></p>
            </fieldset>
        </form>
        </div>
    </div>
</div>
</div>

</body>
</html>
<script src="js/particles.js"></script>
<script src="js/app.js"></script>
<script src="js/stats.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/pngfix.js"></script>