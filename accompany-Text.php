<?php
/*
Plugin Name: Accompany Text Widget
Plugin URI: http://imagewize.com/
Description: Accompany Post Widget grabs a Accompany post and the associated thumbnail to display on your sidebar based on egetway.com 's development
Author: Jasper Frumau
Version: 2
Author URI: http://jasperfrumau.com/
*/

class AccompanyPostWidget extends WP_Widget
{

function AccompanyPostWidget()
{
$widget_ops = array('classname' => 'AccompanyPostWidget', 'description' => 'Displays a Accompany post with thumbnail' );
$this->WP_Widget('AccompanyPostWidget', 'Accompany Text Widget', $widget_ops);
$plugin_dir = basename(dirname(__FILE__));
load_plugin_textdomain( 'accompany-text', false, $plugin_dir );
}

function form($instance)
{
$instance = wp_parse_args( (array) $instance, array( 'number' => '','text' => '', 'imagesPath' => '','cssClass' => '') );
$number = $instance['number'];
$text = $instance['text'];
$widgetNo="widgetname".mt_rand(); //.substr(md5('widgetname'), 0, 4);
$imagesPath= $instance['imagesPath'];
$cssClass= $instance['cssClass'];

?>
<p><label for="<?php echo $this->get_field_id('number'); ?>">Number : <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></label></p>
<p><label for="<?php echo $this->get_field_id('text'); ?>">Text :
<textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text;?></textarea>
</label></p>
<p><label for="<?php echo $this->get_field_id('imagesPath'); ?>">images path : <input class="widefat" id="<?php echo $this->get_field_id('imagesPath'); ?>" name="<?php echo $this->get_field_name('imagesPath'); ?>" type="text" value="<?php echo esc_attr($imagesPath); ?>" /></label></p>

<p><label for="<?php echo $this->get_field_id('cssClass'); ?>">Css Class : <input class="widefat" id="<?php echo $this->get_field_id('cssClass'); ?>" name="<?php echo $this->get_field_name('cssClass'); ?>" type="text" value="<?php echo esc_attr($cssClass); ?>" /></label></p>

<?php
}

function update($new_instance, $old_instance)
{
$instance = $old_instance;
$instance['number'] = $new_instance['number'];
$instance['text'] = $new_instance['text'];
$instance['imagesPath'] = $new_instance['imagesPath'];
$instance['cssClass'] = $new_instance['cssClass'];
icl_register_string('Accompany Text', 'widget body – ' . $this->id, $instance['text']);

return $instance;
}

function widget($args, $instance)
{
extract($args, EXTR_SKIP);

echo $before_widget;
$number = empty($instance['number']) ? ' ' : apply_filters('widget_number', $instance['number']);
$text = empty($instance['text']) ? ' ' : apply_filters('widget_text', $instance['text']);
$imagesPath = empty($instance['imagesPath']) ? ' ' : apply_filters('widget_imagesPath', $instance['imagesPath']);
$cssClass = empty($instance['cssClass']) ? ' ' : apply_filters('widget_cssClass', $instance['cssClass']);

// WIDGET CODE GOES HERE
echo '<div class="box '.$cssClass.'">
<div class="round">
<div class="con">';
if (!empty($number)){ echo ' <span class="num">'.$number.'</span>';}
echo icl_t('Accompany Text', 'widget body – ' . $this->id, $text);
if (!empty($imagesPath)){ echo '<div class="iconBox"><img src="'.$imagesPath.'" class="icon" /> </div>';}
echo ' </div>
</div>
</div>';

echo $after_widget;
}

}

add_action( 'widgets_init', create_function('', 'return register_widget("AccompanyPostWidget");') );?>