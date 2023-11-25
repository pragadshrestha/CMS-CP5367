<?php
/**
 * Getting started template
 */
?>
<div id="getting_started" class="jcub-tab-pane active">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1 class="jcub-info-title text-center"><?php echo esc_html__('About the jcub theme', 'jcub'); ?></h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="jcub-tab-pane-half jcub-tab-pane-first-half">
				<p><?php esc_html_e('This theme is ideal for creating corporate and business websites. There is no separate premium version of it, as jcub is a child theme of the Quality WordPress theme. The premium version, Quality PRO has tons of features: the Homepage has a number of sections where you can feature unlimited sliders, your portfolios, user reviews, latest news, services, calls to action and much more. Each section in the HomePage template is carefully designed to fit to all business requirements.', 'jcub');?></p>
				<p>
				<?php esc_html_e('You can use this theme for any type of activity.', 'jcub'); ?>
				</p>
				<h1 style="margin-top: 73px;"><?php esc_html_e("Getting Started", 'jcub'); ?></h1>
				<div style="border-top: 1px solid #eaeaea;">
				<p style="margin-top: 16px;">

				<?php esc_html_e('Install and activate the jcubweb Companion plugin to take full advantage of all the features.', 'jcub'); ?>
				</p>
				<p><a target="_blank" href="<?php echo esc_url(admin_url('customize.php')); ?>" class="button button-primary"><?php esc_html_e('Go to the Customizer', 'jcub');?></a></p>
				</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="jcub-tab-pane-half jcub-tab-pane-first-half">
				<img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/admin/img/jcub.png'); ?>" alt="<?php echo esc_attr('Quality Theme', 'jcub'); ?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="jcub-tab-center">
				<h1><?php esc_html_e("Useful Links", 'jcub'); ?></h1>
			</div>
			<div class="col-md-6">
				<div class="jcub-tab-pane-half jcub-tab-pane-first-half">
					<a href="<?php echo esc_url('https://jcub1.jcubweb.com/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-desktop info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Lite Demo', 'jcub'); ?></p></a>
					<a href="<?php echo esc_url('https://demo.jcubweb.com/?theme=Quality%20Pro'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div>
					<p class="info-text"><?php echo esc_html__('PRO Demo', 'jcub'); ?></p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="jcub-tab-pane-half jcub-tab-pane-first-half">
					<a href="<?php echo esc_url('https://wordpress.org/support/view/theme-reviews/jcub'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-smiley info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Your feedback is valuable to us', 'jcub'); ?></p></a>
					<a href="<?php echo esc_url('https://jcubweb.com/support/categories/quality?p=categories/quality'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-sos info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Premium Theme Support', 'jcub'); ?></p></a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="jcub-tab-pane-half jcub-tab-pane-first-half">
					<a href="<?php echo esc_url('https://jcubweb.com/quality/'); ?>" target="_blank"  class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div>
					<p class="info-text"><?php echo esc_html__('Premium Theme Details', 'jcub'); ?></p></a>
				</div>
			</div>
		</div>
	</div>
</div>