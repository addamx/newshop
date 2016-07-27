<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<form action="/newshop/Admin/Categorys/edit?id=8" method="post" id="aform">
	<P><label for="name">栏目名:  </label><input type="text" id='name' name="name" value="<?php echo ($info["name"]); ?>" /></P>
	<p>
	<label for="p_category">父栏目</label>
	<select name="pid" id="p_category">
		<option value="0">无</option>
		<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><!--disabled本栏目及其子孙栏目-->
			<option value="<?php echo ($v["id"]); ?>" 
				<?php if(($v["id"]) == $info["pid"]): ?>selected="selected"<?php endif; ?> 
				<?php if(($v["id"]) == $info["id"]): ?>disabled="disabled"<?php endif; ?>
				<?php if(($v["pid"]) == $info["id"]): ?>disabled="disabled"<?php endif; ?>
				>
				<?php echo (str_repeat("&nbsp;",$v["lev"]*4)); echo ($v["name"]); ?>
			</option><?php endforeach; endif; ?>
	</select>
	</p>
	<p><textarea name="intro" id="" cols="30" rows="10"><?php echo ($info["intro"]); ?></textarea></p>
	<input type="text" name="id" hidden="hidden" value="<?php echo ($info["id"]); ?>">
	<button type='submit'>修改</button>
</form>

</body>
</html>