<?php
/**
 * Theme setup for Portal Marketing News.
 *
 * @package PortalMarketingNews
 */

if (! defined('ABSPATH')) {
    exit;
}

function pmn_setup_theme(): void
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');
    add_theme_support('align-wide');

    register_nav_menus([
        'primary' => __('Menu Principal', 'portal-marketing-news'),
        'footer'  => __('Menu de Rodapé', 'portal-marketing-news'),
    ]);
}
add_action('after_setup_theme', 'pmn_setup_theme');

function pmn_enqueue_assets(): void
{
    wp_enqueue_style('portal-marketing-news-style', get_stylesheet_uri(), [], '1.0.0');
}
add_action('wp_enqueue_scripts', 'pmn_enqueue_assets');

function pmn_register_sidebars(): void
{
    register_sidebar([
        'name'          => __('Sidebar do Portal', 'portal-marketing-news'),
        'id'            => 'portal-sidebar',
        'description'   => __('Widgets exibidos em páginas de posts, categorias e páginas internas.', 'portal-marketing-news'),
        'before_widget' => '<section class="pmn-card pmn-widget">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="pmn-section-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'pmn_register_sidebars');

function pmn_customize_register(WP_Customize_Manager $wp_customize): void
{
    $wp_customize->add_section('pmn_visual_identity', [
        'title'       => __('Identidade Visual do Portal', 'portal-marketing-news'),
        'description' => __('Defina cores e tipografia base do tema.', 'portal-marketing-news'),
        'priority'    => 30,
    ]);

    $wp_customize->add_setting('pmn_primary_color', [
        'default'           => '#d71920',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pmn_primary_color_control', [
        'label'    => __('Cor Primária', 'portal-marketing-news'),
        'section'  => 'pmn_visual_identity',
        'settings' => 'pmn_primary_color',
    ]));
}
add_action('customize_register', 'pmn_customize_register');

function pmn_inline_customizer_css(): void
{
    $primary_color = get_theme_mod('pmn_primary_color', '#d71920');
    $css = ':root{--pmn-primary:' . esc_attr($primary_color) . ';}';
    wp_add_inline_style('portal-marketing-news-style', $css);
}
add_action('wp_enqueue_scripts', 'pmn_inline_customizer_css', 20);

function pmn_elementor_theme_locations(\ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $manager): void
{
    $manager->register_all_core_location();
}

if (did_action('elementor/loaded')) {
    add_action('elementor/theme/register_locations', 'pmn_elementor_theme_locations');
}

function pmn_breadcrumbs(): void
{
    if (is_front_page()) {
        return;
    }

    echo '<nav class="pmn-breadcrumbs" aria-label="Breadcrumb">';
    echo '<a href="' . esc_url(home_url('/')) . '">' . esc_html__('Início', 'portal-marketing-news') . '</a>';

    if (is_category()) {
        echo ' / ';
        single_cat_title();
    } elseif (is_single()) {
        $category = get_the_category();
        if (! empty($category)) {
            echo ' / <a href="' . esc_url(get_category_link($category[0])) . '">' . esc_html($category[0]->name) . '</a>';
        }
        echo ' / ' . esc_html(get_the_title());
    } elseif (is_page()) {
        echo ' / ' . esc_html(get_the_title());
    }

    echo '</nav>';
}
