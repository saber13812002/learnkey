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
?>
<div class="thumbnail">
    <!-- post title -->
    <?php 
    $link = get_permalink();
    
    if( get_the_title() == '' )
        { $title = __( '(this post does not have a title)', 'yit' ); }
    else
        { $title = get_the_title(); }
    ?>
    
    <!-- post meta -->
    <?php if ( get_post_type() == 'post' ) : ?>
    <div class="meta quote">

        <div >
            <?php if( yit_get_option( 'blog-show-date' ) ) : ?><p class="date"><span class="month"><?php the_time('M') ?></span><span class="day"><?php the_time('d') ?></span></p><?php endif; ?>
            <?php if( yit_get_option( 'blog-show-author' ) ) : ?><p class="author"><?php echo yit_get_icon( 'blog-author-icon', true ) ?><span><?php _e( 'Author:', 'yit' ) ?></span> <?php the_author_posts_link() ?></p><?php endif; ?>
            <?php if( yit_get_option( 'blog-show-comments' ) ) : ?><p class="comments"><?php echo yit_get_icon( 'blog-comments-icon', true ) ?><span><?php comments_popup_link( __( '<span>Comments:</span> 0', 'yit' ), __( '<span>Comments:</span> 1', 'yit' ), __( '<span>Comments:</span> %', 'yit' ) ); ?></span></p><?php endif ?>
            <?php if( yit_get_option( 'blog-show-tags' ) ) : ?><p class="tags"><?php  ?><span><?php the_tags( __( yit_get_icon( 'blog-tags-icon', true ).'<span>Tags:</span> ', 'yit' ), ', ' ); ?></span></p><?php endif ?>

        </div>

        <?php yit_string( "<blockquote class=\"post-title\"><a href=\"$link\">", get_the_content(), "</a><cite>" . $title . "</cite></blockquote>" ) ?>
        <?php edit_post_link( __( 'Edit', 'yit' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>

    </div>
    <?php endif ?> 
</div>

<div class="clear"></div>      