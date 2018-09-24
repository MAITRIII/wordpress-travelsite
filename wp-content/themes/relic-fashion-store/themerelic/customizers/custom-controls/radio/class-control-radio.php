<?php
/**
 * Image control by radio button 
 */
class Relic_Fashion_Store_Radio_Control extends WP_Customize_Control {

    public function enqueue() {  
        wp_enqueue_style( 'relic-fashion-store-radio', get_template_directory_uri() . '/themerelic/customizers/custom-controls/radio/radio.css'); //for slider            
        wp_enqueue_script( 'relic-fashion-store-radio', get_template_directory_uri() . '/themerelic/customizers/custom-controls/radio/radio.js', array( 'jquery' ), false, true ); //for slider        
    }

    public function render_content() {

        if ( empty( $this->choices ) )
            return;

        $name = '_customize-radio-' . $this->id;

        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
        <ul class="controls" id ="relic-fashion-store-img-container">
        <?php
            foreach ( $this->choices as $value => $label ) :
                $class = ($this->value() == $value)?'relic-fashion-store-radio-img-selected relic-fashion-store-radio-img-img':'relic-fashion-store-img';
                ?>
                <li class="display-inline">
                <label>
                    <input <?php $this->link(); ?> type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> class="radio-input-hidden"/>
                    <img src = '<?php echo esc_url( $label ); ?>' class = '<?php echo esc_attr( $class ); ?>' />
                </label>
                </li>
                <?php
            endforeach;
        ?>
        </ul>
        <?php
    }
}