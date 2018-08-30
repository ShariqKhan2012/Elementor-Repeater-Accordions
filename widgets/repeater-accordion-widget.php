<?php
/**
 * Elementor Repeater-Accordion Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Repeater_Accordion_Widget extends \Elementor\Widget_Accordion {

	/**
	 * Get widget name.
	 *
	 * Retrieve Repeater-Accordion widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'repeater_accordion';
	}

	/*public static function get_type() {
		return 'accordion';
	}*/

	/**
	 * Get widget title.
	 *
	 * Retrieve Repeater-Accordion widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Repeater-Accordion', 'elementor-repeater-accordion-extension' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Repeater-Accordion widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-accordion';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Repeater-Accordion widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jet-listing-elements' ];
	}

	/**
	 * Get HTML wrapper class.
	 *
	 * Retrieve the widget container class. Can be used to override the
	 * container class for specific widgets.
	 *
	 * @since 2.0.9
	 * @access protected
	 */
	protected function get_html_wrapper_class() {
		//return 'elementor-widget-' . $this->get_name();
		return 'elementor-widget-accordion';
		
	}

	/**
	 * Register Repeater-Accordion widget controls.
	 *
	 * Adds different fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		
		parent::_register_controls();
		
		$this->remove_control('tabs');
		
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'Repeater Accordion Source', 'elementor-repeater-accordion-extension' ),
			)
		);

		$this->add_control(
			'repeater_notice',
			array(
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw'  => __( '<b>Note</b> This widget can process only repeater meta fields created with JetThemeCore or ACF plugins', 'elementor-repeater-accordion-extension' ),
			)
		);

		$repeater_fields = $this->get_repeater_fields();

		$this->add_control(
			'dynamic_field_source',
			array(
				'label'   => __( 'Source Repeater', 'elementor-repeater-accordion-extension' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $repeater_fields,
			)
		);

		$this->add_control(
			'tab_title',
			[
				'label' => __( 'Title source', 'elementor-repeater-accordion-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Type meta_key_name_here' , 'elementor-repeater-accordion-extension' ),
				/*'dynamic' => [
					'active' => true,
				],*/
				'label_block' => true,
			]
		);

		$this->add_control(
			'tab_content',
			[
				'label' => __( 'Content source', 'elementor-repeater-accordion-extension' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Type meta_key_name_here' , 'elementor-repeater-accordion-extension' ),
				'label_block' => true,
			]
		);		
		
		$this->end_controls_section();

	}

	/**
	 * Render Repeater-Accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		if( function_exists('jet_engine') ):

			$settings = $this->get_settings_for_display();
			$source = isset( $settings['dynamic_field_source'] ) ? $settings['dynamic_field_source'] : false;

		
			if( !empty( $source ) ) :

				$items = jet_engine()->listings->data->get_meta( $source);

				if( !empty( $items ) ):
			
					$id_int = substr( $this->get_id_int(), 0, 3 );
					$title_source = isset( $settings['tab_title'] ) ? $settings['tab_title'] : false;
					$content_source = isset( $settings['tab_content'] ) ? $settings['tab_content'] : false;					
					?>

					<div class="elementor-accordion" role="tablist">
						<?php
						$index = 0;
						foreach ( $items as $key => $item ) :

							$tab_title_setting_key = '';
							$tab_content_setting_key = '';

							$tab_count = $index + 1;
							$index++;

							if(!empty($title_source)) {
								$tab_title_setting_key = isset( $item[$title_source] ) ? $item[$title_source] : '';
							}

							if(!empty($content_source)) {
								$tab_content_setting_key = isset( $item[$content_source] ) ? $item[$content_source] : '';
							}

							$this->add_render_attribute( $tab_title_setting_key, [
								'id' => 'elementor-tab-title-' . $id_int . $tab_count,
								'class' => [ 'elementor-tab-title' ],
								'tabindex' => $id_int . $tab_count,
								'data-tab' => $tab_count,
								'role' => 'tab',
								'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
							] );

							$this->add_render_attribute( $tab_content_setting_key, [
								'id' => 'elementor-tab-content-' . $id_int . $tab_count,
								'class' => [ 'elementor-tab-content', 'elementor-clearfix' ],
								'data-tab' => $tab_count,
								'role' => 'tabpanel',
								'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
							] );

							$this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );
							?>
							<div class="elementor-accordion-item">
								<<?php echo $settings['title_html_tag']; ?> <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
									<?php if ( $settings['icon'] ) : ?>
									<span class="elementor-accordion-icon elementor-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
										<i class="elementor-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
										<i class="elementor-accordion-icon-opened <?php echo esc_attr( $settings['icon_active'] ); ?>"></i>
									</span>
									<?php endif; ?>
									<?php echo $tab_title_setting_key;  //echo $item['tab_title']; ?>
								</<?php echo $settings['title_html_tag']; ?>>
								<div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
									<?php echo $this->parse_text_editor( $tab_content_setting_key ); ?>
								</div>
							</div>

						<?php endforeach; ?>
					</div>

				<?php endif; 
				
			endif; 
		
		endif; 

	}

	/**
	 * Get repeater meta fields for post type
	 *
	 * @return array
	 */	
	public function get_repeater_fields() {

		$result      = array();

		if( function_exists('jet_engine') ) {
			$meta_fields = jet_engine()->listings->data->get_listing_meta_fields();

			if ( ! empty( $meta_fields ) ) {
				foreach ( $meta_fields as $field ) {
					if ( 'repeater' === $field['type'] ) {
						$result[ $field['name'] ] = $field['title'];
					}
				}
			}
		}

		return apply_filters( 'jet-engine/listings/dynamic-accordion-repeater/fields', $result );

	}

}