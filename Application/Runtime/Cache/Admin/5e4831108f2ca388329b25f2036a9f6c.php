<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<form action="/newshop/index.php/admin/group/add" method="post" id="aform">
	<button type='submit'>增加</button>
	<P><label for="title">角色:  </label><input type="text" id='title' name="title"/></P>
	<ul>
	<?php if(is_array($rule_list)): foreach($rule_list as $key=>$r): if(($r["pid"]) == "0"): ?><li><?php echo ($r["title"]); ?><input type="checkbox" name="rules[]" value="<?php echo ($r["id"]); ?>" />
			<ul>
			<?php if(is_array($rule_list)): foreach($rule_list as $key=>$rr): if(($rr["pid"]) == $r["id"]): ?><li><?php echo ($rr["title"]); ?><input type="checkbox" name="rules[]" value="<?php echo ($rr["id"]); ?>" />
				</li><?php endif; endforeach; endif; ?>
			</ul>
		</li><?php endif; endforeach; endif; ?>
	</ul>
</form>

</body>
</html>