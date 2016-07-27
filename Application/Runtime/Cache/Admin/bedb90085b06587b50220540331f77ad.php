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

            a:link {
                text-decoration: none;
            }

        	#head {
        		border: 1px solid yellow;
        		height: 80px;
        	}
        	#left {
        		border: 1px solid blue;
        		width: 200px;
                bottom: 0;
        		margin-top:15px;
        		float: left;
        	}

            #left li {
                padding: 5px;
            }

        	#right iframe{
                padding-top: 30px;
                padding-left: 30px;
        		border: 1px solid red;
        		width: 1000px;
        		height: 800px;
        		margin: 15px 5px 0px 10px;
        		float: left;
        	}
            
            #right iframe table{
                width:100%;
            }

        </style>
    </head>
<body>
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
<?php if(is_array($nav)): foreach($nav as $key=>$v): ?><ul>
<li>
<?php echo (str_repeat('&nbsp;',$v["lev"]*2)); ?><a href="/newshop/<?php echo ($v["name"]); ?>" target="right_content"/><?php echo ($v["title"]); ?></a>
</li>
</ul><?php endforeach; endif; ?>
</div>

<div id='right' name='right'>
<iframe id="content-iframe" src="/newshop/Admin/Index/welcome" frameborder="0" width="100%" height="100%" name="right_content" scrolling="auto"></iframe>
</div>

</body>
</html>