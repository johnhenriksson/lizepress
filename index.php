<?php
get_header ();

?>

<?php
if (have_posts()) :
	while (have_posts()) : the_post();
	?>
  <div class="post">
  <h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
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
  <?php the_content( 'Läs mer av inlägget: ' .  get_the_title() ); ?>
  </div>
  <div class="comments-link">
  <hr width="50%">
   <a href="<?php comments_link(); ?>">
  Inlägget har <?php comments_number( 'ingen kommentar', 'en kommentar', '% kommentarer' ); ?>.
	</a>
	</div>
  <div class="row post-seperator">
  </div>
	<?php endwhile;

	else :
		echo '<p>No content found</p>';

	endif;
?>

<?php
get_footer ();
?>
