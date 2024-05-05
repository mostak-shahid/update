//PHP OB
<?php ob_start(); ?>
<html>
<?php $html = ob_get_clean();
return $html; ?>

<?php
// Create custom page
add_action( 'init',  function() {
    add_rewrite_rule( 
        'myparamname/([a-z0-9-]+)[/]?$', 
        'index.php?myparamname=$matches[1]', 
        'top' 
    );
});
    
add_filter( 'query_vars', function( $query_vars ) {
    $query_vars[] = 'myparamname';
    return $query_vars;
});
    
add_filter( 'template_include', function( $template ) {
    if ( get_query_var( 'myparamname' ) == false || get_query_var( 'myparamname' ) == '' ) {
        return $template;
    }
    return get_template_directory() . '/template-name.php';
}); 
    
?>
<?php
//Create child page 
add_action('init', function () {
    add_rewrite_endpoint('account', EP_PERMALINK | EP_PAGES);
    add_rewrite_endpoint('subscriptions', EP_PERMALINK | EP_PAGES);
});
add_filter('query_vars', function ($vars) {
    $vars[] = 'account';
    $vars[] = 'subscriptions';
    return $vars;
});
add_shortcode('account-page', 'account_page_func');
function account_page_func() {
    global $wp;
    $html = '';

    if(isset($wp->query_vars['account'])) {
        $html .= user_account_content();
    }elseif(isset($wp->query_vars['subscriptions'])) {
        $html .= user_subscriptions_content();
    } else {
        $html .= user_dashboard_content();
    } 
    return $html;
}  
add_action( 'template_redirect', 'mos_404_redirect' );
function mos_404_redirect() {
    global $wp_query;

    if ( 
        (array_key_exists("account",$wp_query->query) || array_key_exists("subscriptions",$wp_query->query)) && 
        !$wp_query->is_page( 'dashboard' )){
        $wp_query->set_404();
//        status_header(404);
    }
    if ($wp_query->is_page( 'dashboard' ) && !is_user_logged_in()) {
        $wp_query->set_404();
    }
}
?>    
<?php
//Wordpress Redirect 404 Page

add_action( 'template_redirect', 'mos_redirect_post' );
add_action( 'wp', 'mos_redirect_post' );

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
<?php
//Redirect login.php
add_action('init', 'custom_login');
if ( ! function_exists( 'custom_login' ) ) {
    function custom_login(){
        global $pagenow;
        if ('wp-login.php' == $pagenow) {
             wp_redirect( esc_url( home_url('/sign-in/') ) );
            // No need for the exit() statement here
        }
    }
}
?>
<?php
    // Plugin Dependancy
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    if (!is_plugin_active('woocommerce/woocommerce.php')) {
        add_action('admin_notices','upgrade_store_woo_check');
        add_action("wp_ajax_upgrade_store_ajax_install_plugin", "wp_ajax_install_plugin");
    }
    function upgrade_store_woo_check()
        if (current_user_can('activate_plugins')) {
			if (!is_plugin_active('woocommerce/woocommerce.php') && !file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
?>
				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('Upgrade Store requires %1$s WooCommerce %2$s to be activated.', 'upgrade-store'), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a id="upgrade_store_wooinstall" class="install-now button" data-plugin-slug="woocommerce"><?php esc_html_e('Install Now', 'upgrade-store'); ?></a></p>
				</div>

				<script>
					jQuery(document).on('click', '#upgrade_store_wooinstall', function(e) {
						e.preventDefault();
						var current = jQuery(this);
						var plugin_slug = current.attr("data-plugin-slug");
						var ajax_url = '<?php echo esc_url(admin_url('admin-ajax.php')) ?>';

						current.addClass('updating-message').text('Installing...');

						var data = {
							action: 'upgrade_store_ajax_install_plugin',
							_ajax_nonce: '<?php echo esc_html(wp_create_nonce('updates')); ?>',
							slug: plugin_slug,
						};

						jQuery.post(ajax_url, data, function(response) {
								current.removeClass('updating-message');
								current.addClass('updated-message').text('Installing...');
								current.attr("href", response.data.activateUrl);
							})
							.fail(function() {
								current.removeClass('updating-message').text('Install Failed');
							})
							.always(function() {
								current.removeClass('install-now updated-message').addClass('activate-now button-primary').text('Activating...');
								current.unbind(e);
								current[0].click();
							});
					});
				</script>

			<?php
			} elseif (!is_plugin_active('woocommerce/woocommerce.php') && file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: WooCommerce plugin url start, %2$s: WooCommerce plugin url end */ ?>
					<p><?php printf(esc_html__('Upgrade Store requires %1$s WooCommerce %2$s to be activated.', 'upgrade-store'), '<strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a></strong>'); ?></p>
					<p><a href="<?php echo esc_url(get_admin_url()); ?>plugins.php?_wpnonce=<?php echo esc_attr(wp_create_nonce('activate-plugin_woocommerce/woocommerce.php')); ?>&action=activate&plugin=woocommerce/woocommerce.php" class="button activate-now button-primary"><?php esc_html_e('Activate', 'upgrade-store'); ?></a></p>
				</div>
			<?php
			} elseif (version_compare(get_option('woocommerce_db_version'), '2.5', '<')) {
			?>

				<div id="message" class="error">
					<?php /* translators: %1$s: strong tag start, %2$s: strong tag end, %3$s: plugin url start, %4$s: plugin url end */ ?>
					<p><?php printf(esc_html__('%1$sUpgrade Store is inactive.%2$s This plugin requires WooCommerce 2.5 or newer. Please %3$supdate WooCommerce to version 2.5 or newer%4$s', 'upgrade-store'), '<strong>', '</strong>', '<a href="' . esc_url(admin_url('plugins.php')) . '">', '&nbsp;&raquo;</a>'); ?></p>
				</div>

			<?php
			}
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
