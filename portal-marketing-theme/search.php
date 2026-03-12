<?php
/**
 * Search template.
 *
 * @package PortalMarketingNews
 */

get_header();
pmn_breadcrumbs();
?>
<div class="pmn-content-layout">
    <main>
        <h1 class="pmn-section-title">
            <?php
            printf(
                esc_html__('Resultados para: %s', 'portal-marketing-news'),
                '<span>' . esc_html(get_search_query()) . '</span>'
            );
            ?>
        </h1>

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', get_post_type()); ?>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Não encontramos resultados para sua busca.', 'portal-marketing-news'); ?></p>
        <?php endif; ?>
    </main>
    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
