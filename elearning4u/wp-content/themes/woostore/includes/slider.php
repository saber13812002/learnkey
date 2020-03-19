<?php global $woo_options; $count = 0; ?>

<?php if (isset($woo_options[ 'woo_slider' ]) && $woo_options[ 'woo_slider' ] == 'true') { ?>

<div id="slides">
	
	<?php $slides = get_posts( array( 'suppress_filters' => 0 , 'post_type' => 'slide', 'numberposts' => $woo_options['woo_slider_entries'] ) ); ?>
	<?php if (!empty($slides)) { ?>
	<div class="slides_holder">
		<?php if ( count( $slides ) > 1 && isset( $woo_options['woo_slider_nextprev'] ) && $woo_options['woo_slider_nextprev'] == 'true' ) { ?>
			<div class="navigation <?php if ( !$title && !$content ) { echo "no-overlay"; } ?>">
				<a class="prev" href="#"><?php _e( '&larr; Previous', 'woothemes' ) ?></a>
				<a class="next" href="#"><?php _e( 'Next &rarr;', 'woothemes' ) ?></a>
			</div>
		<?php } ?>
				
		<div class="slides_container" <?php if($woo_options[ 'woo_slider_entries' ] == 1) { echo 'style="display: block;overflow: hidden;position: relative;"'; }?>>
			
			<?php foreach($slides as $post) { setup_postdata($post);  ?>
				<?php
					$has_image = get_post_meta( $post->ID, 'image', true );
					$has_url = get_post_meta( $post->ID, 'slide-url', true );
					$post_thumb = get_option('woo_post_image_support') == 'true' && has_post_thumbnail();
					$title = $woo_options[ 'woo_slider_title' ] == "true";
					$content = $woo_options[ 'woo_slider_content' ] == "true";
					
					// layouts
					$layout = get_post_meta($post->ID, 'slide_layout', true);
					if ( $layout == "" ) { $layout = "bottom"; }
					if ($layout == "right") {
						$slide_content_class = 'right';
					} elseif ($layout == "top") {
						$slide_content_class = 'top';
					} elseif ($layout == "bottom") {
						$slide_content_class = 'bottom';
					} else {
						$slide_content_class = 'left';					
					}
					
				?>
				<?php if ( $has_image || $post_thumb ) { $count++;?>

				<div class="slide slide-<?php echo $count; ?>" <?php if($woo_options[ 'woo_slider_entries' ] == 1) { echo 'style="display:block;"'; }?>>
	    				    			
	    			<div class="slide-content <?php echo $slide_content_class; ?> <?php if ( $title || $content ) { echo "slide-overlay"; } ?>">
	    			
	    				<?php if ( $title ) { ?><h2><?php if ($has_url != '') { ?><a href="<?php echo $has_url; ?>"><?php } ?><?php the_title(); ?><?php if ($has_url != '') { ?></a><?php } ?></h2><?php } ?>
	    				<?php if ( $content ) { ?><div class="slide-text"><?php the_excerpt(); ?></div><?php } ?>
	    				
	    			</div><!-- /.content -->
	    			
	    			<div class="image">
						<?php if ($has_url != '') { ?><a href="<?php echo $has_url; ?>"><?php } ?>   				
	    				<?php if ($woo_options[ 'woo_slider_autoheight' ] == "true") { ?>
	    					<?php woo_image('key=image&width=620&class=slide-img&link=img'); ?>
						<?php } else { ?>
							<?php woo_image('key=image&width=620&height='.$woo_options['woo_slider_fixed_height'].'&class=slide-img&link=img'); ?>
						<?php } ?>
						<?php if ($has_url != '') { ?></a><?php } ?>
	    			</div><!-- /.image -->
	      
	    		</div><!-- /.slide -->
				<?php } ?>
			<?php } ?>			
	    </div><!-- /.slides_container -->
	
	</div><!-- /.slides_holder -->
	
	<?php } else { ?>
		<div <?php post_class(); ?>>
                <p class="woo-sc-box note"><?php _e('Please add some Slides to display the Featured Slider.','woothemes'); ?></p>
        </div><!-- /.post -->
    <?php } ?>
</div><!-- /.slides -->

<?php } // end enabled ?>