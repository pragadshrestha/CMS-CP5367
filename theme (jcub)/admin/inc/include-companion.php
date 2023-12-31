<?php

$jcub_hide_install = get_option('jcub_hide_customizer_companion_notice', false);
if (!function_exists('jcubweb_companion') && !$jcub_hide_install) {
	if (class_exists('WP_Customize_Section') && !class_exists('jcub_Companion_Installer_Section')) {
		/**
		 * Recommend the installation of Quality Companion using a custom section.
		 *
		 * @see WP_Customize_Section
		 */
		class jcub_Companion_Installer_Section extends WP_Customize_Section {
			/**
			 * Customize section type.
			 *
			 * @access public
			 * @var string
			 */
			public $type = 'jcub_companion_installer';

			public function __construct($manager, $id, $args = array()) {
				parent::__construct($manager, $id, $args);

				add_action('customize_controls_enqueue_scripts', 'jcub_Companion_Installer_Section::enqueue');
			}

			/**
			 * enqueue styles and scripts
			 *
			 *
			 **/
			public static function enqueue() {
				wp_enqueue_script('plugin-install');
				wp_enqueue_script('updates');
				wp_enqueue_script('jcub-companion-install', get_stylesheet_directory_uri() . '/admin/assets/js/plugin-install.js', array('jquery'));
				wp_localize_script('jcub-companion-install', 'jcub_companion_install',
					array(
						'installing' => esc_html__('Installing', 'jcub'),
						'activating' => esc_html__('Activating', 'jcub'),
						'error'      => esc_html__('Error', 'jcub'),
						'ajax_url'   => esc_url(admin_url('admin-ajax.php')),
					)
				);
			}
			/**
			 * Render the section.
			 *
			 * @access protected
			 */
			protected function render() {
				// Determine if the plugin is not installed, or just inactive.
				$plugins   = get_plugins();
				$installed = false;
				foreach ($plugins as $plugin) {
					if ('jcubweb Companion' === $plugin['Name']) {
						$installed = true;
					}
				}
				$slug = 'jcubweb-companion';
				// Get the plugin-installation URL.
				$classes            = 'cannot-expand accordion-section control-section-companion control-section control-section-themes control-section-' . $this->type;
				?>
				<li id="accordion-section-<?php echo esc_attr($this->id); ?>" class="<?php echo esc_attr($classes); ?>">
					<span class="jcubweb-customizer-notification-dismiss" id="companion-install-dismiss" href="#companion-install-dismiss"> <i class="fa fa-times"></i></span>
					<?php if (!$installed): ?>
					<?php 
						$plugin_install_url = add_query_arg(
							array(
								'action' => 'install-plugin',
								'plugin' => $slug,
							),
							self_admin_url('update.php')
						);
						$plugin_install_url = wp_nonce_url($plugin_install_url, 'install-plugin_jcubweb-companion');
					 ?>
						<p><?php esc_html_e('jcubweb Companion plugin is required to take advantage of this theme\'s features in the customizer.', 'jcub');?></p>
						<a class="jcubweb-plugin-install install-now button-secondary button" data-slug="jcubweb-companion" href="<?php echo esc_url($plugin_install_url); ?>" aria-label="<?php esc_attr_e('Install jcubweb Companion Now', 'jcub');?>" data-name="<?php esc_attr_e('jcubweb Companion', 'jcub'); ?>">
							<?php esc_html_e('Install & Activate', 'jcub');?>
						</a>
					<?php else: ?>
						<?php 
							$plugin_link_suffix = $slug . '/' . $slug . '.php';
							$plugin_activate_link = add_query_arg(
								array(
									'action'        => 'activate',
									'plugin'        => rawurlencode( $plugin_link_suffix ),
									'plugin_status' => 'all',
									'paged'         => '1',
									'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $plugin_link_suffix ),
								), self_admin_url( 'plugins.php' )
							);
						?>
						<p><?php esc_html_e('You have installed jcubweb Companion Plugin. Activate it to take advantage of this theme\'s features in the customizer.', 'jcub');?></p>
						<a class="jcubweb-plugin-activate activate-now button-primary button" data-slug="jcubweb-companion" href="<?php echo esc_url($plugin_activate_link); ?>" aria-label="<?php esc_attr_e('Activate jcubweb Companion now', 'jcub');?>" data-name="<?php esc_attr_e('jcubweb Companion', 'jcub'); ?>">
							<?php esc_html_e('Activate Now', 'jcub');?>
						</a>
					<?php endif;?>
				</li>
				<?php
			}
		}
	}
	if (!function_exists('jcub_companion_installer_register')) {
		/**
		 * Registers the section, setting & control for the jcubweb Companion installer.
		 *
		 * @param object $wp_customize The main customizer object.
		 */
		function jcub_companion_installer_register($wp_customize) {
			$wp_customize->add_section(new jcub_Companion_Installer_Section($wp_customize, 'jcub_companion_installer', array(
				'title'      => '',
				'capability' => 'install_plugins',
				'priority'   => 0,
			)));

		}
		add_action('customize_register', 'jcub_companion_installer_register');
	}
}

function jcub_hide_customizer_companion_notice(){
	update_option('jcub_hide_customizer_companion_notice', true);
	echo true;
	wp_die();
}
add_action('wp_ajax_jcub_hide_customizer_companion_notice', 'jcub_hide_customizer_companion_notice');