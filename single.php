<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main single-blog-post">

	<?php
	while ( have_posts() ) :
		the_post();

		get_template_part( 'template-parts/content', get_post_type() );

		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous', 'healing-haven' ) . '</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next', 'healing-haven' ) . '</span>',
			)
		);
	?>

		<!-- Display Popular services -->
		<?php
		if ( function_exists( 'get_field' ) ) :
			if ( get_field( 'popular_services', 32 ) ) : 
				$popular_services = get_field('popular_services', 32); ?>

		<section class="popular-services">
			<h2>Popular Services</h2>
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php 
						foreach( $popular_services as $popular_service) :
							$service = wc_get_product($popular_service);
							$title = $service->get_title();
							$thumbnail = $service->get_image('portrait-therapist');
							$permalink = $service->get_permalink();
						?>
						<div class="swiper-slide" id="swiper-slide">
							<div class="swiper-service" >
							<?php echo $thumbnail ?>
							<h3><?php echo $title ?></h3>
							<a class="btn-border" href="<?php echo esc_url($permalink) ?>">
								More Info<span class="screen-reader-text">about <?php echo $title ?></span>
							</a>
						</div>
						</div>
						<?php
						endforeach;
						?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			<?php 
			endif;
		endif;
		?>
		</section>
			<?php
	endwhile; // End of the loop.
	?>

	</main><!-- #main -->

<?php
get_footer();
