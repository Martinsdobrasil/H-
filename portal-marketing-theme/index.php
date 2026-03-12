<?php
/**
 * Fallback template.
 *
 * @package PortalMarketingNews
 */

get_header();
pmn_breadcrumbs();
?>
<div class="pmn-content-layout">
    <main>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', get_post_type()); ?>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Nenhum conteúdo encontrado.', 'portal-marketing-news'); ?></p>
        <?php endif; ?>
    </main>
    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
