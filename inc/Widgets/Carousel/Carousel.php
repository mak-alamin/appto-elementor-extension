<?php

/**
 * Class Carousel
 */

namespace Inc\Widgets\Carousel;

class Carousel extends \Elementor\Widget_Base
{
    use \Inc\Traits\Elementor\Controls;

    public function get_name(): string
    {
        return 'appto_carousel';
    }

    public function get_title()
    {
        return __('AppTo Carousel', 'appto-extension');
    }

    public function get_icon(): string
    {
        return 'eicon-tabs';
    }

    public function get_categories(): array
    {
        return ['appto-widgets'];
    }

    protected function _register_controls()
    {
        $this->require_control_files(__DIR__);
    }

    public function get_script_depends()
    {
        return [
            'bundle-js',
            'twinlight-js',
            'wavify-jquery',
            'main-js'
        ];
    }

    protected function render()
    {
        $tabs = $this->get_settings_for_display()['horizon_tabs'];

        // echo '<pre>';
        // print_r($tabs);
        // echo '</pre>';
        // die();

?>
        <div class="screenshot carousel slide carousel-fade">
            <div class="owl-carousel screen nplr screen-loop">
                <div>
                    <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/screen3.jpg">
                </div>
                <div>
                    <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/screenshot-img-1.jpg">
                </div>
                <div>
                    <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/screenshot-img-1.jpg">
                </div>
                <div>
                    <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/screen3.jpg">
                </div>
                <div>
                    <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/screenshot-img-1.jpg">
                </div>
                <div>
                    <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/screenshot-img-1.jpg">
                </div>
            </div>
        </div>
<?php
    }
}
