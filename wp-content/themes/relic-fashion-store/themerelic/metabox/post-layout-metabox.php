<?php
/**
 * The post sidebar layout section
 *
 * @package Relic_Fashion_Store
 */
class Relic_Fashion_Store_Layout{

    //Relic Fashion Store Construct
    public function __construct(){
        add_action( 'add_meta_boxes',array($this,'relic_fashion_store_meta_box_add'));
        add_action( 'save_post', array($this,'relic_fashion_store_meta_box_save') );
    }

    //Metabox Add 
    public function relic_fashion_store_meta_box_add(){
        add_meta_box( 'relic-fashion-store-meta-box-id', 'Display layout', array($this,'relic_fashion_store_meta_box_cb'), array('post','page'), 'normal', 'high' );
    }

    //Fashion Store Metabox
    public function relic_fashion_store_meta_box_cb(){
        global $post;
        $layout = get_post_meta( $post->ID,'layout',true);
        
        
        // We'll use this nonce field later on when saving.
        wp_nonce_field( 'layout_nonce', 'meta_box_nonce' );
        ?>
        <p><?php esc_html_e('Choose from following layout:','relic-fashion-store'); ?><hr/>
            <input type="radio" name="layout" value="left-sidebar" <?php checked( $layout, 'left-sidebar' ); ?>><?php esc_html_e('Left Sidebar','relic-fashion-store'); ?>
            <input type="radio" name="layout" value="right-sidebar" <?php checked( $layout, 'right-sidebar' ); ?>><?php esc_html_e('Right Sidebar','relic-fashion-store'); ?>
            <input type="radio" name="layout" value="full-width" <?php checked( $layout, 'full-width' ); ?>><?php esc_html_e('Full Width','relic-fashion-store'); ?>
            <input type="radio" name="layout" value="both-sidebar" <?php checked( $layout, 'both-sidebar' ); ?>><?php esc_html_e('Both Sidebar','relic-fashion-store'); ?>
        </p>
        <?php    
    }

    //Metabox Save
    public function relic_fashion_store_meta_box_save($news_id){
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        
        // if our nonce isn't there, or we can't verify it, bail
        $POST = wp_unslash($_POST);
        if( !isset( $POST['meta_box_nonce'] ) || !wp_verify_nonce( $POST['meta_box_nonce'], 'layout_nonce' ) || ! current_user_can( 'edit_post', $news_id ) ) return;

        if( isset( $POST['layout'] ) )
            
            $layout = sanitize_text_field( wp_unslash( $_POST['layout'] ) );
            //Set Default Value
            if( empty($layout) ){
                $layout = 'right-sidebar';
            }

            update_post_meta( $news_id, 'layout',  $layout);
    }

}
new Relic_Fashion_Store_Layout();



/*******************************************************************
 *      Relic Fashion Store Layout Setting col-sm-push-12
 ********************************************************************/
if( !function_exists( 'relic_fashion_store_get_layout' )){
    function relic_fashion_store_get_layout() {
        global $post;
        $layout = get_theme_mod( 'relic_fashion_store_archive_page_sidebar', 'right-sidebar' );

        // Front page displays in Reading Settings
        $page_for_posts = get_option('page_for_posts');

        // Get Layout meta
        if($post) {
            $post_specific_layout = get_post_meta( $post->ID, 'layout', true );
        }

        // The Blog Page Contion
        if( is_home() ) {
            $layout = get_theme_mod('relic_fashion_store_archive_page_sidebar','right-sidebar');
        }

        // Home page if Posts page is assigned
        elseif( is_home() && !( is_front_page() ) ) {
            $queried_id  = get_option( 'page_for_posts' );
            if( !empty($post_specific_layout) && $post_specific_layout != 'default-layout' ) {
                $layout = get_post_meta( $post->ID, 'layout', true );
            }
        }

        //page section
        elseif( is_page() ) {
            $layout = get_theme_mod('relic_fashion_store_single_page_layout_option','right-sidebar');
            if( !empty($post_specific_layout) && $post_specific_layout != 'default-layout' ) {
                $layout = get_post_meta( $post->ID, 'layout', true );
            
            }
        }

        //Single Page
        elseif( is_single() ) {
            
            $layout = get_theme_mod('relic_fashion_store_single_page_layout_option','right-sidebar');
            if( !empty($post_specific_layout) && $post_specific_layout != 'default-layout' ) {
                $layout = get_post_meta( $post->ID, 'layout', true );
            }
        }

        return $layout;
    }
}

