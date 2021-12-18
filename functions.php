<?php

if (!defined("ABSPATH")) exit;

function get_ykwp_opt($type)
{
    $ykwp_opt = get_option("yuikawp_config", "");
    $ykwp_return = $ykwp_opt[$type] ? $ykwp_opt[$type] : "";
    return $ykwp_return;
}

function get_ykwp_version()
{
    $ykwp_data = get_file_data(plugin_dir_path(__FILE__) . "yuika-wp.php", array("Version" => "Version"));
    $ykwp_version = $ykwp_data["Version"];
    return $ykwp_version;
}
