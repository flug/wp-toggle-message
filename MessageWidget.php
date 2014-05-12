<?php

class MessageWidget  extends WP_Widget {

    function __construct(){
	parent::__construct(
	    "MessageWidget",
	    __("Toggle Message", "wp_message_widget"),
	    array('description' => __("widget message with opening and closing via javascript")
	));
    }

    public function widget($args , $instance){

	wp_enqueue_style("toggleeffect.css", plugins_url()."/wp-toggle-message/css/toggleeffect.css");
	wp_enqueue_script('effect.js', plugins_url().'/wp-toggle-message/js/effect.js');
	$title = apply_filters( 'widget_title', $instance['toggle_title'] );
	// before and after widget arguments are defined by themes
	echo $args['before_widget'];
	if ( ! empty( $title ) )
	    echo $args['before_title'] .'<a href="javascript:void(0);"  onclick="toggleMessage(\'toggle_message-element_'.$args['widget_id'].'\')" >
	    '. $title .'</a>'.
	$args['after_title'];
	echo '<div class="toggle_message-element" id="toggle_message-element_'.$args['widget_id'].'" >'.nl2br($instance['toggle_message']) . '</div>';

	// This is where you run the code and display the output
	echo $args['after_widget'];

    }
    public function form($instance){
?>
    <p>
	<?php  echo $this->fieldsSet("toggle_title", "Titre" ,'input',
	    (isset($instance['toggle_title']))? $instance['toggle_title'] : ""
	)  ?>

	<?php  echo $this->fieldsSet("toggle_message", "Message" ,"textarea",
	    (isset($instance['toggle_message'])) ? $instance['toggle_message'] : ""
	)  ?>
    </p>

<?php
    }

    public function update ($new_instance, $old_instance) {
	return $new_instance ;
    }

    public function fieldsSet($key , $label , $type, $default_value = "")
    {
	$output = '<label for="'.$this->get_field_id( $key ).'">'. __($label.":" ).'</label>';
	switch($type){
	case  "textarea":
	    $output .= '<textarea class="widefat" id="'.$this->get_field_id( $key ).'"
		name="'.$this->get_field_name( $key ).'" >'.trim(esc_attr( $default_value )).' </textarea>';
	    break;

	case 'checkbox' :
	    $output .= '<input class="widefat" id="'. $this->get_field_id( $key ).'"
		name="'.$this->get_field_name( $key ).'" type="'.$type.'"
		value="1" '. checked( '1', $default_value , false ).'  />';

	    break ;

	default:
	    $output .= '<input class="widefat" id="'. $this->get_field_id( $key ).'"
		name="'.$this->get_field_name( $key ).'" type="'.$type.'"
		value="'.esc_attr( $default_value ).'" />';
	    break;


	}


	return $output;

    }

}

