<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <title>管理中心:<?php echo (MODULE_NAME); ?>-><?php echo (CONTROLLER_NAME); ?></title>
    </head>
<body>
<form action="/newshop/index.php/admin/categorys/add" method="post" id="aform">
	<P><label for="name">栏目名:  </label><input type="text" id='name' name="name"/></P>
	<p>
	<label for="p_category">父栏目</label>
	<select name="pid" id="p_category">
		<option value="0">无</option>
		<?php if(is_array($categorys)): foreach($categorys as $key=>$v): ?><option value="<?php echo ($v["id"]); ?>"><?php echo (str_repeat("&nbsp;",$v["lev"]*4)); echo ($v["name"]); ?></option><?php endforeach; endif; ?>
	</select>
	</p>
	<p><textarea name="intro" id="" cols="30" rows="10"></textarea></p>
	<button type='submit'>增加</button>
</form>

</body>
</html>