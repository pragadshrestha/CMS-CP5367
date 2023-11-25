<?php

if (class_exists('WP_Customize_Control') && !class_exists('jcub_Plugin_Install_Control')) {

    /**
     *
     * @see WP_Customize_Section
     */
    class jcub_Plugin_Install_Control extends WP_Customize_Control {

        /**
         * Customize section type.
         *
         * @access public
         * @var string
         */
        public $type = 'jcub_plugin_install_control';
        public $name = '';
        public $slug = '';

        public function __construct($manager, $id, $args = array()) {
            parent::__construct($manager, $id, $args);
        }

        /**
         * enqueue styles and scripts
         *
         *
         * */
        public function enqueue() {
            wp_enqueue_script('plugin-install');
            wp_enqueue_script('updates');
            wp_enqueue_script('jcub-companion-install', QUALITY_ADMIN_URI . '/assets/js/plugin-install.js', array('jquery'));
            wp_localize_script(
                    'jcub-companion-install',
                    'jcub_companion_install',
                    array(
                        'installing' => esc_html__('Installing', 'jcub'),
                        'activating' => esc_html__('Activating', 'jcub'),
                        'error' => esc_html__('Error', 'jcub'),
                        'ajax_url' => esc_url(admin_url('admin-ajax.php')),
                    )
            );
        }

        /**
         * Render the section.
         *
         * @access protected
         */
        protected function render_content() {
            // Determine if the plugin is not installed, or just inactive.

            if (empty($this->name) && empty($this->slug)) {
                return;
            }

            $hide_install = get_option('jcub_hide_customizer_notice_' . $this->slug, false);
            if ($hide_install) {
                return;
            }

            global $jcub_about_page;
            if (!is_object($jcub_about_page)) {
                return;
            }
            ?>
            <div class="jcubweb-plugin-install-control">
                <span class="jcubweb-customizer-notification-dismiss" id="<?php echo esc_attr($this->slug); ?>-install-dismiss" data-slug="<?php echo esc_attr($this->slug); ?>"> <i class="fa fa-times"></i></span>
                <?php if (!empty($this->label)) : ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php endif; ?>
                <?php if (!empty($this->description)) : ?>
                    <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php endif; ?>
                <?php
                $button = $jcubweb_about_page->get_plugin_buttion($this->slug, $this->name);
                echo wp_kses_post($button['button']);
                ?>
                <div style="clear: both;"></div>
            </div>
            <?php
        }

    }

}

function jcub_hide_customizer_notice() {
    if (isset($_POST['jcubweb_plugin_slug']) && !empty($_POST['jcubweb_plugin_slug'])) {
        $plugin_slug = sanitize_text_field(wp_unslash($_POST['jcubweb_plugin_slug']));
        update_option('jcubweb_hide_customizer_notice_' . $plugin_slug, true);
        echo true;
    }
    wp_die();
}

add_action('wp_ajax_jcubweb_hide_customizer_notice', 'jcub_hide_customizer_notice');
