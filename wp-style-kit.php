<?php
/*
Plugin Name: WP Style Kit
Plugin URI: http://happybloggerplaza.com/wp-style-kit/
Description: WP Style Kit allows you to easily apply styles to text in the Wordpress Visual Editor from a number of predefined styles.
Author: Happy Blogger Plaza
Version: 1.0
Author URI: http://happybloggerplaza.com/

Copyright 2015 Happy Blogger Plaza (email: hbp@happybloggerplaza.com)

*/

/**
 * WP Style Kit main plugin class
 *
 * @author Happy Blogger Plaza <hbp@happybloggerplaza.com>
 */
class WP_Style_Kit {

	/**
	 * Server path to the plugin folder
	 *
	 * @var string
	 */
	public $plugin_dir;

	/**
	 * URL to the plugin folder
	 *
	 * @var string
	 */
	public $plugin_url;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->plugin_dir = dirname( __FILE__ );
		$this->plugin_url = plugins_url( basename( dirname( __FILE__ ) ) );

		add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ) );
		add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2' ) );
		add_action( 'admin_init', array( $this, 'add_editor_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_custom_styles' ) );
	}

	/**
	 * Define custom styles for the dropdown menu
	 *
	 * @param array $settings Existing custom styles in TinyMCE
	 * @return array
	 */
	public function tiny_mce_before_init( $settings ) {
		$style_formats = array(
			array(
				'title'   => 'Callout Box',
				'block'   => 'div',
				'classes' => 'callout',
				'wrapper' => true
			),
			array(
				'title'   => 'Content Box',
				'block'   => 'div',
				'classes' => 'content-box-blue',
				'wrapper' => true
			),
			array(
				'title'   => 'Shadow Box',
				'block'   => 'div',
				'classes' => 'cd-box',
				'wrapper' => true
			),
			array(
				'title'   => 'Headline 1',
				'inline' => 'span',
				'classes'  => 'hed1'
			),
			array(
				'title'  => 'Headline 2',
				'inline' => 'span',
				'classes'  => 'hed2'
			),
			array(
				'title'   => 'Quotes',
				'inline' => 'span',
				'classes'  => 'quotes'
			),
			array(
				'title'   => 'Circle blue',
				'inline' => 'span',
				'classes'  => 'circle-blue'
			),
			array(
				'title'   => 'Circle orange',
				'inline' => 'span',
				'classes'  => 'circle-orange'
			),
			array(
				'title'   => 'Circle red',
				'inline' => 'span',
				'classes'  => 'circle-red'
			),
			array(
				'title'   => 'Box blue',
				'inline' => 'span',
				'classes'  => 'box-blue'
			),
			array(
				'title'   => 'Box orange',
				'inline' => 'span',
				'classes'  => 'box-orange'
			),
			array(
				'title'   => 'Box red',
				'inline' => 'span',
				'classes'  => 'box-red'
			),
		);

		$settings['style_formats'] = json_encode( $style_formats );

		return $settings;
	}

	/**
	 * Add the Styles dropdown to the visual editor
	 *
	 * @param array $buttons Array of buttons already registered
	 * @return array
	 */
	public function mce_buttons_2( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	/**
	 * Load a custom stylesheet in the visual editor
	 *
	 * The path in the add_editor_style function is relative to the theme root.
	 *
	 * @return void
	 */
	public function add_editor_style() {
		add_editor_style( '../../plugins/' . basename( dirname( __FILE__ ) ) . '/wp-style-kit.css' );
	}

	/**
	 * Load a custom stylesheet on the website
	 *
	 * @return void
	 */
	public function enqueue_custom_styles() {
		wp_enqueue_style(
			'wp-style-kit',
			$this->plugin_url . '/wp-style-kit.css',
			array(),
			'1.0',
			'all'
		);
	}

}


$WP_Style_Kit = new WP_Style_Kit();

/*


See this page for more details: http://happybloggerplaza.com/wp-style-kit/

*/