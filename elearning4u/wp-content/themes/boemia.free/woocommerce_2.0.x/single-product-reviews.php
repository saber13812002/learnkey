<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $woocommerce;
?>
<?php if ( comments_open() ) : ?><div id="reviews"><?php

	echo '<div id="comments">';

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$count = $wpdb->get_var( $wpdb->prepare("
			SELECT COUNT(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = %d
			AND comment_approved = '1'
			AND meta_value > 0
		", $post->ID ) );

		$rating = $wpdb->get_var( $wpdb->prepare("
			SELECT SUM(meta_value) FROM $wpdb->commentmeta
			LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
			WHERE meta_key = 'rating'
			AND comment_post_ID = %d
			AND comment_approved = '1'
		", $post->ID ) );

		if ( $count > 0 ) {

			$average = number_format($rating / $count, 2);

			echo '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">';

			echo '<div class="star-rating" title="'.sprintf(__( 'Rated %s out of 5', 'yit' ), $average).'"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'yit' ).'</span></div>';

			echo '<h2>'.sprintf( _n('%s review for %s', '%s reviews for %s', $count, 'yit'), '<span itemprop="ratingCount" class="count">'.$count.'</span>', wptexturize($post->post_title) ).'</h2>';

		echo '</div>';

		} else {

			echo '<h2>'.__('Reviews', 'yit').'</h2>';

		}

	} else {

		echo '<h2>'.__( 'Reviews', 'yit' ).'</h2>';

	}

	$title_reply = '';

	if ( have_comments() ) :
        $title_reply = __('Leave a review for', 'yit').' &ldquo;'.$post->post_title.'&rdquo;';

		echo '<ol class="commentlist">';

		wp_list_comments( array( 'callback' => 'woocommerce_comments' ) );

		echo '</ol>';

		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Previous', 'yit' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'yit' ) ); ?></div>
			</div>
		<?php endif;
		
		echo '<p>'.__('Would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'yit').'</p>';
		
	else :

		$title_reply = __('Be the first to review', 'yit').' &ldquo;'.$post->post_title.'&rdquo;';

		echo '<p>'.__('There are no reviews yet, would you like to <a href="#review_form" class="inline show_review_form">submit yours</a>?', 'yit').'</p>';

	endif;

	$commenter = wp_get_current_commenter();

	echo '</div><div id="review_form_wrapper"><div id="review_form">';

	$comment_form = array(
		'title_reply' => $title_reply,
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'fields' => array(
			'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'yit' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" /></p>',
			'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'yit' ) . '</label> ' . '<span class="required">*</span>' .
			            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" /></p>',
		),
		'label_submit' => __('Submit Review', 'yit'),
		'logged_in_as' => '',
		'comment_field' => ''
	);

	if ( get_option('woocommerce_enable_review_rating') == 'yes' ) {

		$comment_form['comment_field'] = '<p class="comment-form-rating"><label for="rating">' . __('Rating', 'yit') .'</label><select name="rating" id="rating">
			<option value="">'.__('Rate&hellip;', 'yit').'</option>
			<option value="5">'.__('Perfect', 'yit').'</option>
			<option value="4">'.__('Good', 'yit').'</option>
			<option value="3">'.__('Average', 'yit').'</option>
			<option value="2">'.__('Not that bad', 'yit').'</option>
			<option value="1">'.__('Very Poor', 'yit').'</option>
		</select></p>';

	}

	$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'yit' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>' . $woocommerce->nonce_field('comment_rating', true, false);

	comment_form( $comment_form );

	echo '</div></div>';

?><div class="clear"></div></div>
<?php endif; ?>