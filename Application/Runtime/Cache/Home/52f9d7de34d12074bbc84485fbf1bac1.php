<?php if (!defined('THINK_PATH')) exit();?><ul>
	<p>Ad Widget</p>
	<?php if(is_array($list)): foreach($list as $key=>$v): ?><li><a href="<?php echo ($v["link"]); ?>"><?php echo ($v["title"]); ?></a></li><?php endforeach; endif; ?>
</ul>