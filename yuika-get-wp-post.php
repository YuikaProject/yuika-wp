<?php

/*
Plugin Name: Yuika Get WP Post
Plugin URI: 
Description: 唯香 -ゆいか- でWordPressサイトの投稿一覧･検索をできるようにするプラグイン。
Version: 1.0.0
Author: 鮎月 -Liteyan-
Author URI: https://ayutsuki.net/
License: GPL3
*/

if (!defined("ABSPATH")) exit;
$ykapi_dir =  plugin_dir_path(__FILE__);

include_once($ykapi_dir . "api.php");

require $ykapi_dir . "plugin-update-checker/plugin-update-checker.php";
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	"http://files.liteyan.xyz/yuika-get-wp-post/version.json",
	__FILE__,
	"yuika-get-wp-post"
);
