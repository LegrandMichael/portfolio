<?php
/**
 * The template for displaying the footer
 */

?>

	</div><!-- #content -->
	
	<?php if (get_theme_mod( 'social_media_activate' )) { seos_social_section (); } ?>
	
	<footer id="colophon"  role="contentinfo">
	
		<div class="site-info">

				<?php esc_html_e('All rights reserved', 'seos'); ?>  &copy; <?php bloginfo('name'); ?>
							
				<a title="Seos Themes" href="<?php echo esc_url('https://seosthemes.com/', 'seos'); ?>" target="_blank"><?php esc_html_e('Theme by Seos Themes', 'seos'); ?></a>
			
		</div><!-- .site-info -->
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->

	<a id="totop" href="#"><i class="fa fa-chevron-up"></i></a>
	
<?php wp_footer(); ?>

</body>
</html>
