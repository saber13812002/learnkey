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
?>  

<?php if( yit_get_option('topbar') ): ?>
<!-- START TOP BAR -->
<div id="topbar">
	<div class="container">
		<div class="row">

            <div class="span12 wrap">
                <div class="left"><?php get_sidebar( 'topbarleft' ) ?></div>
                <div class="right"><?php get_sidebar( 'topbarright' ) ?></div>
            </div>

        </div>
	</div>
	
</div>
<?php endif;

$yit_topbar = false;
?>

