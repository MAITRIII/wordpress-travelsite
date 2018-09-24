<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package optimum
 */
?>

        </div><!--.inner-page-content-->
            <footer id="colophon" class="site-footer" role="contentinfo">
                <div class="footer-inner-content">
                    <?php if(optimum_get_options('om_enable_megafoter', '')): ?>
                        <div class="footer-topcontent mega-footer">
                            <div class="animated fadeInLeft">
                                <div class="row">
                                    <div class="site-footer-inner col-sm-12 clearfix">
                                    <?php get_sidebar( 'footer' ); ?>
                                    </div>
                                </div>
                            </div><!-- close .animated -->
                        </div><!--.mega-footer-->
                    <?php endif; ?>
                    <div id="footer-info">
                        <div class="site-info">
                            <?php do_action( 'optimum_credits' ); ?>
                            <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'optimum' ); ?>" ><?php printf( __( '&copy; 2018 optimum. All rights reserved', 'optimum' ), 'WordPress' ); ?></a>
                            <span class="sep"> | </span>
                            <?php printf( __( '%1$s  ', 'optimum' ), 'Optimum by '); ?><a href="<?php echo esc_url( __( 'http://nettantra.com', 'optimum' ) ); ?>"><?php printf( __( 'NetTantra', 'optimum' ), 'NetTantra' ); ?></a>
                        </div><!-- close .site-info -->
                    </div><!--#footer-info-->
                </div><!--.footer-inner-content-->
            </footer><!-- close #colophon -->
        </div><!-- close .*-inner (main-content) -->
    </div><!-- close .main-content -->

    </div><!--.inner-wrapper-->
</div><!--.content-wrapper-->


<?php if(optimum_get_options('om_enable_scroll_to_top', '')): ?>
    <a href="#top" id="scroll-top"></a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
