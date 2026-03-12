<?php
/**
 * Archive template.
 *
 * @package PortalMarketingNews
 */

get_header();
pmn_breadcrumbs();
?>
<div class="pmn-content-layout">
    <main>
        <header>
            <h1 class="pmn-section-title"><?php the_archive_title(); ?></h1>
            <?php the_archive_description('<div class="pmn-meta">', '</div>'); ?>
        </header>

        <?php if (have_posts()) : ?>
            <div class="pmn-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('template-parts/content', get_post_type()); ?>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php esc_html_e('Nenhuma notícia encontrada.', 'portal-marketing-news'); ?></p>
        <?php endif; ?>
    </main>
    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
