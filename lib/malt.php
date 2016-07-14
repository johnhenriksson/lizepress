<?php
// Malt Metabox
add_action( 'add_meta_boxes', 'malt_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'malt_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function malt_add_custom_box() {
    add_meta_box(
        'malt_sectionid',
        __( 'Malt', 'myplugin_textdomain' ),
        'malt_inner_custom_box',
        'recept');
}

/* Prints the box content */
function malt_inner_custom_box() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
    <div id="meta_inner">
    <?php

    //get the saved meta as an arry
    $malts = get_post_meta($post->ID,'malts',true);

    $c = 0;
    if ( count( $malts ) > 0 ) {
        foreach( $malts as $malt ) {
            if ( isset( $malt['name'] ) || isset( $malt['weight'] ) ) {
                printf( '<p>Maltsort <input type="text" name="malts[%1$s][name]" value="%2$s" /> -- Vikt(kg) : <input type="text" name="malts[%1$s][weight]" value="%3$s" /><span class="remove">%4$s</span></p>', $c, $malt['name'], $malt['weight'], __( 'Ta bort malt' ) );
                $c = $c +1;
            }
        }
    }

    ?>
<span id="malt"></span>
<span class="add_malt"><?php _e('<button class="button">Lägg till malt</button>'); ?></span>
<script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
        var count = <?php echo $c; ?>;
        $(".add_malt").click(function() {
            count = count + 1;

            $('#malt').append('<p> Maltsort <input type="text" name="malts['+count+'][name]" value="" /> -- Vikt(kg) : <input type="text" name="malts['+count+'][weight]" value="" /><span class="remove">Ta bort malt</span></p>' );
            return false;
        });
        $(".remove").live('click', function() {
            $(this).parent().remove();
        });
    });
    </script>
</div>
<?php

}

/* When the post is saved, saves our custom data */
function malt_save_postdata( $post_id ) {
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !isset( $_POST['dynamicMeta_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
        return;

    // OK, we're authenticated: we need to find and save the data

    $malts = $_POST['malts'];

    update_post_meta($post_id,'malts',$malts);
}

// end malt

?>
