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

//yit_get_template( 'blog/small-image/post-formats/standard.php', array('span' => $span, 'has_thumbnail' => $has_thumbnail) );
?>

<div class="without thumbnail">
        <div class="row">
            <!-- post featured -->
            <div class="image-wrap span4">
                <div class="soundcloud-frame">
                    <?php
                    $url = yit_get_post_meta( get_the_ID(), '_format_audio' );
                    $iframe = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_iframe' );
                    $show_artwork = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_artwork' );
                    $show_comments = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_comments' );
                    $auto_play = ( bool ) yit_get_post_meta( get_the_ID(), '_format_audio_autoplay' );
                    $color = yit_get_post_meta( get_the_ID(), '_format_audio_color' );

                    echo do_shortcode( '[soundcloud iframe="' . $iframe . '" url="' . $url . '" show_artwork="' . $show_artwork . '" show_comments="' . $show_comments . '" auto_play="' . $auto_play . '" color="' . $color . '"]' );
                    ?>
                </div>
            </div>

            <!-- post title -->
            <div class="post-informations">

                <!-- post meta -->
            <?php if ( get_post_type() == 'post' &&( yit_get_option( 'blog-show-author' ) || yit_get_option( 'blog-show-date' ) || yit_get_option( 'blog-show-comments' ) ) ) : ?>
            <div class="meta group">
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
                    { yit_string( "<h1 class=\"post-title audio\"><a href=\"$link\">", $title, "</a></h1>" ); }
                else
                    { yit_string( "<h2 class=\"post-title audio\"><a href=\"$link\">", $title, "</a></h2>" ); }
                ?>
                <div class="the-content">
                <?php
                if( yit_get_option( 'blog-show-read-more' ) ) {
                    the_content( yit_get_option( 'blog-read-more-text' ) );
                } else {
                    the_excerpt();
                }
                ?>

                <?php edit_post_link( __( 'Edit', 'yit' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>
            </div>

            <div class="clear"></div>
        </div>

        <?php if( get_post_format() != '' ) : ?><span class="hidden-phone post-format <?php echo get_post_format() ?>"><?php _e( ucfirst( get_post_format() ), 'yit' ) ?></span><?php endif ?>
    </div>