<?php
get_header();
jcub_banner_image();
quality_breadcrumbs();
?>
<section id="section-block" class="site-content">
    <div class="container">
        <div class="row">
            <!--Blog Posts-->
            <?php echo '<div class="col-md-' . (!is_active_sidebar("sidebar-primary") ? "12" : "8") . ' col-xs-12">'; ?>
            <div class="news">

                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <?php
                    $jcub_current_options = wp_parse_args(get_option('quality_pro_options', array()), theme_data_setup());
                    ?>
                    <article class="post" <?php post_class(); ?>>
                        <figure class="post-thumbnail">
                            <?php $jcub_defalt_arg = array('class' => "img-responsive"); ?>
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('', $jcub_defalt_arg); ?>
                            <?php endif; ?>

                        </figure>
                        <div class="post-content">
                            <?php if ($jcub_current_options['home_meta_section_settings'] == '') { ?>
                                <div class="item-meta">
                                    <a class="author-image item-image" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_avatar(get_the_author_meta('user_email'), $jcub_size = '40'); ?></a>
                                    <?php echo ' '; ?><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html(get_the_author()); ?></a>
                                    <br>
                                    <a class="entry-date" href="<?php echo esc_url(get_month_link(get_post_time('Y'), get_post_time('m'))); ?>">
                                        <?php echo esc_html(get_the_date()); ?></a>
                                </div>
                            <?php } ?>
                            <?php if (!is_single()) { ?>
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </header>
                            <?php } ?>
                            <div class="entry-content">
                                <?php
                                the_content();
                                ?>
                            </div>
                            <?php if ($jcub_current_options['home_meta_section_settings'] == '') { ?>
                                <hr />
                                <div class="entry-meta">
                                    <span class="comment-links"><a href="<?php the_permalink(); ?>"><?php comments_number(esc_html__('No Comments', 'jcub'), esc_html__('One comment', 'jcub'), esc_html__('% comments', 'jcub')); ?></a></span>
                                    <?php
                                    $jcub_cat_list = get_the_category_list();
                                    if (!empty($jcub_cat_list)) {
                                        ?>
                                        <span class="cat-links"><?php esc_html_e('In', 'jcub'); ?><?php the_category(' '); ?></span>
                                    <?php } ?>

                                </div>
                            <?php } ?>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php wp_link_pages(); ?>
            <!--/Blog Content-->
            <?php comments_template('', true); ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
</section>
<?php
get_footer();
