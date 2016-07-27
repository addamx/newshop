<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<p id='info'></p>
<form action="/newshop/Admin/Group/ajaxmodify" method="post" id="aform">
	<button type='submit' onclick="ajaxmodify();return false;">修改</button>
	<p>ID: <?php echo ($group["id"]); ?></p>
	<input type='text' hidden name='id' value="<?php echo ($group["id"]); ?>"/>
	<P><label for="title">角色:  </label><input type="text" id='title' name="title" value="<?php echo ($group["title"]); ?>"/></P>
	<ul>
	<?php if(is_array($rule_list)): foreach($rule_list as $key=>$r): if(($r["pid"]) == "0"): ?><li><?php echo ($r["title"]); ?><input type="checkbox" name="rules[]" value="<?php echo ($r["id"]); ?>" <?php if(in_array(($r["id"]), is_array($group["rules"])?$group["rules"]:explode(',',$group["rules"]))): ?>checked="checked"<?php endif; ?> />
			<ul>
			<?php if(is_array($rule_list)): foreach($rule_list as $key=>$rr): if(($rr["pid"]) == $r["id"]): ?><li><?php echo ($rr["title"]); ?><input type="checkbox" name="rules[]" value="<?php echo ($rr["id"]); ?>" <?php if(in_array(($rr["id"]), is_array($group["rules"])?$group["rules"]:explode(',',$group["rules"]))): ?>checked="checked"<?php endif; ?> />
				</li><?php endif; endforeach; endif; ?>
			</ul>
		</li><?php endif; endforeach; endif; ?>
	</ul>
	
</form>
<script type="text/javascript" src="http://apps.bdimg.com/libs/jquery/2.1.4/jquery.js"></script>
<script type="text/javascript">
function ajaxmodify() {
	var vdata = $("#aform").serialize();
	$.ajax({
		url:"/newshop/Admin/Group/ajaxmodify",
		data: vdata,
		type: 'post',
		dataType: 'json',
		success: function(rst) {
			$("#info").text(rst.info);
		}
	});
}

</script>
</body>
</html>