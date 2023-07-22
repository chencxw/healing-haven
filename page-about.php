<?php
/**
 * The template for displaying About page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<?php healing_haven_post_thumbnail(); ?>

			<?php
			if ( function_exists( 'get_field' ) ) :
			?>

				<div class="entry-content">

				<?php
				$about_clinic = get_field( 'about_clinic' );

				if ( $about_clinic ) {

					foreach ( $about_clinic as $item ) {

						$title_about = $item['title_about'];
						$about_parag = $item['about_paragraph'];

						if( $title_about &&  $about_parag ) {
						?>
							<section class="about <?php echo esc_attr(strtolower( $title_about ));?>">
								<h2><?php echo esc_html( $title_about ); ?></h2>
								<p><?php echo esc_html( $about_parag ); ?></p>
							</section>
						
						<?php
						}

					}

				}

				$policies = get_field( 'policies' );

				if ( $policies ) :
					?>
					<section class="about policies" id="policies">
						<h2>Policies</h2>
						<div class="accordion">

					<?php

					$index = 0;

					foreach ( $policies as $policy ) {
						$policy_title = $policy['policy_title'];
						$policy_parag = $policy['policy_paragraph'];

						if( $policy_title && $policy_parag ) :
							?>

							<button class="accordion-item">
								<div class="accordion-header">
									<h3 class="accordion-title"><?php echo $policy_title; ?></h3>
									<svg aria-hidden="true" class="accordion-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
										<path d="M7 10l5 5 5-5z"/>
									</svg>
								</div>

								<div class="accordion-content"><?php echo $policy_parag; ?></div>
							</button> <!-- Close accordion-item -->

							<?php

							$index++;

						endif;
					}
					?>

						</div> <!-- Close accordion -->
					</section>

					<?php
				endif;
			endif;
			
		endwhile; // End of the loop.
		?>
				</div><!-- .entry-content -->

				<div class="button-container">
					<a class="link-button" href="<?php echo esc_url( home_url( '/therapists' ) ); ?>">
						<span>Meet Our Team</span>
					</a>
				</div>

		</article><!-- #post-<?php the_ID(); ?> -->
	</main><!-- #main -->

<?php
get_footer();
