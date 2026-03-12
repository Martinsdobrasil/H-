<?php
/**
 * Page template.
 *
 * @package PortalMarketingNews
 */

get_header();
pmn_breadcrumbs();
?>
<div class="pmn-content-layout">
    <main>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('pmn-card'); ?>>
                <div class="pmn-card-content">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-content"><?php the_content(); ?></div>
                </div>
            </article>
        <?php endwhile; ?>
    </main>
    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
