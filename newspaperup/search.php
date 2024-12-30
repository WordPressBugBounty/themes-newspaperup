<?php
/**
 * The template for displaying search results pages.
 *
 * @package Newspaperup
 */
get_header(); ?>
<!--==================== main content section ====================-->
<main id="content" class="search-class content">
    <!--container-->
    <div class="container">
        <!--==================== breadcrumb section ====================-->
        <?php do_action('newspaperup_action_archive_page_title'); ?>
        <!--row-->
        <div class="row">
            <?php get_template_part('sections/content','search'); ?>
            <aside class="col-lg-4 sidebar-right">
                <?php get_sidebar();?>
            </aside>
        </div><!--/row-->
    </div><!--/container-->
</main>
<?php
get_footer();