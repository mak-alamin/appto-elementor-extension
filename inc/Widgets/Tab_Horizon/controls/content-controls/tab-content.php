<?php

//Content Controls Section Starts
$this->start_controls_section(
    'tab_horizon_content',
    [
        'label' => __('Tabs', 'appto-extension'),
        'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]
);

//Tab Items
$this->add_control(
    'horizon_tabs',
    [
        'label' => __('Tab Items', 'appto-extension'),
        'type' => \Elementor\Controls_Manager::REPEATER,
        'fields' => [
            [
                'name' => 'tab_label',
                'label' => __('<b>Tab Label</b>', 'appto-extension'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Tab Label Here', 'appto-extension'),
                'label_block' => true,
                'default' => __('Tab Item', 'appto-extension'),
            ],
            [
                'name'    => 'icon',
                'label' => __('Icon', 'appto-extension'),
                'type'     => \Elementor\Controls_Manager::ICONS,
            ],
            [
                'name' => 'title',
                'label' => __('Title', 'appto-extension'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Type Title here', 'appto-extension'),
            ],
            [
                'name' => 'description',
                'label' => __('Description', 'appto-extension'),
                'type' => \Elementor\Controls_Manager::WYSIWYG, // WYSIWYG
                'placeholder' => __('Tab Content here', 'appto-extension'),
            ],
            [
                'name'    => 'phone_screen',
                'label' => __('Phone Screen', 'appto-extension'),
                'type'     => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        ],
        'default' => [
            [
                'tab_label' => __('Log In', 'appto-extension'),
                'icon' => [
                    'value' => 'fas fa-lock',
                ],
                'title' => 'Login',
                'description' => 'Login Content',
            ],
            [
                'tab_label' => __('Data Analysis', 'appto-extension'),
                'icon' => [
                    'value' => 'fab fa-searchengin',
                ],
                'title' => 'Data Analysis',
                'description' => 'Data Analysis Content',
            ],
            [
                'tab_label' => __('Show Result', 'appto-extension'),
                'icon' => [
                    'value' => 'fas fa-user',
                ],
                'title' => 'Show Result',
                'description' => 'Show Result Content',
            ],
        ],
    ]
);

$this->end_controls_section();
//Content Controls Section Ends