<?php

//BG Style Controls
$this->start_controls_section('appto_slider_bg_style', [
    'label' => __('Background Style', 'appto-extension'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
]);

$this->add_control(
    'appto_banner_slider_bg_style',
    [
        'label' => esc_html__('Background Style', 'appto-extension'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'wave',
        'options' => [
            'flat' => esc_html__('Flat', 'appto-extension'),
            'wave' => esc_html__('Wave', 'appto-extension'),
            'wave-zig' => esc_html__('Wave Zig', 'appto-extension'),
        ],
        'toggle' => true,
        'prefix_class' => 'appto-banner-slider-style-',
    ]
);

$this->add_control(
    'appto_banner_slider_bg_gradient',
    [
        'label' => esc_html__('Background Gradient', 'appto-extension'),
        'type' => \Elementor\Controls_Manager::SELECT,
        'default' => 'wave',
        'options' => [
            'blue' => esc_html__('Blue', 'appto-extension'),
            'purple' => esc_html__('Purple', 'appto-extension'),
            'green' => esc_html__('Green', 'appto-extension'),
            'cyan' => esc_html__('Cyan', 'appto-extension'),
        ],
        'toggle' => true,
        'prefix_class' => 'appto-banner-slider-gradient-',
    ]
);

$this->end_controls_section();

//Title Style Controls Start
$this->start_controls_section('slider_title_style', [
    'label' => __('Title Style', 'appto-extension'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
]);

$this->add_control(
    'title_color',
    [
        'label' => __('Text Color', 'appto-extension'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#fefefe',
        'selectors' => [
            '{{WRAPPER}} .slide_title' => 'color: {{VALUE}};',
        ]
    ]
);

$this->end_controls_section();
//Title Style Controls End


//Subtitle Style Controls Start
$this->start_controls_section('slider_subtitle_style', [
    'label' => __('Subtitle Style', 'appto-extension'),
    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
]);

$this->add_control(
    'subtitle_color',
    [
        'label' => __('Text Color', 'appto-extension'),
        'type' => \Elementor\Controls_Manager::COLOR,
        'default' => '#fefefe',
        'selectors' => [
            '{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
        ]
    ]
);

$this->end_controls_section();
//Subtitle Style Controls End