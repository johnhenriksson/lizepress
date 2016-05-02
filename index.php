<?php
get_header ();

?>

<?php
if (have_posts()) :
	while (have_posts()) : the_post();
	?>
	<?php 
	$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
	 ?>
	<div class="row">
        <div class="col s12 m12">
          <div class="card">
          <?php if (has_post_thumbnail()) : ?>
          	<a href="<?php the_permalink(); ?>">
            <div class="card-image">
				<img src="<?php echo $thumb_url[0]; ?>" class="responsive-img">
              <span class="card-title"><?php the_title();?></span>
            </div>
            </a>
            <div class="card-content">
           <?php else : ?>
           	<div class="card-content">
              <span class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span>
        	<?php endif; ?>
            
              <p><?php the_excerpt(); ?></p>
            </div>
            <div class="card-action">
              <a href="<?php the_permalink(); ?>">Read more...</a>
            </div>
          </div>
        </div>
      </div>
	<?php endwhile; ?>
	<div class="row">
		<div class="col s12 m12 pagination">
			<h5 class="left-align"><?php previous_posts_link(); ?></h5><h5 class="right-align"><?php next_posts_link(); ?></h5>
		</div>
	</div>
		
	
	

	<?php

	else :
		echo '<p>No content found</p>';

	endif;
?>

<?php
get_footer ();
?>