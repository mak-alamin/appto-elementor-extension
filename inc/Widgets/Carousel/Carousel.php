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
        return __('Image Carousel', 'appto-extension');
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
        $images = $this->get_settings_for_display()['image_carousel_gallery'];

		$widget_id = 'appto-ele-widget-' . $this->get_id();
?>
        <div id="<?php echo $widget_id; ?>" class="screenshot carousel slide carousel-fade">
            <div class="owl-carousel screen nplr screen-loop">
                <?php
                if (!empty($images)) {
                    foreach ($images as $key => $image) {
                ?>
                        <div>
                            <img alt="" src="<?php echo $image['url']; ?>">
                        </div>
                <?php  }
                } ?>
            </div>
        </div>

        <script>
            jQuery(document).ready(function() {
                var $screenLoop = jQuery('#<?php echo $widget_id; ?> .screen-loop')
                if ($screenLoop.length > 0) {
                    $screenLoop.owlCarousel({
                        center: true,
                        loop: true,
                        nav: false,
                        autoplay: true,
                        autoplayTimeout: 2000,
                        margin: 25,
                        responsive: {
                            320: {
                                items: 1,
                                margin: 10
                            },
                            481: {
                                items: 3,
                                margin: 60
                            },
                            991: {
                                items: 4
                            }
                        }
                    });
                }
            });
        </script>
<?php
    }
}
