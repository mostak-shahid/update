//PHP OB
<?php ob_start(); ?>
<html>
<?php $html = ob_get_clean();
return $html; ?>



<?php
//Wordpress Redirect Page

add_action( 'template_redirect', 'mos_redirect_post' );

function mos_redirect_post() {
    if ( is_singular( 'query' ) ) {
//        wp_redirect( home_url(), 301 );
//        exit;

        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        get_template_part( 404 ); 
        exit();
    }
}

?>
<!--Attatchment detgails-->
<?php wp_get_attachment_metadata( $attachment_id, $unfiltered ); ?>
<?php wp_get_attachment_image( int $attachment_id, string|array $size = 'thumbnail', bool $icon = false, string|array $attr = '' ) ?>
<?php wp_get_attachment_url( $attachment_id ); ?>
<?php var_dump(wp_get_attachment_image_src( $attachment_id, 'full-width-image')) ?>

		$attachment_size_url = wp_get_attachment_image_src( $attachment_id, 'full-width-image')[0];
		$attachment_title = get_the_title($attachment_id);	
		$attachment_description = get_post_field('post_content', $attachment_id);	
		$attachment_caption = get_the_excerpt( $attachment_id );	
		$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

<!--Attatchment detgails-->