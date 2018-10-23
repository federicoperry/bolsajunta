<?php
namespace ElementPack\Modules\CookieConsent\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use ElementPack\Element_Pack_Loader;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Cookie_Consent extends Widget_Base {
	public function get_name() {
		return 'bdt-cookie-consent';
	}

	public function get_title() {
		return esc_html__( 'Cookie Consent', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-widget-icon eicon-favorite';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_style_depends() {
		return [ 'cookieconsent' ];
	}

	public function get_script_depends() {
		return [ 'cookieconsent' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => __( 'Layout', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'message',
			[
				'label'   => __( 'Message', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'This website uses cookies to ensure you get the best experience on our website. ',
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => __( 'Button Text', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Got it!',
			]
		);

		$this->add_control(
			'learn_more_text',
			[
				'label'       => __( 'Learn More Text', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Learn more', 'bdthemes-element-pack' ),
				'default'     => 'Learn more',
			]
		);

		$this->add_control(
			'learn_more_link',
			[
				'label'         => __( 'Learn More Link', 'bdthemes-element-pack' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'placeholder'   => __( 'https://your-link.com', 'bdthemes-element-pack' ),
				'default'       => [
					'url' => 'http://cookiesandyou.com/',
				],
			]
		);

		$this->add_control(
			'position',
			[
				'label'   => __( 'Position', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'bottom'       => esc_html__('Bottom', 'bdthemes-element-pack'),
					'bottom-left'  => esc_html__('Bottom Left', 'bdthemes-element-pack') ,
					'bottom-right' => esc_html__('Bottom Right', 'bdthemes-element-pack') ,
					'top'          => esc_html__('Top', 'bdthemes-element-pack') ,
				],
			]
		);

		$this->add_control(
			'expiry_days',
			[
				'label'       => __( 'Expiry Days', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'description' => 'Specify -1 for no expiry',
				'default'     => [
					'size' => 365,
				],
				'range' => [
					'px' => [
						'min'  => 1,
						'max'  => 731,
						'step' => 5,
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Style', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label'     => __( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default' => '#3937a3',
				'selectors' => [
					'body .cc-window' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'body .cc-window' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'learn_more_color',
			[
				'label'     => __( 'Learn More Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4593E3',
				'selectors' => [
					'body .cc-window .cc-link' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subtitle_typography',
				'selector' => 'body .cc-window *',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_dismiss_button',
			[
				'label' => esc_html__( 'Button', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_dismiss_button_style' );

		$this->start_controls_tab(
			'tab_dismiss_button_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'dismiss_button_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_background',
			[
				'label'     => esc_html__( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#41aab9',
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_border_style',
			[
				'label'   => __( 'Border Style', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'bdthemes-element-pack' ),
					'solid'  => __( 'Solid', 'bdthemes-element-pack' ),
					'double' => __( 'Double', 'bdthemes-element-pack' ),
					'dotted' => __( 'Dotted', 'bdthemes-element-pack' ),
					'dashed' => __( 'Dashed', 'bdthemes-element-pack' ),
					'groove' => __( 'Groove', 'bdthemes-element-pack' ),
				],
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss' => 'border-style: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_border_width',
			[
				'label'   => __( 'Border Width', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'min'  => 0,
					'max'  => 20,
					'size' => 1,
				],
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss' => 'border-width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ccc',
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'body .cc-window .cc-btn.cc-dismiss' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'body .cc-window .cc-btn.cc-dismiss' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'dismiss_button_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => 'body .cc-window .cc-btn.cc-dismiss',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dismiss_button_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'dismiss_button_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_hover_background',
			[
				'label'     => esc_html__( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss:hover' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'dismiss_button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'dismiss_button_border_style!' => 'none',
				],
				'selectors' => [
					'body .cc-window .cc-btn.cc-dismiss:hover' => 'border-color: {{VALUE}} !important;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();

		$cc_position = $settings['position'];

		if ($cc_position == 'bottom-left') {
			$cc_position = 'cc-bottom cc-left cc-floating';
		} else if ($cc_position == 'bottom-right') {
			$cc_position = 'cc-bottom cc-right cc-floating';
		} else if ($cc_position == 'top') {
			$cc_position = 'cc-top cc-banner';
		} else if ($cc_position == 'bottom') {
			$cc_position = 'cc-bottom cc-banner';
		}
		
		if ( !Element_Pack_Loader::elementor()->editor->is_edit_mode() ) {
			?>		
			
			<script>
				window.addEventListener("load", function(){
					window.cookieconsent.initialise({
					  	"palette": {
					    	"popup": {
					      		"background": "#000"
						    },
					    	"button": {
					     		"background": "#f1d600"
					    	}
					  	},
						"position": "<?php echo esc_attr($settings['position']); ?>",
						"content": {
							"message": "<?php echo esc_attr($settings['message']); ?>",
							"dismiss": "<?php echo esc_attr($settings['button_text']); ?>",
						 	"link": "<?php echo esc_attr($settings['learn_more_text']); ?>",
							"href": "<?php echo esc_url($settings['learn_more_link']['url']); ?>",

					  	},
					  	"expiryDays" : <?php echo esc_attr($settings['expiry_days']['size']); ?>
					})
				});
			</script>
	        <?php
	    } else {
	    	?>

			<div role="dialog" aria-live="polite" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window <?php echo esc_attr($cc_position); ?> cc-type-info cc-theme-block cc-bottom cc-color-override--2000495483">

				<!--googleoff: all-->
				<span id="cookieconsent:desc" class="cc-message"><?php echo esc_attr($settings['message']); ?><a aria-label="learn more about cookies" role="button" tabindex="0" class="cc-link" href="<?php echo esc_url($settings['learn_more_link']['url']); ?>" rel="noopener noreferrer nofollow" target="_blank"><?php echo esc_attr($settings['learn_more_text']); ?></a></span>
				<div class="cc-compliance">
					<a aria-label="dismiss cookie message" role="button" tabindex="0" class="cc-btn cc-dismiss"><?php echo $settings['button_text']; ?></a>
				</div>
				<!--googleon: all-->

			</div>

	    	<?php
	    }
	}

	protected function _content_template() {
		?>
		
		<# 
			var cc_position = settings.position;

			if (cc_position == 'bottom-left') {
				cc_position = 'cc-bottom cc-left cc-floating';
			} else if (cc_position == 'bottom-right') {
				cc_position = 'cc-bottom cc-right cc-floating';
			} else if (cc_position == 'top') {
				cc_position = 'cc-top cc-banner';
			} else if (cc_position == 'bottom') {
				cc_position = 'cc-bottom cc-banner';
			}
	
		#>

		<div role="dialog" aria-live="polite" aria-label="cookieconsent" aria-describedby="cookieconsent:desc" class="cc-window cc-type-info cc-theme-block <# print(cc_position) #> cc-color-override--2000495483">

			<!--googleoff: all-->
			<span id="cookieconsent:desc" class="cc-message"><# print(settings.message) #><a aria-label="learn more about cookies" role="button" tabindex="0" class="cc-link" href="<# print(settings.learn_more_link) #>" rel="noopener noreferrer nofollow" target="_blank"><# print(settings.learn_more_text) #></a></span>
			<div class="cc-compliance">
				<a aria-label="dismiss cookie message" role="button" tabindex="0" class="cc-btn cc-dismiss"><# print(settings.button_text) #></a>
			</div>
			<!--googleon: all-->

		</div>



        <?php
	}
}
