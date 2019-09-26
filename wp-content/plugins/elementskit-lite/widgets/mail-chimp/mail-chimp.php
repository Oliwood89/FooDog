<?php
namespace Elementor;

use \ElementsKit\Elementskit_Widget_Mail_Chimp_Handler as Handler;
use \ElementsKit\Modules\Controls\Controls_Manager as ElementsKit_Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Elementskit_Widget_Mail_Chimp extends Widget_Base {

	public $base;

    public function get_name() {
        return Handler::get_name();
    }

    public function get_title() {
        return Handler::get_title();
    }

    public function get_icon() {
        return Handler::get_icon();
    }

    public function get_categories() {
        return Handler::get_categories();
    }


    protected function _register_controls() {

        //start content Mail form design
        $this->start_controls_section(
            'ekit_mail_chimp_section_form', [
                'label' => esc_html__( 'Form ', 'elementskit' ),
            ]
        );

		// show name control
		$this->add_control(
			'ekit_mail_chimp_section_form_name_show',
			[
				'label' => esc_html__( 'Show Name', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		// first name
		$this->add_control(
			'ekit_mail_first_heading_title',
			[
				'label' => esc_html__( 'First Name ', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes',
				],
			]
		);
		$this->add_control(
            'ekit_mail_chimp_first_name_label',
            [
                'label' => esc_html__( 'Label', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'First name', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
            ]
		);
		$this->add_control(
            'ekit_mail_chimp_first_name_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Your frist name', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
            ]
		);
		$this->add_control(
			'ekit_mail_chimp_first_name_icon_show',
			[
				'label' => esc_html__( 'Show Input Group Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
			]
		);
		$this->add_control(
            'ekit_mail_chimp_first_name_icon',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'type' => Controls_Manager::ICON,
                'default' => 'icon icon-user',
                'condition' => [
					'ekit_mail_chimp_first_name_icon_show' => 'yes',
					'ekit_mail_chimp_section_form_name_show' => 'yes'
                ]
            ]
		);
		$this->add_control(
			'ekit_mail_chimp_first_name_icon_before_after',
			[
				'label' => esc_html__( 'Before After', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before'  => esc_html__( 'Before', 'elementskit' ),
					'after' => esc_html__( 'After', 'elementskit' ),
				],
				'condition' => [
					'ekit_mail_chimp_first_name_icon_show' => 'yes',
					'ekit_mail_chimp_first_name_icon!' => '',
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
			]
		);

		$this->add_control(
			'ekit_mail_last_and_first_name_divider',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
			]
		);

		// last name
		$this->add_control(
			'ekit_mail_last_heading_title',
			[
				'label' => esc_html__( 'Last Name : ', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes',
				],
			]
		);
		$this->add_control(
            'ekit_mail_chimp_last_name_label',
            [
                'label' => esc_html__( 'Label', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Last name:', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
            ]
        );
		$this->add_control(
            'ekit_mail_chimp_last_name_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Your last name', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
            ]
		);

		$this->add_control(
			'ekit_mail_chimp_last_name_icon_show',
			[
				'label' => esc_html__( 'Show Input Group Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
			]
		);
		$this->add_control(
            'ekit_mail_chimp_last_name_icon',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'type' => Controls_Manager::ICON,
                'default' => 'icon icon-user',
                'condition' => [
					'ekit_mail_chimp_last_name_icon_show' => 'yes',
					'ekit_mail_chimp_section_form_name_show' => 'yes'
                ]
            ]
		);
		$this->add_control(
			'ekit_mail_chimp_last_name_icon_before_after',
			[
				'label' => esc_html__( 'Before After', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before'  => esc_html__( 'Before', 'elementskit' ),
					'after' => esc_html__( 'After', 'elementskit' ),
				],
				'condition' => [
					'ekit_mail_chimp_last_name_icon_show' => 'yes',
					'ekit_mail_chimp_last_name_icon!' => '',
					'ekit_mail_chimp_section_form_name_show' => 'yes'
				]
			]
		);

		// phone number
		$this->add_control(
			'ekit_mail_chimp_section_form_phone_show',
			[
				'label' => esc_html__( 'Show Phone :', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'separator' => 'before'
			]
		);
		$this->add_control(
			'ekit_mail_phone_heading_title',
			[
				'label' => esc_html__( 'Phone : ', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'ekit_mail_chimp_section_form_phone_show' => 'yes',
				],
			]
		);
		$this->add_control(
            'ekit_mail_chimp_phone_label',
            [
                'label' => esc_html__( 'Label', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Phone', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'ekit_mail_chimp_section_form_phone_show' => 'yes'
				]
            ]
        );
		$this->add_control(
            'ekit_mail_chimp_phone_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Your phone No', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
				'condition' => [
					'ekit_mail_chimp_section_form_phone_show' => 'yes'
				]
            ]
		);
		$this->add_control(
			'ekit_mail_chimp_phone_icon_show',
			[
				'label' => esc_html__( 'Show Input Group Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'ekit_mail_chimp_section_form_phone_show' => 'yes'
				]
			]
		);
		$this->add_control(
            'ekit_mail_chimp_phone_icon',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'type' => Controls_Manager::ICON,
                'default' => 'icon icon-phone-handset',
                'condition' => [
					'ekit_mail_chimp_phone_icon_show' => 'yes',
					'ekit_mail_chimp_section_form_phone_show' => 'yes'
                ]
            ]
		);
		$this->add_control(
			'ekit_mail_chimp_phone_icon_before_after',
			[
				'label' => esc_html__( 'Before After', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before'  => esc_html__( 'Before', 'elementskit' ),
					'after' => esc_html__( 'After', 'elementskit' ),
				],
				'condition' => [
					'ekit_mail_chimp_phone_icon_show' => 'yes',
					'ekit_mail_chimp_phone_icon!' => '',
					'ekit_mail_chimp_section_form_phone_show' => 'yes'
				]
			]
		);

		// email address
		$this->add_control(
			'ekit_mail_email_address_heading_title',
			[
				'label' => esc_html__( 'Email Address : ', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_control(
            'ekit_mail_chimp_email_address_label',
            [
                'label' => esc_html__( 'Label', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Email address', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],

            ]
        );
		$this->add_control(
            'ekit_mail_chimp_email_address_placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
				'placeholder' 	 => esc_html__( 'Your email address', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
            ]
		);

		$this->add_control(
			'ekit_mail_chimp_email_icon_show',
			[
				'label' => esc_html__( 'Show Input Group Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
            'ekit_mail_chimp_email_icon',
            [
                'label' => esc_html__( 'Icon', 'elementskit' ),
                'type' => Controls_Manager::ICON,
                'default' => 'icon icon-envelope',
                'condition' => [
					'ekit_mail_chimp_email_icon_show' => 'yes',
                ]
            ]
		);
		$this->add_control(
			'ekit_mail_chimp_email_icon_before_after',
			[
				'label' => esc_html__( 'Before After', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before'  => esc_html__( 'Before', 'elementskit' ),
					'after' => esc_html__( 'After', 'elementskit' ),
				],
				'condition' => [
					'ekit_mail_chimp_email_icon_show' => 'yes',
					'ekit_mail_chimp_email_icon!' => '',
				]
			]
		);

		$this->add_control(
			'ekit_mail_chimp_email_and_button_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// submit button text
		$this->add_control(
            'ekit_mail_chimp_submit',
            [
                'label' => esc_html__( 'Submit Button Text', 'elementskit' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Sign Up', 'elementskit' ),
				'placeholder' => esc_html__( '', 'elementskit' ),
				'label_block'	 => false,
				'dynamic' => [
					'active' => true,
				],
            ]
        );
		$this->add_control(
			'ekit_mail_chimp_submit_button_heading',
			[
				'label' => esc_html__( 'Submit Button : ', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'ekit_mail_chimp_submit_icon_show',
			[
				'label' => esc_html__( 'Show Icon', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'ekit_mail_chimp_submit_icon',
			[
				'label' => esc_html__( 'Button Icons', 'elementskit' ),
				'type' => Controls_Manager::ICON,
				'default' => 'icon icon-tick',
				'condition' => [
					'ekit_mail_chimp_submit_icon_show' => 'yes'
				]
			]
		);
		$this->add_control(
			'ekit_mail_chimp_submit_icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'elementskit' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'before',
				'options' => [
					'before'  => esc_html__( 'Before', 'elementskit' ),
					'after' => esc_html__( 'After', 'elementskit' ),
				],
				'condition' => [
					'ekit_mail_chimp_submit_icon_show' => 'yes',
					'ekit_mail_chimp_submit_icon!' => ''
				]
			]
		);

		$this->add_control(
			'ekit_mail_chimp_form_style_switcher',
			[
				'label' => esc_html__( 'Form Style Switch', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Inline', 'elementskit' ),
				'label_off' => esc_html__( 'Stack', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->end_controls_section();
		// end content form

		// label
		$this->start_controls_section(
			'ekit_mail_chimp_input_label_style',
			[
				'label' => esc_html__( 'Label', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_mail_chimp_input_label_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .elementskit_input_label',
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_label_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_label' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_label_margin',
			[
				'label' => esc_html__( 'Margin', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// input style
		$this->start_controls_section(
			'ekit_mail_chimp_input_style',
			[
				'label' => esc_html__( 'Input', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_mail_chimp_input_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'selector' => '{{WRAPPER}} .ekit_form_control',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_mail_chimp_input_style_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ekit_form_control',
				'exclude' => [
					'image'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ekit_form_control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_mail_chimp_input_style_border',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .ekit_form_control',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_mail_chimp_input_style_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elementskit' ),
				'selector' => '{{WRAPPER}} .ekit_form_control, {{WRAPPER}} .ekit_form_control:focus',
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit_form_control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ekit_form_control' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_group_style_width',
			[
				'label' => esc_html__( 'Input Group Input Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_group .ekit_form_control' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit_form_control' => 'height: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_margin_bottom',
			[
				'label' => esc_html__( 'Margin Bottom', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_wraper:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_mail_chimp_form_style_switcher!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_margin_right',
			[
				'label' => esc_html__( 'Margin Right', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit_inline_form .elementskit_input_wraper:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_mail_chimp_form_style_switcher' => 'yes'
				]
			]
		);

		$this->add_control(
			'ekit_mail_chimp_input_style_placeholder_heading',
			[
				'label' => esc_html__( 'Placeholder', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_placeholder_color',
			[
				'label' => esc_html__( 'Placeholder Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit_form_control::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit_form_control::-moz-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit_form_control:-ms-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .ekit_form_control:-moz-placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_style_placeholder_font_size',
			[
				'label' => esc_html__( 'Font Size', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit_form_control::-webkit-input-placeholder' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ekit_form_control::-moz-placeholder' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ekit_form_control:-ms-input-placeholder' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ekit_form_control:-moz-placeholder' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_mail_chimp_button_style_holder',
			[
				'label' => esc_html__( 'Button', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'ekit_mail_chimp_button_typography',
				'label' => esc_html__( 'Typography', 'elementskit' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .ekit-mail-submit',
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_border_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'ekit_mail_chimp_button_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'elementskit' ),
				'selector' => '{{WRAPPER}} .ekit-mail-submit',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_mail_chimp_button_border',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .ekit-mail-submit',
			]
		);

		$this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'ekit_mail_chimp_button_title_shadow',
                'selector' => '{{WRAPPER}} .ekit-mail-submit' ,
            ]
		);

		$this->add_control(
			'ekit_mail_chimp_button_style_use_width_height',
			[
				'label' => esc_html__( 'Use Height Width', 'elementskit' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'elementskit' ),
				'label_off' => esc_html__( 'Hide', 'elementskit' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_width',
			[
				'label' => esc_html__( 'Width', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_mail_chimp_button_style_use_width_height' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_style_height',
			[
				'label' => esc_html__( 'Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_mail_chimp_button_style_use_width_height' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_style_line_height',
			[
				'label' => esc_html__( 'Line Height', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit' => 'line-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_mail_chimp_button_style_use_width_height' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_style_margin',
			[
				'label' => esc_html__( 'Margin', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
            'ekit_mail_chimp_button_normal_and_hover_tabs'
        );
        $this->start_controls_tab(
            'ekit_mail_chimp_button_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'elementskit' ),
            ]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_mail_chimp_button_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} .ekit-mail-submit',
				'exclude' => [
					'image'
				]
			]
		);

		$this->end_controls_tab();
        $this->start_controls_tab(
            'ekit_mail_chimp_button_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'elementskit' ),
            ]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_color_hover',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_mail_chimp_button_background_hover',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient', ],
				'selector' => '{{WRAPPER}} .ekit-mail-submit:before',
				'exclude' => [
					'image'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'ekit_mail_chimp_button_icon_heading',
			[
				'label' => esc_html__( 'Icon', 'elementskit' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_icon_padding_right',
			[
				'label' => esc_html__( 'Padding Right', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit > i' => 'padding-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_mail_chimp_submit_icon_position' => 'before'
				]
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_button_icon_padding_left',
			[
				'label' => esc_html__( 'Padding Left', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .ekit-mail-submit > i' => 'padding-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'ekit_mail_chimp_submit_icon_position' => 'after'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'ekit_mail_chimp_input_icon_style_holder',
			[
				'label' => esc_html__( 'Input Icon', 'elementskit' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'ekit_mail_chimp_input_icon_background',
				'label' => esc_html__( 'Background', 'elementskit' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementskit_input_group_text',
				'exclude' => [
					'image'
				]
			]
		);

		$this->add_control(
			'ekit_mail_chimp_input_icon_color_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_icon_color',
			[
				'label' => esc_html__( 'Color', 'elementskit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000000',
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_group_text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'ekit_mail_chimp_input_icon_border',
				'label' => esc_html__( 'Border', 'elementskit' ),
				'selector' => '{{WRAPPER}} .elementskit_input_group_text',
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_group_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'elementskit' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_group_text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'ekit_mail_chimp_input_icon_font_size',
			[
				'label' => esc_html__( 'Font Size', 'elementskit' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .elementskit_input_group_text' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();

	}


	protected function render( ) {
        echo '<div class="ekit-wid-con" >';
            $this->render_raw();
        echo '</div>';
    }

    protected function render_raw( ) {
		   $settings = $this->get_settings_for_display();
		   extract($settings);

		 ?>
		 <div class="ekit-mail-chimp">
			<form method="post" class="ekit-mailChimpForm">
			<div class="ekit-mail-message" ></div>

				<div class="elementskit_form_wraper <?php if($ekit_mail_chimp_form_style_switcher == 'yes'): ?>elementskit_inline_form<?php endif;?>">
				<?php if(isset($ekit_mail_chimp_section_form_name_show) && $ekit_mail_chimp_section_form_name_show == 'yes'):?>
					<div class="ekit-mail-chimp-name elementskit_input_wraper">
						<?php // if( strlen($ekit_mail_chimp_first_name_label) > 1 || strlen($ekit_mail_chimp_first_name_placeholder) > 1): ?>
						<div class="elementskit_form_group">
							<?php if($ekit_mail_chimp_first_name_label != ''): ?>
							<label class="elementskit_input_label"><?php esc_html_e($ekit_mail_chimp_first_name_label);?> </label>
							<?php endif; ?>
							<div class="elementskit_input_element_container <?php if(($ekit_mail_chimp_first_name_icon_show == 'yes') && ($ekit_mail_chimp_first_name_icon != '')) : ?>elementskit_input_group<?php endif; ?>">
								<?php if(($ekit_mail_chimp_first_name_icon_show == 'yes') && ($ekit_mail_chimp_first_name_icon != '') && ($ekit_mail_chimp_first_name_icon_before_after == 'before')) : ?>
								<div class="elementskit_input_group_prepend">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_first_name_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
								<input type="text" class="ekit_user_first ekit_form_control <?php if(($ekit_mail_chimp_first_name_icon_show == 'yes') && ($ekit_mail_chimp_first_name_icon != '') && ($ekit_mail_chimp_first_name_icon_before_after == 'after')) : ?> ekit_append_input <?php endif; ?>"  name="firstname" placeholder="<?php esc_html_e($ekit_mail_chimp_first_name_placeholder);?>" required />

								<?php if(($ekit_mail_chimp_first_name_icon_show == 'yes') && ($ekit_mail_chimp_first_name_icon != '') && ($ekit_mail_chimp_first_name_icon_before_after == 'after')) : ?>
								<div class="elementskit_input_group_append">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_first_name_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<?php // endif; ?>
					</div>
				<?php endif; ?>
				<?php if(isset($ekit_mail_chimp_section_form_name_show) && $ekit_mail_chimp_section_form_name_show == 'yes'):?>
					<div class="ekit-mail-chimp-name elementskit_input_wraper">
						<?php // if( strlen($ekit_mail_chimp_last_name_label) > 1 || strlen($ekit_mail_chimp_last_name_placeholder) > 1): ?>
						<div class="elementskit_form_group">
							<?php if($ekit_mail_chimp_last_name_label != ''): ?>
							<label class="elementskit_input_label"><?php esc_html_e($ekit_mail_chimp_last_name_label);?> </label>
							<?php endif; ?>
							<div class="elementskit_input_element_container <?php if(($ekit_mail_chimp_last_name_icon_show == 'yes') && ($ekit_mail_chimp_last_name_icon != '')) : ?>elementskit_input_group<?php endif; ?>">
								<?php if(($ekit_mail_chimp_last_name_icon_show == 'yes') && ($ekit_mail_chimp_last_name_icon != '') && ($ekit_mail_chimp_last_name_icon_before_after == 'before')) : ?>
								<div class="elementskit_input_group_prepend">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_last_name_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
								<input type="text" class="ekit_user_last ekit_form_control <?php if(($ekit_mail_chimp_last_name_icon_show == 'yes') && ($ekit_mail_chimp_last_name_icon != '') && ($ekit_mail_chimp_last_name_icon_before_after == 'after')) : ?> ekit_append_input <?php endif; ?>" name="lastname" placeholder="<?php esc_html_e($ekit_mail_chimp_last_name_placeholder);?>" required />

								<?php if(($ekit_mail_chimp_last_name_icon_show == 'yes') && ($ekit_mail_chimp_last_name_icon != '') && ($ekit_mail_chimp_last_name_icon_before_after == 'after')) : ?>
								<div class="elementskit_input_group_append">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_last_name_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<?php //endif; ?>
					</div>
				<?php endif;
				if(isset($ekit_mail_chimp_section_form_phone_show) && $ekit_mail_chimp_section_form_phone_show == 'yes'):?>
					<div class="ekit-mail-chimp-phone elementskit_input_wraper">
						<div class="elementskit_form_group">
							<?php if($ekit_mail_chimp_phone_label != ''): ?>
							<label class="elementskit_input_label"><?php esc_html_e($ekit_mail_chimp_phone_label);?> </label>
							<?php endif; ?>
							<div class="elementskit_input_element_container <?php if(($ekit_mail_chimp_phone_icon_show == 'yes') && ($ekit_mail_chimp_phone_icon != '')) : ?>elementskit_input_group<?php endif; ?>">
								<?php if(($ekit_mail_chimp_phone_icon_show == 'yes') && ($ekit_mail_chimp_phone_icon != '') && ($ekit_mail_chimp_phone_icon_before_after == 'before')) : ?>
								<div class="elementskit_input_group_prepend">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_phone_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
								<input type="phone" class="ekit_mail_phone ekit_form_control <?php if(($ekit_mail_chimp_phone_icon_show == 'yes') && ($ekit_mail_chimp_phone_icon != '') && ($ekit_mail_chimp_phone_icon_before_after == 'after')) : ?> ekit_append_input <?php endif; ?>" name="phone" placeholder="<?php esc_html_e($ekit_mail_chimp_phone_placeholder);?>" required />

								<?php if(($ekit_mail_chimp_phone_icon_show == 'yes') && ($ekit_mail_chimp_phone_icon != '') && ($ekit_mail_chimp_phone_icon_before_after == 'after')) : ?>
								<div class="elementskit_input_group_append">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_phone_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
					<div class="ekit-mail-chimp-email elementskit_input_wraper">
						<div class="elementskit_form_group">
							<?php if($ekit_mail_chimp_email_address_label != ''): ?>
							<label class="elementskit_input_label"><?php esc_html_e($ekit_mail_chimp_email_address_label);?> </label>
							<?php endif; ?>
							<div class="elementskit_input_element_container <?php if(($ekit_mail_chimp_email_icon_show == 'yes') && ($ekit_mail_chimp_email_icon != '')) : ?>elementskit_input_group<?php endif; ?>">
								<?php if(($ekit_mail_chimp_email_icon_show == 'yes') && ($ekit_mail_chimp_email_icon != '') && ($ekit_mail_chimp_email_icon_before_after == 'before')) : ?>
								<div class="elementskit_input_group_prepend">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_email_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
								<input type="email" name="email" class="ekit_mail_email ekit_form_control <?php if(($ekit_mail_chimp_email_icon_show == 'yes') && ($ekit_mail_chimp_email_icon != '') && ($ekit_mail_chimp_email_icon_before_after == 'after')) : ?> ekit_append_input <?php endif; ?>" placeholder="<?php esc_html_e($ekit_mail_chimp_email_address_placeholder);?>" required />

								<?php if(($ekit_mail_chimp_email_icon_show == 'yes') && ($ekit_mail_chimp_email_icon != '') && ($ekit_mail_chimp_email_icon_before_after == 'after')) : ?>
								<div class="elementskit_input_group_append">
									<div class="elementskit_input_group_text"><i class="<?php echo esc_attr($ekit_mail_chimp_email_icon); ?>"></i></div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="ekit_submit_input_holder elementskit_input_wraper">
						<button type="submit" class="ekit-mail-submit" name="ekit_mail_chimp"><?php if(($ekit_mail_chimp_submit_icon_show == 'yes') && ($ekit_mail_chimp_submit_icon != '') && ($ekit_mail_chimp_submit_icon_position == 'before')): ?> <i class="<?php echo esc_attr($ekit_mail_chimp_submit_icon); ?>"></i><?php endif; ?><?php esc_html_e($ekit_mail_chimp_submit);?><?php if(($ekit_mail_chimp_submit_icon_show == 'yes') && ($ekit_mail_chimp_submit_icon != '') && ($ekit_mail_chimp_submit_icon_position == 'after')): ?> <i class="<?php echo esc_attr($ekit_mail_chimp_submit_icon); ?>"></i><?php endif; ?></button>
					</div>
				</div>
			</form>
		 </div>
		 <?php
	  }

	  protected function _content_template() { }

}