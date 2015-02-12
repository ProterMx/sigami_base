			<footer role="contentinfo">

				<div id="inner-footer" class="clearfix">
		          <hr />
		          <div id="widget-footer" class="clearfix row">
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
		            <?php endif; ?>
		          </div>

					<nav class="clearfix">
						<?php
							wp_nav_menu(
								array(
									'menu' => 'footer_links', /* menu name */
									'theme_location' => 'footer_links', /* where in the theme it's assigned */
									'container_class' => 'footer-links clearfix', /* container class */
									'fallback_cb' => array('Sigami_Base','footer_links_fallback') /* menu fallback */
								)
							);
						?>
					</nav>

					<p class="pull-right"><a href="http://320press.com" id="credit320" title="320Press & SIGAMI">SIGAMI</a></p>

					<p class="attribution">&copy; <?php bloginfo('name'); ?></p>

				</div> <!-- end #inner-footer -->

			</footer> <!-- end footer -->

		</div> <!-- end #container -->
			<?php if( current_theme_supports('sigami-ie') ) : ?>
				<!--[if lt IE 7 ]>
				<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
				<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
				<![endif]-->
			<?php endif; ?>


		<?php wp_footer(); // js scripts are inserted using this function ?>
			<?php if( current_theme_supports('sigami-grunt') ) : ?>
			<script src="//localhost:35729/livereload.js"></script>
			<?php endif; ?>
	</body>

</html>