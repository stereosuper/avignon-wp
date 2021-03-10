				<footer role="contentinfo">
					<?php if(get_field('displayFooterTop')){ ?>
					<?php $alumni = new WP_Query(array( 'post_type' => 'page', 'meta_key' => '_wp_page_template', 'meta_value' => 'alumni.php', 'post_parent' => 0)); ?>
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
								<?php } if(get_field('admissionsImg', 'options')){ ?>
									<div class="imgLiquidFill">
										<?php echo wp_get_attachment_image( get_field('admissionsImg', 'options'), 'full' ); ?>
									</div>
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

			<!-- Le Monde Livres -->
			<script src="//use.typekit.net/rwg3qyk.js"></script>

			<?php wp_footer(); ?>

		</div>

	</body>
</html>
