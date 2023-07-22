<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>
</header>
<div class="services-page-wrapper">

<?php
	// Get all product categories
	$categories = get_terms( array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
	) );

	if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {

		?>
			 <nav class="category-nav">
				<button class="subnav-title" aria-controls="services-menu" aria-expanded="false">
					Explore Our Massages

					<svg aria-hidden="true" class="accordion-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						<path d="M7 10l5 5 5-5z"/>
					</svg>
					</button>
			 <ul class='dropdown'>
		<?php
	
		foreach ( $categories as $category ) {

			if ( $category->name == 'Uncategorized' ) {
				continue;
			}

			?>
			<li>
				<a  class="services-menu-link" href="#category-<?php echo esc_html( $category->term_id); ?>">
				 <?php echo esc_html( $category->name); ?>
				</a>
			</li>
				<?php
		}
	
		?>
			</ul>
			</nav>
			<div class="services-wrapper">

		<?php

		foreach ( $categories as $category ) {

			if ($category->name == 'Uncategorized'){
				continue;
			}

			// Output category name
			?>
			<section class="service-section <?php echo esc_html( $category->term_id ) ?>" id="category-<?php echo esc_html( $category->term_id ) ?>">
			<h2 class="service-title"> <?php echo esc_html( $category->name ) ?></h2>
			<?php


			// Get the products in the current category
			$products = new WP_Query( array(
				'post_type'      => 'product',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'tax_query'      => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'term_id',
						'terms'    => $category->term_id,
					),
				),
			) );

			if ( $products->have_posts() ) {
				?>
				<div class="prices-wrapper">
					<ul class="price-list">
				<?php

				while ( $products->have_posts() ) {
					$products->the_post();

					// Get the price
					$price = $product->get_price();
					$permalink = $product->get_permalink();

					if ($product->is_type('booking')) {
						
						$duration = $product->get_duration();
						?>
						<li>
						<a href='<?php echo $permalink ?>'>
						<?php
						echo $duration . ' min - ';
						echo '$'.$price. ' ';
						?>
							</a></li>
						<?php
					}
					else
						echo `$`.$price. ' ';
				}
				?>
					</div>
				<?php

			} else {
				echo 'No products found.';
			}
			
			// Get the category featured image
			$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);

			if (has_post_thumbnail()) {
                the_post_thumbnail('portrait-therapist');
            }

			?>
				<p class="service-description"> <?php echo esc_html( $category->description ) ?></p>

				<?php
			
			if ( function_exists( 'get_field' ) ) {
				
				if ( get_field( 'service_categories', $category ) ) {
					?>
	
					<div class='services-staff'>
						<h3 class='services-staff-title'>Offered By: </h3>
						<ul class='therapist-list'>
		
					<?php
					$therapists = get_field( 'service_categories', $category  );

					foreach ($therapists as $id) {

						$title = get_the_title($id);
						$staffLink = get_the_permalink($id);
						
						?> <li> <?php
						echo "<a href='$staffLink'>";
						echo $title;
						?>
						</a>
						</li>
						<?php
					}
					?>
					</ul>
				</div>
					<?php
				};
			}

			echo '</section>';


			wp_reset_postdata();
		}


	} else {
		echo 'No categories found.';
	}
	?>
	</div>

		<button class="button-container">
			<a class="link-button" href="<?php echo esc_url( home_url( '/about#policies' ) ); ?>">
				<span>Check Out Policies</span>
			</a>
		</button>
	</div>

<?php


/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );


get_footer( 'shop' );

