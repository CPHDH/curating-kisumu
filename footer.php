
	<footer class="footer-main" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

		<div class="searchbar-bottom">
			<div class="searchbar-inner container">
			<?php get_search_form();?>
			</div>
		</div>

		<nav role="navigation">
			<?php wp_nav_menu(array(
			'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
			'container_class' => 'footer-links',         // class of container (should you choose to use it)
			'menu' => __( 'Footer Links', 'sepalandseedtheme' ),   // nav name
			'menu_class' => 'nav footer-nav',            		// adding custom nav class
			'theme_location' => 'footer-links',             // where it's located in the theme
			'before' => '',                                 // before the menu
			'after' => '',                                  // after the menu
			'link_before' => '',                            // before each link
			'link_after' => '',                             // after each link
			'depth' => 0,                                   // limit the depth of the nav
			'fallback_cb' => false												  // fallback function
			)); ?>
		</nav>

		<div class="colophon">
			<div class="social">
				<a target="_blank" href="https://twitter.com/curatingkisumu"><i class="icon-twitter"></i></a>
				<a target="_blank" href="https://www.facebook.com/curatingkisumu/"><i class="icon-facebook"></i></a>
				<a target="_blank" href="https://www.youtube.com/channel/UCiHA8Vz7Cwlpdy7KkZLXCKw"><i class="icon-youtube-play"></i></a>
			</div>
		</div>

		<p class="credits" style="text-align:center;" class="source-org copyright">&copy; <?php echo date('Y'); ?> <a href="https://www.maseno.ac.ke/" taget="_blank">Maseno University</a> and <a href="https://www.csuohio.edu/" taget="_blank">Cleveland State University</a>.<br>With support from the <a href="https://www.neh.gov/" taget="_blank">National Endowment for the Humanities</a><br><br><strong><em>Visit the <a href="https://archive.macleki.org">Kisumu Archive</a> for more historic and contemporary images.</em></strong><br></p>

	</footer>

	<?php wp_footer(); ?>

</body>
</html>
