<!-- banner_content_blog -->
    <?php 

    if(has_post_thumbnail()):
        /* grab the url for the full size featured image */
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
    ?>
    <div class="banner_content_blog" <?php if ($featured_img_url): ?>style="background-image:url('<?php echo esc_url($featured_img_url) ?>');" <?php endif; ?>></div>
    <?php endif; ?>

    

<section id="post-<?php the_ID(); ?>" <?php post_class('blog-detail_text'); ?> itemscope itemtype="http://schema.org/BlogPosting">
    <div class="container">
        <div class="row">
            <?php
                //Left Sidebar Call
                if ( relic_fashion_store_get_layout() == 'left-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
                    get_sidebar('left'); 
                endif;
            ?>
            <div class="<?php echo esc_attr( relic_fashion_store_page_column() ); ?>">
                <div class="blog_text blog_text1" >
                    <?php the_category(','); ?>
                    <small><i class="fa fa-comment" aria-hidden="true"></i><?php printf( esc_html( _n( '%d Comment', '%d Comments', get_comments_number(), 'relic-fashion-store'  ) ), esc_html(number_format_i18n(get_comments_number()))); ?></small>
                    <span itemprop="author"><?php the_author(); ?>, <?php the_date( get_option('date_format') ); ?></span>
                    <h4  itemprop="headline"><?php the_title(); ?></h4>
                        <div class="blog-content" itemprop="text"><?php the_content(); ?></div>
                        <span class="tag"><?php the_tags(); ?></span>
                        <?php relic_fashion_store_social_share_section( get_the_ID() ); ?>
                    </div>
                    <?php 
                        //Display Related Post Options
                        if( get_theme_mod('relic_fashion_store_related_post_enable',true) == true ){
                            relic_fashion_store_single_page_related_post( $post->ID );
                        }
                        
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif; 
                    ?>
                </div>

                <?php
                    
                    //Sidebar Layout Section Hear
                    if ( relic_fashion_store_get_layout() == 'right-sidebar' OR relic_fashion_store_get_layout() == 'both-sidebar') : 
                        get_sidebar(); 
                    endif;
                ?>
            </div>
        </div>
    </section>
