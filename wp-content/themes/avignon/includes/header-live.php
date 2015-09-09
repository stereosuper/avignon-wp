<div id="mask"></div>
<div id="bloc-top">
	<?php
		$styleImg = '';
		if(/*!is_single() && */!is_home() && !is_archive() && has_post_thumbnail()){
			$styleImg = 'style="background-image:url('. wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) .')"';
		}else if(get_field('liveImg', 'options')){
			$styleImg = 'style="background-image:url('. get_field('liveImg', 'options') .')"';
		}
	?>
	<div id="bg-top" <?php echo $styleImg; ?>></div>
</div>