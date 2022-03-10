<?php

/**
 * Elementor Team Widget.
 *
 *
 * @since 1.0.0
 */
class Elementor_Cloud_Link_Widget extends \Elementor\Widget_Base
{
	/**
	 * Get widget name.
	 *
	 * Retrieve Team widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'Cloud Link';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Team widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Cloud Link', 'elemext');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Team widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-video-camera';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Team widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['aqb-widgets'];
	}

	/**
	 * Register Team widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'elemext'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'website_link',
			[
				'label' => esc_html__( 'Link', 'elemext' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					'custom_attributes' => '',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render Team widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{		
        $settings = $this->get_settings_for_display();

        $html = '<?xml version="1.0" encoding="UTF-8"?><svg viewBox="0 0 640 480" xmlns="http://www.w3.org/2000/svg"><g fill="#3f3f9b" opacity=".75" stroke-width="2.587"><a xlink:href="https://'.  $settings['website_link']["url"].'"><path d="m307.19 90.098c-37.514 0-69.203 23.924-79.063 56.594-4.1044-2.3209-8.8264-3.6562-13.875-3.6562-15.613 0-28.281 12.668-28.281 28.281 0 0.15903-0.002625 0.31036 0 0.46875-4.6769-0.95819-9.5806-1.5-14.656-1.5-30.947 0-56.062 19.018-56.062 42.438 0 23.419 25.116 42.438 56.062 42.438 12.257 0 23.583-3.0059 32.812-8.0625 5.5123 16.492 21.068 28.406 39.406 28.406 12.427 0 23.569-5.4713 31.188-14.125 7.3906 3.866 16.082 6.0938 25.375 6.0938 12.644 0 24.184-4.1131 32.844-10.875 11.67 12.111 28.829 19.781 47.969 19.781 23.481 0 44.002-11.553 55.031-28.688 1.6603 0.24332 3.3638 0.375 5.0937 0.375 18.68 0 33.813-14.69 33.813-32.812s-15.133-32.844-33.813-32.844c-3.3425 0-6.5745 0.49783-9.625 1.375-10.066-11.865-25.115-20.091-42.312-22.094-3.5179-40.082-38.849-71.594-81.906-71.594v-1.5e-5z"/></a></g></svg>';
	    echo $html;
	}
}
