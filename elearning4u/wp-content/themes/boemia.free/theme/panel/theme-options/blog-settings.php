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

function yit_blog_type_options( $array ) {
    $array['small']   = __( 'Small Thumbnail', 'yit' );
    
    return $array;
}

add_filter( 'yit_blog-type_options', 'yit_blog_type_options' );
 
function yit_tab_blog_settings( $items ) {

    $items[73] = $items[70];

    unset( $items[62], $items[65], $items[66], $items[70], $items[72], $items[75], $items[76], $items[90], $items[80] );

    $items[50]['std'] = 'small';
    $items[51]['std'] = 'small';

    $items[71] = array(
        'id'   => 'blog-show-tags',
        'type' => 'onoff',
        'name' => __( 'Show tags', 'yit' ),
        'desc' => __( 'Select if you want to show the tags of the post.', 'yit' ),
        'std'  => apply_filters( 'yit_blog-show-tags_std', 1 )
    );

    $items[72] = array(
        'id'   => 'blog-tags-icon',
        'type' => 'selecticon',
        'name' => __( 'Tags icon', 'yit' ),
        'desc' => __( 'Select the icon to use for the tags.', 'yit' ),
        'deps' => apply_filters( 'yit_blog-tags-icon_deps', array(
            'ids' => 'blog-show-tags',
            'values' => 1
        ) ),
        'upload' => true,
        'std'  => apply_filters( 'yit_blog-tags-icon_std', 'icon-tag' )
    );


    
    return $items;
}
add_filter( 'yit_submenu_tabs_theme_option_blog_settings', 'yit_tab_blog_settings' );

add_filter( 'yit_blog-read-more-text_std', create_function( '', 'return "[read more]";' ) );

function yit_blog_tags_icon_std() {
    return array( 'icon' => 'icon-tags', 'custom' => YIT_THEME_IMG_URL . '/icons/tags.png' );
}
add_filter( 'yit_blog-tags-icon_std', 'yit_blog_tags_icon_std' );

function yit_blog_author_icon_std() {
    return array( 'icon' => 'icon-user', 'custom' => YIT_THEME_IMG_URL . '/icons/author.png' );
}
add_filter( 'yit_blog-author-icon_std', 'yit_blog_author_icon_std' );

function yit_blog_comments_icon_std() {
    return array( 'icon' => 'icon-comment', 'custom' => YIT_THEME_IMG_URL . '/icons/comments.png' );
}
add_filter( 'yit_blog-comments-icon_std', 'yit_blog_comments_icon_std' );