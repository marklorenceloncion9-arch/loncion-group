<?php
$slug = get_query_var('maiteam_member');

if (!$slug && is_page()) {
    $slug = get_post_field('post_name', get_queried_object_id());
}

$member = maiteam_get_member($slug);

if (!$member) {
    wp_safe_redirect(home_url('/'));
    exit;
}

get_header();
?>

<main class="mai-member-page">
    <?php get_template_part('template-parts/member-panel', null, array(
        'slug'   => $slug,
        'member' => $member,
    )); ?>
</main>

<?php get_footer(); ?>
