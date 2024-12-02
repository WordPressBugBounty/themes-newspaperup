<?php
/**
 * The template for displaying all WooCommerce pages.
 *
 * @package Newspaperup
 */
get_header(); ?>
<!--==================== ti breadcrumb section ====================-->

<!-- #main -->
<main id="content" class="woocommerce-class content">
	<div class="container">
		<?php do_action('newspaperup_action_archive_page_title'); ?>
		<div class="row">
			<div class="col-lg-12">
				<?php woocommerce_content(); ?>
			</div>
		</div><!-- .container -->
	</div>	
</main><!-- #main -->
<?php get_footer(); ?>