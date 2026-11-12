
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
wp_body_open();

$is_member = (bool) get_query_var('maiteam_member');
$home_href = $is_member ? home_url('/#home') : '#home';
$about_href = $is_member ? home_url('/#mai-about') : '#mai-about';
$projects_href = $is_member ? home_url('/#mai-projects') : '#mai-projects';
$languages_href = $is_member ? home_url('/#mai-languages') : '#mai-languages';
?>

<header class="mai-header">

    <div class="mai-header-container">

        <a href="<?php echo esc_url($home_href); ?>" class="mai-logo">
            MAITEAM PORTFOLIO
        </a>

        <nav class="mai-navigation" aria-label="Primary">
            <a href="<?php echo esc_url($home_href); ?>"<?php echo $is_member ? '' : ' class="is-active"'; ?>>Home</a>
            <a href="<?php echo esc_url($about_href); ?>">About Us</a>
            <a href="<?php echo esc_url($projects_href); ?>">Projects</a>
            <a href="<?php echo esc_url($languages_href); ?>">Languages</a>
        </nav>

    </div>

</header>
