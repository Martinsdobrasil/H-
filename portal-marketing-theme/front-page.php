<?php
/**
 * Front page template.
 *
 * @package PortalMarketingNews
 */

get_header();
pmn_breadcrumbs();

$featured_query = new WP_Query([
    'post_type'           => 'post',
    'posts_per_page'      => 1,
    'ignore_sticky_posts' => true,
]);

$secondary_query = new WP_Query([
    'post_type'           => 'post',
    'posts_per_page'      => 4,
    'offset'              => 1,
    'ignore_sticky_posts' => true,
]);
?>
<section class="pmn-grid pmn-home-hero">
    <div>
        <?php if ($featured_query->have_posts()) : ?>
            <?php while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
                <article <?php post_class('pmn-card'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large'); ?>
                    <?php endif; ?>
                    <div class="pmn-card-content">
                        <div class="pmn-kicker"><?php the_category(', '); ?></div>
                        <h2 class="pmn-title pmn-title--xl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="pmn-meta"><?php echo esc_html(get_the_date()); ?> • <?php the_author(); ?></p>
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>

    <aside class="pmn-sidebar">
        <section class="pmn-card">
            <div class="pmn-card-content">
                <h2 class="pmn-section-title"><?php esc_html_e('Destaques do Dia', 'portal-marketing-news'); ?></h2>
                <ul class="pmn-list">
                    <?php while ($secondary_query->have_posts()) : $secondary_query->the_post(); ?>
                        <li>
                            <span class="pmn-kicker"><?php the_category(', '); ?></span>
                            <a href="<?php the_permalink(); ?>"><strong><?php the_title(); ?></strong></a>
                        </li>
                    <?php endwhile; wp_reset_postdata(); ?>
                </ul>
            </div>
        </section>

        <section class="pmn-banner">
            <h3><?php esc_html_e('Espaço Publicitário', 'portal-marketing-news'); ?></h3>
            <p><?php esc_html_e('Banner 300x250 para parceiros e anunciantes.', 'portal-marketing-news'); ?></p>
        </section>

        <section class="pmn-newsletter">
            <h3><?php esc_html_e('Newsletter do Portal', 'portal-marketing-news'); ?></h3>
            <p><?php esc_html_e('Receba as principais notícias de publicidade e marketing.', 'portal-marketing-news'); ?></p>
            <label for="newsletter-email" class="screen-reader-text"><?php esc_html_e('Seu e-mail', 'portal-marketing-news'); ?></label>
            <input id="newsletter-email" type="email" placeholder="nome@email.com">
            <button type="button"><?php esc_html_e('Quero receber', 'portal-marketing-news'); ?></button>
        </section>
    </aside>
</section>

<section class="pmn-grid pmn-home-sections" aria-label="Editorias">
    <?php
    $sections = ['Publicidade', 'Marketing', 'Branding', 'Mídia', 'Redes Sociais', 'Campanhas', 'Negócios', 'Tendências'];
    foreach ($sections as $section) :
        $category = get_category_by_slug(sanitize_title($section));
        $cat_query = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'cat'            => $category ? $category->term_id : 0,
        ]);
        ?>
        <article class="pmn-card">
            <div class="pmn-card-content">
                <h2 class="pmn-section-title"><?php echo esc_html($section); ?></h2>
                <ul class="pmn-list">
                    <?php if ($cat_query->have_posts()) : ?>
                        <?php while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <li><?php esc_html_e('Nenhuma notícia publicada nesta editoria ainda.', 'portal-marketing-news'); ?></li>
                    <?php endif; ?>
                </ul>
            </div>
        </article>
    <?php endforeach; ?>
</section>
<?php
get_footer();
