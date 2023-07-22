<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Healing_Haven_Massage
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<?php

		if(function_exists( 'get_field' )){

			?> <ul class="footer-list">
			<?php
					if( get_field( 'address' , 37 )){
						?><li class="footer-item"><?php
						the_field( 'address' , 37 );
						?></li><?php
						
					}
					if( get_field( 'clinic_email' , 37 )){
						?><li class="footer-item"><?php
						the_field( 'clinic_email' , 37 );
						?></li><?php
					}
					if( get_field( 'phone_number' , 37 )){
						?><li class="footer-item"><?php
						the_field( 'phone_number' , 37 );
						?></li><?php
					}

					if( get_field( 'social_media' , 37 )){

						if (have_rows('social_media' , 37 )) {

							while (have_rows('social_media' , 37 )) {

								the_row();
						
							$icon = get_sub_field('icon_svg');
							$link = get_sub_field( 'social_media_link');
							?>
							<li class="footer-item">
								<a aria-label="instagram icon" title="instagram icon" target="_blank" rel="noopener" href="<?php echo $link ?>" ><?php
								echo $icon
							?></a></li><?php
							}
							}
					}
			}
			?>
			<li class="footer-item footer-policies-wrapper">
			<a class="footer-policies" href="<?php echo esc_url( home_url( '/about#policies' ) ); ?>">
				<span>Clinic Policies</span>
			</a>
			<a class="footer-privacy-policies" href="<?php echo esc_url( get_privacy_policy_url() ); ?>">
				<span>Privacy Policies</span>
			</a>
			</li>
		</ul>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
