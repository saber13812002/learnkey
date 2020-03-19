<?php get_header(); ?>
<?php global $woo_options; ?>

    <div id="content" class="col-full">
		<div id="main" class="col-left">      
           
		<?php get_template_part( 'includes/slider' ); ?>
		
        <?php if ( isset( $woo_options['woo_homepage_content'] ) && $woo_options['woo_homepage_content'] != 'Disabled' ) { ?>
        <div class="home-content">
			<?php 
				if ( $woo_options['woo_homepage_content'] == "Show latest blog post" ) {
					query_posts( 'showposts=1' );
				} else { 			
					query_posts( 'page_id=' . get_page_id( $woo_options['woo_homepage_content'] ) ); 
				}
			?>
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		        					
            <h2 class="title"><?php the_title(); ?></h2>
		    <div class="entry">
		    	<?php the_content(); ?>
		    </div>
            <?php endwhile; endif; ?>
            <div class="fix"></div>
        </div><!-- /.home-content -->
        <?php } ?>
				
		<div id="featured-products" class="fp-slider">
			<h2><?php _e('Featured Products', 'woothemes'); ?></h2>
			<?php if ( $woo_options[ 'woo_featured_product_style' ] == "slider" ) { ?>
				<?php get_template_part( 'includes/featured-products-slider' ); ?>
	        <?php } else { ?>
	        	<?php echo do_shortcode('[featured_products per_page="4" columns="2"]'); ?>
	        <?php } ?>
		</div><!--/#featured-products-->
		
		<div class="product-gallery">
			<h2><?php _e('Recent Products', 'woothemes'); ?></h2>
			<?php echo do_shortcode('[recent_products per_page="6" columns="2"]'); ?>
		</div><!--/.product-gallery-->
						                
		</div><!-- /#main -->

        <?php get_sidebar(); ?>

    </div><!-- /#content -->
		
<?php get_footer(); ?>

