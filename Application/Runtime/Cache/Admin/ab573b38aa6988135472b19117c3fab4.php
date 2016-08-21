<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<form action="/newshop/index.php/admin/manager/addmanager" method="post" onsubmit="return checkCapcha();">
	<p><label for="username">用户名</label>
	<input type="text" name='username' id='username' >
	<span class="help-block"></span></p>

	<p><label for="password">密码</label>
	<input type="password" name='password' id='password' >
	<span class="help-block"></span></p>

	<p><label for="repassword">确认密码</label>
	<input type="password" name='repassword' id='repassword' >
	<span class="help-block"></span></p>

	<p><label for="email">邮箱</label>
	<input type="text" name='email' id='email' >
	<span class="help-block"></span></p>

	<p><label for="phone">手机号码</label>
	<input type="text" name='phone' id='phone' >
	<span class="help-block"></span></p>

	<p><input type="text" name='captcha' id='captcha'>
	<img id='captcha_img' src="/newshop/index.php/Admin/Manager/verifyImg" alt="" onclick="chimg();" />
	<span class="help-block"></span></p>

	<button type="submit" name="submit">增加</button>
</form>

<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript">
function chimg() {
            var img = document.getElementById('captcha_img');
            img.src="/newshop/index.php/Admin/Manager/verifyImg?qs=Math.random()";
        }

function checkCapcha(){
    var dom_captcha = $("#captcha");
    var state = '';
    $.ajax({
        url:"/newshop/index.php/Admin/Manager/checkCaptcha",
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
</body>
</html>