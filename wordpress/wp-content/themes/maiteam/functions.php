
<?php

require_once get_template_directory() . '/inc/members.php';

function maiteam_enqueue_assets() {

    wp_enqueue_style(
        'maiteam-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'maiteam-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array('maiteam-fonts'),
        '7.55'
    );

    wp_enqueue_style(
        'maiteam-cover',
        get_template_directory_uri() . '/assets/css/intro-cover.css',
        array('maiteam-main'),
        '2.1'
    );

    wp_enqueue_script(
        'maiteam-cover',
        get_template_directory_uri() . '/assets/js/intro-cover.js',
        array(),
        '2.0',
        true
    );

    wp_enqueue_script(
        'maiteam-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '7.54',
        true
    );

}

add_action('wp_enqueue_scripts', 'maiteam_enqueue_assets');

function maiteam_theme_setup() {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary' => 'Primary Menu'
    ));

}

add_action('after_setup_theme', 'maiteam_theme_setup');

function maiteam_query_vars($vars) {
    $vars[] = 'maiteam_member';
    return $vars;
}
add_filter('query_vars', 'maiteam_query_vars');

function maiteam_register_member_routes() {
    add_rewrite_rule(
        '^(mark-lorence|honey-rose|qeeundilyn|michelou)/?$',
        'index.php?maiteam_member=$matches[1]',
        'top'
    );
}
add_action('init', 'maiteam_register_member_routes');

function maiteam_flush_member_routes() {
    if (get_option('maiteam_rewrite_version') === '1') {
        return;
    }

    flush_rewrite_rules(false);
    update_option('maiteam_rewrite_version', '1');
}
add_action('init', 'maiteam_flush_member_routes', 99);

function maiteam_ensure_member_pages() {
    if (get_option('maiteam_member_pages') === '1') {
        return;
    }

    foreach (maiteam_get_members() as $slug => $member) {
        $existing = get_page_by_path($slug);

        if ($existing) {
            continue;
        }

        wp_insert_post(array(
            'post_title'  => $member['name'],
            'post_name'   => $slug,
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_content'=> '',
        ));
    }

    update_option('maiteam_member_pages', '1');
}
add_action('init', 'maiteam_ensure_member_pages');

function maiteam_member_template($template) {
    $slug = get_query_var('maiteam_member');

    if (!$slug && is_page()) {
        $slug = get_post_field('post_name', get_queried_object_id());
    }

    if ($slug && maiteam_get_member($slug)) {
        set_query_var('maiteam_member', $slug);
        return get_template_directory() . '/member.php';
    }

    return $template;
}
add_filter('template_include', 'maiteam_member_template');

function maiteam_member_title($title) {
    $slug   = get_query_var('maiteam_member');
    $member = $slug ? maiteam_get_member($slug) : null;

    if ($member) {
        return $member['name'] . ' - More Info';
    }

    return $title;
}
add_filter('pre_get_document_title', 'maiteam_member_title');

function maiteam_body_class($classes) {
    if (get_query_var('maiteam_member')) {
        $classes[] = 'mai-member-body';
    }

    return $classes;
}
add_filter('body_class', 'maiteam_body_class');
