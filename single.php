<?php
get_header ();

?>

<?php
if (have_posts()) :
	while (have_posts()) : the_post();
	?>
  <div class="single-content">
  <h1><?php the_title(); ?></h1>
  <?php the_content(); ?>
  </div>
	<?php endwhile;

	else :
		echo '<p>No content found</p>';

	endif;
?>

<?php
get_footer ();
?>