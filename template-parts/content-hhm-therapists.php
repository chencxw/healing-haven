<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Healing_Haven_Massage
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>
	</header><!-- .entry-header -->

	<?php 

	the_post_thumbnail( 'portrait-therapist' );
	?>

	<div class="therapist-details">
		<?php 

		// Output Therapist email
		if ( function_exists( 'get_field' ) ) {
			if ( get_field( 'therapist_email' ) ) { 
				?>
				<div class="email-wrapper">
					<h3>Email:</h3>
					<a href="mailto:<?php the_field('therapist_email'); ?>">
						<?php the_field('therapist_email'); ?>
					</a>
				</div>
			<?php
			};
		};

		// Output therapist specialties
		$specialties = get_the_terms( $post->ID, 'hhm-specialties' ); 
		$specialty_array = array();

		foreach($specialties as $specialty) {
			$specialty_array[] = $specialty->name;
		} ?>

		<div class="specialties-wrapper">
			<h3>Specialty:</h3>
			<p><?php echo implode(", ", $specialty_array) ?></p>
		</div>


		<?php
		// Output Therapist Availabilities
		if ( function_exists( 'get_field' ) ) {

			if ( get_field( 'days_available' ) ) { 

				$days_available = get_field( 'days_available');
				$days_array = array();

				foreach ( $days_available as $day ) {
					$days_array[] = $day['days_available'];
				} ?>

				<div class="availability-wrapper">
					<h3>Availability:</h3>
					<p><?php echo implode(",", $days_array); ?></p>
				</div>

				<?php
			};
		};
		?>
	</div>

		<?php
		// Output therapist bio
		if ( function_exists( 'get_field' ) ) {

			if ( get_field( 'therapist_bio' ) ) {

				the_field('therapist_bio');
			};
		}; 
		?>

		<!-- Output Testimonials -->
		<section class="therapist-testimonial">
			<h2>Testimonials</h2>

			<div class="swiper">
				<div class="swiper-wrapper">

					<?php 
					$args = array (
						'post_type' => 'hhm-testimonial',
						'posts_per_page' => '-1',
					);
					$therapist_ID = get_the_ID();

					$query = new WP_Query( $args );
					if ( $query->have_posts() ) {
						while( $query->have_posts() ) {
							$query->the_post();

							if ( function_exists( 'get_field' ) ) {
								if ( get_field( 'therapist_reviewed') ) { 
									$testimonials = get_field('therapist_reviewed');

									foreach( $testimonials as $testimonial) {
										if ($testimonial == $therapist_ID) { ?>
										
										<article class="swiper-slide">
										<div class="quotation">
												<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m21.301 4c.411 0 .699.313.699.663 0 .248-.145.515-.497.702-1.788.948-3.858 4.226-3.858 6.248 3.016-.092 4.326 2.582 4.326 4.258 0 2.007-1.738 4.129-4.308 4.129-3.24 0-4.83-2.547-4.83-5.307 0-5.98 6.834-10.693 8.468-10.693zm-10.833 0c.41 0 .699.313.699.663 0 .248-.145.515-.497.702-1.788.948-3.858 4.226-3.858 6.248 3.016-.092 4.326 2.582 4.326 4.258 0 2.007-1.739 4.129-4.308 4.129-3.241 0-4.83-2.547-4.83-5.307 0-5.98 6.833-10.693 8.468-10.693z" fill-rule="nonzero"/></svg>
											</div>
											<h3><?php the_title(); ?></h3> 
											<?php the_content(); ?>
										</article>
											<?php
										}
										}
								}
							}
						}; ?>

				</div>
				<div class="swiper-pagination"></div>

				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>

			<?php
			wp_reset_postdata();
			}
			?>

		</section>

		<!-- Output availability calendar -->
		<div class="therapist-availability-calendar">
			<h2>Availability</h2>
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'healing-haven' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);
		?>
		</div>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'healing-haven' ),
				'after'  => '</div>',
			)
		);
		?>

	<!-- .entry-content -->

	<!-- Call to action button -->

	<div class="button-container">
					<a class="link-button" href="<?php echo get_post_type_archive_link('hhm-therapists'); ?>">
						<span>See other therapists</span>
					</a>
	</div>
	
</article>
