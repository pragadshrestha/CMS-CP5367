<?php
function jcub_header_layout_customizer($wp_customize) {

    /**
     * Image Radio Button Custom Control
     *
     * @author Anthony Hortin <http://maddisondesigns.com>
     * @license http://www.gnu.org/licenses/gpl-2.0.html
     * @link https://github.com/maddisondesigns
     */
    class jcub_Image_Radio_Button_Custom_Control extends WP_Customize_Control {

        /**
         * The type of control being rendered
         */
        public $type = 'image_radio_button';

         public function enqueue() {
                add_action('customize_controls_print_styles', array($this, 'print_styles'));
            }

            public function print_styles() {
                ?><style>
                    /*Red child*/
                    #customize-control-quality_pro_options-header_sticky_layout_setting input{
                        display:none;
                    }
                    #customize-control-quality_pro_options-header_sticky_layout_setting img{
                        margin-top: 5%;
                    }
                    #customize-control-quality_pro_options-blog_masonry4_layout_setting img{
                        margin-top: 5%;
                    }
                    #customize-control-quality_pro_options-blog_masonry4_layout_setting input{
                        display:none;
                    }
                    .image_radio_button_control .radio-button-label > input:checked + img {
                        border: 3px solid #2885bb;
                    }

                </style>
                <?php
            }
        /**
         * Render the control in the customizer
         */
        public function render_content() {
            ?>
            <div class="image_radio_button_control">
                <?php if (!empty($this->label)) { ?>
                    <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <?php } ?>
                <?php if (!empty($this->description)) { ?>
                    <span class="customize-control-description"><?php echo esc_html($this->description); ?></span>
                <?php } ?>

                <?php foreach ($this->choices as $key => $value) { ?>
                    <label class="radio-button-label">
                        <input type="radio" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($key); ?>" <?php $this->link(); ?> <?php checked(esc_attr($key), $this->value()); ?>/>
                        <img src="<?php echo esc_attr($value['image']); ?>" alt="<?php echo esc_attr($value['name']); ?>" title="<?php echo esc_attr($value['name']); ?>" />
                    </label>
                <?php } ?>
            </div>
            <?php
        }

    }

    $jcub_current_options = wp_parse_args(get_option('quality_pro_options', array()), quality_theme_data_setup());
        
        
       /* Header Layout section */
        $wp_customize->add_panel('header_options', array(
        'priority' => 450,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Header Setting', 'jcub'),
         ));
        
        $wp_customize->add_section( 'header_sticky_layout_setting' , array(
            'title'      => esc_html__('Header Layout', 'jcub'),
            'panel'  => 'header_options'
        ) );
        
        // Header Layout settings
        if(get_option('quality_user', 'new')=='old' || $jcub_current_options['text_title'] !='' || $jcub_current_options['upload_image_logo']!='' || $jcub_current_options['webrit_custom_css']=='nomorenow' ){

            $wp_customize->add_setting( 'quality_pro_options[header_sticky_layout_setting]' , array(
            'default' => 'default',
            'sanitize_callback' => 'jcub_sanitize_radio',
            'type'=>'option'
            ) );

        }
        else{

            $wp_customize->add_setting( 'quality_pro_options[header_sticky_layout_setting]' , array(
            'default' => 'sticky',
            'sanitize_callback' => 'jcub_sanitize_radio',
            'type'=>'option'
            ) );

        }
            $wp_customize->add_control(new jcub_Image_Radio_Button_Custom_Control($wp_customize, 'quality_pro_options[header_sticky_layout_setting]',
                    array(
                'label' => esc_html__('Header Layout Setting', 'jcub'),
                'section' => 'header_sticky_layout_setting',
                'choices' => array(
                    'default' => array(
                        'image' => get_stylesheet_directory_uri() . '/images/jcub-header-default.png',
                        'name' => esc_html__('Standard Layout', 'jcub')
                    ),
                    'sticky' => array(
                        'image' => get_stylesheet_directory_uri() . '/images/jcub-header-overlay.png',
                        'name' => esc_html__('Overlay Layout', 'jcub')
                    )
                )
                    )
    ));

}

add_action('customize_register', 'jcub_header_layout_customizer');

//radio box sanitization function
function jcub_sanitize_radio($input, $setting) {

    $input = sanitize_key($input);

    $choices = $setting->manager->get_control($setting->id)->choices;

    //return if valid 
    return ( array_key_exists($input, $choices) ? $input : $setting->default );
}
