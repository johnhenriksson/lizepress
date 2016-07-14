<?php
// Humle Metabox
add_action( 'add_meta_boxes', 'humle_add_custom_box' );

/* Do something with the data entered */
add_action( 'save_post', 'humle_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function humle_add_custom_box() {
    add_meta_box(
        'humle_sectionid',
        __( 'Humle', 'myplugin_textdomain' ),
        'humle_inner_custom_box',
        'recept');
}

/* Prints the box content */
function humle_inner_custom_box() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
    <div id="meta_inner">
    <?php

    //get the saved meta as an arry
    $hops = get_post_meta($post->ID,'hops',true);

    $c = 0;
    if ( count( $hops ) > 0 ) {
        foreach( $hops as $hop ) {
            if ( isset( $hop['name'] ) || isset( $hop['wieght'] ) ) {
                printf( '<p>Humlesort <input type="text" name="hops[%1$s][name]" value="%2$s" /> -- Vikt(g) : <input type="text" name="hops[%1$s][wieght]" value="%3$s" /><span class="remove">%4$s</span></p>', $c, $hop['name'], $hop['wieght'], __( 'Ta bort Humle' ) );
                $c = $c +1;
            }
        }
    }

    ?>
<span id="humle"></span>
<span class="add_humle"><?php _e('<button class="button">Lägg till Humle</button>'); ?></span>
<script>
    var $ =jQuery.noConflict();
    $(document).ready(function() {
        var count = <?php echo $c; ?>;
        $(".add_humle").click(function() {
            count = count + 1;

            $('#humle').append('<p> Humlesort <input type="text" name="hops['+count+'][name]" value="" /> -- Vikt(g) : <input type="text" name="hops['+count+'][wieght]" value="" /><span class="remove">Ta bort Humle</span></p>' );
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
function humle_save_postdata( $post_id ) {
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

    $hops = $_POST['hops'];

    update_post_meta($post_id,'hops',$hops);
}

// end Humle

?>
