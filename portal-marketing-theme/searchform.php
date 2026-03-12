<form role="search" method="get" class="pmn-search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="screen-reader-text" for="search-field"><?php esc_html_e('Buscar:', 'portal-marketing-news'); ?></label>
    <input id="search-field" type="search" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e('Buscar notícias', 'portal-marketing-news'); ?>">
    <button type="submit"><?php esc_html_e('Buscar', 'portal-marketing-news'); ?></button>
</form>
