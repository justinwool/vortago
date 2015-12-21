<?php
//Multinews functions
require_once get_template_directory() . '/framework/main.php';
//For demo site only
if (file_exists(get_template_directory() . '/demo/demo.php')) {
            require_once get_template_directory() . '/demo/demo.php';
}

// Fix 404 in pafination
function mom_remove_page_from_query_string($query_string)
{
if (isset($query_string['name']) && $query_string['name'] == 'page' && isset($query_string['page'])) {
unset($query_string['name']);
list($delim, $page_index) = split('/', $query_string['page']);
$query_string['paged'] = $page_index;
}
return $query_string;
}
add_filter('request', 'mom_remove_page_from_query_string');


//search in ticker menu 
if (mom_option('bar_search') == 1) {
add_filter( 'wp_nav_menu_items', 'mom_search_in_wp_ticker', 10, 2 );
}
function mom_search_in_wp_ticker ( $items, $args ) {
    if ($args->theme_location == 'breaking') { 
			ob_start();
    	?>
  <li class="top-search breaking-search menu-item-iconsOnly"><a href="#"><i class="icon_only fa-icon-search"></i></a>
<div class="search-dropdown">
  <form class="mom-search-form" method="get" action="<?php echo home_url(); ?>/">
      <input type="text" id="tb-search" class="sf" name="s" placeholder="<?php _e('Enter keywords and press enter', 'framework') ?>" required="" autocomplete="off">
    <?php if(mom_option('ajax_search_disable')) { ?><span class="sf-loading"><img src="<?php echo MOM_IMG; ?>/ajax-search-nav.png" alt="search" width="16" height="16"></span><?php } ?>
    <?php if(defined('ICL_LANGUAGE_CODE')) { ?><input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"/><?php } ?>
  </form>
  <?php if(mom_option('ajax_search_disable')) { ?>
  <div class="ajax-search-results"></div>
  <?php } ?>
</div>
</li>

<?php
			$output = ob_get_contents();
			ob_end_clean();

        $items .= $output;
    }
    return $items;
}
if ( ! isset( $content_width ) ) {

    $content_width = 1000;

}