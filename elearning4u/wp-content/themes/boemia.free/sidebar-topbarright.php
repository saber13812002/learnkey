<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
wp_reset_query();

do_action( 'yit_before_sidebar_topbarright' );
?>


<div class="hide-topbar <?php if( !yit_get_option('responsive-topbar-menu') ) echo 'hide-menu '; if( !yit_get_option('responsive-topbar-language') ) echo 'hide-language'; ?>" style="display: inline;">
    <?php if( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Topbar Right' ) ) { } ?>
</div>
<?php do_action( 'yit_after_sidebar_topbarright' );