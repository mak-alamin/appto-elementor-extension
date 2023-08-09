<?php

/**
 * Class Testimonial
 */

namespace Inc\Widgets\Testimonial;

class Testimonial extends \Elementor\Widget_Base
{
    use \Inc\Traits\Elementor\Controls;

    public function get_name(): string
    {
        return 'appto_testimonial';
    }

    public function get_title()
    {
        return __('AppTo Testimonial', 'appto-extension');
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
        return [];
    }

    protected function render()
    {
        $tabs = $this->get_settings_for_display()['testimonials'];

        // echo '<pre>';
        // print_r($tabs);
        // echo '</pre>';
        // die();
?>
        <div class="owl-carousel quote">
            <div class="quote-wrapper">
                <p class="quote-text">Lorem ipsum dolor sit amet, eu debet utinam vim. Idque accusam ea sit repudiandae id. Quo ex alia natum tritani, dolorum persequeris.</p>
                <div class="spce"></div>
                <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/profile-img-3.jpg">
                <div class="light">
                    <h6>Roger Bentham</h6>
                    <p class="meta">Author, Magento</p>
                </div>
            </div>
            <div class="quote-wrapper">
                <p class="quote-text">Lorem ipsum dolor sit amet, eu debet utinam vim. Idque accusam ea sit repudiandae id. Quo ex alia natum tritani, dolorum persequeris.</p>
                <div class="spce"></div>
                <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/profile-img-3.jpg">
                <div class="light">
                    <h6>Roger Bentham</h6>
                    <p class="meta">Author, Magento</p>
                </div>
            </div>
            <div class="quote-wrapper">
                <p class="quote-text">Lorem ipsum dolor sit amet, eu debet utinam vim. Idque accusam ea sit repudiandae id. Quo ex alia natum tritani, dolorum persequeris.</p>
                <div class="spce"></div>
                <img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/profile-img-3.jpg">
                <div class="light">
                    <h6>Paulo Mark</h6>
                    <p class="meta">CEO, It Founadtion</p>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <script>
            var quoteCarousel = jQuery('.quote');
            if (quoteCarousel.length > 0) {
                quoteCarousel.owlCarousel({
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 2500,
                    margin: 10,
                    nav: false,
                    responsive: {
                        300: {
                            items: 1,
                        },
                        768: {
                            items: 2,
                        }
                    }
                })
            }
        </script>
<?php
    }
}
