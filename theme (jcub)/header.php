<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        ``
        <![endif]-->
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <!-- Theme Css -->
        <?php wp_head();?>
    </head>
    <body <?php body_class(); ?>>

        <?php wp_body_open(); ?>
        <a class="skip-link screen-reader-text" href="#section-block"><?php esc_html_e('Skip to content', 'jcub'); ?></a> 
        <!--Header Logo & Menus-->
        <?php
        $jcub_options = wp_parse_args(get_option('quality_pro_options', array()), jcub_default_data());
        if ($jcub_options['header_sticky_layout_setting'] == 'sticky') {

            jcub_header_sticky_layout();
        } else {

            jcub_header_default_layout();
        }
        ?>       
        <div class="clearfix"></div>