<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title><?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
    <body>
    <div class='warn' id='loginfo'><?php echo ($info); ?></div>
    <form action="/newshop/index.php/Admin/Manager/login.html" method="post" onsubmit="return checkCaptcha();">

        <p>用户名:<input name='username' id="username" type="text" /><span class="help-block"></span></p>
        
        <p>密码:<input name='password' id="password" type="password" /><span class="help-block"></span></p>
        
        <p>验证码<input name='captcha' id="captcha" type="text" /><img id='captcha_img' src="/newshop/index.php/Admin/Manager/verifyImg" alt="" onclick="chimg();" /><span class="help-block"></span></p>
        
        
        <button type='submit' name='submit' >登录</button>
    </form>
    <script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
    <script type='text/javascript'>
        $(document).ready(function() {
            var dom_user = $("#username");
            dom_user.blur(function () {
                var vlName = dom_user.val();
                if (vlName.length < 5) {
                    dom_user.siblings(".help-block").text("用户名太短了");
                } else if (vlName.length > 10){
                    dom_user.siblings(".help-block").text("用户名太长了");
                }
                else {
                    dom_user.siblings(".help-block").text("");
                }
            });

            var dom_pw = $("#password");
            dom_pw.blur(function () {
                var vlName = dom_pw.val();
                if (vlName.length < 6) {
                    dom_pw.siblings(".help-block").text("密码太短了");
                } else {
                    dom_pw.siblings(".help-block").text("");
                }
            });

            var dom_cap = $("#captcha");
            dom_cap.blur(function () {
                var vlName = dom_cap.val();
                if (vlName.length == 0) {
                    dom_cap.siblings(".help-block").text("请输入验证码");
                } else {
                    dom_cap.siblings(".help-block").text("");
                }
            });
        });


        function chimg() {
            var img = document.getElementById('captcha_img');
            img.src="/newshop/index.php/Admin/Manager/verifyImg?qs=Math_random()";
        }

        
        function checkCaptcha(){
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