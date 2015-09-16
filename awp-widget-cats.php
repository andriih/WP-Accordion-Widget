<?php
/*
Plugin Name: Awp Widget Accardion
Description: awp-widget-cats
Plugin URI: http://#
Author: Andrii Hnatyshyn
Author URI: http://#
Version: 1.0
License: GPL2
Text Domain: Text Domain
Domain Path: Domain Path
*/
add_action('widgets_init','awp_cats');


function awp_cats ()
{
	register_widget('AWP_Cats');
}
class AWP_Cats extends WP_Widget
{
	function __construct()
	{
		$args = array(
			'name'=>'Accordeon',
			'description'=>'awp Accordeon',
		);
		return parent::__construct('awp_cats','',$args);
	}

	function form ($instance) // РОЗРИВ коду
	{
		$eventType ='';
		extract($instance);
		//print_r($instance);
		$title = !empty($title) ? esc_attr( $title ) : '' ;
		$eventType = !empty($eventType) ? $eventType : 'hover';
		print_r($eventType);
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Заголовок:</label>
				<input type="text" 	name ="<?php echo $this->get_field_name('name'); ?>" 
									id   ="<?php echo $this->get_field_id('title'); ?>" 
									value="<?php echo $title; ?>" 
									class="widefat"></input>
			</p>

			<!-- showdown type selection option -->
			<p>
				<label for="<?php echo $this->get_field_id('eventType'); ?>">Opening method</label>
				<select name ="<?php echo $this->get_field_name('eventType'); ?>" 
						id   ="<?php echo $this->get_field_id('eventType'); ?>" 
						class="widefat">

				<option value="click">On Click</option>
				<option value="hover">On Hover</option>
				</select> 
				
				
			</p>
		<?php
	}

	function widget($args,$instance)
	{
		$title='';
		extract($args);
		extract($instance);
                add_action('wp_footer',array($this , 'awp_styles_scripts' ));
                
		$title = apply_filters('widget_title', $title);
		$cats = wp_list_categories(
			array(
				'title_li' => '',
				'echo' => false
				//'exclude' => $exclude;
			)
		);
		$str = preg_replace('#title="[^"]+#','',$cats);
		$html = $before_widget;
		$html .= $before_title.$title.$after_title;
		$html .= '<ul class="accordion">';
		$html .= $cats;
		$html .='</ul>';
		$html .=$after_widget;
		echo $html;                       
	}

	function awp_styles_scripts ()
                {
                    wp_register_script('awp-cookie', plugins_url('js/jquery.cookie.js',__FILE__),array('jquery'));
                    wp_register_script('awp-hoverIntent', plugins_url('js/jquery.hoverIntent.minified.js',__FILE__),array('awp-cookie'));
                    wp_register_script('awp-dcjqaccordion', plugins_url('js/jquery.dcjqaccordion.2.9.js',__FILE__),array('awp-hoverIntent'));
                    wp_register_script('awp-scripts', plugins_url('js/awp-scripts.js',__FILE__),array('awp-dcjqaccordion'));


                  	wp_enqueue_script( 'awp-scripts') ; 

                  	
                }
}

