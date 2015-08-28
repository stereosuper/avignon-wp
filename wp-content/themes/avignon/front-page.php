<?php 
/*
Template Name: Home
*/

get_header(); ?>
	
	<div id="bloc-top" class="bloc-top-home">
  		<div id="bg-top"></div>

  		<div id="container-bloc-txt-home">
  			<div id="wrapper-bloc-logo-home">
	  			<div id="bloc-logo-home">
					<span class="visu-bloc-logo"></span>
					<span class="txt-bloc-logo"><strong>Institut</strong> d'Avignon</span>
	  			</div>
  			</div>
			
			<div id="wrapper-bloc-txt-home">
				<div id="bloc-txt-home">
					<h1>
						<a href="#zone-left-study" id="btn-study">Study</a> <i>&amp;</i> 
						<a href="#live-top" id="btn-live">Live</a><br /> <span class="txt-h1">in Avignon</span>
					</h1>
					<p>A six-week intensive program in French Literature, History, and Theater studies, Founded in 1962 by Michel Guggenheim &amp; René Girard<br /> under the auspices of Bryn Mawr College</p>
				</div>
	  		</div>

  		</div>
  	</div>

	<div class="bloc-content white-bg" role='main'>

		<?php if ( have_posts() ) : the_post(); ?>

		  	<div id="zone-left-study">

		  		<div id="bloc-img-zone-left-study">
					<div class="content-bloc-img-zone imgLiquidFill">
						<img src="<?php echo get_template_directory_uri(); ?>/img/img-study-left.jpg">
					</div>
		  		</div>

				<div id="bloc-txt-zone-left-study">
					<h2 class="h1">Study</h2>
					<h3 class="h2">Curriculum</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pretium ante, sed ultrices eros. Etiam porttitor purus enim, sit amet consectetur sem eget. Donec nec ante, sed ultrices eros. Etiam porttitor purus enim, sit amet sem pellentesque eget. nec ante, sed ultrices eros. Etiam purus, sit amet consectetur sem pellentesque eget.</p>
					<a href="#" class="btn">All courses</a>
				</div>

		  	</div><div id="zone-right-study">
		  		
		  		<div id="bloc-img-zone-right-study">
					<div class="content-bloc-img-zone imgLiquidFill">
						<img src="<?php echo get_template_directory_uri(); ?>/img/img-study-right.jpg">
					</div>
		  		</div>

				<div id="bloc-txt-zone-right-study">
					<div id="bloc-apply-home" class="bloc-bg-pattern">
						<h3 class="h2">Apply</h3>
						<div id="zone-txt-bloc-apply">
							<div id="zone-txt-left-bloc-apply">
								<p>Lorem ipsum dolor sit amet, clit. Donec nec prit amet consectetur sem pellentesque eget.</p>
							</div>
							<div id="zone-txt-right-bloc-apply">
								<a href="#" class="btn btn-grey">Apply</a>
							</div>
						</div>
					</div>

					<div id="bloc-faculty-home">
						<h3 class="h2">Faculty</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pretium ante, sed ultrices eros. Etiam porttitor purus enim, sit amet consectetur sem pellentesque eget.</p>
						<ul id="links-faculty">
							<li>
								<a class="btn-arrow" href="#">See faculty's list</a>
							</li><li>
								<a class="btn-arrow" href="#">See calendar</a>
							</li>
						</ul>
					</div>
				</div>
		  	
		  	</div>

		  	<div id="bloc-info-avignon" class="bloc-content bloc-bg-pattern">
		  		
		  		<div class="container">
		  			<div id="bloc-img-left2-live" class="bloc-img-border" data-sr='move 0px'>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<img src="<?php echo get_template_directory_uri(); ?>/img/img-live-left2.jpg">
		  				</div>
		  			</div>

		  			<div id="bloc-img-right1-live" class="bloc-img-border" data-sr>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<img src="<?php echo get_template_directory_uri(); ?>/img/img-live-right1.jpg">
		  				</div>
		  			</div>

		  			<div id="bloc-img-right3-live" class="bloc-img-border" data-sr>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<img src="<?php echo get_template_directory_uri(); ?>/img/img-live-right3.jpg">
		  				</div>
		  			</div>

		  			<div id="bloc-img-right2-live" class="bloc-img-border" data-sr>
		  				<div class="content-bloc-img imgLiquidFill">
		  					<img src="<?php echo get_template_directory_uri(); ?>/img/img-live-right2.jpg">
		  				</div>
		  			</div>
		  			
		  			<div id="live-top">
		  				<div id="bloc-live-home">
		  					<h2 class="h1">Live</h2>
		  					<h3 class="h2">Discover Avignon</h3>
		  					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pretium ante, sed ultrices eros. Etiam porttitor purus enim, sit amet sempellentesque eget. Donec nec pretium ante, sed ultrices eros. Etiam porttitor purus enim, sit amet consectetur sem pellentesque eget.</p>
		  					<a href="#" class="btn">Living in Avignon</a>
		  				</div>
		  			</div>

		  			<div id="container-live-left-right" class="clearfix">
		  				<div id="live-right">

		  					<div id="bloc-activities-home">
		  						<h3 class="h2">Activities</h3>
		  						<p>Lorem ipsum dolor sit amet, consectetur adipiretium ante, sed ultrices eros.</p>
		  						<ul class="activities">
		  							<li>
		  								<div class="activities-date">
		  									<span>13 juin</span>
		  								</div>
		  								<div class="activities-title">
		  									Visite guidée d'Avignon
		  								</div>
		  							</li><li>
		  								<div class="activities-date">
		  									<span>17 juin</span>
		  								</div>
		  								<div class="activities-title">
		  									Uzès &amp; Pont-du-Gard (canoë)
		  								</div>
		  							</li><li>
		  								<div class="activities-date">
		  									<span>20 juin</span>
		  								</div>
		  								<div class="activities-title">
		  									Cours de cuisine à <a href="#">La Mirande</a>
		  								</div>
		  							</li>
		  						</ul>
		  						<a href="#" class="btn">All activities</a>
		  					</div>

		  				</div><div id="live-left">
		  					
		  					<div id="bloc-img-left1-live" class="bloc-img-border" data-sr>
		  						<div class="content-bloc-img imgLiquidFill">
		  							<img src="<?php echo get_template_directory_uri(); ?>/img/img-live-left1.jpg">
		  						</div>
		  					</div>
		  					
		  					<div id="bloc-twitter-home">
		  						<h5><strong>#livingAvignon</strong> on Twitter</h5>
		  						<p>Students are tweeting with this hashtag to share their experience</p>
		  						<a class="twitter-timeline" href="https://twitter.com/hashtag/avignon" data-widget-id="628465755189809152" data-chrome="noheader nofooter noborders">Tweets sur #avignon</a>
		  						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
		  						</script>
		  						<a href="#" class="btn">All Tweets</a>
		  					</div>
		  				</div>
		  			</div>
		  			
		  			<div id="bloc-alumni">
		  				<h3 class="h2">Avignon Institute Alumni</h3>
		  				<div id="bloc-alumni-stories">
		  					<h4>Blog : Alumni's stories</h4>
		  					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pretium ante, sed ultrices eros. Etiam Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pretium ante, sed ultrices eros.</p>
		  					<a href="#" class="btn btn-grey btn-full-width">Share your experience</a>
		  					<p>You wants to share your own experience ? <a class="btn-arrow btn-white" href="#">Get involved</a></p>
		  				</div><div id="bloc-alumni-fb">
		  					<h4>Join our community on Facebook</h4>
		  					<div class="imgLiquidFill" id="bg-img-facebook"><img src="<?php echo get_template_directory_uri(); ?>/img/bg-facebook.jpg"></div>
		  					<div class="fb-page" data-href="https://www.facebook.com/pages/Bryn-Mawr-College-Institut-dEtudes-Fran%C3%A7aises-dAvignon/99327867676" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/pages/Bryn-Mawr-College-Institut-dEtudes-Fran%C3%A7aises-dAvignon/99327867676"><a href="https://www.facebook.com/pages/Bryn-Mawr-College-Institut-dEtudes-Fran%C3%A7aises-dAvignon/99327867676">Bryn Mawr College/ Institut d&#039;Etudes Françaises d&#039;Avignon</a></blockquote></div></div>
		  				</div>
		  				
		  				<div id="bloc-contribute">
		  					<div id="content-bloc-contribute">
		  						<h3 class="h2">Contribute</h3>
		  						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pretium ante, sed ultrices eros. Etiam Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec nec pretium ante, sed ultrices eros. Etiam </p>
		  						<a href="#" class="btn btn-grey-2">support the Institut</a>
		  					</div>
		  					
		  					<div id="img-bloc-contribute">
		  						<ul id="images-contribute">
		  							<li class="imgLiquidFill">
		  								<img src="<?php echo get_template_directory_uri(); ?>/img/contribute/contribute-1.jpg" alt="">
		  							</li><li class="imgLiquidFill">
		  								<img src="<?php echo get_template_directory_uri(); ?>/img/contribute/contribute-2.jpg" alt="">
		  							</li><li class="imgLiquidFill">
		  								<img src="<?php echo get_template_directory_uri(); ?>/img/contribute/contribute-3.jpg" alt="">
		  							</li><li class="imgLiquidFill">
		  								<img src="<?php echo get_template_directory_uri(); ?>/img/contribute/contribute-4.jpg" alt="">
		  							</li><li class="imgLiquidFill">
		  								<img src="<?php echo get_template_directory_uri(); ?>/img/contribute/contribute-5.jpg" alt="">
		  							</li><li class="imgLiquidFill">
		  								<img src="<?php echo get_template_directory_uri(); ?>/img/contribute/contribute-6.jpg" alt="">
		  							</li>
		  						</ul>
		  					</div>
		  				</div>
		  				
		  				<div id="bloc-facebook-responsive">
		  					<h4>Join our community on Facebook</h4>
		  					<div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
		  				</div>
		  			</div>
		  	  	
		  	  	</div>				
		  	</div>
				
		<?php else : ?>
						
			<h1>404</h1>

		<?php endif; ?>

	</div>

<?php get_footer(); ?>