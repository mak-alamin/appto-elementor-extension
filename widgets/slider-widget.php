<?php

/**
 * Class Slider_Widget
 */

class Slider_Widget extends \Elementor\Widget_Base
{

	private $anim_file = '';
	private $bg_grdnt = 'grdnt-blue'; //grdnt-blue style-wave
	private $bg_style = 'wave-zig';

	public function get_name(): string
	{
		return 'banner_slider';
	}

	public function get_title()
	{
		return __('Banner Slider', 'appto-extension');
	}

	public function get_icon(): string
	{
		return 'eicon-slides';
	}

	public function get_categories(): array
	{
		return ['appto'];
	}

	protected function _register_controls()
	{

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
				'label' => __('Slider ID', 'appto'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __('Give a unique id for this slider', 'appto'),
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
						'label' => __('<b>Title</b>', 'appto'),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __('Your Title Here', 'appto'),
						'label_block' => true,
						'default' => __('List Item', 'appto'),
					],

					[
						'name' => 'subtitle',
						'label' => __('Subtitle', 'appto'),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'placeholder' => __('Your subtitle here', 'appto'),
					],

					[
						'name' => 'button_1',
						'label' => __('Button 1', 'appto'),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __('Your Button Text', 'appto'),
					],

					[
						'name' => 'button_2',
						'label' => __('Button 2', 'appto'),
						'type' => \Elementor\Controls_Manager::TEXT,
						'placeholder' => __('Your Button Text', 'appto'),
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
						'title' => __('Buy AppTo for showcase your app', 'appto'),
						'subtitle' => 'Your subtitle here',
						'button_1' => 'Get App Now',
						'button_2' => 'Discover More'
					],
					[
						'title' => __('Best Theme for App Landing', 'appto'),
						'subtitle' => 'Your subtitle 2 here',
						'button_1' => 'Get App Now',
						'button_2' => 'Discover More'
					],
					[
						'title' => __('Best Theme for App Landing', 'appto'),
						'subtitle' => 'Your subtitle 3 here',
						'button_1' => 'Get App Now',
						'button_2' => 'Discover More'
					],
				],
			]
		);

		$this->end_controls_section();
		//Content Controls Section Ends


		//Title Style Controls Start
		$this->start_controls_section('title-style', [
			'label' => __('Title Style', 'appto'),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]);

		$this->add_control(
			'title_color',
			[
				'label' => __('Text Color', 'appto'),
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
		$this->start_controls_section('subtitle-style', [
			'label' => __('Subtitle Style', 'appto'),
			'tab' => \Elementor\Controls_Manager::TAB_STYLE,
		]);

		$this->add_control(
			'subtitle_color',
			[
				'label' => __('Text Color', 'appto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fefefe',
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();
		//Subtitle Style Controls End
	}


	protected function render()
	{
		$settings = $this->get_settings_for_display();

		if ($this->bg_style == 'wave-zig') {
			$this->anim_file = dirname(__DIR__) . '/assets/animations/wave-zig.php';
		}

		$slider_id = (!empty($settings['slider_id'])) ? $settings['slider_id'] : '';
?>

		<!-- banner -->
		<div class="hero grdnt-<?php echo $this->bg_grdnt . ' style-' . $this->bg_style; ?>">

			<?php
			if (file_exists($this->anim_file)) {
				include $this->anim_file;
			}
			?>

			<div id="<?php echo $slider_id; ?>" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
				<div class="container h-100">
					<div class="row hero-content h-100">
						<div class="carousel-inner">

							<?php foreach ($settings['slides'] as $index => $item) :
								// echo '<pre>';
								// print_r($item);
								$active = ($index == 0) ? 'active' : '';
							?>
								<!-- item -->
								<div class="item <?php echo $active; ?>">
									<div class="flx-container align-flx-center active clearfix">
										<div class="col-sm-6 fade-up">
											<div class="intro-text light fade-up">
												<h1 class="fw-700 slide_title"><?php echo $item['title']; ?>
												</h1>
												<div class="spce"></div>
												<p class="subtitle"><?php echo $item['subtitle']; ?>
												</p>
												<div class="btn-holder">
													<a class="btn grdnt-green" href="#"><?php echo $item['button_1']; ?></a>
													<a class="btn grdnt-orange" href="#"><?php echo $item['button_2']; ?></a>
												</div>
											</div>
										</div>
										<div class="img-pre col-sm-6 text-right">
											<img class="fade-left" alt="" src="<?php echo $item['image']['url']; ?>">
										</div>
									</div>
								</div>
							<?php endforeach; ?>

						</div> <!-- /carousel-inner -->

						<div class="cntrl-wrapper">
							<!-- Left and right controls -->
							<a class="left carousel-control" href="#<?php echo $slider_id; ?>" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#<?php echo $slider_id; ?>" data-slide="next">
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

	protected function _content_template()
	{
		if ($this->bg_style == 'wave-zig') {
			$this->anim_file = dirname(__DIR__) . '/assets/animations/wave-zig.php';
		}
	?>
		<!-- banner -->
		<div class="hero grdnt-<?php echo $this->bg_grdnt . ' style-' . $this->bg_style; ?>">

			<?php
			if (file_exists($this->anim_file)) {
				include $this->anim_file;
			}
			?>

			<div id="{{{ settings.slider_id }}}" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
				<div class="container h-100">
					<div class="row hero-content h-100">
						<div class="carousel-inner">
							<# if ( settings.slides ) { _.each(settings.slides, function(item, index){ var active=(index==0) ? 'active' : '' ; #>
								<!-- item -->
								<div class="item {{{ active }}}">
									<div class="flx-container align-flx-center active clearfix">
										<div class="col-sm-6 fade-up">
											<div class="intro-text light fade-up">
												<h1 class="fw-700 slide_title">{{{ item.title }}}
												</h1>
												<div class="spce"></div>
												<p class="subtitle">{{{ item.subtitle }}}
												</p>
												<div class="btn-holder">
													<a class="btn grdnt-green" href="#">{{{ item.button_1 }}}</a>
													<a class="btn grdnt-orange" href="#">{{{ item.button_2 }}}</a>
												</div>
											</div>
										</div>
										<div class="img-pre col-sm-6 text-right">
											<img class="fade-left" alt="" src="#">
										</div>
									</div>
								</div>
								<# }); } #>

						</div> <!-- /carousel-inner -->

						<div class="cntrl-wrapper">
							<!-- Left and right controls -->
							<a class="left carousel-control" href="#{{{ settings.slider_id }}}" data-slide="prev">
								<span class="glyphicon glyphicon-chevron-left"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="right carousel-control" href="#{{{ settings.slider_id }}}" data-slide="next">
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
