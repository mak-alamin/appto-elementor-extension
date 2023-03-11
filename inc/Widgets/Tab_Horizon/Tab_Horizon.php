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
		return __('Tab Horizon', 'appto-extension');
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
		<div class="tab tab-horizon col-sm-6">
			<div class="tab-menu text-center">
				<ul class="tab-list nav nav-tabs">
					<?php
					foreach ($tabs as $key => $tab) {
						$active = ($key == 0) ? ' active' : '';

						$id = $tab['_id'];

						$icon_class = $tab['icon']['value'];

						echo "<li class='owl-dot $active'>";

						echo "<a href='#tab_horizon_$id' data-toggle='tab'>
							<div class='icon icon-sm'>
								<span class='$icon_class'></span>
							</div>";

						echo $tab['tab_label'];
						echo "</a></li>";
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
				<img alt="" src="http://localhost/appto/appto-main/wp-content/uploads/2023/03/phone.png">
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
<?php

		if (is_admin()) {
			// solves the width issue
			if (!defined('ELEMENTOR_VERSION')) {
				return;
			}
			echo "<script>jQuery('.owl-carousel').owlCarousel();</script>";
		}
	}
}
