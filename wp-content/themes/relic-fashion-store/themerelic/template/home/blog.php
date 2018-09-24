<?php
/**
 * Use: Homepage Blog Function
 * Description: Display all setting and output blog section.
 * @package Relic_Fashion_Store
 */
function relic_fashion_store_blog_section(){
    /** Blog section customizer data */
    $relic_fashion_store_blog_info_left_section_enable       = get_theme_mod( 'relic_fashion_store_blog_info_left_section_enable',true );
    $relic_fashion_store_blog_date_metabox                   = get_theme_mod( 'relic_fashion_store_blog_date_metabox',true );
    $relic_fashion_store_blog_author_metabox                 = get_theme_mod( 'relic_fashion_store_blog_author_metabox',true );
    $relic_fashion_store_blog_comments_metabox               = get_theme_mod( 'relic_fashion_store_blog_comments_metabox',true );
    $relic_fashion_store_post_category_select           = intval( get_theme_mod( 'relic_fashion_store_post_category_select' ) );
    $relic_fashion_store_blog_number_of_post                 = intval( get_theme_mod( 'relic_fashion_store_blog_number_of_post',2 ) );
    
    $fallback_thumbnail_image = get_theme_mod( 'relic_fashion_store_archive_page_feedback_thumbnail',true );
    //left info section 
    if( $relic_fashion_store_blog_info_left_section_enable == true ){
        $relic_fashion_store_blog = 'col-sm-12 col-md-12 col-lg-9';
    }else{
        $relic_fashion_store_blog = 'col-sm-12 col-md-12 col-lg-12';
    }

    //Blog Category Links
    $relic_fashion_store_post_category_select_links = get_category_link( $relic_fashion_store_post_category_select );
    ?>

    <!-- blog -->
    <section id="relic_fashion_blog_section" class="blog">
        <div class="container">
            <div class="row">
                
                <?php if( $relic_fashion_store_blog_info_left_section_enable == true ): ?>
                    <div class="col-sm-12 col-md-12 col-lg-3">
                        <div class="blog_item_word">
                            <h4><?php echo wp_kses_post( relic_fashion_store_blog_header_title_callback() ); ?></h4>
                            <a href="<?php echo esc_url( $relic_fashion_store_post_category_select_links ); ?>" class="view-more"><?php echo esc_html( relic_fashion_store_blog_desc_text_callback() ); ?></a>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="<?php echo esc_attr( $relic_fashion_store_blog ); ?>">
                    <div class="blog_item_add">
                        <div class="row">
                            <?php 
                                $args = array( 
                                    'post_type'=>'post',
                                    'posts_per_page' => $relic_fashion_store_blog_number_of_post,//set the number you want here 
                                    'no_found_rows' => true, 
                                    'post_status' => 'publish', 
                                    'ignore_sticky_posts' => true,
                                    'cat' => $relic_fashion_store_post_category_select  //the current category id
                                );
                                $blog_query = new WP_Query( $args ); 

                                //Default Image Links
                                $fallback_image = get_template_directory_uri().'/assets/images/fallback/feedback-post-thumbnail.jpg';
                                
                                //Loop Start
                                while( $blog_query->have_posts()): $blog_query->the_post(); 
                            
                            ?>
                                <div class="col-md-6">
                                    <div class="blog_item_catagory" itemscope itemtype="http://schema.org/BlogPosting">
                                        <div class="" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php 
                                                    if( has_post_thumbnail() ){
                                                        the_post_thumbnail( 'relic-fashion-store-blog', array( 'itemprop' => 'image' ) );                                                    
                                                    }elseif( $fallback_thumbnail_image == true ){
                                                        ?>
                                                        <img  itemprop="image" src="<?php echo esc_url( $fallback_image ); ?>" alt="" >
                                                    <?php
                                                    }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="blog_item_text">
                                            <h4 itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                                <p><?php if( $relic_fashion_store_blog_author_metabox != false): the_author(); ?>, <?php endif; if( $relic_fashion_store_blog_date_metabox != false): the_time( get_option( 'date_format' ) ); endif; ?></p>
                                                <?php if( $relic_fashion_store_blog_comments_metabox != false): ?><span><i class="fa fa-comment" aria-hidden="true"></i><?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'relic-fashion-store'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?></span> <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <?php
}
add_action('relic_fashion_store_blog','relic_fashion_store_blog_section');