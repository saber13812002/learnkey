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

$has_thumbnail = ( ! has_post_thumbnail() || ( ! is_single() && ! yit_get_option( 'blog-show-featured' ) ) || ( is_single() && ! yit_get_option( 'blog-show-featured-single' ) ) ) ? false : true; ?>
                       
<div id="post-<?php the_ID(); ?>" <?php post_class( 'hentry-post group blog-small' ); ?>>   
    <!-- post featured & title -->
    <?php
    $no_thumbnail = 'span3 no-thumb';
    $post_format = get_post_format() == '' ? 'standard' : get_post_format();
    $post_format = yit_get_option( 'blog-post-formats-list' ) && get_post_format() != ''  ? get_post_format() : $post_format;

    if($post_format!='standard'):
        yit_get_template( 'blog/small/post-formats/' . $post_format . '.php' );
    else:
    ?>                
    <div class="<?php if ( ! $has_thumbnail ) echo 'without ' ?>thumbnail">
        <div class="row">
            <?php if ( $has_thumbnail ) : ?>
                <?php $no_thumbnail = ''; ?>
            <!-- post featured -->
            <div class="image-wrap span4">
                <?php the_post_thumbnail( 'blog_small' ); ?>
            </div>
            <?php endif ?>
            
            <!-- post title -->
            <div class="post-informations">

                <!-- post meta -->
            <?php if ( get_post_type() == 'post' &&( yit_get_option( 'blog-show-author' ) || yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ) ) : ?>
            <div class="meta group <?php echo $no_thumbnail ?>">
                <div>
                    <?php if( yit_get_option( 'blog-show-date' ) ) : ?><p class="date"><span class="month"><?php the_time('M') ?></span><span class="day"><?php the_time('d') ?></span></p><?php endif; ?>
                    <?php if( yit_get_option( 'blog-show-author' ) ) : ?><p class="author"><?php echo yit_get_icon( 'blog-author-icon', true ) ?><span><?php _e( 'Author:', 'yit' ) ?></span> <?php the_author_posts_link() ?></p><?php endif; ?>
                    <?php if( yit_get_option( 'blog-show-comments' ) ) : ?><p class="comments"><?php echo yit_get_icon( 'blog-comments-icon', true ) ?><span><?php comments_popup_link( __( '<span>Comments:</span> 0', 'yit' ), __( '<span>Comments:</span> 1', 'yit' ), __( '<span>Comments:</span> %', 'yit' ) ); ?></span></p><?php endif ?>
                    <?php if( yit_get_option( 'blog-show-tags' ) ) : ?><p class="tags"><?php  ?><span><?php the_tags( __( yit_get_icon( 'blog-tags-icon', true ).'<span>Tags:</span> ', 'yit' ), ', ' ); ?></span></p><?php endif ?>
                </div>
            </div>
            <?php endif ?>


            </div>

             <?php
                $link = get_permalink();

                if( get_the_title() == '' )
                    { $title = __( '(this post does not have a title)', 'yit' ); }
                else
                    { $title = get_the_title(); }

                if ( is_single() )
                    { yit_string( "<h1 class=\"post-title\"><a href=\"$link\">", $title, "</a></h1>" ); }
                else
                    { yit_string( "<h2 class=\"post-title\"><a href=\"$link\">", $title, "</a></h2>" ); }
                ?>
                <div class="the-content">
                <?php
                if( is_single() OR yit_get_option( 'blog-show-read-more' ) ) {
                    the_content( yit_get_option( 'blog-read-more-text' ) );
                } else {
                    the_excerpt();
                } 
                ?>

                <?php edit_post_link( __( 'Edit', 'yit' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>
            </div>
            
            <div class="clear"></div>
        </div>
        
        <?php if( get_post_format() != '' ) : ?><span class="post-format <?php echo get_post_format() ?>"><?php _e( ucfirst( get_post_format() ), 'yit' ) ?></span><?php endif ?>
    </div>
    
    <?php endif //if quote ?>  
    
    <?php wp_link_pages(); ?>

	<?php
    if( is_single() ) { 
       if( is_paged() ) { previous_post_link(); echo ' | '; next_post_link(); }
    }
    ?>    
</div> 