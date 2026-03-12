<?php
/**
 * Comments template.
 *
 * @package PortalMarketingNews
 */

if (post_password_required()) {
    return;
}
?>
<section class="pmn-card" id="comments">
    <div class="pmn-card-content">
        <?php if (have_comments()) : ?>
            <h2 class="pmn-section-title">
                <?php
                printf(
                    esc_html(_nx('1 comentário', '%1$s comentários', get_comments_number(), 'comments title', 'portal-marketing-news')),
                    esc_html(number_format_i18n(get_comments_number()))
                );
                ?>
            </h2>
            <ol class="pmn-list">
                <?php wp_list_comments(['style' => 'ol', 'short_ping' => true]); ?>
            </ol>
        <?php endif; ?>

        <?php comment_form(); ?>
    </div>
</section>
