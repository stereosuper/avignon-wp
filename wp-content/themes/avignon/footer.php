		<footer role="contentinfo">
			<?php if(get_field('displayFooterTop')){ ?>
			<?php $alumni = new WP_Query(array( 'post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'alumni.php')); ?>
				<?php if(is_page_template('alumni.php') || $post->post_parent == $alumni->post->ID || is_home() || is_singular('post')){ ?>
					<div class='footer-alumni'>
						<div class='container'>
							<?php get_template_part( 'includes/bloc-alumni' ); ?>
						</div>
					</div>
				<?php }else{ ?>
				<div id='motif'>
					<div class='container'>
						<?php if(get_field('admissionsTitle', 'options')){ ?>
						    <h2><?php the_field('admissionsTitle', 'options'); ?></h2>
						<?php } if(get_field('admissionsText', 'options')){ ?>
						    <p><?php the_field('admissionsText', 'options'); ?></p>
						<?php } if(get_field('admissionsBtn', 'options') && get_field('admissionsUrl', 'options')){ ?>
						    <a href="<?php the_field('admissionsUrl', 'options'); ?>" class='btn'>
						    	<?php the_field('admissionsBtn', 'options'); ?>
						    </a>
						<?php } ?>
					</div>
				</div>
				<?php } ?>
			<?php }else{ ?>
				<div id='motif'></div>
			<?php } ?>
			
			<div class='container'>

				<div id='footer-top'>
					<ul id='menu-footer'>
						<li>
							<h3>Study</h3>
							<?php wp_nav_menu( array( 'theme_location' => 'footer-study', 'container' => false ) ); ?>
						</li><li>
							<h3>Live</h3>
							<?php wp_nav_menu( array( 'theme_location' => 'footer-live', 'container' => false ) ); ?>
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
