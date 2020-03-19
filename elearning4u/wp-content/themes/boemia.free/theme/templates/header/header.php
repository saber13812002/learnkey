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

global $yit_topbar;
$yit_topbar = true;
 
do_action( 'yit_before_logo' ) ?>

<div class="row">
	<!-- START LOGO -->
	<div id="logo" class="span12 group">
	    <?php
	    /**
	     * @see yit_logo
	     */
	    do_action( 'yit_logo' ) ?> 
	</div>
	<!-- END LOGO -->
	<?php do_action( 'yit_after_logo' ) ?>
</div>

<div class="row">
    <div class="visible-1024 tablet-view hidden-phone"><?php if( yit_get_option( 'show-top-menu-search' ) ) the_widget('search_mini'); ?></div>

	<div id="nav" class="span12 group">
		<!-- START MAIN NAVIGATION -->
		<?php
		/**
		 * @see yit_main_navigation
		 */
		do_action( 'yit_main_navigation') ?>
		<!-- END MAIN NAVIGATION -->

		<div id="nav-sidebar">
            <div class="hidden-1024 visible-phone"><?php if( yit_get_option( 'show-top-menu-search' ) ) the_widget('search_mini'); ?></div>
		</div>
	</div>
</div>

<?php $yit_topbar = false; ?>