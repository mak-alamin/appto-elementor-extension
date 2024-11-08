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
        return ['jquery', 'owl-carousel-js'];
    }

    protected function render()
    {
        $testimonials = $this->get_settings_for_display()['appto_testimonials'];

        $widget_id = 'appto-ele-widget-' . $this->get_id();
?>
        <div id="<?php echo $widget_id; ?>" class="owl-carousel quote">
            <?php foreach ($testimonials as $key => $testimonial) { ?>
                <div class="quote-wrapper">
                    <div class="quote-text"><?php echo $testimonial['content']; ?></div>

                    <div class="spce"></div>

                    <?php
                    if (!empty($testimonial['image']['url'])) {
                        $imgUrl = $testimonial['image']['url'];
                        $imgAlt = $testimonial['image']['alt'];

                        echo '<img alt="' . $imgAlt . '" src="' . $imgUrl . '">';
                    }
                    ?>

                    <div class="light">
                        <h6><?php echo $testimonial['client_name']; ?></h6>
                        <p class="meta"><?php echo $testimonial['title']; ?></p>
                    </div>
                </div>
            <?php } ?>

        </div>

        <script>
            jQuery(document).ready(function() {

                var quoteCarousel = jQuery('#<?php echo $widget_id; ?>.quote');
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
            });
        </script>
<?php
    }
}
