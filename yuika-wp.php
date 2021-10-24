<?php

/*
Plugin Name: Yuika WP
Plugin URI: https://yuika.ayutsuki.net/post/tips/yuika-wp-plugin/
Description: 唯香 -ゆいか- とWordPressサイトの連携をできるようにするプラグイン。
Version: 1.0.0
Author: 鮎月 -Liteyan-
Author URI: https://ayutsuki.net/
License: GPL3
*/

if (!defined("ABSPATH")) exit;
$ykwp =  plugin_dir_path(__FILE__);
$files = array("functions.php", "api.php", "settings-page.php");

foreach ($files as $file_name) {
	include_once($ykwp . $file_name);
}

require $ykwp . "plugin-update-checker/plugin-update-checker.php";
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	"http://forum.yuika.ayutsuki.net/yuika-wp/version.json",
	__FILE__,
	"yuika-wp"
);
