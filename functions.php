<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
function theme_enqueue_scripts() {
  wp_enqueue_script( 'climate-illustrated', get_stylesheet_directory_uri() . '/dist/js/main.min.js', array(), '1.0.0', true );
}


/**
 * Adds Foo_Widget widget.
 */
class AdSpot extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'adSpot', // Base ID
      __( 'Ad Spot', 'Ad spot placement' ), // Name
      array( 'description' => __( 'Ad Spot', 'Ad placement' ), ) // Args
    );
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
    //echo $args['before_widget'];
    //if ( ! empty( $instance['title'] ) ) {
    //  echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
    //}
    //echo __( 'Hello, World!', 'text_domain' );
    //echo $args['after_widget'];
    echo "<div class='widget'><img src='http://www.placehold.it/" . $instance["size"] . "' /></div>";
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    $title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'New title', 'text_domain' );
    $size = ! empty( $instance['size'] ) ? $instance['size'] : __( '300x250', 'text_domain' );
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    <label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Size:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>" type="text" value="<?php echo esc_attr( $size ); ?>">
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
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    $instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '';

    return $instance;
  }

} // class Foo_Widget

// register Foo_Widget widget
function registerAdSpot() {
    register_widget( 'AdSpot' );
}
add_action( 'widgets_init', 'registerAdSpot' );


?>
