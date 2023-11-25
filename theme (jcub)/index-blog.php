<?php
$jcub_parent_current_options = wp_parse_args(get_option('quality_pro_options', array()), quality_theme_data_setup());
?>
<section id="section-block" class="news">
    <div class="container">
        <?php if (($jcub_parent_current_options['blog_heading']) || ($jcub_parent_current_options['home_blog_description'] != '' )) { ?>
            <div class="row">
                <div class="section-header">			
                    <?php if ($jcub_parent_current_options['blog_heading']) { ?>
                        <p><?php echo wp_kses_post($jcub_parent_current_options['blog_heading']); ?></p>
                    <?php } if ($jcub_parent_current_options['home_blog_description']) { ?>
                        <h1 class="widget-title"><?php echo wp_kses_post($jcub_parent_current_options['home_blog_description']); ?></h1>
                    <?php } ?>
                    <hr class="divider">
                </div>
            </div>
        <?php } ?>
        <!--Blog Content-->
        <?php 
        $jcub_current_options= wp_parse_args(get_option('quality_pro_options', array()), jcub_default_data());
        if ($jcub_current_options['blog_masonry4_layout_setting'] == 'masonry4') {
            jcub_blog_masonry4_layout();
        } else {
            jcub_blog_default_layout();
        }?>        	
    </div>
</section>