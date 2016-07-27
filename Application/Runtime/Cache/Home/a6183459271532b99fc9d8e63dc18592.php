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
<table>
<tr>
	<th><input type="checkbox" selected="selected"></input>全选</th>
	<th colspan="2">商品</th>
	<th>单价(元)</th>
	<th>数量</th>
	<th>小计(元)</th>
	<th>操作</th>
</tr>
<form action="/newshop/Home/Flow/checkout" method="post" content-type="applicaiton/x-www-form-urlencoded">
<?php if(is_array($buy_list)): foreach($buy_list as $key=>$v): ?><tr>
	<td><input type="checkbox" selected="selected" /></td>
	<td><img src="<?php echo ($v["thumb_img"]); ?>" alt="" /></td>
	<td><?php echo ($v["name"]); ?></td>
	<td><?php echo ($v["shop_price"]); ?></td><td><a id="dec<?php echo ($v["id"]); ?>" style="width:40px;border:1px black solid;" onclick="decQty(this.id);">&nbsp;-&nbsp;</a><input class="num" name="info[<?php echo ($v["id"]); ?>][num]" id="qty_input<?php echo ($v["id"]); ?>" type="text" value="<?php echo ($v["num"]); ?>" style="width:20px;" onchange="createOB(this);"/><a id="add<?php echo ($v["id"]); ?>" style="width:40px;border:1px black solid;" onclick="addQty(this.id);">&nbsp;+&nbsp;</a></td><td><span></span>
	</td>
	<td><a href="">删除</a><input type="text" hidden="hidden" name="info[<?php echo ($v["id"]); ?>][id]" value="<?php echo ($v["id"]); ?>"/></td>
</tr><?php endforeach; endif; ?>
</table>
<button type="submit" style="float:right;">去结算</button>
</form>
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