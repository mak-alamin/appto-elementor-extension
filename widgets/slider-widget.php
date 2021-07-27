<?php
/**
 * Class Slider_Widget
 */

class Slider_Widget extends \Elementor\Widget_Base{

	public function get_name(): string {
        return 'banner_slider';
    }

	public function get_title() {
        return __('Banner Slider', 'appto-extension');
    }

	public function get_icon(): string {
        return 'eicon-slides';
    }

	public function get_categories(): array {
        return ['appto'];
    }

    protected function _register_controls() {
       
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'appto-extension' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'slides',
			[
				'label' => __( 'Slides', 'appto-extension' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'title',
						'label' => __( '<b>Title</b>', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __( 'Your Title Here', 'plugin-name' ),
                        'label_block' => true,
						'default' => __( 'List Item', 'plugin-name' ),
					],
					[
						'name' => 'subtitle',
						'label' => __( 'Subtitle', 'plugin-name' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'placeholder' => __( 'Your subtitle here', 'plugin-name' ),
					],
				],
                'default' => [
					[
						'title' => __( 'Buy AppTo for showcase your app', 'plugin-name' ),
						'subtitle' => 'Your subtitle here',
					],
					[
						'title' => __( 'Best Theme for App Landing', 'plugin-name' ),
						'subtitle' => 'Your subtitle here',
					],
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
		$settings = $this->get_settings_for_display();
		$bg_grdnt = 'grdnt-blue'; //grdnt-blue style-wave
		$bg_style = 'wave-zig';
		?>

		<!-- banner -->
		<div id="home" class="hero grdnt-<?php echo $bg_grdnt . ' style-' . $bg_style; ?>">	
			<?php 
				if($bg_style == 'wave-zig'){
					if(file_exists(dirname(__DIR__) . '/assets/animations/wave-zig.php')){
						include_once dirname(__DIR__) . '/assets/animations/wave-zig.php';
					}
				}
			?>
			
			<div id="banner-carousel" class="carousel slide carousel-fade" data-ride="carousel"  data-interval="5000">
				<div class="container h-100">
					<div class="row hero-content h-100">
						<div class="carousel-inner">

						<?php foreach ( $settings['slides'] as $index => $item ) : 
							// echo '<pre>';
							// print_r($item);
							$active = ($index == 0) ? 'active' : '';
						?>
							<!-- item -->
							<div class="item <?php echo $active; ?>">
								<div class="flx-container align-flx-center active clearfix">
									<div class="col-sm-6 fade-up">
										<div class="intro-text light fade-up">
											<h1 class="fw-700"><?php echo $item['title'] ; ?>
											</h1>
											<div class="spce"></div>
											<p><?php echo $item['subtitle'] ; ?>
											</p>
											<div class="btn-holder">
												<a class="btn grdnt-green" href="#">Get App Now</a>
												<a class="btn grdnt-orange" href="#">Discover More</a>
											</div>
										</div>
									</div>
									<div class="img-pre col-sm-6 text-right">
										<img class="fade-left" alt="" src="image/img-c.png">
									</div>
								</div>
							</div>

						<?php endforeach; ?>
					
						</div> <!-- /carousel-inner -->

						<div class="cntrl-wrapper">
					 		<!-- Left and right controls -->
							<a class="left carousel-control" href="#banner-carousel" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#banner-carousel" data-slide="next">
								<span class="glyphicon glyphicon-chevron-right"></span>
								<span class="sr-only">Next</span>
							</a>
					    </div>
					</div>
				</div>
			</div>	
		</div>
		<!-- End Banner -->

<?php

	}

	// public function get_script_depends() {}

	// public function get_style_depends() {}
}