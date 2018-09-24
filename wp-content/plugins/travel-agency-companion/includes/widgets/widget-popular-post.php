<?php
/**
 * Widget Popular Post
 *
 * @package Rttk_Pro
 */
 
// register Travel_Agency_Popular_Post widget
function raratheme_register_popular_post_widget() {
    register_widget( 'Travel_Agency_Popular_Post' );
}
add_action( 'widgets_init', 'raratheme_register_popular_post_widget' );

if( ! class_exists( 'Travel_Agency_Popular_Post' ) ) : 
 /**
 * Adds RaraTheme_Popular_Post widget.
 */
class Travel_Agency_Popular_Post extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct(){
        if( ! is_customize_preview() ) add_action( 'wp', array( $this, 'raratheme_set_views' ) );
        
        parent::__construct(
            'raratheme_popular_post', // Base ID
            esc_html__( 'Travel Agency: Popular Post', 'travel-agency-companion' ), // Name
            array( 'description' => esc_html__( 'A Popular Post Widget', 'travel-agency-companion' ), ) // Args
        );
    }
    
    /**
     * Function to add the post view count 
     */
    function raratheme_set_views( $post_id ) {
        if ( in_the_loop() ) {
            $post_id = get_the_ID();
          } 
        else {
            global $wp_query;
            $post_id = $wp_query->get_queried_object_id();
        }
        if( is_singular( 'post' ) )
        {
            $count_key = '_raratheme_view_count';
            $count = get_post_meta( $post_id, $count_key, true );
            if( $count == '' ){
                $count = 0;
                delete_post_meta( $post_id, $count_key );
                add_post_meta( $post_id, $count_key, '1' );
            }else{
                $count++;
                update_post_meta( $post_id, $count_key, $count );
            }
        }
    }

    /**
     * Function to get the post view count 
     */
    function travel_agency_get_views( $post_id ){
        $count_key = '_raratheme_view_count';
        $count = get_post_meta( $post_id, $count_key, true );
        if( $count == '' ){        
            return __( "0 View", 'travel-agency-companion' );
        }elseif($count<=1){
            return $count. __(' View', 'travel-agency-companion' );
        }else{
            return $count. __(' Views', 'travel-agency-companion' );    
        }    
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
       
        $title       = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $num_post    = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumb  = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_date   = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $based_on    = ! empty( $instance['based_on'] ) ? $instance['based_on'] : 'views';
        $comment_num = ! empty( $instance['comment_num'] ) ? $instance['comment_num'] : '';
        $view_count  = ! empty( $instance['view_count'] ) ? $instance['view_count'] : '';
        
        $cat = get_theme_mod( 'exclude_categories' );
        if( $cat ) $cat = array_diff( array_unique( $cat ), array('') );
        
        $arg = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => $num_post,
            'ignore_sticky_posts'   => true,
            'category__not_in'      => $cat
        );
        
        if( $based_on == 'views' ){
            $arg['orderby'] = 'meta_value_num';
            $arg['meta_key'] = '_raratheme_view_count';
        }elseif( $based_on == 'comments' ){
            $arg['orderby'] = 'comment_count';
        }
        
        $qry = new WP_Query( $arg );
        
        if( $qry->have_posts() ){
            echo $args['before_widget'];
            if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
            ?>
            <ul>
                <?php 
                while( $qry->have_posts() ){
                    $qry->the_post();
                ?>
                    <li>
                        <?php if( has_post_thumbnail() && $show_thumb ){ ?>
                            <a href="<?php the_permalink();?>" class="post-thumbnail">
                                <?php 
                                $popular_post_size = apply_filters( 'popular_post_size', 'thumbnail' );
                                the_post_thumbnail( $popular_post_size );?>
                            </a>
                        <?php }?>
                        <div class="entry-header">
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                            <?php 
                            if( $show_date  ){ ?>
                                <div class="entry-meta"> 
                                    <?php $obj = new Travel_Agency_Companion_Functions;
                                    $obj->travel_agency_posted_on(); ?>
                                </div>
                            <?php
                            }
                            
                            if( $based_on == 'views' && $view_count ){ ?>
                                <span class="view-count"><?php echo esc_html( $this->travel_agency_get_views( get_the_ID() ) );?></span>
                            <?php }elseif( $based_on == 'comments' && $comment_num ){ ?>
                                <span class="comment-count"><i class="fa fa-comment" aria-hidden="true"></i><?php echo absint( get_comments_number() ); ?></span>
                            <?php 
                            }
                            ?>
                        </div>                        
                    </li>        
                <?php    
                }
                wp_reset_postdata();
            ?>
            </ul>
            <?php
            echo $args['after_widget'];   
        }
        wp_reset_postdata();  
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        $title          = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $num_post       = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_postdate  = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $based_on       = ! empty( $instance['based_on'] ) ? $instance['based_on'] : 'views';
        $comment_num    = ! empty( $instance['comment_num'] ) ? $instance['comment_num'] : '';
        $view_count     = ! empty( $instance['view_count'] ) ? $instance['view_count'] : '';
        
        ?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'travel-agency-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) );  ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>"><?php esc_html_e( 'Number of Posts', 'travel-agency-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_post' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $num_post ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'based_on' ) ); ?>"><?php esc_html_e( 'Popular based on:', 'travel-agency-companion' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'based_on' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'based_on' ) ); ?>" class="based-on">
                <option value="views" <?php selected( $based_on, 'views' ); ?>><?php esc_html_e( 'Post Views', 'travel-agency-companion' ); ?></option>
                <option value="comments" <?php selected( $based_on, 'comments' ); ?>><?php esc_html_e( 'Comment Count', 'travel-agency-companion' ); ?></option>
            </select>
        </p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumbnail ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"><?php esc_html_e( 'Show Post Thumbnail', 'travel-agency-companion' ); ?></label>
        </p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_postdate' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_postdate ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>"><?php esc_html_e( 'Show Post Date', 'travel-agency-companion' ); ?></label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'comment_num' ) ); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'comment_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_num' ) ); ?>" value="1" <?php checked( 1, $comment_num ); ?> />
                <?php esc_html_e( 'Show number of comments', 'travel-agency-companion' ); ?>
            </label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'view_count' ) ); ?>">
                <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'view_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_count' ) ); ?>" value="1" <?php checked( 1, $view_count ); ?> />
                <?php esc_html_e( 'Show number of views', 'travel-agency-companion' ); ?>
            </label>
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        
        $instance = array();
        
        $instance['title']          = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['num_post']       = ! empty( $new_instance['num_post'] ) ? absint( $new_instance['num_post'] ) : 3 ;        
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? absint( $new_instance['show_thumbnail'] ) : '';
        $instance['show_postdate']  = ! empty( $new_instance['show_postdate'] ) ? absint( $new_instance['show_postdate'] ) : '';
        $instance['based_on']       = ! empty( $new_instance['based_on'] ) ? esc_attr( $new_instance['based_on'] ) : 'views';
        $instance['comment_num']    = ! empty( $new_instance['comment_num'] ) ? absint( $new_instance['comment_num'] ) : '';
        $instance['view_count']     = ! empty( $new_instance['view_count'] ) ? absint( $new_instance['view_count'] ) : '';
        
        return $instance;
                
    }

} // class Travel_Agency_Popular_Post 
endif;