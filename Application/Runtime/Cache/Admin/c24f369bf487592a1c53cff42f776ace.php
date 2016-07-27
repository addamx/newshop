<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
        <style type="text/css">
        	* {
				margin:0;
				padding:0;
				border:0;
			}
        	#main {
        		width: 100%;
        		height: 100%;
        	}
        	#head {
        		border: 1px solid yellow;
        		height: 80px;
        	}
        	#left {
        		border: 1px solid blue;
        		width: 200px;
        		height: 800px;
        		margin:1em 0px 0px 0px;
        		float: left;
        	}
        	#right {
        		border: 1px solid red;
        		width: 800px;
        		height: 800px;
        		margin: 1em 0 0 1em;
        		float: left;
        	}
        </style>
    </head>
	<body>
		<div id='main'>
			<div id='head'>
			    <table cellspacing=0 cellpadding=0 width="100%" border=0>
			    	<tr>
                	<td align=middle>当前用户：<?php echo ($_SESSION['mg_user']['username']); ?> &nbsp;&nbsp; 
	                    <a href="#">修改口令
	                    </a>
	                    <a onclick="if (confirm('确定要退出吗？')) return true; else return false;" href="/newshop/Admin/Manager/logout"  target=_top>退出系统
	                    </a> 
                	</td>
                	</tr>
        		</table>
			</div>
			<div id='left'>
                <?php if(is_array($nav)): foreach($nav as $key=>$v): if(($v["pid"]) == "0"): ?><ul>
					<li>
						<a href="/newshop/<?php echo ($v["name"]); ?>"><?php echo ($v["title"]); ?></a>
                            <?php if(is_array($nav)): foreach($nav as $key=>$vv): if(($vv["pid"]) == $v["id"]): ?><ul>
                                <li><a href="/newshop/<?php echo ($vv["name"]); ?>">&nbsp;<?php echo ($vv["title"]); ?></a></li>
                                    <?php if(is_array($nav)): foreach($nav as $key=>$vvv): if(($vvv["pid"]) == $vv["id"]): ?><ul>
                                        <li><a href="/newshop/<?php echo ($vvv["name"]); ?>">&nbsp;&nbsp;<?php echo ($vvv["title"]); ?></a></li>
                                    </ul><?php endif; endforeach; endif; ?>
                            </ul><?php endif; endforeach; endif; ?>
					</li>
				</ul><?php endif; endforeach; endif; ?>
			</div>
			<div id='right' name='right'>
				<iframe id="content-iframe" src="/newshop/Admin/Index/welcome" frameborder="0" width="100%" height="100%" name="right_content" scrolling="auto"></iframe>
			</div>
		</div>

	</body>
</html>