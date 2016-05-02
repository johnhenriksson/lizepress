</div>
<footer class="page-footer">
          <div class="container">
          	<!-- Widget Area -->
			<div class="row">
			<?php if (dynamic_sidebar('footer_widget_area')) : else : endif; ?>
			</div>
            <div class="row">
              <div class="col l6 s12">
                <h5><?php bloginfo('description') ?></h5>
                <p>You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5>Links</h5>
                <?php

                $args = array (
                		'theme_location' => 'footer_menu'
                	);

                	?>

            	<?php wp_nav_menu( $args ); ?>
<!--                 <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                </ul> -->
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            <p><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p>
            </div>
          </div>
        </footer>

<?php wp_footer(); ?>
</body>
</html>