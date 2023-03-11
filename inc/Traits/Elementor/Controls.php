<?php

namespace Inc\Traits\Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

trait Controls
{
    /**
     * Require control files
     */
    public function require_control_files($dir)
    {
        $content_controls = array();
        $style_controls = array();

        if (!empty(realpath($dir . '/controls/content-controls'))) {
            $content_controls = array_diff(scandir($dir . '/controls/content-controls'), array('.', '..'));
        }

        if (!empty(realpath($dir . '/controls/style-controls'))) {
            $style_controls = array_diff(scandir($dir . '/controls/style-controls'), array('.', '..'));
        }

        if (!empty($content_controls)) {
            foreach ($content_controls as $key => $file) {
                require_once $dir . '/controls/content-controls/' . $file;
            }
        }

        if (!empty($style_controls)) {
            foreach ($style_controls as $key => $file) {
                require_once $dir . '/controls/style-controls/' . $file;
            }
        }
    }

    /**
     * Color & Typography Controls
     */
    public function color_typography_controls(array $args)
    {
        $defaults = array(
            'id' => '',
            'selectors' => array(),
            'disable_controls' => array()
        );

        $args = wp_parse_args($args, $defaults);

        extract($args);

        $color_selectors = array();
        $align_selectors = array();

        foreach ($selectors as $key => $selector) {
            $color_selectors[$selector] = 'color: {{VALUE}};';
            $align_selectors[$selector] = 'text-align: {{VALUE}};';
        }

        // Color
        $this->add_control(
            'appto_' . $id . '_color',
            [
                'label' => __('Text Color', 'appto'),
                'type' => Controls_Manager::COLOR,
                'size_units' => ['px', '%', 'em'],
                'selectors' => $color_selectors,
            ]
        );

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'appto_' . $id . '_typography',
                'selector' => $selectors[0],
            ]
        );

        // Alignment
        if (!in_array('alignment', $disable_controls)) {
            $this->add_control(
                'appto_' . $id . '_alignment',
                [
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'label' => esc_html__('Alignment', 'appto'),
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'appto'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'appto'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'appto'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'selectors' => $align_selectors,
                ]
            );
        }
    }

    /**
     * CSS Box Style controls
     */
    public function box_controls(array $args)
    {
        $defaults = array(
            'id' => '',
            'selectors' => array(),
            'disable_controls' => array(),
            'default_values' => [
                'bg' => '#fff',
                'border_color' =>  '#eee'
            ]
        );

        $args = wp_parse_args($args, $defaults);

        // echo '<pre>';
        // print_r($args);
        // echo '</pre>';

        // if ($args['id'] == 'product_popup_title') {
        //     die();
        // }

        extract($args);

        $bg_selectors = array();
        $padding_selectors = array();
        $margin_selectors = array();
        $b_radius_selectors = array();

        foreach ($selectors as $key => $selector) {
            $bg_selectors[$selector] = 'background-color: {{VALUE}};';

            $padding_selectors[$selector] = 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};';

            $margin_selectors[$selector] = 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};';

            $b_radius_selectors[$selector] = 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};';
        }

        // Background Color
        $this->add_control(
            'appto_' . $id . '_bg_color',
            [
                'label' => esc_html__('Background Color', 'appto'),
                'type' => Controls_Manager::COLOR,
                'default' => $default_values['bg'],
                'selectors' => $bg_selectors,
            ]
        );

        // Padding
        if (!in_array('padding', $disable_controls)) {
            $this->add_responsive_control(
                'appto_' . $id . '_padding',
                [
                    'label' => __('Padding', 'appto'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'rem', 'em'],
                    'selectors' => $padding_selectors,
                ]
            );
        }

        // Margin
        if (!in_array('margin', $disable_controls)) {
            $this->add_responsive_control(
                'appto_' . $id . '_margin',
                [
                    'label' => __('Margin', 'appto'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'rem', 'em'],
                    'selectors' => $margin_selectors,
                ]
            );
        }

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'appto_' . $id . '_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => false,
                        ],
                    ],
                    'color' => [
                        'default' => $default_values['border_color'],
                    ],
                ],
                'selector' => $selectors[0]
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'appto_' . $id . '_border_radius',
            [
                'label' => __('Border Radius', 'appto'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem', 'em'],
                'selectors' => $b_radius_selectors,
            ]
        );
    }

    /**
     * --------------------------------
     * Size Controls
     * --------------------------------
     */
    public function size_controls($args)
    {
        $defaults = array(
            'id' => '',
            'selectors' => array(),
            'disable_controls' => array(),
            'width_default' => [
                'unit' => '%',
                'size' => 100,
            ],
            'height_default' => [
                'unit' => '%',
                'size' => 100,
            ]
        );

        $args = wp_parse_args($args, $defaults);

        extract($args);

        $width_selectors = array();
        $height_selectors = array();
        $maxWidth_selectors = array();
        $maxHeight_selectors = array();

        foreach ($selectors as $key => $selector) {
            $width_selectors[$selector] = 'width:  {{SIZE}}{{UNIT}};';

            $maxWidth_selectors[$selector] = 'max-width:  {{SIZE}}{{UNIT}};';

            $height_selectors[$selector] = 'height: {{SIZE}}{{UNIT}};';

            $maxHeight_selectors[$selector] = 'max-height: {{SIZE}}{{UNIT}};';
        }

        // Width
        $this->add_control(
            'appto_' . $id . '_width',
            [
                'label' => esc_html__('Width', 'appto'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => $width_default,
                'selectors' => $width_selectors,
            ]
        );

        // Height
        if (!in_array('height', $disable_controls)) {
            $this->add_control(
                'appto_' . $id . '_height',
                [
                    'label' => esc_html__('Height', 'appto'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 0,
                            'max' => 100,
                        ]
                    ],
                    'default' => $height_default,
                    'selectors' => $height_selectors,
                ]
            );
        }

        // Max Width
        if (!in_array('max-width', $disable_controls)) {
            $this->add_control(
                'appto_' . $id . '_max_width',
                [
                    'label' => esc_html__('Max Width', 'appto'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vw'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'vw' => [
                            'min' => 0,
                            'max' => 100,
                        ]
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors' => $maxWidth_selectors,
                ]
            );
        }

        // Max Height
        if (!in_array('max-height', $disable_controls)) {
            $this->add_control(
                'appto_' . $id . '_max_height',
                [
                    'label' => esc_html__('Max Height', 'appto'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'vh'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        'vh' => [
                            'min' => 0,
                            'max' => 100,
                        ]
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 100,
                    ],
                    'selectors' => $maxHeight_selectors,
                ]
            );
        }
    }


    /**
     * --------------------------------
     * Position Controls
     * --------------------------------
     */
    public function position_controls(array $args)
    {
        $defaults = array(
            'id' => '',
            'selectors' => array(),
            'disable_controls' => array()
        );

        $args = wp_parse_args($args, $defaults);

        extract($args);

        $top_selectors = array();
        $left_selectors = array();

        foreach ($selectors as $key => $selector) {
            $top_selectors[$selector] = 'top:  {{SIZE}}{{UNIT}};';

            $left_selectors[$selector] = 'left: {{SIZE}}{{UNIT}};';
        }

        $this->add_control(
            'appto_' . $id . '_top',
            [
                'label' => esc_html__('Vertical Offset', 'appto'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => $top_selectors,
            ]
        );

        $this->add_control(
            'appto_' . $id . '_left',
            [
                'label' => esc_html__('Horizontal Offset', 'appto'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 90,
                ],
                'selectors' => $left_selectors,
            ]
        );
    }
}
