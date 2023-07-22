<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			$args = array(
				'post_type'      => 'hhm-therapists',
				'posts_per_page' => -1,
			);

			$query = new WP_Query( $args );

			if( $query -> have_posts() ) {
				?>
				<section class="therapists-section">

				<?php
				while( $query -> have_posts () ) {
					$query -> the_post();
				?>
				<article class="therapist-item">						
					<?php the_post_thumbnail( 'portrait-therapist' );?>
					<h2><?php the_title(); ?></h2>
					<?php
						$specialties = get_the_terms(get_the_ID(), 'hhm-specialties');
						if ($specialties) {
							echo '<p><span>Specialty:</span> ';
							$specialty_names = array();
							foreach ($specialties as $specialty) {
								$specialty_names[] = $specialty->name;
							}
							echo implode(' / ', $specialty_names). '</p>';
						}
					?>

						<?php
						if ( function_exists( 'get_field' ) ) {
							$days_available = get_field( 'days_available', get_the_ID() );
							if ( $days_available ) {
								echo '<p><span>Availability:</span> ';
								$days = array();
								foreach ( $days_available as $day ) {
									$days[] = $day['days_available'];
								}
								echo implode(', ', $days). '</p>';
							}
						}
						?>
						<div class="therapist-more-info">
							<a href="<?php the_permalink(); ?>">
								More Info<span class="screen-reader-text">about <?php the_title(); ?></span>
								<svg aria-hidden="true" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
									<path d="m14.523 18.787s4.501-4.505 6.255-6.26c.146-.146.219-.338.219-.53s-.073-.383-.219-.53c-1.753-1.754-6.255-6.258-6.255-6.258-.144-.145-.334-.217-.524-.217-.193 0-.385.074-.532.221-.293.292-.295.766-.004 1.056l4.978 4.978h-14.692c-.414 0-.75.336-.75.75s.336.75.75.75h14.692l-4.979 4.979c-.289.289-.286.762.006 1.054.148.148.341.222.533.222.19 0 .378-.072.522-.215z" fill-rule="nonzero"/>
								</svg>
							</a>
						</div>
				</article>
				<?php
				}
				wp_reset_postdata();
				?>
				</section>
			<?php
			}
		endif;
		?>
	</main><!-- #main -->

<?php
get_footer();
