<?php
/**
 * Wordpress-Plugin jcWpProject
 * @author		Stefan Jacomeit <stefan@jacomeit.com>
 * @version		1.0.1
 * @copyright	2011 Jacomeit.com
 * @license		GPLv2
 */
/*
Plugin Name: jcWpProject
Plugin URI: http://www.jacomeit.com/archiv/jc-wp-project
Description: Mit diesem Plugin können Projekte inkl. deren Status erfasst und mittels Shortcodes in Seiten und Artikeln inklusive einer sog. Progressbar angezeigt werden.
Author: Stefan Jacomeit
Author URI: http://www.jacomeit.com
Version: 1.0.1
*/

/**
 * Load the internationalization
 */
load_plugin_textdomain('jc-wp-project', false, 'jc-wp-project/languages');
/**
 * Include the Sidebar-Widget
 */
add_action('widgets_init', 'jc_wp_project_status_widget');
function jc_wp_project_status_widget() {
	include_once(plugin_dir_path(__FILE__)."/includes/Jc_Wp_Projectstatus_Widget.php");
	register_widget('Jc_Wp_Projectstatus_Widget');
}

/**
 * Set the rest of functions, only if it's not in admin
 */
if (!is_admin()) {
	/**
	 * Add jQuery, jQueryUI and jQuery-Progressbar to frontend head
	 */
	add_action('init', 'jc_project_enqueScript');
	function jc_project_enqueScript() {
		wp_enqueue_script('jcprojects', plugin_dir_url(__FILE__).'js/jcproject.js', array('jquery'));
		wp_enqueue_script('jcUiProgress', plugin_dir_url(__FILE__).'js/jquery-ui-1.8.16.progressbar.min.js');
		wp_enqueue_style('jcproject', plugin_dir_url(__FILE__).'css/jc-jquery-ui.css');
	}
	/**
	 * First Shortcode for using in Articles/Pages
	 */
	add_action('init', 'jc_project_register_shortcodes');
	function jc_project_register_shortcodes() {
		add_shortcode('jcWpProjectStatus', 'jc_wp_project_status_shortcode');
		add_shortcode('jcWpProjects', 'jc_wp_projects_shortcode');
	}
	/**
	 * Shortcode [jcWpProjectStatus]
	 * Shows the Projectstatus from custom field, if its filled out. If not, 
	 * nothing happens.
	 */
	function jc_wp_project_status_shortcode() {
		global $post;
		$status = get_post_meta($post->ID, 'jcProjectStatus', true);
		$out = '';
		if (!empty($status)) {
			$out = '<div class="jcProjectItem" id="'.$status.'"></div>'."\n";
			$out .= '<div style="clear:both;"></div>'."\n";
		}
		return $out;
	}
	/**
	 * Shows all defined Projects from all articles/pages, where are public as 
	 * list.
	 */
	function jc_wp_projects_shortcode() {
		global $wpdb;
		$wpdb->show_errors();
		$out = '';
		$posts = $wpdb->get_results("SELECT p.ID, p.post_date, p.post_title, p.post_excerpt FROM {$wpdb->posts} AS p JOIN {$wpdb->postmeta} AS pm ON pm.post_id = p.ID WHERE pm.meta_key = 'jcProjectStatus' && p.post_status = 'publish' ORDER BY p.post_date DESC");
		if (!empty($posts)) {
			$out = '<ul class="jcProjectList">'."\n";
			foreach($posts as $post) {
				list($date,$time)=explode(" ",$post->post_date);
				list($y,$m,$d)=explode("-",$date);
				$out .= '<li><span class="date">'.$d.'.'.$m.'.'.$y.'</span>'."\n";
				$out .= '<a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a><br/>'."\n";
				$excerpt = get_post_meta($post->ID,'jcProjectExcerpt', true);
				if (!empty($excerpt)) {
					$out .= '<div class="excerpt">'.$excerpt.'</div>'."\n";
				}
				$out .= '<div class="jcProjectItem" id="'.get_post_meta($post->ID,'jcProjectStatus',true).'"></div>'."\n";
				$out .= '<div style="clear:both;"></div>'."\n";
			}
			$out .= "</ul>\n";
		}
		return $out;
	}
}