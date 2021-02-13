//PHP OB
<?php ob_start(); ?>
<html>
<?php $html = ob_get_clean();
return $html; ?>




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