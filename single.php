<?php
get_header ();

?>

<?php
if (have_posts()) :
	while (have_posts()) : the_post();
	?>
  <div class="post">
  <h1 class="post-title"><?php the_title(); ?></h1>
  <div class="post-meta">
  <?php echo get_the_date(); ?> av <?php echo the_author_posts_link(); ?> -
  <?php
    $categories = get_the_category();
    $separator = ' | ';
    $output = '';
    if ( ! empty( $categories ) ) {
        foreach( $categories as $category ) {
            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
        }
        echo trim( $output, $separator );
    }
   ?>
  </div>
  <?php the_content(); ?>
  </div>
	<?php endwhile;

	else :
		echo '<p>No content found</p>';

	endif;
?>
<?php comments_template(); ?>
<?php
get_footer ();
?>
