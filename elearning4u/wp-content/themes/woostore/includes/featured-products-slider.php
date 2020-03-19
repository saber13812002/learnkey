<ul class="featured-products">
<?php
global $woocommerce;

$args = array( 'post_type' => 'product', 'posts_per_page' => 10, 'meta_key' => 'featured', 'meta_value' => 'yes' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); $_product = &new woocommerce_product( $loop->post->ID ); ?>

<li>
	<h2><?php the_title(); ?></h2>
	<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php // echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
			<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_thumbnail'); else echo '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_thumbnail_image_width').'px" height="'.$woocommerce->get_image_size('shop_thumbnail_image_height').'px" />'; ?>
			
		<?php // if ( $loop->post->post_title ) echo get_the_title( $loop->post->ID ); else echo $loop->post->ID; ?>			
	</a> 
	<span class="price"><?php echo $_product->get_price_html(); ?></span>
	<?php woocommerce_template_loop_add_to_cart( $loop->post, $_product ); ?>
</li>
<?php endwhile; ?>
</ul>