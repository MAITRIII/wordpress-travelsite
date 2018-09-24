<?php
/**
 * The function for display  footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Relic_Fashion_Store
 */
/*********************************************************************
 *                      Payment Logo 
 *********************************************************************/
function relic_fashion_store_payment_method() {
    /** Relic Fashion Store Payment Logo */
    if( get_theme_mod( 'relic_fashion_store_payment_logo_enable',true ) == true){
            /** Payment Customizer Value */
            $relic_fashion_store_payment_method_support_image = get_theme_mod('relic_fashion_store_payment_method_support_image',get_template_directory_uri() . '/assets/images/footer/payment-logo.png');
        ?>
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
            <div class="footer_right clearfix">
                
                <p class="payment-method"><?php echo esc_attr( relic_fashion_store_payment_method_title_callback() ); ?> </p>
                        
                <div class="visa-card clearfix">
                    <img src="<?php echo esc_url( $relic_fashion_store_payment_method_support_image ); ?>" >
                    
                </div>
            </div>
        </div>
        <?php
    }


}




if ( ! function_exists( 'relic_fashion_store_footer_copyright' ) ) {
    /**
     * Footer Copyright Section
     *
     * Change the footer copyright Section
     *
     * @since Relic Fashion Store 1.0.0
     */
    function relic_fashion_store_footer_copyright() {
        //Condtion Enable
        ?>  
        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
            <div class="footer_left">
                <div class="site-info">
                    <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'relic-fashion-store' ) ); ?>" target="_blank"><?php
                        /* translators: %s: CMS name, i.e. WordPress. */
                        printf( esc_html__( 'Proudly powered by %s', 'relic-fashion-store' ), 'WordPress' );
                    ?></a>
                    <span class="sep"> | </span><a href="<?php echo esc_url('www.themerelic.com','relic-fashion-store'); ?>" target="_blank">
                    <?php
                        /* translators: 1: Theme name, 2: Theme author. */
                        printf( esc_html__( 'Theme: %1$s by %2$s.', 'relic-fashion-store' ), 'Relic Fashion Store', 'ThemeRelic' );
                    ?></a>
                </div><!-- .site-info -->
            </div>
        </div>
        <?php
    }
}
