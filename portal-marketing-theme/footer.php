<?php
/**
 * Footer template.
 *
 * @package PortalMarketingNews
 */
?>
    </div>
</div>
<footer class="pmn-site-footer">
    <div class="pmn-container pmn-footer-inner">
        <?php
        wp_nav_menu([
            'theme_location' => 'footer',
            'container'      => false,
            'fallback_cb'    => '__return_false',
        ]);
        ?>
        <p><?php echo esc_html(date_i18n('Y')); ?> &copy; <?php bloginfo('name'); ?>.</p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
