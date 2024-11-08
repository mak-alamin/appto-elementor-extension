<?php
// Tabs
$this->start_controls_section(
    'image_carousel_content',
    [
        'label' => __('Images', 'appto-extension'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

$this->add_control(
    'image_carousel_gallery',
    [
        'label' => esc_html__( 'Add Images', 'appto-extension' ),
        'type' => \Elementor\Controls_Manager::GALLERY,
        'show_label' => false,
        'default' => [],
    ]
);

$this->end_controls_section();