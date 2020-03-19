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
 * YIT Theme Options submenu page
 * 
 * 
 * @since 1.0.0
 */

class YIT_Submenu_Theme_option extends YIT_Submenu_Abstract {
    
    /**
     * Menu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_menu = array();
    
    /**
     * Submenu items
     * 
     * @var array
     * @since 1.0.0
     */
    public $_submenu = array();
    
    /**
	 * Init helper method
     * 
	 */
	public function init() {
	    $this->_menu = apply_filters( 'yit_admin_menu_theme_options', array(
            'general' => __( 'General', 'yit' ),
    		'pages' => __( 'Pages', 'yit' ),
    		'blog' => __( 'Blog', 'yit' ),
    		'testimonials' => __( 'Testimonials', 'yit' ),
            'custom_codes' => __( 'Custom codes', 'yit' ),
        ) );
        
        $this->_submenu = apply_filters( 'yit_admin_submenu_theme_options', array(
            'general' => array(
                'settings' => __( 'Settings', 'yit' ),
                'footer' => __( 'Footer', 'yit' ),
                'integration' => __( 'Integration', 'yit' ),
            ),
            'pages' => array(
                'archives' => __( 'Archives', 'yit' ),
                'categories' => __( 'Categories', 'yit' ),
                'search' => __( 'Search', 'yit' ),
            ),
            'blog' => array(
                'settings' => __( 'Settings', 'yit' ),
            ),
            'testimonials' => array(
                'settings' => __( 'Settings', 'yit' ),
            ),
            'custom_codes' => array(
                'custom_style' => __( 'Custom style', 'yit' ),
                'custom_script' => __( 'Custom script', 'yit' )
            ),
        ) );
	}
    
    /**
     * Print the menu for the Theme Options
     * 
     * @return void
     * @since 1.0.0
     */
    public function get_menu($id) {
        if( !empty( $this->_menu ) && !empty( $this->_submenu ) ) :
           yit_get_template('admin/panel/menu.php', array ( 'id' => $id, 'menu' => $this->_menu, 'submenu' => $this->_submenu ) );
        endif;
    }
	
	/**
	 * Print all options
     * 
     * @return void
     * @since 1.0.0
	 */
	public function display_page() {
    
        $this->get_header('theme_option');
		$this->get_form( array(
							'id' => 'theme_option',
							'action' => 'panel',
							'subpage' => strtolower( str_replace( 'YIT_Submenu_', '', get_class($this) ) )
						));
						
        foreach( $this->_tabClasses as $slug => $fields ) : ?>
        <div id="yit_<?php echo $slug ?>" class="yit-box">
            <div class="yit-options">
                <?php
                ksort( $fields->fields );
                
                foreach( $fields->fields as $priority => $tab ) {
                    if( $priority < 0 )
                        { continue; }
                    
                    YIT_Type::display( $tab );
                }
                ?>
            </div>
        </div>
        <?php
        endforeach;
        
        $this->get_footer();
	}
}