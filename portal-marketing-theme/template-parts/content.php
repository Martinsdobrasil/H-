<?php
/**
 * Generic content card.
 *
 * @package PortalMarketingNews
 */
?>
<article <?php post_class('pmn-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail('medium_large'); ?></a>
    <?php endif; ?>
    <div class="pmn-card-content">
        <div class="pmn-kicker"><?php the_category(', '); ?></div>
        <h2 class="pmn-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <p class="pmn-meta"><?php echo esc_html(get_the_date()); ?> • <?php the_author(); ?></p>
        <?php the_excerpt(); ?>
    </div>
</article>
