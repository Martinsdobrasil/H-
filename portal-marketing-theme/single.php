<?php
/**
 * Single post template.
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
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('large'); ?>
                <?php endif; ?>
                <div class="pmn-card-content">
                    <div class="pmn-kicker"><?php the_category(', '); ?></div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <p class="entry-meta"><?php the_author(); ?> • <?php echo esc_html(get_the_date()); ?></p>
                    <div class="entry-content"><?php the_content(); ?></div>

                    <div class="pmn-share">
                        <p><strong><?php esc_html_e('Compartilhar:', 'portal-marketing-news'); ?></strong></p>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener">X/Twitter</a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener">LinkedIn</a>
                    </div>

                    <section class="pmn-related">
                        <h2 class="pmn-section-title"><?php esc_html_e('Notícias relacionadas', 'portal-marketing-news'); ?></h2>
                        <ul class="pmn-list">
                            <?php
                            $related = new WP_Query([
                                'post_type'      => 'post',
                                'posts_per_page' => 3,
                                'post__not_in'   => [get_the_ID()],
                                'category__in'   => wp_get_post_categories(get_the_ID()),
                            ]);
                            while ($related->have_posts()) : $related->the_post();
                                echo '<li><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></li>';
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    </section>

                    <section class="pmn-banner">
                        <h3><?php esc_html_e('Publicidade', 'portal-marketing-news'); ?></h3>
                        <p><?php esc_html_e('Espaço reservado para campanhas patrocinadas.', 'portal-marketing-news'); ?></p>
                    </section>
                </div>
            </article>

            <?php if (comments_open() || get_comments_number()) : ?>
                <?php comments_template(); ?>
            <?php endif; ?>
        <?php endwhile; ?>
    </main>
    <?php get_sidebar(); ?>
</div>
<?php
get_footer();
