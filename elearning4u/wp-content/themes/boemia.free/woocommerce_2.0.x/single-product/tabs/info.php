<?php
/**
 * Info Tab
 */
global $post;
$show = yit_get_post_meta($post->ID, '_use_ask_info');
$form_id = yit_get_option('shop-products-details-contact-form');
if($form_id != -1 && $show ) {
    echo '<div id="ask-info-wrapper">';
    echo do_shortcode( '[contact_form name="'. $form_id .'" ]' );
    echo '</div>';
}