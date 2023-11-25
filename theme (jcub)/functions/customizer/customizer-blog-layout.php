<?php

function jcub_blog_layout_customizer($wp_customize) {

    $jcub_current_options = wp_parse_args(get_option('quality_pro_options', array()), quality_theme_data_setup());

    // blog Layout settings
    if (get_option('quality_user', 'new')=='old' || $jcub_current_options['text_title'] != '' || $jcub_current_options['upload_image_logo'] != '' || $jcub_current_options['webrit_custom_css']=='nomorenow') {

        $wp_customize->add_setting('quality_pro_options[blog_masonry4_layout_setting]', array(
            'default' => 'default',
            'sanitize_callback' => 'jcub_sanitize_radio',
            'type' => 'option'
        ));
    } else {

        $wp_customize->add_setting('quality_pro_options[blog_masonry4_layout_setting]', array(
            'default' => 'masonry4',
            'sanitize_callback' => 'jcub_sanitize_radio',
            'type' => 'option'
        ));
    }
    $wp_customize->add_control(new jcub_Image_Radio_Button_Custom_Control($wp_customize, 'quality_pro_options[blog_masonry4_layout_setting]',
                    array(
                'label' => esc_html__('Blog Layout Setting', 'jcub'),
                'section' => 'blog_setting',
                'priority'              => 20,
                'choices' => array(
                    'default' => array(
                        'image' => get_stylesheet_directory_uri() . '/images/quality-blue-blog-default.png',
                        'name' => esc_html__('Standard Layout', 'jcub')
                    ),
                    'masonry4' => array(
                        'image' => get_stylesheet_directory_uri() . '/images/quality-blue-blog-masonry.png',
                        'name' => esc_html__('Masonry 4 Column', 'jcub')
                    )
                )
                    )
    ));
}
add_action('customize_register', 'jcub_blog_layout_customizer');