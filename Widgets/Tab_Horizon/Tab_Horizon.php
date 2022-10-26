<?php
/**
 * Class Tab_Horizon
 */

class Tab_Horizon extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'how_it_works';
	}

	public function get_title() {
		return __('How It Works', 'appto-extension');
	}

	public function get_icon(): string {
		return 'eicon-tabs';
	}

	public function get_categories(): array {
		return ['appto'];
	}

	protected function render() {
		?>
			<div class="tab tab-horizon col-sm-6">
				<div class="tab-menu text-center">
					<ul class="tab-list nav nav-tabs">
						<li class="owl-dot active">
							<a href="#lA" data-toggle="tab">
								<div class="icon icon-sm">
									<span class="ti-lock"></span>
								</div>
								Log In
							</a>
						</li>
						<li class="owl-dot">
							<a href="#lB" data-toggle="tab">
								<div class="icon icon-sm">
									<span class="ti-package"></span>
								</div>Data Analysis
							</a>
						</li>
						<li class="owl-dot">
							<a href="#lC" data-toggle="tab">
								<div class="icon icon-sm">
									<span class="ti-user"></span>
								</div>
								Show Result
							</a>
						</li>
					</ul>
				</div>
				<div class="spce"></div>
				<div class="tab-content">
					<!-- flight section -->
					<div class="tab-pane fade in active" id="lA">
						<div>
							<div class="spce"></div>
							<h4>Log In</h4>
							<div class="spce"></div>
							<p>Full privacy control to make your content public, private or password protected.</p>
							<ul class="list-style">
								<li>Ut enim ad minim veniam quis</li>
								<li>adipiscing elit sed do eiusmod</li>
								<li>minim veniam quis nostrud</li>
								<li>adminim veniam quis</li>
							</ul>
						</div>
					</div>
					<div class="tab-pane fade" id="lB">
						<div>
							<div class="spce"></div>
							<h4>Data Analysis</h4>
							<div class="spce"></div>
							<p>100+ fonts, millions of free images, and thousands of quality icons to beautify your content. Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
							<ul class="list-style">
								<li>Ut enim ad minim veniam quis</li>
								<li>adipiscing elit sed do eiusmod</li>
								<li>minim veniam quis nostrud</li>
							</ul>
						</div>
					</div>
					<div class="tab-pane fade" id="lC">
						<div>
							<div class="spce"></div>
							<h4>Show Result</h4>
							<div class="spce"></div>
							<p>View and present your content anytime from anywhere on any device.</p>
							<ul class="list-style">
								<li>Ut enim ad minim veniam quis</li>
								<li>adipiscing elit sed do eiusmod</li>
								<li>minim veniam quis nostrud</li>
								<li>adminim veniam quis</li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-6 col-md-4 col-md-offset-2 col-sm-offset-0 text-center">
				<div class="slide-side">
					<img alt="" src="http://localhost:8080/appto_theme_dev/wp-content/uploads/2021/07/phone.png">
					<div class="owl-carousel nplr app-slide">
						<div>
							<img alt="Screen 1" src="http://localhost:8080/appto_theme_dev/wp-content/uploads/2021/07/img-a.png">
						</div>
						<div>
							<img alt="Screen 2" src="http://localhost:8080/appto_theme_dev/wp-content/uploads/2021/07/screenshot-img-2.jpg">
						</div>
						<div>
							<img alt="Screen 3" src="http://localhost:8080/appto_theme_dev/wp-content/uploads/2021/07/screen3.jpg">
						</div>
					</div>
				</div>
			</div>
		<?php
	}
}