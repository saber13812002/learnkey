<?php
/**
 * Reviews Tab
 */
 
global $woocommerce, $post; 

if ( comments_open() ) : ?>
	
	<?php comments_template(); ?>
	
<?php endif; ?>