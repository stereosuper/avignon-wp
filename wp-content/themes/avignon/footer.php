		<footer role="contentinfo">
			<div id='motif'></div>
			
			<div class='container'>

				<div id='footer-top'>
					<ul id='menu-footer'>
						<li>
							<h3>Study</h3>
							<?php wp_nav_menu( array( 'theme_location' => 'secondary-study', 'container' => false ) ); ?>
						</li><li>
							<h3>Live</h3>
							<?php wp_nav_menu( array( 'theme_location' => 'secondary-live', 'container' => false ) ); ?>
						</li><li id='social'>
							<h3>Network</h3>
							<?php dynamic_sidebar('footer-social'); ?>
						</li>
					</ul><div id="bloc-contact">
						<h2>Contact Us</h2>
						<?php dynamic_sidebar('footer-contact'); ?>
					</div>
				</div>

				<div id="footer-bottom" class="clearfix">
					<?php dynamic_sidebar('footer-bottom'); ?>
				</div>

			</div>
		</footer>

	</div>

	<?php wp_footer(); ?>
	
	<?php if(is_front_page()){ ?>
		<script> 
			var config = {
				easing: 'ease-in-out',
				over: '0.5s',
				move: '50px',
			    scale: { direction: 'up', power: '0%' },
			    reset: true,
			    vFactor: '0.50',
			    wait: '0.5s',
			    delay: 'onload',
			}
			window.sr = new scrollReveal( config );
		</script>
	<?php } ?>

	</body>
</html>
