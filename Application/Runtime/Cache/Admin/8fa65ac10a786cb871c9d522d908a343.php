<?php if (!defined('THINK_PATH')) exit();?><html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<form action="/newshop/Admin/Manager/editManager?id=1" method="post" onsubmit="return checkCapcha();">
	<p><label for="username">用户名</label>
	<input type="text" name='username' id='username' value="<?php echo ($info["username"]); ?>">
	<span class="help-block"></span></p>

	<p><label for="password">修改密码</label>
	<input type="password" name='password' id='password' value="<?php echo ($info["password"]); ?>">
	<span class="help-block"></span></p>

	<p><label for="repassword">确认密码</label>
	<input type="password" name='repassword' id='repassword' value="">
	<span class="help-block"></span></p>

	<p><label for="email">邮箱</label>
	<input type="text" name='email' id='email' value="<?php echo ($info["email"]); ?>">
	<span class="help-block"></span></p>

	<p><label for="phone">手机号码</label>
	<input type="text" name='phone' id='phone' value="<?php echo ($info["phone"]); ?>">
	<span class="help-block"></span></p>

	<p><input type="text" name='captcha' id='captcha'>
	<img id='captcha_img' src="/newshop/Admin/Manager/verifyImg" alt="" onclick="chimg();" />
	<span class="help-block"></span></p>
	<input type="text" name="id" hidden id="<?php echo ($info["id"]); ?>", value="<?php echo ($info["id"]); ?>">
	<button type="submit" name="submit">修改</button>
</form>

<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript">
function chimg() {
            var img = document.getElementById('captcha_img');
            img.src="/newshop/Admin/Manager/verifyImg?qs=Math_random()";
        }

function checkCapcha(){
    var dom_captcha = $("#captcha");
    var state = '';
    $.ajax({
        url:"/newshop/Admin/Manager/checkCaptcha",
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