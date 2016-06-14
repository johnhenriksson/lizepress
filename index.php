<?php
get_header ();

?>
<!-- Main content -->
<div class="row">
	<!-- Posts -->
	<div class="col s8 m8">
		<?php
		if (have_posts()) :
			while (have_posts()) : the_post();
			?>
		<?php
		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
		 ?>
      	<?php if (has_post_thumbnail()) : ?>
	      <div class="card large">
	      	<a href="<?php the_permalink(); ?>">
	        <div class="card-image">
				<img src="<?php echo $thumb_url[0]; ?>" class="responsive-img">
	          <!-- <span class="card-title"><h4><?php the_title();?></h4></span> -->
	        </div>
	        </a>
	        <div class="card-content">
	        <span class="card-title"><h5><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h5></span>
	       <?php else : ?>
	        <div class="card">
	       	<div class="card-content">
	          <span class="card-title"><h5><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h5></span>
	    	<?php endif; ?>

	          <p><?php the_excerpt(); ?></p>
	        </div>
	        <div class="card-action">
	          <a href="<?php the_permalink(); ?>">Read more...</a>
	        </div>
	      </div>
		<?php endwhile; ?>
	</div>
    <!-- End posts -->

	<!-- Sidebar -->
	<div class="col s4 m4">
		<!-- Search -->
		<div class="row">
			<?php get_search_form(); ?>
		</div>
		<!-- End Search -->
		<!-- Categories -->
		<div class="row">
			<h5>Categories</h5>
			<div class="collection">
				<?php 
					$categories = get_categories();
					$cur_category = get_category( get_query_var( 'cat' ) );
					// $cur_cat_id = $cur_category->cat_ID;
					
					foreach ($categories as $category) {
						if ($category == $cur_category) {
							echo '<a class="collection-item active" href="'.get_category_link($category).'">'.$category->name."</a>";
						}else{
							echo '<a class="collection-item" href="'.get_category_link($category).'">'.$category->name."</a>";	
						}
						
					 } 
				?>		
			</div>
		</div>
		<!-- End Categories -->
	</div>
	<!-- End sidebar -->
</div>
<!-- End Maint Content -->

<!-- Pagination -->
<div class="row">
	<div class="col s12 m12 pagination">
		<h5 class="left-align"><?php previous_posts_link(); ?></h5><h5 class="right-align"><?php next_posts_link(); ?></h5>
	</div>
</div>
<!-- End Pagination -->




	<?php

	else :
		echo '<p>No content found</p>';

	endif;
?>

<?php
get_footer ();
?>
