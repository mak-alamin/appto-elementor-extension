<?php

//Content Controls Section Starts
$this->start_controls_section(
    'slider_content',
    [
        'label' => __('Slider Content', 'appto-extension'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

//Banner Slider unique id
$this->add_control(
    'slider_id',
    [
        'label' => __('Slider ID', 'appto-extension'),
        'type' => \Elementor\Controls_Manager::TEXT,
        'placeholder' => __('Give a unique id for this slider', 'appto-extension'),
        'label_block' => true,
        'separator' => 'after'
    ]
);

//Slide Items
$this->add_control(
    'slides',
    [
        'label' => __('Slides', 'appto-extension'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => [
            [
                'name' => 'title',
                'label' => __('<b>Title</b>', 'appto-extension'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Your Title Here', 'appto-extension'),
                'label_block' => true,
                'default' => __('List Item', 'appto-extension'),
            ],

            [
                'name' => 'subtitle',
                'label' => __('Subtitle', 'appto-extension'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Your subtitle here', 'appto-extension'),
            ],

            [
                'name' => 'button_1',
                'label' => __('Button 1', 'appto-extension'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Your Button Text', 'appto-extension'),
            ],

            [
                'name' => 'button_2',
                'label' => __('Button 2', 'appto-extension'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Your Button Text', 'appto-extension'),
            ],

            [
                'name'	=> 'image',
                'type' 	=> \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        ],
        'default' => [
            [
                'title' => __('Buy AppTo for showcase your app', 'appto-extension'),
                'subtitle' => 'Your subtitle here',
                'button_1' => 'Get App Now',
                'button_2' => 'Discover More'
            ],
            [
                'title' => __('Best Theme for App Landing', 'appto-extension'),
                'subtitle' => 'Your subtitle 2 here',
                'button_1' => 'Get App Now',
                'button_2' => 'Discover More'
            ],
            [
                'title' => __('Best Theme for App Landing', 'appto-extension'),
                'subtitle' => 'Your subtitle 3 here',
                'button_1' => 'Get App Now',
                'button_2' => 'Discover More'
            ],
        ],
    ]
);

$this->end_controls_section();
//Content Controls Section Ends