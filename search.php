<?php get_header(); ?>
<?php
$s=get_search_query();
$args = array(
                's' =>$s
            );
    // The Query
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) {
        _e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>");
        while ( $the_query->have_posts() ) {
           $the_query->the_post();
                 ?>
                    <!-- Display serach result have_posts -->
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
				          <a href="<?php the_permalink(); ?>">Läs mer...</a>
				        </div>
				      </div>
	      			<!-- End result posts-->
                 <?php
        }
    }else{
?>
        <h2 style='font-weight:bold;color:#000'>Din sökning gav ingen träff</h2>
        <div class="alert alert-info">
          <p>Tyvärr, men ingenting matchade dina sökkriterier. Vänligen försök igen med några andra/olika sökord.</p>
        </div>
<?php } ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>