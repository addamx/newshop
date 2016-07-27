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
		<?php if(is_array($goodcates)): foreach($goodcates as $key=>$v): ?><a href="/newshop/Home/Index/category?cid=<?php echo ($v["id"]); ?>"><li <?php if(($cid) == $v["id"]): ?>style="background-color:yellow;"<?php endif; ?>><?php echo (str_repeat("&nbsp;",$v["lev"]*2)); echo ($v["name"]); ?></li></a><?php endforeach; endif; ?>
	</ul>
	</div>



<div id="main">
	<div id="cat_goods" class="">
		<?php if(is_array($cat_goods)): foreach($cat_goods as $key=>$v): ?><div class="good">
				<img src="<?php echo (UPLOAD_URL); echo explode(',', $v['goods_img'])[0]; ?>">
				<div><a href="/newshop/Home/goods/detail?gid=<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></a></div>
				<div>[新品]<span> ¥<?php echo ($v["shop_price"]); ?>&nbsp;&nbsp;<a href="/newshop/Home/Flow/add?goods_id=<?php echo ($v["id"]); ?>">购买</a></span></div>
			</div><?php endforeach; endif; ?>
	</div>
</div>



	<div id='right'>
		<?php echo W('Ad/aw');?>
	</div>




<div id="footer">
    <p class="text" style="text-align: center;">
        © 2016-2020 newshop 版权所有，并保留所有权利。<br />
    </p>
</div>
</body>
</html>