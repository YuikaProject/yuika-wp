<?php

if (!defined("ABSPATH")) exit;

function ykwp_add_settings_main()
{
    add_submenu_page("tools.php", "Yuika Get WP Post API Settings", "Yuika WP", "administrator", "yuikawp_config", "ykwp_display_plugin_sub_page");
}

function ykwp_display_plugin_sub_page()
{
    if (isset($_POST["yuikawp_config"])) {
        check_admin_referer("yuikawp_config");
        $opt = $_POST["yuikawp_config"];
        update_option("yuikawp_config", $opt);
?><div id="settings_updated" class="updated notice is-dismissible">
            <p><strong>設定を保存したよ！</strong></p>
        </div>
    <?php
    }

    ?>

    <div class="wrap">
        <div id="icon-options-general" class="icon32"></div>
        <h2>Yuika Get WP Post API 設定</h2>
        <div id="settings" style="clear:both;">
            <form action="" method="post">
                <?php wp_nonce_field("yuikawp_config"); ?>

                <h3>API 有効化設定</h3>
                <p>チェックを入れることで、APIを有効化できます。<br>申請前に、有効化しておいてください。</p>
                <tr>
                    <input name="yuikawp_config[api-tf]" type="hidden" value="false" />
                    <td><label><input name="yuikawp_config[api-tf]" type="checkbox" id="api-tf" value="true" <?php checked(@get_ykwp_opt("api-tf"), "true"); ?> /> API有効</label></td>
                </tr>

                <?php
                if (is_plugin_active("search-exclude/search-exclude.php")) { ?>
                    <h3>Search Exclude プラグイン連携</h3>
                    <p>チェックを入れることで、一覧表示や検索時に「Search Exclude」プラグインで非表示に設定した投稿を非表示にできます。</p>
                    <tr>
                        <input name="yuikawp_config[sync-search-exclude-tf]" type="hidden" value="false" />
                        <td><label><input name="yuikawp_config[sync-search-exclude-tf]" type="checkbox" id="sync-search-exclude-tf" value="true" <?php checked(@get_ykwp_opt("sync-search-exclude-tf"), "true"); ?> /> 連携する</label></td>
                    </tr>
                <?php
                }
                ?>

                <h3>表示する投稿タイプ</h3>
                <p>チェックを入れた投稿タイプのみ、一覧表示されます。</p>
                <tr>
                    <?php
                    $post_types = get_post_types(array("public" => true));
                    foreach ($post_types as $post_type) {
                        if ($post_type == "attachment") continue;
                        ?>
                        <input name="yuikawp_config[post-type_<?php echo $post_type ?>]" type="hidden" value="false" />
                        <td><label><input name="yuikawp_config[post-type_<?php echo $post_type ?>]" type="checkbox" id="post-type_<?php echo $post_type ?>" value="true" <?php checked(@get_ykwp_opt("post-type_" . $post_type), "true"); ?> /> <?php echo $post_type ?></label></td>
                        <br>
                    <?php
                    }
                    ?>
                </tr>

                <?php submit_button(); ?>
            </form>
        </div>
    </div>
<?php
}

add_action("admin_menu", "ykwp_add_settings_main");
