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
 
/**
 * Class to print fields in the tab Home Blog -> Settings
 * 
 * @since 1.0.0
 */
class YIT_Submenu_Tabs_Theme_option_Blog_Settings extends YIT_Submenu_Tabs_Abstract {
    /**
     * Default fields
     * 
     * @var array
     * @since 1.0.0
     */
    public $fields;
    
    /**
     * Merge default fields with theme specific fields using the filter yit_submenu_tabs_theme_option_blog_settings
     * 
     * @param array $fields
     * @since 1.0.0
     */
    public function __construct() {
        $fields = $this->init();
        $this->fields = apply_filters( strtolower( __CLASS__ ), $fields );
    }
    
    /**
     * Set default values
     * 
     * @return array
     * @since 1.0.0
     */
    public function init() {  
        return array(
            58 => array(
			    'id' => 'blog-cats-exclude',
			    'name' => __('Exclude categories', 'yit'),
			    'desc' => __('Select witch categories you want exlude from blog.', 'yit'),
			    'type' => 'cat',
			    'cols' => 2,
			    'heads' => array(__('Blog Page', 'yit'), __('List cat. sidebar', 'yit'))
			),
            59 => array(
                'id'   => 'blog-show-featured',
                'type' => 'onoff',
                'name' => __( 'Show featured image', 'yit' ),
                'desc' => __( 'Select if you want to show the featured image of the post.', 'yit' ),
                'std'  => apply_filters( 'yit_blog-show-featured_std', 1 )
            ),
            60 => array(
                'id'   => 'blog-show-featured-single',
                'type' => 'onoff',
                'name' => __( 'Show featured image detail', 'yit' ),
                'desc' => __( 'Select if you want to show the featured image of the post when in single page.', 'yit' ),
                'std'  => apply_filters( 'yit_blog-show-featured-single', 1 )
            ),
            61 => array(
                'id'   => 'blog-show-date',
                'type' => 'onoff',
                'name' => __( 'Show date', 'yit' ),
                'desc' => __( 'Select if you want to show the date of the post.', 'yit' ),
                'std'  => apply_filters( 'yit_blog-show-date_std', 1 )
            ),
            62 => array(
                'id'   => 'blog-date-icon',
                'type' => 'selecticon',
                'name' => __( 'Date icon', 'yit' ),
                'desc' => __( 'Select the icon to use for the date.', 'yit' ),
                'deps' => array(
                    'ids' => 'blog-show-date',
                    'values' => 1
                ),
                'upload' => true,
                'std'  => apply_filters( 'yit_blog-date-icon_std', 'icon-calendar' )
            ),
            63 => array(
                'id'   => 'blog-show-author',
                'type' => 'onoff',
                'name' => __( 'Show author', 'yit' ),
                'desc' => __( 'Select if you want to show the author of the post.', 'yit' ),
                'std'  => apply_filters( 'yit_blog-show-author_std', 1 )
            ),
            64 => array(
                'id'   => 'blog-author-icon',
                'type' => 'selecticon',
                'name' => __( 'Author icon', 'yit' ),
                'desc' => __( 'Select the icon to use for the author.', 'yit' ),
                'deps' => array(
                    'ids' => 'blog-show-author',
                    'values' => 1
                ),
                'upload' => true,
                'std'  => apply_filters( 'yit_blog-author-icon_std', 'icon-user' )
            ),
            65 => array(
                'id'   => 'blog-show-categories',
                'type' => 'onoff',
                'name' => __( 'Show categories', 'yit' ),
                'desc' => __( 'Select if you want to show the categories of the post.', 'yit' ),
                'deps' => array(
                    'ids' => 'blog-type',
                    'values' => 'elegant'
                ),
                'std'  => apply_filters( 'yit_blog-show-categories_std', 1 )
            ),
            66 => array(
                'id'   => 'blog-categories-icon',
                'type' => 'selecticon',
                'name' => __( 'Categories icon', 'yit' ),
                'desc' => __( 'Select the icon to use for categories.', 'yit' ),
                'deps' => array(
                    'ids' => 'blog-show-categories',
                    'values' => 1
                ),
                'upload' => true,
                'std'  => apply_filters( 'yit_blog-categories-icon_std', 'icon-tags' )
            ),
            67 => array(
                'id'   => 'blog-show-comments',
                'type' => 'onoff',
                'name' => __( 'Show comments', 'yit' ),
                'desc' => __( 'Select if you want to show the comments number of the post.', 'yit' ),
                'std'  => apply_filters( 'yit_blog-show-comments_std', 1 )
            ),
            68 => array(
                'id'   => 'blog-comments-icon',
                'type' => 'selecticon',
                'name' => __( 'Comments icon', 'yit' ),
                'desc' => __( 'Select the icon to use for comments.', 'yit' ),
                'deps' => array(
                    'ids' => 'blog-show-comments',
                    'values' => 1
                ),
                'upload' => true,
                'std'  => apply_filters( 'yit_blog-comments-icon_std', 'icon-comment' )
            ),
			70 => array(
                'id'   => 'blog-show-read-more',
                'type' => 'onoff',
                'name' => __( 'Show read more button', 'yit' ),
                'desc' => __( 'Select if you want to show the read more button below the post.', 'yit' ),
                'std'  => apply_filters( 'yit_blog-show-read-more_std', 1 )
            ),
            71 => array(
                'id'   => 'blog-read-more-text',
                'type' => 'text',
                'name' => __( 'Read more text', 'yit' ),
                'desc' => __( 'Write what you want to show on more link', 'yit' ),
                'deps' => array(
					'ids' => 'blog-show-read-more',
					'values' => 1
				),
                'std'  => apply_filters( 'yit_blog-read-more-text_std', __( '&rarr; Read more', 'yit' ) )
            ),
            80 => array(
                'id'   => 'blog-show-tags',
                'type' => 'onoff',
                'name' => __( 'Show tags', 'yit' ),
                'desc' => __( 'Select if you want to show the tags of the post', 'yit' ),
                'std'  => apply_filters( 'yit_blog-show-tags_std', 1 )
            ),
            90 => array(
		        'id'   => 'blog-post-formats-list',
		        'type' => 'onoff',
		        'name' => __( 'Show post formats on posts list', 'yit' ),
		        'desc' => __( 'Select if you want to show the post formats also in the posts list and not only in the post detail page.', 'yit' ),
		        'std'  => apply_filters( 'yit_blog-post-formats-list_std', 0 )
		    )
        );
    }
}