<?php
/**
 * WordPress博客集成Hitokoto一言经典语句功能
 * 二开作者：沈唁
 * 博客地址：https://qq52o.me/1801.html
 */

//获取句子文件的绝对路径
//如果你介意别人可能会拖走这个文本，可以把文件名自定义一下，或者通过Nginx禁止拉取也行。
$path = dirname(__FILE__);
$file = file($path . "/hitokoto.txt");

//随机读取一行
$arr = mt_rand(0, count($file) - 1);
$content = trim($file[$arr]);

//编码判断，用于输出相应的响应头部编码
if (isset($_GET['charset']) && !empty($_GET['charset'])) {
	$charset = $_GET['charset'];
	if (strcasecmp($charset, "gbk") == 0) {
		$content = mb_convert_encoding($content, 'gbk', 'utf-8');
	}
} else {
	$charset = 'utf-8';
}
header("Content-Type: text/html; charset=$charset");

//格式化判断，输出js或纯文本
if ($_GET['syz'] === 'js') {
	echo "function hitokoto(){document.write('" . $content . "');}";
} else {
	echo $content;
}