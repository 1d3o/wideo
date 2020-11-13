<?php 
function clear_rocket_cache_on_post_save() {
     rocket_clean_domain();
}
if(in_array( 'wp-rocket/wp-rocket.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    add_action( 'save_post', 'clear_rocket_cache_on_post_save' );
};