<?php

/**
 * Class Banner_Slider
 */

namespace Inc\Widgets\Banner_Slider;

class Banner_Slider extends \Elementor\Widget_Base
{
	use \Inc\Traits\Elementor\Controls;

	private $anim_file = '';
	private $bg_grdnt = 'blue'; //grdnt-blue 
	private $bg_style = 'wave'; //wave, wave-zig

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
		$settings = $this->get_settings_for_display();

		$this->bg_grdnt = $settings['appto_banner_slider_bg_gradient'];
		$this->bg_style = $settings['appto_banner_slider_bg_style'];

		if ($this->bg_style == 'wave-zig') {
			$this->anim_file = APPTO_ELE_EXT_ASSET_DIR . '/animations/wave-zig.php';
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

							<?php
							foreach ($settings['slides'] as $index => $item) :
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

						<?php if (count($settings['slides']) > 1) { ?>
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
						<?php } ?>

					</div>
				</div>
			</div>
		</div>
		<!-- End Banner -->
	<?php
	}

	protected function _content_template()
	{
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
