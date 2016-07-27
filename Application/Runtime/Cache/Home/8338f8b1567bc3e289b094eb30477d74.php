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
<div id='log'><div id="person">登录状态: 
	<?php if(($_SESSION['user']) != ""): echo ($_SESSION['user']['name']); ?>
	<div><a href="/newshop/Home/User/index">个人中心</a>&nbsp;&nbsp;&nbsp;<a href="/newshop/Home/User/logout"><button>退出</button></a></div>
	<?php else: ?>
	<div>未登录&nbsp;&nbsp;&nbsp;<a href="/newshop/Home/user/login"><button>登录</button></a><a href="/newshop/Home/User/register"><button>注册</button></a></div><?php endif; ?>
	</div>
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
<div id="rec">
<form action="/newshop/Home/Flow/done" method="post" content-type="application/x-www-form-urlencoded">
<div><label for="xm">收货人姓名: </label><input id="xm" name="xm" type="text"></div>
<div><label for="mobile">手机号码: </label><input id="mobile" name="mobile" type="text"></div>
<div><label for="address">具体地址: </label><input id="address" name="address" type="text"></div>
<div><label for="paytype">支付方式: </label><select name="paytype" id="paytype">
	<option value="1">在线支付</option>
	<option value="2">货到付款</option>
</select></div>
<div><label for="note">备注(20字符内): </label><textarea id="note" name="note"></textarea></div>

<button type="submit">提交</button>
</form>
</div>
<div id="cart">
<h2 id="ttl">总价: <?php echo ($ttl); ?></h2>
<table>
<tr>
	<th colspan="2">商品</th>
	<th>单价(元)</th>
	<th>数量</th>
</tr>
<?php if(is_array($cart)): foreach($cart as $key=>$v): ?><tr>
<td><img src="<?php echo ($v["thumb_img"]); ?>" alt=""></td>
<td><?php echo ($v["name"]); ?></td>
<td><?php echo ($v["shop_price"]); ?></td>
<td><?php echo ($v["num"]); ?></td>
</tr><?php endforeach; endif; ?>
</table>
</div>
</div>


<link rel="stylesheet" type="text/css" href="<?php echo (SITE_URL); ?>/Public//static/home/css/flow.css" />
<script type="text/javascript" src="<?php echo (SITE_URL); ?>/Public//static/home/js/flow.js"></script>



<div id="footer">
    <p class="text" style="text-align: center;">
        © 2016-2020 newshop 版权所有，并保留所有权利。<br />
    </p>
</div>
</body>
</html>