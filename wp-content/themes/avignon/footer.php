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
			<script src="http://use.typekit.net/rwg3qyk.js"></script>
			<script>try{Typekit.load();}catch(e){}</script>

			<?php wp_footer(); ?>

			<?php if(is_front_page()){ ?>
				<script defer> 
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

				<script defer>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
				if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
				fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

				<script defer>
				  window.fbAsyncInit = function() {
				    FB.init({
				      appId      : '932551300139293',
				      xfbml      : true,
				      version    : 'v2.4'
				    });
				  };

				  (function(d, s, id){
				     var js, fjs = d.getElementsByTagName(s)[0];
				     if (d.getElementById(id)) {return;}
				     js = d.createElement(s); js.id = id;
				     js.src = "http://connect.facebook.net/en_US/sdk.js";
				     fjs.parentNode.insertBefore(js, fjs);
				   }(document, 'script', 'facebook-jssdk'));
				</script>

				<div id="fb-root"></div>
				<script defer>
				(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "http://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=932551300139293";
				  fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
				</script>
			<?php } ?>

		</div>

	</body>
</html>
