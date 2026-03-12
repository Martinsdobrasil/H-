<?php
/**
 * Sidebar template.
 *
 * @package PortalMarketingNews
 */
?>
<aside class="pmn-sidebar" aria-label="Barra lateral">
    <?php if (is_active_sidebar('portal-sidebar')) : ?>
        <?php dynamic_sidebar('portal-sidebar'); ?>
    <?php else : ?>
        <section class="pmn-card">
            <div class="pmn-card-content">
                <h3 class="pmn-section-title"><?php esc_html_e('Mais lidas', 'portal-marketing-news'); ?></h3>
                <ul class="pmn-list">
                    <?php
                    $popular = new WP_Query([
                        'post_type'      => 'post',
                        'posts_per_page' => 5,
                        'orderby'        => 'comment_count',
                    ]);
                    while ($popular->have_posts()) : $popular->the_post();
                        echo '<li><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></li>';
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>
</aside>
