<?php
/**
 * Header template.
 *
 * @package PortalMarketingNews
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="pmn-site-header">
    <div class="pmn-container pmn-header-inner">
        <a class="pmn-logo" href="<?php echo esc_url(home_url('/')); ?>">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <?php bloginfo('name'); ?>
            <?php endif; ?>
        </a>

        <nav class="pmn-main-nav" aria-label="Menu principal">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => '__return_false',
            ]);
            ?>
        </nav>

        <?php get_search_form(); ?>
    </div>
</header>
<div class="pmn-main">
    <div class="pmn-container">
