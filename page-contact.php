<?php
/**
 * The template for displaying the contact page
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
			$page_title = get_the_title();
			echo "<h1 class='page-title'>$page_title</h1>"
			?>
		<?php

		if (function_exists ('get_field')) {
		$contact_field = get_field('contact_form_intro');
		$phone_number = get_field('phone_number');
		$clinic_email = get_field('clinic_email');
		$clinic_address = get_field('address');
		$hours = get_field('open_hours');
		$acf_field = get_field_object('open_hours');
		$google_map = get_field('address_map');
		
			
		if ($phone_number) {
			?>
			<section class='clinic-info'>
			<div class="contact-phone">
				<svg xmlns="http://www.w3.org/2000/svg" width="24.137" height="24.179" viewBox="0 0 24.137 24.179" aria-hidden="true">
			<path id="Icon_feather-phone" data-name="Icon feather-phone" d="M25.5,19.754v3.369a2.246,2.246,0,0,1-2.448,2.246,22.222,22.222,0,0,1-9.691-3.447,21.9,21.9,0,0,1-6.737-6.737A22.222,22.222,0,0,1,3.177,5.448,2.246,2.246,0,0,1,5.412,3H8.78a2.246,2.246,0,0,1,2.246,1.931,14.418,14.418,0,0,0,.786,3.155,2.246,2.246,0,0,1-.505,2.369L9.881,11.882a17.966,17.966,0,0,0,6.737,6.737l1.426-1.426a2.246,2.246,0,0,1,2.369-.505,14.418,14.418,0,0,0,3.155.786A2.246,2.246,0,0,1,25.5,19.754Z" transform="matrix(0.999, 0.035, -0.035, 0.999, -1.762, -2.591)" fill="none" stroke="#313131" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
			</svg>
				<p><?php echo $phone_number; ?></p>
			</div>
			<?php
		}
		?>

		<?php
		if ($clinic_email) {
			?>
			<div class="contact-email">
				<svg xmlns="http://www.w3.org/2000/svg" width="21.393" height="17" viewBox="0 0 21.393 17" aria-hidden="true">
			<g id="Icon_feather-mail" data-name="Icon feather-mail" transform="translate(-2.304 -5.5)">
				<path id="Path_30" data-name="Path 30" d="M5,6H21a2.006,2.006,0,0,1,2,2V20a2.006,2.006,0,0,1-2,2H5a2.006,2.006,0,0,1-2-2V8A2.006,2.006,0,0,1,5,6Z" fill="none" stroke="#313131" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
				<path id="Path_31" data-name="Path 31" d="M23,9,13,16,3,9" transform="translate(0 -1)" fill="none" stroke="#313131" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"/>
			</g>
			</svg>
				<a href = "mailto: <?php echo $clinic_email; ?>" class="contact-email-link"><?php echo $clinic_email; ?></a>
			</div>
			<?php
		}
		?>

		<?php 
		if ($hours) {
			?>
			<div class="contact-hours">
				<svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26" aria-hidden="true">
				<g id="Ellipse_10" data-name="Ellipse 10" fill="#fff" stroke="#313131" stroke-width="1">
					<circle cx="13" cy="13" r="13" stroke="none"/>
					<circle cx="13" cy="13" r="12.5" fill="none"/>
				</g>
				<line id="Line_192" data-name="Line 192" y2="7" transform="translate(13.5 6.5)" fill="none" stroke="#313131" stroke-width="1"/>
				<line id="Line_193" data-name="Line 193" x2="7" transform="translate(13.5 13.5)" fill="none" stroke="#313131" stroke-width="1"/>
				</svg>

			<div class="contact-hours-container">
				<p><?php if ($acf_field) {
			$title = $acf_field['label'];
			echo $title;
		} ?></p> <br/>
				<p><?php echo $hours; ?></p>
			</div>
			</div>
			<?php
		}
		?>


		<?php
		if ($clinic_address) {
			?>
			<div class="contact-address">
				<h2>Location</h2>
				<p><?php echo $clinic_address; ?></p>
			</div>
			<?php
		}
		?>
	</section>
		
		<?php
		if ($google_map) {
			$address = $google_map['address'];
			$zoom = $google_map['zoom'];

			?>
			<section class='google-map'>
			<div class="contact-map">
				 <div class="acf-map" data-zoom="<?php echo esc_attr($zoom); ?>">
					<div class="marker" data-lat="<?php echo esc_attr($google_map['lat']); ?>" data-lng="<?php echo esc_attr($google_map['lng']); ?>">
					</div>
				</div>
			</div>
			</section>
			<?php
			}
			
		?>


		<section class='contact-form'>
		<?php
		
		gravity_form( 1, true,  false,  false, null, false,'', true );
	}
		?>
		</section>
		<?php
		
			// get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
