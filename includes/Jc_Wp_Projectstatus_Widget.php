<?php
/** 
 * Creates the Sidebar - Widget for Jc-Wp-Project-Status Plugin
 * 
 * @author 		Stefan Jacomeit <stefan@jacomeit.com>
 * @version		1.0
 * @copyright	2011 Jacomeit.com
 * @license		GPLv2
 */
class Jc_Wp_Projectstatus_Widget extends WP_Widget
{
	/**
	 * Constructor of the class
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		$options = array(
			'classname' => 'Jc_Wp_Projectstatus_Widget',
			'description' => __('Shows the status as progressbar from the saved projects','jc-wp-project')
		);
		parent::__construct('jc-wp-project-status-widget', __('Jc-WP Project','jc-wp-project'), $options);
	}
	/**
	 * Displays the form into the widget-properties
	 * 
	 * @param array $instance
	 * @access public
	 * @return void
	 */
	public function form($instance)
	{
		$defaults = array('title'=>__('Actual projects', 'jc-wp-project'), 'sum' => 'all');
		$instance = wp_parse_args((array)$instance, $defaults);
		$title = $instance['title'];
		$sum = $instance['sum'];
		$amount = array('all',1,2,3,4,5,6,7,8);
		?>
		<p><?php _e('Title', 'jc-wp-project'); ?>: <input type="text" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" value="<?php echo esc_attr($title); ?>" /></p>
		<p><?php _e('Count', 'jc-wp-project'); ?>: <select name="<?php echo $this->get_field_name('sum'); ?>" class="widefat">
		<?php foreach($amount as $m): ?>
		<option value="<?php echo $m; ?>"<?php if ($m == $instance['sum']) echo " selected=\"selected\""; ?>><?php _e(ucfirst($m),'jc-wp-project'); ?></option>
		<?php endforeach; ?>
		</select></p>
		<?php
	}
	/**
	 * Updates the widget  properties after saving
	 * 
	 * @param array $newInstance
	 * @param array $oldInstance
	 * @access public
	 * @return void
	 */
	public function update($newInstance, $oldInstance)
	{
		$instance = $oldInstance;
		$instance['title'] = strip_tags($newInstance['title']);
		$instance['sum'] = strip_tags($newInstance['sum']);
		return $instance;
	}
	/**
	 * Displays the widget on the sidebar, if applicable
	 * 
	 * @param array $args
	 * @param array $instance
	 * @access public
	 * @return void
	 */
	public function widget($args, $instance)
	{
		global $wpdb;
		extract($args);
		
		echo $before_widget;
		$title = apply_filters( 'widget_title', $instance['title']);
		$sum = (!empty($instance['sum']) && is_numeric($instance['sum'])) ? (int)$instance['sum'] : 'all';
		if (!empty($title)) { echo $before_title . $title . $after_title; }
		
		$select = "SELECT p.ID, p.post_date, p.post_title, p.post_excerpt FROM {$wpdb->posts} AS p JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.ID WHERE pm.meta_key = 'jcProjectStatus' && p.post_status = 'publish' ORDER BY p.post_date DESC";
		if ($sum != 'all' && is_int($sum)) {
			$select .= " LIMIT {$sum}";
		}
		$posts = $wpdb->get_results($select);
		if (!empty($posts)) {
			echo '<ul class="jcProjectWidget">'."\n";
			foreach($posts as $post) {
				list($date,$time)=explode(" ",$post->post_date);
				list($y,$m,$d)=explode("-",$date);
				echo '<li><span class="date">'.$d.'.'.$m.'.'.$y.'</span>'."\n";
				echo '<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a><br/>'."\n";
				echo '<div class="jcProjectItem" id="'.get_post_meta($post->ID,'jcProjectStatus',true).'"></div>'."\n";
				echo '<div style="clear:both;"></div>'."\n";
			}
			echo "</ul>\n";
		}
		echo $after_widget;
	}
}