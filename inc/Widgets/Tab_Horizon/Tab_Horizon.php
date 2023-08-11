<?php

/**
 * Class Tab_Horizon
 */

namespace Inc\Widgets\Tab_Horizon;

class Tab_Horizon extends \Elementor\Widget_Base
{
	use \Inc\Traits\Elementor\Controls;

	public function get_name(): string
	{
		return 'tab_horizon';
	}

	public function get_title()
	{
		return __('Tab Slider', 'appto-extension');
	}

	public function get_icon(): string
	{
		return 'eicon-tabs';
	}

	public function get_categories(): array
	{
		return ['appto-widgets'];
	}

	public function get_keywords()
	{
		return [
			'appto',
			'appto tab',
			'appto slider',
			'tab',
			'slider',
			'tab slider',
			'tabs',
			'tab slide',
		];
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
		$tabs = $this->get_settings_for_display()['horizon_tabs'];
		$phone_image = $this->get_settings_for_display()['phone_bg_image'];
?>
		<div class="tab tab-horizon col-sm-6">
			<div class="tab-menu text-center">
				<ul class="tab-list nav nav-tabs">
					<?php
					foreach ($tabs as $key => $tab) {
						$active = ($key == 0) ? ' active' : '';

						$id = $tab['_id'];

						$icon_class = $tab['icon']['value'];

						echo "<li class='owl-dot $active' data-id='tab_horizon_$id'>";

						echo "<div class='icon icon-sm'>
								<span class='$icon_class'></span>
							</div>";

						echo $tab['tab_label'];
						echo "</li>";
					}
					?>
				</ul>
			</div>

			<div class="spce"></div>

			<div class="tab-content">
				<!-- flight section -->
				<?php
				foreach ($tabs as $key => $tab) {
					$active = ($key == 0) ? ' active' : '';
				?>
					<div class="tab-pane fade in <?php echo $active; ?>" id="<?php echo 'tab_horizon_' . $tab['_id']; ?>">
						<div>
							<div class="spce"></div>

							<h4><?php echo $tab['title']; ?></h4>

							<div class="spce"></div>

							<?php echo $tab['description']; ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="col-sm-6 col-md-4 col-md-offset-2 col-sm-offset-0 text-center">
			<div class="slide-side">
				<?php if (!empty($phone_image['url'])) {
					$imageUrl = $phone_image['url'];
					$imageAlt = $phone_image['alt'];

					echo "<img alt='$imageAlt' src='$imageUrl'>";
				}

				?>
				<div class="owl-carousel nplr app-slide">
					<?php
					foreach ($tabs as $key => $tab) {
						$active = ($key == 0) ? ' active' : '';
					?>
						<div <?php echo $active; ?>>
							<img alt="<?php echo $tab['phone_screen']['alt']; ?>" src="<?php echo $tab['phone_screen']['url']; ?>">
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

		<script>
			var $appSlide = jQuery('.app-slide')
			if ($appSlide.length > 0) {
				$appSlide.owlCarousel({
					loop: true,
					center: true,
					margin: 0,
					autoWidth: true,
					nav: false,
					dots: true,
					ouchDrag: false,
					mouseDrag: false,
					dotsContainer: '.tab-list'
				})

				jQuery('.owl-dot').on('click', function() {
					$appSlide.trigger('to.owl.carousel', [jQuery(this).index(), 300]);

					jQuery(".tab-horizon .tab-content .tab-pane").removeClass("active");

					var currentTab = '#' + jQuery(this).data("id");

					jQuery(currentTab).addClass("active");
				});
			}
		</script>
<?php
	}
}
