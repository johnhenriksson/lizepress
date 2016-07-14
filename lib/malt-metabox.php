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
    $songs = get_post_meta($post->ID,'songs',true);

    $c = 0;
    if ( count( $songs ) > 0 ) {
        foreach( $songs as $track ) {
            if ( isset( $track['title'] ) || isset( $track['track'] ) ) {
                printf( '<p>Maltsort <input type="text" name="songs[%1$s][title]" value="%2$s" /> -- Vikt(kg) : <input type="text" name="songs[%1$s][track]" value="%3$s" /><span class="remove">%4$s</span></p>', $c, $track['title'], $track['track'], __( 'Ta bort malt' ) );
                $c = $c +1;
            }
        }
    }

    ?>
<span id="here"></span>
<span class="add"><?php _e('Lägg till malt'); ?></span>
<script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
        var count = <?php echo $c; ?>;
        $(".add").click(function() {
            count = count + 1;

            $('#here').append('<p> Maltsort <input type="text" name="songs['+count+'][title]" value="" /> -- Vikt(kg) : <input type="text" name="songs['+count+'][track]" value="" /><span class="remove">Ta bort malt</span></p>' );
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

    $songs = $_POST['songs'];

    update_post_meta($post_id,'songs',$songs);
}

// end malt
?>