<?php

if (!defined("ABSPATH")) exit;

function get_ykwp_opt($type)
{
    $ykwp_opt = get_option("yuikawp_config", "");
    $ykwp_return = $ykwp_opt[$type] ? $ykwp_opt[$type] : "";
    return $ykwp_return;
}
