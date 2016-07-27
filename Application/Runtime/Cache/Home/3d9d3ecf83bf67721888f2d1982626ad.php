<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>NEWSHOP - </title>
        <link rel="stylesheet" type="text/css" href="<?php echo (SITE_URL); ?>/Public//static/home/css/style.css" />
        <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
    </head>
<body>
<div id="banner">

<div id="banner1"><h1>M - C: <?php echo (MODULE_NAME); ?> -- <?php echo (CONTROLLER_NAME); ?></h1>	</div>
<div id='log'><div id="person">用户登录状态: 
	<?php if(($_SESSION['user']) != ""): ?><div><a href="/newshop/Home/User/index">个人中心</a>&nbsp;&nbsp;&nbsp;<a href="/newshop/Home/User/logout"><button>退出</button></a></div>
	<?php else: ?>
	<div>未登录&nbsp;&nbsp;&nbsp;<a href="/newshop/Home/user/login"><button>登录</button></a><a href="/newshop/Home/User/register"><button>注册</button></a></div><?php endif; ?>
	</div>
<div style="text-align:right;"><a href="/newshop/admin/manager/login">管理员后台</a></div>
</div>
</div>





<div id='bread'>
	<ul>
	<li><a href="/newshop/Home/Index/index">首页</a></li>
	<?php if(is_array($breadmenu)): foreach($breadmenu as $key=>$v): ?><span>-></span>
	<li><a href="/newshop/<?php echo ($v["name"]); ?>"><?php echo ($v["title"]); ?></a></li><?php endforeach; endif; ?>
	</ul>
</div>









<div id="main">
<h2>用户注册</h2>
<div id="container">
<form action="/newshop/Home/User/register" method="post" content-type="application/x-www-form-urlencoded" onsubmit="return checkCapcha();">

<div class="reg"><label for="username">用户名:</label><input id="username" name="username" type="text"/><span class="help-block"></span></div>
<div class="reg"><label for="password">密码</label><input type="password" id="password" name="password"/><span class="help-block"></span></div>
<div class="reg"><label for="repassword">再次输入</label><input type="password" id="repassword" name="repassword"/><span class="help-block"></span></div>
<div class="reg"><label for="email">邮箱:</label><input type="text" id="email" name="email"/><span class="help-block"></span></div>

<div class="reg"><label for="captcha">验证码:</label><input type="text" id="captcha" name="captcha"/><img id="captcha_img" src="/newshop/Home/User/verifyImg" onclick="chimg();"/><span class="help-block"></span></div>

<div id="fbutton">
<button type='reset' style="font-size:17px;">重置</button>
<button type="submit" style="font-size:20px;font-weight:bold;">注册</button>
</div>
</form>
</div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo (SITE_URL); ?>/Public//static/home/css/register.css" />



<script type="text/javascript">

function chimg() {
            var img = document.getElementById('captcha_img');
            img.src="/newshop/Home/User/verifyImg?qs="+Math.random();
        }

function checkCapcha(){
    var dom_captcha = $("#captcha");
    var state = '';
    $.ajax({
        url:"/newshop/Home/User/checkCaptcha",
        type:"get",
        data:{data:dom_captcha.val()}, 
        async:false,
        success: function(result){
            if(result == "fail") {
                dom_captcha.siblings(".help-block").text("验证码错误");
                state='fail';
                return false;
            }
        }
    });
    if (state=='fail'){
        return false;
    }
}
</script>




<div id="footer">
    <p class="text" style="text-align: center;">
        © 2016-2020 newshop 版权所有，并保留所有权利。<br />
    </p>
</div>
</body>
</html>