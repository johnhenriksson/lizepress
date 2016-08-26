<?php
function crunchify_social_sharing_buttons($content) {
  global $post;
  if(is_singular() || is_home()){

    // Get current page URL
    $crunchifyURL = urlencode(get_permalink());

    // Get current page title
    $crunchifyTitle = str_replace( ' ', '%20', get_the_title());

    // Get Post Thumbnail for pinterest
    $crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

    // Get the comment link
    $commentLink = get_comments_link();

    // Get the comment number
    $commentNumber = get_comments_number();
    if ( comments_open() ){
        if ($commentNumber == 0 ){
            $comments = __('Inlägget har ingen kommentar.');

        } elseif ( $commentNumber > 1) {
            $comments = __(' Inlägget har ').$commentNumber.__(' kommentarer.');
        } else {
            $comments = __('Inlägget har en kommentar.');
        }
    } else {
        $comments = __('Kommentarer är avstängda för detta inlägget.');
    }

    // Construct sharing URL without using any script
    $twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
    $googleURL = 'https://plus.google.com/share?url='.$crunchifyURL;
    $bufferURL = 'https://bufferapp.com/add?url='.$crunchifyURL.'&amp;text='.$crunchifyTitle;
    $whatsappURL = 'whatsapp://send?text='.$crunchifyTitle . ' ' . $crunchifyURL;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$crunchifyURL.'&amp;title='.$crunchifyTitle;

    // Based on popular demand added Pinterest too
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$crunchifyURL.'&amp;media='.$crunchifyThumbnail[0].'&amp;description='.$crunchifyTitle;



    // Add sharing button at the end of page/page content
    $content .= '<div class="comments-link"><hr width="50%">';
    $content .= '<!-- Crunchify.com social sharing. Get your copy here: http://crunchify.me/1VIxAsz -->';
    $content .= '<div class="crunchify-social">';
    $content .= '<h5>DELA PÅ</h5> <a class="crunchify-link crunchify-twitter" href="'. $twitterURL .'" target="_blank">Twitter</a>';
    $content .= '<a class="crunchify-link crunchify-facebook" href="'.$facebookURL.'" target="_blank">Facebook</a>';
    $content .= '<a class="crunchify-link crunchify-whatsapp" href="'.$whatsappURL.'" target="_blank">WhatsApp</a>';
    $content .= '<a class="crunchify-link crunchify-googleplus" href="'.$googleURL.'" target="_blank">Google+</a>';
    $content .= '<a class="crunchify-link crunchify-buffer" href="'.$bufferURL.'" target="_blank">Buffer</a>';
    $content .= '<a class="crunchify-link crunchify-linkedin" href="'.$linkedInURL.'" target="_blank">LinkedIn</a>';
    $content .= '<a class="crunchify-link crunchify-pinterest" href="'.$pinterestURL.'" target="_blank">Pin It</a>';
    $content .= '</div>';
    $content .= '<a href="'.$commentLink.'">';
    $content .= $comments.'</a>';
    $content .= '</div>';

    return $content;
  }else{
    // if not a post/page then don't include sharing button
    return $content;
  }
};
add_filter( 'the_content', 'crunchify_social_sharing_buttons');

?>
