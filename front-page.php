<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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

				// Get Hero image and store it in a variable 
				if ( function_exists( 'get_field' ) ) {
					if ( get_field( 'hero_image' ) ) {
						$hero_image = get_field( 'hero_image' );
					}; 
				}
				?>
				<header class="home-hero" style="background-image: url('<?php echo $hero_image ?>');">
					<?php 
					// Output hero section text
					if ( function_exists( 'get_field' ) ) { ?>
						<div class="hero-text">
							<?php
							if ( get_field('welcome_message') ) { ?>
								<p> <?php the_field( 'welcome_message' ); ?></p>
							
							<?php 
							}
							if ( get_field('welcome_message_2') ) { ?>
								<h1><?php the_field( 'welcome_message_2' ); ?></h1>
							<?php
							} ?>
						</div>
					<?php
					};
					?>
				</header>

			<div class="home-section-wrapper">
				<!-- Output intro text -->
				<section class="home-intro" id="home-intro">
					<?php 
					if ( function_exists( 'get_field' ) ) {
						if ( get_field( 'slogan' ) ) { ?>
							<h2><?php the_field( 'slogan' ); ?></h2>
						<?php
						}
						if ( get_field( 'about_clinic_home' ) ) { ?>
							<p><?php the_field( 'about_clinic_home' ); ?></p>
						<?php
						}
					}
					?>
				</section>

				<!-- Output popular services -->
				<section class="home-popular-services">
						<h2>Popular Services</h2>
						<?php get_template_part( 'template-parts/popular-services' ); ?>
						<p class="more-services-btn">
							<a href="<?php echo wc_get_page_permalink('shop') ?>" class="link-spacing">All Services</a>
						</p>
				</section>

				<!-- Output 3 random testimonials -->
				<section class="home-testimonials">
					<h2 class="testimonial-header">Testimonials</h2>
					<?php 
					$args = array (
						'post_type' => 'hhm-testimonial',
						'posts_per_page' => 3,
						'orderby' => 'rand',
					);

					$query = new WP_Query( $args );
					if ( $query->have_posts() ) { ?>
						<div class="swiper">
							<div class="swiper-wrapper">
								<?php
								while( $query->have_posts() ) {
									$query->the_post(); ?>
									<article class="swiper-slide" id="swiper-slide">
										<div class="quotation">
											<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m21.301 4c.411 0 .699.313.699.663 0 .248-.145.515-.497.702-1.788.948-3.858 4.226-3.858 6.248 3.016-.092 4.326 2.582 4.326 4.258 0 2.007-1.738 4.129-4.308 4.129-3.24 0-4.83-2.547-4.83-5.307 0-5.98 6.834-10.693 8.468-10.693zm-10.833 0c.41 0 .699.313.699.663 0 .248-.145.515-.497.702-1.788.948-3.858 4.226-3.858 6.248 3.016-.092 4.326 2.582 4.326 4.258 0 2.007-1.739 4.129-4.308 4.129-3.241 0-4.83-2.547-4.83-5.307 0-5.98 6.833-10.693 8.468-10.693z" fill-rule="nonzero"/></svg>
										</div>
										<h3><?php the_title(); ?></h3>
										<?php the_content(); ?>
									</article>
								<?php
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

				<!-- Output 3 random blog posts -->
				<section class="home-blog">
						<h2>Recent Blog Posts</h2>
						<?php 
						$args = array(
							'post_type' => 'post',
							'posts_per_page' => 3
						);
						$blog_query = new WP_Query( $args );
						if ( $blog_query -> have_posts() ) {
							while ( $blog_query -> have_posts() ) {
								$blog_query -> the_post();
								?>
								<article>
									<?php the_post_thumbnail( 'thumbnail' ); ?>
									<h3><?php the_title(); ?></h3>
									<p><?php echo get_the_date(); ?></p>
									<p><?php the_excerpt(); ?></p>
									<p class="read-more-btn">
										<a href="<?php the_permalink() ?>">
											Read More<span class="screen-reader-text">about <?php the_title(); ?></span>
											<svg aria-hidden="true" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
												<path d="m14.523 18.787s4.501-4.505 6.255-6.26c.146-.146.219-.338.219-.53s-.073-.383-.219-.53c-1.753-1.754-6.255-6.258-6.255-6.258-.144-.145-.334-.217-.524-.217-.193 0-.385.074-.532.221-.293.292-.295.766-.004 1.056l4.978 4.978h-14.692c-.414 0-.75.336-.75.75s.336.75.75.75h14.692l-4.979 4.979c-.289.289-.286.762.006 1.054.148.148.341.222.533.222.19 0 .378-.072.522-.215z" fill-rule="nonzero"/>
											</svg>
										</a>
									</p>
								</article>
								<?php
							}
							wp_reset_postdata();
						}
						?>
						<p class="blog-posts-btn">
							<a href="<?php the_permalink(57) ?>" class="link-spacing">Check out other posts</a>
						</p>
				</section>

				<!-- Output instagram feed -->
				<section class="instagram">
						<h2>Check out our instagram</h2>
						<?php 
						if ( function_exists( 'get_field' ) ) {
							if ( get_field( 'instagram' ) ) {
								the_field('instagram');
							};
						};
						?>
				</section>
			</div>
		<?php endwhile; ?>
	</main><!-- #main -->

<?php
get_footer();
