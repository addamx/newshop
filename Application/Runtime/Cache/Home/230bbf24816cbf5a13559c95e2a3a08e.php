<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>NEWSHOP -- 首页</title>
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







	<div id='nav'>
	<ul>
		<?php if(is_array($goodcates)): foreach($goodcates as $key=>$v): ?><a href="/newshop/Home/Index/category?cid=<?php echo ($v["id"]); ?>"><li><?php echo (str_repeat("&nbsp;",$v["lev"]*2)); echo ($v["name"]); ?></li></a><?php endforeach; endif; ?>
	</ul>
	</div>



<div id="main" style="width:1000px;height:100%">
<div id="detail_left">
	<div id="goods_img"><img src="" /></div>
	<div id="thumb_img"><?php if(is_array($info["thumb_img"])): foreach($info["thumb_img"] as $key=>$v): ?><img src="<?php echo (UPLOAD_URL); ?>/<?php echo ($v); ?>" onclick="chimg(this);" /><?php endforeach; endif; ?>
	</div>
</div>
<div id="detail_right">
	<div id="title" style="font-size:20px;font-weight:bold;"><?php echo ($info["name"]); ?></div>
	<div id="brief"><?php echo ($info["brief"]); ?></div>
	<div id="shop_price" style="font-size:20px;"><?php echo ($info["shop_price"]); ?></div>

	<form action="/newshop/Home/Flow/add" method="get" content-type="application/x-www-form-urlencoded">
	<div id="qty">
		<span style="width:40px;border:1px black solid;" onclick="redQty();">&nbsp;-&nbsp;</span>
		<input name="goods_qty" id="qty_input" type="text" value="1" style="width:20px;" />
		<span style="width:40px;border:1px black solid;" onclick="addQty();">&nbsp;+&nbsp;</span>
		<span>剩余库存: <?php echo ($info["goods_number"]); ?></span>
	</div>
	<input type="text" hidden="hidden" name="goods_id" value="<?php echo ($info["id"]); ?>" />
	<div id="buy"><button type="submit">购买</button></div>
	</form>
</div>
<div id="goods_desc"><?php echo (htmlspecialchars_decode(html_entity_decode($info["goods_desc"]))); ?></div>
</div>


<script type="text/javascript" src="<?php echo (SITE_URL); ?>/Public//static/home/js/goods.js"></script>



<div id="footer">
    <p class="text" style="text-align: center;">
        © 2016-2020 newshop 版权所有，并保留所有权利。<br />
    </p>
</div>
</body>
</html>