<?php

function ykapi_get_all_posts()
{
    $args = array(
        "numberposts" => -1,
        "post_type" => "post",
        "post_status" => "publish"
    );
    $all_posts = get_posts($args);
    $result = array();
    foreach ($all_posts as $post) {
        $data = array(
            "ID" => $post->ID,
            "thumbnail" => get_the_post_thumbnail_url($post->ID, "full"),
            "author" => get_the_author_meta("nickname", $post->post_author),
            "url" => urldecode(get_permalink($post->ID)),
            "slug" => $post->post_name,
            "date" => $post->post_date,
            "date_timestamp" => get_the_date("U", $post->ID),
            "modified" => $post->post_modified,
            "modified_timestamp" => get_the_modified_date("U", $post->ID),
            "title" => $post->post_title,
            "excerpt" => $post->post_excerpt,
            "category" => get_the_category($post->ID)
        );
        array_push($result, $data);
    };
    return $result;
}

function ykapi_get_siteinfo()
{
    $result = array(
        "name" => get_bloginfo("name"),
        "description" => get_bloginfo("description"),
        "home_url" => home_url(),
        "description" => get_bloginfo("description"),
        "favicon" => get_site_icon_url()
    );
    return $result;
}

function ykapi_search_posts($parameter)
{
    $args = array(
        "posts_per_page" => -1,
        "post_type" => array("post", "page", "blog", "news"),
        "s" => urldecode($parameter["keywords"]),
        "post_status" => "publish"
    );
    $query = new WP_Query($args);
    $all_posts = $query->posts;
    $result = array();
    foreach ($all_posts as $post) {
        $data = array(
            "ID" => $post->ID,
            "thumbnail" => get_the_post_thumbnail_url($post->ID, "full"),
            "author" => get_the_author_meta("nickname", $post->post_author),
            "url" => urldecode(get_permalink($post->ID)),
            "slug" => $post->post_name,
            "date" => $post->post_date,
            "date_timestamp" => get_the_date("U", $post->ID),
            "modified" => $post->post_modified,
            "modified_timestamp" => get_the_modified_date("U", $post->ID),
            "title" => $post->post_title,
            "excerpt" => $post->post_excerpt,
            "category" => get_the_category($post->ID)
        );
        array_push($result, $data);
    };
    return $result;
}

function ykapi_add_ep()
{
    $api_endpoints = array(
        "postlist" => "ykapi_get_all_posts",
        "siteinfo" => "ykapi_get_siteinfo",
        '/search/(?P<keywords>.*?("|$)|((?<=[\t ",+])|^)[^\t ",+]+)' => "ykapi_search_posts"
    );

    foreach ($api_endpoints as $endpoint => $callback) {
        register_rest_route(
            "/api/yuika",
            "/" . $endpoint,
            array(
                "methods" => "GET",
                "callback" => $callback
            )
        );
    }
}
add_action("rest_api_init", "ykapi_add_ep");