<?php

/*
Plugin Name: Cryptocurrency Product for WooCommerce
Plugin URI: https://wordpress.org/plugins/cryptocurrency-product-for-woocommerce
Description: Cryptocurrency Product for WooCommerce enables customers to buy Ether or any ERC20 or ERC223 token on your WooCommerce store for fiat, bitcoin or any other currency supported by WooCommerce.
Version: 3.8.1
WC requires at least: 3.0.0
WC tested up to: 4.6.2
Author: ethereumicoio
Author URI: https://ethereumico.io
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: cryptocurrency-product-for-woocommerce
Domain Path: /languages
*/
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Explicitly globalize to support bootstrapped WordPress
global 
    $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_basename,
    $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options,
    $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_dir,
    $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_url_path,
    $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_product
;
if ( !function_exists( 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_deactivate' ) ) {
    function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_deactivate()
    {
        if ( !current_user_can( 'activate_plugins' ) ) {
            return;
        }
        deactivate_plugins( plugin_basename( __FILE__ ) );
    }

}

if ( PHP_INT_SIZE != 8 ) {
    add_action( 'admin_init', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_deactivate' );
    add_action( 'admin_notices', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice' );
    function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice()
    {
        if ( !current_user_can( 'activate_plugins' ) ) {
            return;
        }
        echo  '<div class="error"><p><strong>Cryptocurrency Product for WooCommerce</strong> requires 64 bit architecture server.</p></div>' ;
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }

} else {
    
    if ( version_compare( phpversion(), '7.0', '<' ) ) {
        add_action( 'admin_init', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_deactivate' );
        add_action( 'admin_notices', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice' );
        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice()
        {
            if ( !current_user_can( 'activate_plugins' ) ) {
                return;
            }
            echo  '<div class="error"><p><strong>Cryptocurrency Product for WooCommerce</strong> requires PHP version 7.0 or above.</p></div>' ;
            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }
    
    } else {
        
        if ( !function_exists( 'gmp_init' ) ) {
            add_action( 'admin_init', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_deactivate' );
            add_action( 'admin_notices', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice_gmp' );
            function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice_gmp()
            {
                if ( !current_user_can( 'activate_plugins' ) ) {
                    return;
                }
                echo  '<div class="error"><p><strong>Cryptocurrency Product for WooCommerce</strong> requires  <a target="_blank" href="http://php.net/manual/en/book.gmp.php">GMP</a> module to be installed.</p></div>' ;
                if ( isset( $_GET['activate'] ) ) {
                    unset( $_GET['activate'] );
                }
            }
        
        } else {
            
            if ( !function_exists( 'mb_strtolower' ) ) {
                add_action( 'admin_init', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_deactivate' );
                add_action( 'admin_notices', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice_mbstring' );
                function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice_mbstring()
                {
                    if ( !current_user_can( 'activate_plugins' ) ) {
                        return;
                    }
                    echo  '<div class="error"><p><strong>Cryptocurrency Product for WooCommerce</strong> requires  <a target="_blank" href="http://php.net/manual/en/book.mbstring.php">Multibyte String (mbstring)</a> module to be installed.</p></div>' ;
                    if ( isset( $_GET['activate'] ) ) {
                        unset( $_GET['activate'] );
                    }
                }
            
            } else {
                /**
                 * Check if WooCommerce is active
                 * https://wordpress.stackexchange.com/a/193908/137915
                 **/
                
                if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                    add_action( 'admin_init', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_deactivate' );
                    add_action( 'admin_notices', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice_woocommerce' );
                    function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_admin_notice_woocommerce()
                    {
                        if ( !current_user_can( 'activate_plugins' ) ) {
                            return;
                        }
                        echo  '<div class="error"><p><strong>Cryptocurrency Product for WooCommerce</strong> requires WooCommerce plugin to be installed and activated.</p></div>' ;
                        if ( isset( $_GET['activate'] ) ) {
                            unset( $_GET['activate'] );
                        }
                    }
                
                } else {
                    
                    if ( function_exists( 'cryptocurrency_product_for_woocommerce_freemius_init' ) ) {
                        cryptocurrency_product_for_woocommerce_freemius_init()->set_basename( false, __FILE__ );
                    } else {
                        // Create a helper function for easy SDK access.
                        function cryptocurrency_product_for_woocommerce_freemius_init()
                        {
                            global  $cryptocurrency_product_for_woocommerce_freemius_init ;
                            
                            if ( !isset( $cryptocurrency_product_for_woocommerce_freemius_init ) ) {
                                // Include Freemius SDK.
                                require_once dirname( __FILE__ ) . '/vendor/freemius/wordpress-sdk/start.php';
                                $cryptocurrency_product_for_woocommerce_freemius_init = fs_dynamic_init( array(
                                    'id'              => '4418',
                                    'slug'            => 'cryptocurrency-product-for-woocommerce',
                                    'type'            => 'plugin',
                                    'public_key'      => 'pk_ad7ad2f13633e6e97e62528e0259b',
                                    'is_premium'      => false,
                                    'premium_suffix'  => 'Professional',
                                    'has_addons'      => true,
                                    'has_paid_plans'  => true,
                                    'trial'           => array(
                                    'days'               => 7,
                                    'is_require_payment' => true,
                                ),
                                    'has_affiliation' => 'all',
                                    'menu'            => array(
                                    'slug'   => 'cryptocurrency-product-for-woocommerce',
                                    'parent' => array(
                                    'slug' => 'options-general.php',
                                ),
                                ),
                                    'is_live'         => true,
                                ) );
                            }
                            
                            return $cryptocurrency_product_for_woocommerce_freemius_init;
                        }
                        
                        // Init Freemius.
                        cryptocurrency_product_for_woocommerce_freemius_init();
                        // Signal that SDK was initiated.
                        do_action( 'cryptocurrency_product_for_woocommerce_freemius_init_loaded' );
                        // ... Your plugin's main file logic ...
                        $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_basename = plugin_basename( dirname( __FILE__ ) );
                        $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_dir = untrailingslashit( plugin_dir_path( __FILE__ ) );
                        $plugin_url_path = untrailingslashit( plugin_dir_url( __FILE__ ) );
                        // HTTPS?
                        $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_url_path = ( is_ssl() ? str_replace( 'http:', 'https:', $plugin_url_path ) : $plugin_url_path );
                        // Set plugin options
                        $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options = get_option( 'cryptocurrency-product-for-woocommerce_options', array() );
                        require $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_dir . '/vendor/autoload.php';
                        require_once $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_dir . '/vendor/woocommerce/action-scheduler/action-scheduler.php';
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_product_type_options( $product_type_options )
                        {
                            $cryptocurrency = array(
                                'cryptocurrency_product_for_woocommerce_cryptocurrency_product_type' => array(
                                'id'            => '_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type',
                                'wrapper_class' => 'show_if_simple show_if_variable',
                                'label'         => __( 'Cryptocurrency', 'cryptocurrency-product-for-woocommerce' ),
                                'description'   => __( 'Make product a cryptocurrency.', 'cryptocurrency-product-for-woocommerce' ),
                                'default'       => 'no',
                            ),
                            );
                            // combine the two arrays
                            $product_type_options = array_merge( $cryptocurrency, $product_type_options );
                            //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('product_type_options=' . print_r($product_type_options, true));
                            return apply_filters( 'cryptocurrency_product_for_woocommerce_product_type_options', $product_type_options );
                        }
                        
                        add_filter( 'product_type_options', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_product_type_options' );
                        // Function to check if a product is a cryptocurrency
                        function _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id )
                        {
                            $cryptocurrency = get_post_meta( $product_id, '_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type', true );
                            $is_cryptocurrency = ( !empty($cryptocurrency) ? 'yes' : 'no' );
                            return $is_cryptocurrency === 'yes';
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_meta( $post_id, $post )
                        {
                            global 
                                $wpdb,
                                $woocommerce,
                                $woocommerce_errors,
                                $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options
                            ;
                            $product = wc_get_product( $post_id );
                            if ( !$product ) {
                                return $post_id;
                            }
                            if ( get_post_type( $post_id ) != 'product' ) {
                                return $post_id;
                            }
                            // check if we are called from the product settings page
                            // fix from: https://stackoverflow.com/questions/5434219/problem-with-wordpress-save-post-action#comment6729746_5849143
                            if ( !isset( $_POST['_text_input_cryptocurrency_flag'] ) ) {
                                return $post_id;
                            }
                            if ( !current_user_can( 'edit_product', $post_id ) ) {
                                return $post_id;
                            }
                            $is_cryptocurrency = ( isset( $_POST['_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type'] ) ? 'yes' : 'no' );
                            
                            if ( $is_cryptocurrency != 'yes' ) {
                                delete_post_meta( $post_id, '_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type' );
                                return $post_id;
                            }
                            
                            update_post_meta( $post_id, '_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type', $is_cryptocurrency );
                            //    if ( get_option( "woocommerce_enable_multiples") != "yes" ) {
                            //        update_post_meta( $post_id, '_sold_individually', $is_cryptocurrency );
                            //    }
                            $want_physical = get_option( 'woocommerce_enable_physical' );
                            if ( $want_physical == "no" ) {
                                update_post_meta( $post_id, '_virtual', $is_cryptocurrency );
                            }
                            //
                            // Handle first save
                            //
                            // Select
                            $cryptocurrency_option = $_POST['_select_cryptocurrency_option'];
                            
                            if ( !empty($cryptocurrency_option) ) {
                                update_post_meta( $post_id, '_select_cryptocurrency_option', esc_attr( $cryptocurrency_option ) );
                            } else {
                                update_post_meta( $post_id, '_select_cryptocurrency_option', '' );
                            }
                            
                            //    if ( isset( $_POST['_text_input_cryptocurrency_data'] ) ) {
                            //        update_post_meta( $post_id, '_text_input_cryptocurrency_data', sanitize_text_field( $_POST['_text_input_cryptocurrency_data'] ) );
                            //    }
                            if ( isset( $_POST['_text_input_cryptocurrency_minimum_value'] ) ) {
                                update_post_meta( $post_id, '_text_input_cryptocurrency_minimum_value', sanitize_text_field( $_POST['_text_input_cryptocurrency_minimum_value'] ) );
                            }
                            if ( isset( $_POST['_text_input_cryptocurrency_step'] ) ) {
                                update_post_meta( $post_id, '_text_input_cryptocurrency_step', sanitize_text_field( $_POST['_text_input_cryptocurrency_step'] ) );
                            }
                            do_action(
                                'cryptocurrency_product_for_woocommerce_save_option_field',
                                $cryptocurrency_option,
                                $post_id,
                                $product
                            );
                            $product_id = $post_id;
                            $vendor_id = get_post_field( 'post_author_override', $product_id );
                            if ( empty($vendor_id) ) {
                                $vendor_id = get_post_field( 'post_author', $product_id );
                            }
                            if ( !user_can( $vendor_id, 'vendor' ) ) {
                                // process only vendor's products
                                return $post_id;
                            }
                            $vendor_fee = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['vendor_fee'] ) ? doubleval( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['vendor_fee'] ) : 0 );
                            if ( $vendor_fee <= 0 ) {
                                return $post_id;
                            }
                            // Ether rate
                            $rate = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_ETH_rate( 1 );
                            
                            if ( is_null( $rate ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( 'Failed to get Ether rate' );
                                return $post_id;
                            }
                            
                            $eth_value = $vendor_fee / $rate;
                            $eth_value_wei = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_double_int_multiply( $eth_value, pow( 10, 18 ) );
                            // 1. check balance
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id );
                            $providerUrl = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint();
                            $eth_balance = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBalanceEth( $thisWalletAddress, $providerUrl );
                            
                            if ( null === $eth_balance || $eth_balance->compare( $eth_value_wei ) < 0 ) {
                                // @see https://wordpress.stackexchange.com/a/42178/137915
                                // unhook this function to prevent indefinite loop
                                remove_action( 'save_post', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_meta' );
                                // update the post to change post status
                                wp_update_post( array(
                                    'ID'          => $post_id,
                                    'post_status' => 'draft',
                                ) );
                                // re-hook this function again
                                add_action( 'save_post', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_meta' );
                            }
                        
                        }
                        
                        add_action(
                            'save_post',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_meta',
                            10,
                            2
                        );
                        // @see https://wordpress.stackexchange.com/a/42178/137915
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_redirect_location( $location, $post_id )
                        {
                            //If post was published...
                            
                            if ( isset( $_POST['publish'] ) ) {
                                //obtain current post status
                                $status = get_post_status( $post_id );
                                //The post was 'published', but if it is still a draft, display draft message (10).
                                if ( $status == 'draft' ) {
                                    $location = add_query_arg( 'message', 10, $location );
                                }
                            }
                            
                            return $location;
                        }
                        
                        add_filter(
                            'redirect_post_location',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_redirect_location',
                            10,
                            2
                        );
                        /**
                         * Show pricing fields for cryptocurrency product.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_js()
                        {
                            global  $post ;
                            if ( 'product' != get_post_type() ) {
                                return;
                            }
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_js_aux();
                        }
                        
                        /**
                         * Show pricing fields for cryptocurrency product.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_js_aux()
                        {
                            global  $post ;
                            //    $post_id = $post->ID;
                            //    $product = wc_get_product( $post_id );
                            //    if (!$product) {
                            //        return;
                            //    }
                            //    if (!_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product->get_id() )) {
                            //        return;
                            //    }
                            ?><script type='text/javascript'>
        <?php 
                            ?>

		jQuery( document ).ready( function() {
            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_init();
//			jQuery( '.options_group.pricing' ).addClass( 'show_if_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type' ).show();
			jQuery( '#_select_cryptocurrency_option' ).on( 'change', CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_select_cryptocurrency_option_change);
            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_select_cryptocurrency_option_change();
			jQuery( '#_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type' ).on( 'change', CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_select_cryptocurrency_product_type);
            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_select_cryptocurrency_product_type();
            <?php 
                            ?>

		});

	</script><?php 
                        }
                        
                        add_action( 'admin_footer', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_js' );
                        /**
                         * Amount in base crypto for one $
                         * 
                         * @param int $product_id
                         * @return double
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_( $product_id )
                        {
                            $_product = wc_get_product( $product_id );
                            
                            if ( !$_product ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_({$product_id}) not a product" );
                                return 1;
                            }
                            
                            $price = doubleval( $_product->get_price() );
                            
                            if ( 0 == $price ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_({$product_id}) zero product price" );
                                return 1;
                            }
                            
                            return 1 / $price;
                        }
                        
                        /**
                         * Amount in crypto for one $
                         * 
                         * @param int $product_id
                         * @return double
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_for_1_store_currency( $product_id )
                        {
                            $_product = wc_get_product( $product_id );
                            
                            if ( !$_product ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_({$product_id}) not a product" );
                                return 1;
                            }
                            
                            $price = doubleval( $_product->get_price() );
                            
                            if ( 0 == $price ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_({$product_id}) zero product price" );
                                return 1;
                            }
                            
                            return 1 / $price;
                        }
                        
                        /**
                         * Product price in $
                         * 
                         * @param double $orig_price
                         * @param type $product
                         * @param bool $sale
                         * @return double
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $orig_price, $product, $sale = false )
                        {
                            $product_id = ( !is_null( $product ) ? $product->get_id() : null );
                            if ( $sale && empty($orig_price) ) {
                                return $orig_price;
                            }
                            return $orig_price;
                        }
                        
                        /**
                         * ETH price in $
                         * 
                         * @param double $orig_price
                         * @param type $product
                         * @param bool $sale
                         * @return double
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_ETH_rate( $orig_price )
                        {
                            $product = null;
                            $product_id = null;
                            $sale = false;
                            return $orig_price;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_base_cryptocurrency_symbol( $product_id )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_dir ;
                            $baseCurrency = '';
                            $_select_dynamic_price_source_option = get_post_meta( $product_id, '_select_dynamic_price_source_option', true );
                            if ( empty($_select_dynamic_price_source_option) ) {
                                return $baseCurrency;
                            }
                            return apply_filters(
                                'cryptocurrency_product_for_woocommerce_get_base_cryptocurrency_symbol',
                                $baseCurrency,
                                $_select_dynamic_price_source_option,
                                $product_id
                            );
                        }
                        
                        // @see https://stackoverflow.com/a/47788626/4256005
                        add_filter(
                            'woocommerce_product_get_price',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price',
                            10,
                            2
                        );
                        add_filter(
                            'woocommerce_product_get_sale_price',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_sale_price',
                            10,
                            2
                        );
                        add_filter(
                            'woocommerce_product_get_regular_price',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_regular_price',
                            10,
                            2
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price( $price, $product )
                        {
                            global  $post ;
                            //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price $price: ' . $price);
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product->get_id() ) ) {
                                return $price;
                            }
                            //    if( is_shop() || is_product_category() || is_product_tag() || is_product() || is_cart() || is_checkout() || (wp_doing_ajax() && !is_checkout()) ||
                            //        ( function_exists('get_current_screen') &&
                            //        get_current_screen() && get_current_screen()->parent_base == 'woocommerce' &&
                            //        'shop_order' == get_post_type($post) )
                            //    ) {
                            
                            if ( $product->is_on_sale() ) {
                                if ( empty($price) ) {
                                    return $price;
                                }
                                $sale_price = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $price, $product, true );
                                // / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product->get_id());
                                //            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price $sale_price: ' . $sale_price);
                                return $sale_price;
                            } else {
                                $regular_price = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $price, $product );
                                // / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product->get_id());
                                //            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price $regular_price: ' . $regular_price);
                                return $regular_price;
                            }
                            
                            //    }
                            return $price;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_sale_price( $price, $product )
                        {
                            global  $post ;
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product->get_id() ) ) {
                                return $price;
                            }
                            
                            if ( is_shop() || is_product_category() || is_product_tag() || is_product() || wp_doing_ajax() && !is_checkout() || function_exists( 'get_current_screen' ) && get_current_screen() && get_current_screen()->parent_base == 'woocommerce' && 'shop_order' == get_post_type( $post ) ) {
                                if ( empty($price) ) {
                                    return $price;
                                }
                                $sale_price = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $price, $product, true );
                                // / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product->get_id());
                                //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_sale_price $sale_price: ' . $sale_price);
                                return $sale_price;
                            }
                            
                            return $price;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_regular_price( $price, $product )
                        {
                            global  $post ;
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product->get_id() ) ) {
                                return $price;
                            }
                            
                            if ( is_shop() || is_product_category() || is_product_tag() || is_product() || wp_doing_ajax() && !is_checkout() || function_exists( 'get_current_screen' ) && get_current_screen() && get_current_screen()->parent_base == 'woocommerce' && 'shop_order' == get_post_type( $post ) ) {
                                $regular_price = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $price, $product );
                                // / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product->get_id());
                                //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_regular_price $regular_price: ' . $regular_price);
                                return $regular_price;
                            }
                            
                            return $price;
                        }
                        
                        //add_filter( 'woocommerce_add_cart_item', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item', 20, 2 );
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item( $cart_data, $cart_item_key ) {
                        //    $product_id = $cart_data['product_id'];
                        //    if (!_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id )) {
                        //        return $cart_data;
                        //    }
                        //    $product = wc_get_product($product_id);
                        //    $new_price = $cart_data['data']->get_price();
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item $cart_data[data]->get_price(): ' . $cart_data['data']->get_price());
                        //    // Price calculation
                        //    if ( $product->is_on_sale() ) {
                        //        if (empty($new_price)) {
                        //            return $new_price;
                        //        }
                        //        $product_price = $product->get_sale_price();
                        //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item $product_price: ' . $product_price);
                        //        if ($new_price < $product_price) {
                        //            $new_price = $product_price;
                        //        }
                        ////        $new_price = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $new_price, $product, true ) / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id);
                        //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id): ' . CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id));
                        //        $new_price = $new_price / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id);
                        //    } else {
                        //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $new_price, $product ): ' . CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $new_price, $product ));
                        //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id): ' . CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id));
                        //        $product_price = $product->get_regular_price();
                        //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item $product_price: ' . $product_price);
                        //        if ($new_price < $product_price) {
                        //            $new_price = $product_price;
                        //        }
                        ////        $new_price = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_price( $new_price, $product ) / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id);
                        //        $new_price = $new_price / CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_($product_id);
                        //    }
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_add_cart_item $new_price: ' . $new_price);
                        //
                        //    // Set and register the new calculated price
                        //    $cart_data['data']->set_price( $new_price );
                        //    $cart_data['new_price'] = $new_price;
                        //
                        //    return $cart_data;
                        //}
                        add_filter(
                            'woocommerce_get_cart_item_from_session',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_get_cart_item_from_session',
                            20,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_get_cart_item_from_session( $session_data, $values, $key )
                        {
                            if ( !isset( $session_data['new_price'] ) || empty($session_data['new_price']) ) {
                                return $session_data;
                            }
                            //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_get_cart_item_from_session $session_data[new_price]: ' . $session_data['new_price']);
                            // Get the new calculated price and update cart session item price
                            $session_data['data']->set_price( $session_data['new_price'] );
                            return $session_data;
                        }
                        
                        // @see https://github.com/woocommerce/woocommerce/blob/e2b59d44ee88c131e044c49e508767620415e1e6/includes/wc-formatting-functions.php#L557
                        /**
                         * Format the price with a currency symbol.
                         *
                         * @param  float $price Formatted price.
                         * @param  array $args  Arguments to format a price {
                         *     Array of arguments.
                         *     Defaults to empty array.
                         *
                         *     @type bool   $ex_tax_label       Adds exclude tax label.
                         *                                      Defaults to false.
                         *     @type string $currency           Currency code.
                         *                                      Defaults to empty string (Use the result from get_woocommerce_currency()).
                         *     @type string $decimal_separator  Decimal separator.
                         *                                      Defaults the result of wc_get_price_decimal_separator().
                         *     @type string $thousand_separator Thousand separator.
                         *                                      Defaults the result of wc_get_price_thousand_separator().
                         *     @type string $decimals           Number of decimals.
                         *                                      Defaults the result of wc_get_price_decimals().
                         *     @type string $price_format       Price format depending on the currency position.
                         *                                      Defaults the result of get_woocommerce_price_format().
                         * }
                         * @param  float $unformatted_price Raw price.
                         * @return string
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wc_price(
                            $return,
                            $price,
                            $args,
                            $unformatted_price
                        )
                        {
                            global 
                                $wp,
                                $woocommerce,
                                $post,
                                $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_product
                            ;
                            return $return;
                        }
                        
                        add_filter(
                            'wc_price',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wc_price',
                            100,
                            5
                        );
                        /**
                         * Add a custom product tab.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_product_tabs( $tabs )
                        {
                            $tabs['cryptocurrency'] = array(
                                'label'  => __( 'Cryptocurrency', 'cryptocurrency-product-for-woocommerce' ),
                                'target' => 'cryptocurrency_product_data',
                                'class'  => array( 'show_if_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type', 'show_if_variable_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type' ),
                            );
                            //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log('tabs=' . print_r($tabs, true));
                            return $tabs;
                        }
                        
                        add_filter( 'woocommerce_product_data_tabs', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_product_tabs' );
                        // define the woocommerce_product_options_general_product_data callback
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_options_general_product_data_aux( $post_id )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_dir ;
                            $settings = [];
                            return $settings;
                        }
                        
                        // define the woocommerce_product_options_general_product_data callback
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_options_general_product_data()
                        {
                            global  $post ;
                            $post_id = $post->ID;
                            $product = wc_get_product( $post_id );
                            
                            if ( !$product ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "woocommerce_product_options_general_product_data({$post_id}) not a product" );
                                return;
                            }
                            
                            
                            if ( !cryptocurrency_product_for_woocommerce_freemius_init()->is__premium_only() || !cryptocurrency_product_for_woocommerce_freemius_init()->is_plan( 'pro', true ) ) {
                                ?>
    <div class="options_group show_if_simple cryptocurrency-product-for-woocommerce-settings-wrapper show_if_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type show_if_variable_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type">
        <h3 class="cryptocurrency-product-for-woocommerce-settings-header" style="display: block;"><?php 
                                _e( 'Cryptocurrency Product Settings', 'cryptocurrency-product-for-woocommerce' );
                                ?></h3>
        <div class="options_group show_if_simple"><p><?php 
                                echo  sprintf(
                                    __( '%1$sUpgrade Now!%2$s to enable "%3$s" feature.', 'cryptocurrency-product-for-woocommerce' ),
                                    '<a href="' . cryptocurrency_product_for_woocommerce_freemius_init()->get_upgrade_url() . '" target="_blank">',
                                    '</a>',
                                    __( 'The dynamic price source', 'cryptocurrency-product-for-woocommerce' )
                                ) ;
                                ?>
        </p></div>
    </div>
    <?php 
                            }
                            
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_scripts_();
                        }
                        
                        // add the action
                        add_action( 'woocommerce_product_options_general_product_data', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_options_general_product_data' );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_display_options( $settings )
                        {
                            foreach ( $settings as $s ) {
                                switch ( $s['_cryptocurrency_product_setting_type'] ) {
                                    case 'text_input':
                                        woocommerce_wp_text_input( $s );
                                        break;
                                    case 'checkbox':
                                        woocommerce_wp_checkbox( $s );
                                        break;
                                    case 'select':
                                        woocommerce_wp_select( $s );
                                        break;
                                    case 'hidden':
                                        woocommerce_wp_hidden_input( $s );
                                        break;
                                    default:
                                        throw new Exception( "Unknown _cryptocurrency_product_setting_type: " . $s['_cryptocurrency_product_setting_type'] );
                                }
                            }
                        }
                        
                        /**
                         * Contents of the cryptocurrency options product tab.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options_product_tab_content( $object_id = null )
                        {
                            global  $post ;
                            $post_id = ( is_null( $object_id ) || empty($post_id) ? $post->ID : $object_id );
                            // Get the selected value
                            $_select_cryptocurrency_option = get_post_meta( $post_id, '_select_cryptocurrency_option', true );
                            if ( empty($_select_cryptocurrency_option) ) {
                                $_select_cryptocurrency_option = '';
                            }
                            $options = [];
                            $options[''] = __( 'Select a value', 'woocommerce' );
                            // default value
                            $options['Ether'] = __( 'Ether', 'cryptocurrency-product-for-woocommerce' );
                            $options = apply_filters( 'cryptocurrency_product_for_woocommerce_get_product_symbols', $options );
                            $s = pow( 10, -18 );
                            $settings = [
                                //        [
                                //            'id'			=> '_text_input_cryptocurrency_data',
                                //            'label'			=> __( 'Token address', 'cryptocurrency-product-for-woocommerce' ),
                                //            'desc_tip'		=> 'true',
                                //            'description'	=> __( 'The ethereum address of the Token to sell', 'cryptocurrency-product-for-woocommerce' ),
                                //            'type' 			=> 'text',
                                //            'wrapper_class' => 'hidden',
                                //            '_cryptocurrency_product_setting_type' => 'text_input',
                                //        ],
                                [
                                    'id'                                   => '_select_cryptocurrency_option',
                                    'label'                                => __( 'The cryptocurrency', 'cryptocurrency-product-for-woocommerce' ),
                                    'options'                              => $options,
                                    '_cryptocurrency_product_setting_type' => 'select',
                                ],
                                [
                                    'id'                                   => '_text_input_cryptocurrency_minimum_value',
                                    'label'                                => __( 'Minimum amount', 'cryptocurrency-product-for-woocommerce' ),
                                    'desc_tip'                             => 'true',
                                    'description'                          => __( 'The minimum amount of cryptocurrency user can buy', 'cryptocurrency-product-for-woocommerce' ),
                                    'wrapper_class'                        => '_text_input_cryptocurrency_minimum_value_field hidden',
                                    'custom_attributes'                    => [
                                    'min'        => 0,
                                    'step'       => $s,
                                    'novalidate' => 'novalidate',
                                    'type'       => 'number',
                                ],
                                    '_cryptocurrency_product_setting_type' => 'text_input',
                                ],
                                [
                                    'id'                                   => '_text_input_cryptocurrency_step',
                                    'label'                                => __( 'Step', 'cryptocurrency-product-for-woocommerce' ),
                                    'desc_tip'                             => 'true',
                                    'description'                          => __( 'The increment/decrement step', 'cryptocurrency-product-for-woocommerce' ),
                                    'wrapper_class'                        => '_text_input_cryptocurrency_step_field hidden',
                                    'custom_attributes'                    => [
                                    'min'        => $s,
                                    'step'       => $s,
                                    'novalidate' => 'novalidate',
                                    'type'       => 'number',
                                ],
                                    '_cryptocurrency_product_setting_type' => 'text_input',
                                ],
                                [
                                    'id'                                   => '_text_input_cryptocurrency_balance',
                                    'label'                                => __( 'Balance', 'cryptocurrency-product-for-woocommerce' ),
                                    'desc_tip'                             => 'true',
                                    'description'                          => __( 'The wallet balance', 'cryptocurrency-product-for-woocommerce' ),
                                    'wrapper_class'                        => '_text_input_cryptocurrency_balance_field hidden',
                                    'custom_attributes'                    => array(
                                    'disabled' => 'disabled',
                                ),
                                    '_cryptocurrency_product_setting_type' => 'text_input',
                                ],
                                // fix for save_post: https://stackoverflow.com/questions/5434219/problem-with-wordpress-save-post-action#comment6729746_5849143
                                [
                                    'id'                                   => '_text_input_cryptocurrency_flag',
                                    'value'                                => 'yes',
                                    '_cryptocurrency_product_setting_type' => 'hidden',
                                ],
                            ];
                            $settings = apply_filters(
                                'cryptocurrency_product_for_woocommerce_product_type_settings',
                                $settings,
                                $_select_cryptocurrency_option,
                                $post_id
                            );
                            return $settings;
                        }
                        
                        /**
                         * Contents of the cryptocurrency options product tab.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options_product_tab_content_wc()
                        {
                            global  $post ;
                            $post_id = $post->ID;
                            ?><div id="cryptocurrency_product_data" class="panel woocommerce_options_panel hidden"><?php 
                            ?><div class="options_group"><?php 
                            $settings = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options_product_tab_content( $post_id );
                            //            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("options_product_tab_content_wc($post_id): " . print_r($settings, true));
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_display_options( $settings );
                            ?></div>

	</div><?php 
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_scripts_();
                        }
                        
                        add_action( 'woocommerce_product_data_panels', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options_product_tab_content_wc' );
                        add_action(
                            'cryptocurrency_product_for_woocommerce_save_option_field',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_save_option_field_hook',
                            10,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_save_option_field_hook( $cryptocurrency_option, $post_id, $product )
                        {
                            if ( 'Ether' !== $cryptocurrency_option ) {
                                return;
                            }
                        }
                        
                        // @see https://wordpress.stackexchange.com/a/110052/137915
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_transition_post_status( $new_status, $old_status, $post )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            if ( !current_user_can( 'administrator' ) ) {
                                return;
                            }
                            if ( !($old_status != 'publish' && $new_status == 'publish' && !empty($post->ID) && in_array( $post->post_type, [ 'product' ] )) ) {
                                return;
                            }
                            $product_id = $post->ID;
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id ) ) {
                                return;
                            }
                            $vendor_id = get_post_field( 'post_author_override', $product_id );
                            if ( empty($vendor_id) ) {
                                $vendor_id = get_post_field( 'post_author', $product_id );
                            }
                            if ( !user_can( $vendor_id, 'vendor' ) ) {
                                // process only vendor's products
                                return;
                            }
                            $vendor_fee = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['vendor_fee'] ) ? doubleval( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['vendor_fee'] ) : 0 );
                            if ( $vendor_fee <= 0 ) {
                                return;
                            }
                            // Ether rate
                            $rate = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_ETH_rate( 1 );
                            
                            if ( is_null( $rate ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( 'Failed to get Ether rate' );
                                return;
                            }
                            
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( 'Ether rate: ' . $rate );
                            $eth_value = $vendor_fee / $rate;
                            $eth_value_wei = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_double_int_multiply( $eth_value, pow( 10, 18 ) );
                            // 1. check balance
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id );
                            $providerUrl = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint();
                            $eth_balance = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBalanceEth( $thisWalletAddress, $providerUrl );
                            
                            if ( null === $eth_balance || $eth_balance->compare( $eth_value_wei ) < 0 ) {
                                $eth_balance_str = $eth_balance->toString();
                                $eth_value_wei_str = $eth_value_wei->toString();
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to take vendor fee: insufficient Ether balance: eth_balance_wei({$eth_balance_str}) < eth_value_wei({$eth_value_wei_str})" );
                                return;
                            }
                            
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_enqueue_send_ether_task(
                                null,
                                null,
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress(),
                                $eth_value,
                                $providerUrl,
                                0,
                                $vendor_id
                            );
                        }
                        
                        add_action(
                            'transition_post_status',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_transition_post_status',
                            10,
                            3
                        );
                        /**
                         * Save the custom fields.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_save_option_field( $post_id, $product = null )
                        {
                            //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("save_option_field($post_id): " . print_r($_POST, true));
                            $product = ( is_null( $product ) ? wc_get_product( $post_id ) : $product );
                            
                            if ( !$product ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "save_option_field({$post_id}) not a product" );
                                return;
                            }
                            
                            
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product->get_id() ) ) {
                                $is_cryptocurrency = ( isset( $_POST['_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type'] ) ? 'yes' : 'no' );
                                if ( $is_cryptocurrency == 'no' ) {
                                    return;
                                }
                            }
                            
                            // Select
                            $cryptocurrency_option = $_POST['_select_cryptocurrency_option'];
                            
                            if ( !empty($cryptocurrency_option) ) {
                                update_post_meta( $post_id, '_select_cryptocurrency_option', esc_attr( $cryptocurrency_option ) );
                            } else {
                                update_post_meta( $post_id, '_select_cryptocurrency_option', '' );
                            }
                            
                            //	if ( isset( $_POST['_text_input_cryptocurrency_data'] ) ) {
                            //		update_post_meta( $post_id, '_text_input_cryptocurrency_data', sanitize_text_field( $_POST['_text_input_cryptocurrency_data'] ) );
                            //    }
                            if ( isset( $_POST['_text_input_cryptocurrency_minimum_value'] ) ) {
                                update_post_meta( $post_id, '_text_input_cryptocurrency_minimum_value', sanitize_text_field( $_POST['_text_input_cryptocurrency_minimum_value'] ) );
                            }
                            if ( isset( $_POST['_text_input_cryptocurrency_step'] ) ) {
                                update_post_meta( $post_id, '_text_input_cryptocurrency_step', sanitize_text_field( $_POST['_text_input_cryptocurrency_step'] ) );
                            }
                            do_action(
                                'cryptocurrency_product_for_woocommerce_save_option_field',
                                $cryptocurrency_option,
                                $post_id,
                                $product
                            );
                        }
                        
                        add_action( 'woocommerce_process_product_meta', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_save_option_field' );
                        add_action( 'woocommerce_process_product_meta_variable', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_save_option_field' );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei()
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $gasPriceMaxGwei = doubleval( ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['gas_price'] ) ? $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['gas_price'] : '41' ) );
                            return array(
                                'tm'        => time(),
                                'gas_price' => $gasPriceMaxGwei,
                            );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_query_web3_gas_price_gwei()
                        {
                            $providerUrl = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint();
                            $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                            $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                            $eth = $web3->eth;
                            $ret = null;
                            $eth->gasPrice( function ( $err, $gasPrice ) use( &$ret ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to get gasPrice: ", $err );
                                    return;
                                }
                                
                                $ret = $gasPrice;
                            } );
                            if ( is_null( $ret ) ) {
                                return CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei();
                            }
                            list( $priceGwei, $_ ) = $ret->divide( new phpseclib\Math\BigInteger( pow( 10, 9 ) ) );
                            $sPriceGwei = $priceGwei->toString();
                            if ( '0' === $sPriceGwei ) {
                                return CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei();
                            }
                            return $priceGwei->toString();
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_query_gas_price_gwei()
                        {
                            $apiEndpoint = "https://www.etherchain.org/api/gasPriceOracle";
                            $response = wp_remote_get( $apiEndpoint, array(
                                'sslverify' => false,
                            ) );
                            
                            if ( is_wp_error( $response ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Error in gasPriceOracle response: ", $response );
                                return CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei();
                            }
                            
                            $http_code = wp_remote_retrieve_response_code( $response );
                            
                            if ( 200 != $http_code ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Bad response code in gasPriceOracle response: ", $http_code );
                                return CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei();
                            }
                            
                            $body = wp_remote_retrieve_body( $response );
                            
                            if ( !$body ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "empty body in gasPriceOracle response" );
                                return CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei();
                            }
                            
                            $j = json_decode( $body, true );
                            
                            if ( !isset( $j["fast"] ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "no fast field in gasPriceOracle response" );
                                return CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei();
                            }
                            
                            $gasPriceGwei = $j["fast"];
                            if ( 0 == $gasPriceGwei ) {
                                $gasPriceGwei = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_query_web3_gas_price_gwei();
                            }
                            $cache_gas_price = array(
                                'tm'        => time(),
                                'gas_price' => $gasPriceGwei,
                            );
                            
                            if ( get_option( 'ethereumicoio_cache_gas_price' ) ) {
                                update_option( 'ethereumicoio_cache_gas_price', $cache_gas_price );
                            } else {
                                $deprecated = '';
                                $autoload = 'no';
                                add_option(
                                    'ethereumicoio_cache_gas_price',
                                    $cache_gas_price,
                                    $deprecated,
                                    $autoload
                                );
                            }
                            
                            return $cache_gas_price;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_gas_price_wei()
                        {
                            // Get all existing Cryptocurrency Product options
                            $cache_gas_price_gwei = get_option( 'ethereumicoio_cache_gas_price', array() );
                            if ( !$cache_gas_price_gwei ) {
                                $cache_gas_price_gwei = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_query_gas_price_gwei();
                            }
                            $tm_diff = time() - intval( $cache_gas_price_gwei['tm'] );
                            // TODO: admin setting
                            $timeout = 10 * 60;
                            // seconds
                            if ( $tm_diff > $timeout ) {
                                $cache_gas_price_gwei = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_query_gas_price_gwei();
                            }
                            $gasPriceGwei = doubleval( $cache_gas_price_gwei['gas_price'] );
                            $gasPriceMaxGwei = doubleval( CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_default_gas_price_gwei()['gas_price'] );
                            if ( $gasPriceMaxGwei < $gasPriceGwei ) {
                                $gasPriceGwei = $gasPriceMaxGwei;
                            }
                            if ( 0 == $gasPriceGwei ) {
                                $gasPriceGwei = $gasPriceMaxGwei;
                            }
                            $gasPriceWei = 1000000000 * $gasPriceGwei;
                            // gwei -> wei
                            return intval( $gasPriceWei );
                        }
                        
                        /**
                         * Hide Attributes data panel.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_hide_attributes_data_panel( $tabs )
                        {
                            $tabs['shipping']['class'][] = 'hide_if_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type';
                            $tabs['shipping']['class'][] = 'hide_if_variable_cryptocurrency_product_for_woocommerce_cryptocurrency_product_type';
                            return $tabs;
                        }
                        
                        add_filter( 'woocommerce_product_data_tabs', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_hide_attributes_data_panel' );
                        //----------------------------------------------------------------------------//
                        //                     Shipping field for crypto-address                      //
                        //----------------------------------------------------------------------------//
                        function _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency_product_in_cart()
                        {
                            if ( !is_null( WC()->cart ) ) {
                                // Find each product in the cart and add it to the $cart_ids array
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $product ) {
                                    if ( _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product['product_id'] ) ) {
                                        return true;
                                    }
                                }
                            }
                            return false;
                        }
                        
                        // The type of crypto product in a cart
                        function _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_cart()
                        {
                            if ( !is_null( WC()->cart ) ) {
                                // Find each product in the cart and add it to the $cart_ids array
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $product ) {
                                    
                                    if ( _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product['product_id'] ) ) {
                                        $cryptocurrency_option = get_post_meta( $product['product_id'], '_select_cryptocurrency_option', true );
                                        if ( empty($cryptocurrency_option) ) {
                                            $cryptocurrency_option = '';
                                        }
                                        return $cryptocurrency_option;
                                    }
                                
                                }
                            }
                            return '';
                        }
                        
                        function _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_id_in_cart()
                        {
                            if ( !is_null( WC()->cart ) ) {
                                // Find each product in the cart and add it to the $cart_ids array
                                foreach ( WC()->cart->get_cart() as $cart_item_key => $product ) {
                                    if ( _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product['product_id'] ) ) {
                                        return $product['product_id'];
                                    }
                                }
                            }
                            return '';
                        }
                        
                        function _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order( $order_id )
                        {
                            // do the payment
                            try {
                                $order = wc_get_order( $order_id );
                            } catch ( Exception $ex ) {
                                // 35956
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order({$order_id}): " . $ex->getMessage() );
                                return '';
                            }
                            if ( !$order ) {
                                throw new Exception( "_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order({$order_id}): no order" );
                            }
                            $order_items = $order->get_items();
                            foreach ( $order_items as $product ) {
                                $product_id = $product['product_id'];
                                if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id ) ) {
                                    // skip non-cryptocurrency products
                                    continue;
                                }
                                $_product = wc_get_product( $product_id );
                                
                                if ( !$_product ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order({$product_id}) not a product" );
                                    continue;
                                }
                                
                                $cryptocurrency_option = get_post_meta( $product_id, '_select_cryptocurrency_option', true );
                                return $cryptocurrency_option;
                            }
                            return '';
                        }
                        
                        // Hook in
                        add_filter( 'woocommerce_checkout_fields', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_override_checkout_fields' );
                        // Our hooked in function - $fields is passed via the filter!
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_override_checkout_fields( $fields )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency_product_in_cart() ) {
                                return $fields;
                            }
                            $cryptocurrency_option = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_cart();
                            return apply_filters( 'cryptocurrency_product_for_woocommerce_override_checkout_fields', $fields, $cryptocurrency_option );
                        }
                        
                        add_filter(
                            'cryptocurrency_product_for_woocommerce_override_checkout_fields',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_override_checkout_fields',
                            20,
                            2
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_override_checkout_fields( $fields, $cryptocurrency_option )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            if ( "ETHEREUM" !== apply_filters( 'cryptocurrency_product_for_woocommerce_get_base_blockchain', '', $cryptocurrency_option ) ) {
                                return $fields;
                            }
                            $user_id = get_current_user_id();
                            $walletDisabled = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_field_disable'] ) ? esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_field_disable'] ) : '' );
                            $isWalletFieldDisabled = !empty($walletDisabled);
                            $custom_attributes = array();
                            if ( !($user_id > 0 || $isWalletFieldDisabled || !function_exists( 'ETHEREUM_WALLET_create_account' ) || !WC()->checkout()->is_registration_required()) ) {
                                ?>
<script type='text/javascript'>
    jQuery( document ).ready( function() {
        setTimeout(function(){
            jQuery('#billing_cryptocurrency_ethereum_address_field').hide();
        }, 100);
    });
</script>
    <?php 
                            }
                            $value = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_user_wallet();
                            if ( !empty($walletDisabled) ) {
                                $custom_attributes['readonly'] = 'readonly';
                            }
                            ?>
<script type='text/javascript'>
    jQuery( document ).ready( function() {
        setTimeout(function(){
            jQuery('#billing_cryptocurrency_ethereum_address').val("<?php 
                            echo  $value ;
                            ?>");
        }, 100);
    });
</script>
    <?php 
                            $fields['billing']['billing_cryptocurrency_ethereum_address'] = array(
                                'label'             => __( 'Ethereum Address', 'cryptocurrency-product-for-woocommerce' ),
                                'placeholder'       => _x( '0x', 'placeholder', 'cryptocurrency-product-for-woocommerce' ),
                                'required'          => $user_id > 0 || $isWalletFieldDisabled || !function_exists( 'ETHEREUM_WALLET_create_account' ) || !WC()->checkout()->is_registration_required(),
                                'class'             => array( 'form-row-wide' ),
                                'clear'             => true,
                                'value'             => $value,
                                'custom_attributes' => $custom_attributes,
                            );
                            return $fields;
                        }
                        
                        /**
                         * Display field value on the order edit page
                         */
                        //add_action( 'woocommerce_admin_order_data_after_billing_address', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_checkout_field_display_admin_order_meta', 10, 1 );
                        //
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_checkout_field_display_admin_order_meta($order){
                        //    echo '<p><strong>'.__('Ethereum Address From Checkout Form', 'cryptocurrency-product-for-woocommerce').':</strong> ' . get_post_meta( $order->get_id(), '_billing_cryptocurrency_ethereum_address', true ) . '</p>';
                        //}
                        /* Display additional billing fields (email, phone) in ADMIN area (i.e. Order display ) */
                        /* Note:  $fields keys (i.e. field names) must be in format:  WITHOUT the "billing_" prefix (it's added by the code) */
                        add_filter( 'woocommerce_admin_billing_fields', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_additional_admin_billing_fields' );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_additional_admin_billing_fields( $fields )
                        {
                            $fields['cryptocurrency_ethereum_address'] = array(
                                'label' => __( 'Ethereum Address', 'cryptocurrency-product-for-woocommerce' ),
                            );
                            return $fields;
                        }
                        
                        /* Display additional billing fields (email, phone) in USER area (i.e. Admin User/Customer display ) */
                        /* Note:  $fields keys (i.e. field names) must be in format: billing_ */
                        add_filter( 'woocommerce_customer_meta_fields', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_additional_customer_meta_fields' );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_additional_customer_meta_fields( $fields )
                        {
                            $fields['billing']['fields']['billing_cryptocurrency_ethereum_address'] = array(
                                'label'       => __( 'Ethereum Address', 'cryptocurrency-product-for-woocommerce' ),
                                'description' => '',
                            );
                            return $fields;
                        }
                        
                        // @see https://stackoverflow.com/a/41987077/4256005
                        add_filter(
                            'woocommerce_email_customer_details_fields',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_email_customer_details_fields',
                            20,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_email_customer_details_fields( $fields, $sent_to_admin = false, $order = null )
                        {
                            
                            if ( is_null( $order ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( 'woocommerce_email_customer_details_fields order is null' );
                                return $fields;
                            }
                            
                            $order_id = $order->get_id();
                            $cryptocurrency_option = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order( $order_id );
                            
                            if ( empty($cryptocurrency_option) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( 'woocommerce_email_customer_details_fields empty($cryptocurrency_option) for order id ' . $order_id );
                                return $fields;
                            }
                            
                            $_billing_cryptocurrency_address = apply_filters(
                                'cryptocurrency_product_for_woocommerce_get_cryptocurrency_address',
                                '',
                                $cryptocurrency_option,
                                $order_id
                            );
                            $fields['billing_cryptocurrency_address'] = array(
                                'label' => __( 'Crypto Wallet Address', 'cryptocurrency-product-for-woocommerce' ),
                                'value' => $_billing_cryptocurrency_address,
                            );
                            $txhash = get_post_meta( $order_id, 'ether_txhash', true );
                            if ( empty($txhash) ) {
                                $txhash = get_post_meta( $order_id, 'erc20_txhash', true );
                            }
                            if ( empty($txhash) ) {
                                $txhash = get_post_meta( $order_id, 'txhash', true );
                            }
                            if ( !empty($txhash) ) {
                                $fields['cryptocurrency_txhash'] = array(
                                    'label' => __( 'Crypto Tx Hash', 'cryptocurrency-product-for-woocommerce' ),
                                    'value' => $txhash,
                                );
                            }
                            return $fields;
                        }
                        
                        /* Add CSS for ADMIN area so that the additional billing fields (email, phone) display on left and right side of edit billing details */
                        //add_action('admin_head', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_admin_css');
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_custom_admin_css() {
                        //  echo '<style>
                        //    #order_data .order_data_column ._billing_email2_field {
                        //        clear: left;
                        //        float: left;
                        //    }
                        //    #order_data .order_data_column ._billing_phone_field {
                        //        float: right;
                        //    }
                        //  </style>';
                        //}
                        // @see https://stackoverflow.com/a/37780501/4256005
                        // Adding Meta container admin shop_order pages
                        add_action( 'add_meta_boxes', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_add_meta_boxes' );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_add_meta_boxes()
                        {
                            global  $post ;
                            if ( 'shop_order' !== get_post_type( $post ) ) {
                                return;
                            }
                            $order_id = $post->ID;
                            $cryptocurrency_option = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order( $order_id );
                            if ( empty($cryptocurrency_option) ) {
                                return;
                            }
                            do_action( 'cryptocurrency_product_for_woocommerce_add_meta_boxes', $cryptocurrency_option );
                        }
                        
                        // Adding Meta container admin shop_order pages
                        add_action(
                            'cryptocurrency_product_for_woocommerce_add_meta_boxes',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_add_meta_boxes',
                            20,
                            1
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_add_meta_boxes( $cryptocurrency_option )
                        {
                            if ( "ETHEREUM" !== apply_filters( 'cryptocurrency_product_for_woocommerce_get_base_blockchain', '', $cryptocurrency_option ) ) {
                                return;
                            }
                            add_meta_box(
                                'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_other_fields',
                                __( 'Ethereum Address', 'cryptocurrency-product-for-woocommerce' ),
                                'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_add_other_fields_for_packaging',
                                'shop_order',
                                'side',
                                'core'
                            );
                        }
                        
                        // Adding Meta field in the meta container admin shop_order pages
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_add_other_fields_for_packaging()
                        {
                            global  $post ;
                            if ( 'shop_order' !== get_post_type( $post ) ) {
                                return;
                            }
                            $order_id = $post->ID;
                            $cryptocurrency_option = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order( $order_id );
                            $_billing_cryptocurrency_ethereum_address = apply_filters(
                                'cryptocurrency_product_for_woocommerce_get_cryptocurrency_address',
                                '',
                                $cryptocurrency_option,
                                $order_id
                            );
                            $meta_field_data = $_billing_cryptocurrency_ethereum_address;
                            echo  '<input type="hidden" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_' . $cryptocurrency_option . '_other_meta_field_nonce" value="' . wp_create_nonce() . '">
    <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
        <input type="text" style="width:250px;";" name="_billing_cryptocurrency_ethereum_address_input" placeholder="' . $meta_field_data . '" value="' . $meta_field_data . '"></p>' ;
                        }
                        
                        // Save the data of the Meta field
                        add_action(
                            'save_post',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_save_wc_order_other_fields',
                            1000,
                            1
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_save_wc_order_other_fields( $post_id )
                        {
                            // We need to verify this with the proper authorization (security stuff).
                            if ( 'shop_order' !== get_post_type( $post_id ) ) {
                                return;
                            }
                            // Check the user's permissions.
                            if ( !current_user_can( 'edit_shop_order', $post_id ) ) {
                                return $post_id;
                            }
                            $order_id = $post_id;
                            $order = wc_get_order( $order_id );
                            if ( !$order ) {
                                return $post_id;
                            }
                            $cryptocurrency_option = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_order( $order_id );
                            // Check if our nonce is set.
                            if ( !isset( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_' . $cryptocurrency_option . '_other_meta_field_nonce'] ) ) {
                                return $post_id;
                            }
                            $nonce = $_REQUEST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_' . $cryptocurrency_option . '_other_meta_field_nonce'];
                            //Verify that the nonce is valid.
                            
                            if ( !wp_verify_nonce( $nonce ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "save_wc_order_other_fields: bad nonce" );
                                return $post_id;
                            }
                            
                            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
                            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                                return $post_id;
                            }
                            // --- Its safe for us to save the data ! --- //
                            do_action( 'cryptocurrency_product_for_woocommerce_save_wc_order_other_fields', $cryptocurrency_option, $post_id );
                        }
                        
                        add_action(
                            'cryptocurrency_product_for_woocommerce_save_wc_order_other_fields',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_save_wc_order_other_fields_hook',
                            10,
                            2
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_save_wc_order_other_fields_hook( $cryptocurrency_option, $post_id )
                        {
                            if ( "ETHEREUM" !== apply_filters( 'cryptocurrency_product_for_woocommerce_get_base_blockchain', '', $cryptocurrency_option ) ) {
                                return;
                            }
                            // Sanitize user input  and update the meta field in the database.
                            $_billing_cryptocurrency_ethereum_address_input = sanitize_text_field( $_POST['_billing_cryptocurrency_ethereum_address_input'] );
                            $order_id = $post_id;
                            $order = wc_get_order( $order_id );
                            if ( !$order ) {
                                return;
                            }
                            
                            if ( empty($_billing_cryptocurrency_ethereum_address_input) ) {
                                // @see https://stackoverflow.com/a/43815280/4256005
                                // Get an instance of the WC_Order object
                                // Get the user ID from WC_Order methods
                                $user_id = $order->get_user_id();
                                // or $order->get_customer_id();
                                if ( $user_id >= 0 ) {
                                    $_billing_cryptocurrency_ethereum_address_input = get_user_meta( $user_id, 'user_ethereum_wallet_address', true );
                                }
                            }
                            
                            $_billing_cryptocurrency_ethereum_address_input_old = get_post_meta( $post_id, '_billing_cryptocurrency_ethereum_address', true );
                            
                            if ( $_billing_cryptocurrency_ethereum_address_input_old != $_billing_cryptocurrency_ethereum_address_input ) {
                                update_post_meta( $post_id, '_billing_cryptocurrency_ethereum_address', $_billing_cryptocurrency_ethereum_address_input );
                                // Is this a note for the customer?
                                $is_customer_note = 1;
                                $order->add_order_note( sprintf( __( '%1$s set to %2$s', 'cryptocurrency-product-for-woocommerce' ), __( 'Ethereum Address', 'cryptocurrency-product-for-woocommerce' ), $_billing_cryptocurrency_ethereum_address_input ), $is_customer_note );
                            }
                        
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_checkout_update_order_meta( $order_id, $data )
                        {
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency_product_in_cart() ) {
                                return;
                            }
                            $cryptocurrency_option = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_cart();
                            do_action(
                                'cryptocurrency_product_for_woocommerce_checkout_update_order_meta',
                                $cryptocurrency_option,
                                $order_id,
                                $data
                            );
                        }
                        
                        add_action(
                            'woocommerce_checkout_update_order_meta',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_checkout_update_order_meta',
                            20,
                            2
                        );
                        add_action(
                            'cryptocurrency_product_for_woocommerce_checkout_update_order_meta',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_checkout_update_order_meta_hook',
                            10,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_checkout_update_order_meta_hook( $cryptocurrency_option, $order_id, $data )
                        {
                            if ( "ETHEREUM" !== apply_filters( 'cryptocurrency_product_for_woocommerce_get_base_blockchain', '', $cryptocurrency_option ) ) {
                                return;
                            }
                            if ( isset( $data['billing_cryptocurrency_ethereum_address'] ) ) {
                                update_post_meta( $order_id, '_billing_cryptocurrency_ethereum_address', $data['billing_cryptocurrency_ethereum_address'] );
                            }
                        }
                        
                        add_filter(
                            'cryptocurrency_product_for_woocommerce_get_base_blockchain',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_get_base_blockchain',
                            20,
                            2
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_get_base_blockchain( $blockchain, $cryptocurrency_option )
                        {
                            if ( !in_array( $cryptocurrency_option, [ 'Ether' ] ) ) {
                                return $blockchain;
                            }
                            return "ETHEREUM";
                        }
                        
                        //----------------------------------------------------------------------------//
                        //                     Process order status changes                           //
                        //----------------------------------------------------------------------------//
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_processing( $order_id )
                        {
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order( $order_id );
                        }
                        
                        add_action( 'woocommerce_order_status_processing', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_processing' );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_completed( $order_id )
                        {
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order( $order_id );
                        }
                        
                        add_action( 'woocommerce_order_status_completed', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_completed' );
                        function _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_double_int_multiply( $dval, $ival )
                        {
                            $dval = doubleval( $dval );
                            $ival = intval( $ival );
                            $dv1 = floor( $dval );
                            $ret = new phpseclib\Math\BigInteger( intval( $dv1 ) );
                            $ret = $ret->multiply( new phpseclib\Math\BigInteger( $ival ) );
                            if ( $dv1 === $dval ) {
                                return $ret;
                            }
                            $dv2 = $dval - $dv1;
                            $iv1 = intval( $dv2 * $ival );
                            $ret = $ret->add( new phpseclib\Math\BigInteger( $iv1 ) );
                            return $ret;
                        }
                        
                        add_action(
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_send_ether",
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_send_ether",
                            0,
                            6
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_send_ether(
                            $order_id,
                            $product_id,
                            $marketAddress,
                            $eth_value,
                            $providerUrl,
                            $from_user_id
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $order = wc_get_order( $order_id );
                            
                            if ( !$order->has_status( "processing" ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Order {$order_id} status is not eligible for processing. Skip payment." );
                                return;
                            }
                            
                            if ( !is_null( $order_id ) ) {
                                
                                if ( CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_is_order_payed( $order_id ) ) {
                                    // already payed
                                    $txhash = get_post_meta( $order_id, 'ether_txhash', true );
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Ether payment found for order {$order_id}: {$txhash}. Skip payment." );
                                    return;
                                }
                            
                            }
                            // проверить, есть ли прошлая транзакция
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id, $from_user_id );
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return false;
                            }
                            
                            $lasttxhash = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_last_txhash( $thisWalletAddress );
                            $txhash = null;
                            $nonce = null;
                            $canceled = false;
                            
                            if ( $lasttxhash ) {
                                // если есть, проверить, завершена ли она
                                $lastnonce = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_last_nonce( $thisWalletAddress );
                                $tx_confirmed = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_tx_confirmed(
                                    $lasttxhash,
                                    $lastnonce,
                                    $providerUrl,
                                    $product_id,
                                    $from_user_id
                                );
                                
                                if ( $tx_confirmed ) {
                                    //   - да, послать новую транзакцию
                                    list( $txhash, $nonce, $canceled ) = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_send_ether_impl(
                                        $order_id,
                                        $product_id,
                                        $marketAddress,
                                        $eth_value,
                                        $providerUrl,
                                        $from_user_id
                                    );
                                } else {
                                    
                                    if ( is_null( $tx_confirmed ) ) {
                                        // nonce in last tx is outdated. remove it
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_delete_last_txhash( $thisWalletAddress );
                                        //            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_cancel_complete_order_task($order_id, $txhash, $nonce);
                                    }
                                
                                }
                            
                            } else {
                                // нет последней транзакции. послать новую транзакцию
                                list( $txhash, $nonce, $canceled ) = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_send_ether_impl(
                                    $order_id,
                                    $product_id,
                                    $marketAddress,
                                    $eth_value,
                                    $providerUrl,
                                    $from_user_id
                                );
                            }
                            
                            
                            if ( $txhash ) {
                                // успех - запомнить новую последнюю транзакцию
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_set_last_txhash( $thisWalletAddress, $txhash, $nonce );
                                // поставить задачу отслеживания состояния транзакции
                                if ( !is_null( $order_id ) ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_complete_order_task( $order_id );
                                }
                            } else {
                                if ( !$canceled ) {
                                    // Неуспех - поставить себя снова в очередь
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_enqueue_send_ether_task(
                                        $order_id,
                                        $product_id,
                                        $marketAddress,
                                        $eth_value,
                                        $providerUrl,
                                        1 * 60,
                                        $from_user_id
                                    );
                                }
                            }
                            
                            return true;
                        }
                        
                        // Takes a hex (string) address as input
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_checksum_encode( $addr_str )
                        {
                            $out = array();
                            $addr = str_replace( '0x', '', strtolower( $addr_str ) );
                            $addr_array = str_split( $addr );
                            $hash_addr = \kornrunner\Keccak::hash( $addr, 256 );
                            $hash_addr_array = str_split( $hash_addr );
                            for ( $idx = 0 ;  $idx < count( $addr_array ) ;  $idx++ ) {
                                $ch = $addr_array[$idx];
                                
                                if ( (int) hexdec( $hash_addr_array[$idx] ) >= 8 ) {
                                    $out[] = strtoupper( $ch ) . '';
                                } else {
                                    $out[] = $ch . '';
                                }
                            
                            }
                            return '0x' . implode( '', $out );
                        }
                        
                        // create Ethereum wallet on user register
                        // see https://wp-kama.ru/hook/user_register
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_address_from_key( $privateKeyHex )
                        {
                            $privateKeyFactory = new \BitWasp\Bitcoin\Key\Factory\PrivateKeyFactory();
                            $privateKey = $privateKeyFactory->fromHexUncompressed( $privateKeyHex );
                            $pubKeyHex = $privateKey->getPublicKey()->getHex();
                            $hash = \kornrunner\Keccak::hash( substr( hex2bin( $pubKeyHex ), 1 ), 256 );
                            $ethAddress = '0x' . substr( $hash, 24 );
                            $ethAddressChkSum = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_checksum_encode( $ethAddress );
                            return $ethAddressChkSum;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_create_account()
                        {
                            $random = new \BitWasp\Bitcoin\Crypto\Random\Random();
                            $privateKeyBuffer = $random->bytes( 32 );
                            $privateKeyHex = $privateKeyBuffer->getHex();
                            $ethAddressChkSum = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_address_from_key( $privateKeyHex );
                            return [ $ethAddressChkSum, $privateKeyHex ];
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_send_ether_impl(
                            $order_id,
                            $product_id,
                            $marketAddress,
                            $eth_value,
                            $providerUrl,
                            $from_user_id
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id, $from_user_id );
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                if ( !is_null( $order_id ) ) {
                                    update_post_meta( $order_id, 'status', __( 'Configuration error', 'cryptocurrency-product-for-woocommerce' ) );
                                }
                                return null;
                            }
                            
                            $chainId = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getChainId();
                            
                            if ( null === $chainId ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Blockchain", 'cryptocurrency-product-for-woocommerce' ) ) );
                                if ( !is_null( $order_id ) ) {
                                    update_post_meta( $order_id, 'status', __( 'Configuration error', 'cryptocurrency-product-for-woocommerce' ) );
                                }
                                return null;
                            }
                            
                            $eth_value_wei = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_double_int_multiply( $eth_value, pow( 10, 18 ) );
                            $eth_value_wei_str = $eth_value_wei->toString();
                            // 1. check balance
                            $blockchainNetwork = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBlockchainNetwork();
                            $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                            $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                            $eth = $web3->eth;
                            $eth_balance = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBalanceEth( $thisWalletAddress, $providerUrl, $eth );
                            
                            if ( null === $eth_balance ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "eth_balance is null" );
                                if ( !is_null( $order_id ) ) {
                                    update_post_meta( $order_id, 'status', __( 'Network error', 'cryptocurrency-product-for-woocommerce' ) );
                                }
                                return null;
                            }
                            
                            
                            if ( $eth_balance->compare( $eth_value_wei ) < 0 ) {
                                $eth_balance_str = $eth_balance->toString();
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "eth_balance_wei({$eth_balance_str}) < eth_value_wei({$eth_value_wei_str}) for {$order_id}" );
                                
                                if ( !is_null( $order_id ) ) {
                                    update_post_meta( $order_id, 'status', __( 'Insufficient funds', 'cryptocurrency-product-for-woocommerce' ) );
                                    // Load the order.
                                    $order = wc_get_order( $order_id );
                                    // Place the order to failed.
                                    $res = $order->update_status( 'failed', sprintf( __( 'Ether balance (%1$s wei) is less then the value requested: %2$s wei.', 'cryptocurrency-product-for-woocommerce' ), $eth_balance_str, $eth_value_wei_str ) );
                                    if ( !$res ) {
                                        // failed to complete order
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to fail order: " . $order_id );
                                    }
                                }
                                
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_delete_last_txhash( $thisWalletAddress );
                                return [ null, null, true ];
                            }
                            
                            // 3. make payment if balance is enough
                            $nonce = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_nonce( $thisWalletAddress, $providerUrl, $eth );
                            
                            if ( null === $nonce ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "nonce is null" );
                                if ( !is_null( $order_id ) ) {
                                    update_post_meta( $order_id, 'status', __( 'Network error', 'cryptocurrency-product-for-woocommerce' ) );
                                }
                                return null;
                            }
                            
                            $gasLimit = 21000;
                            $gasPrice = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_gas_price_wei();
                            $thisWalletPrivKey = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletPrivateKey( $product_id, $from_user_id );
                            
                            if ( is_null( $thisWalletPrivKey ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet private key", 'cryptocurrency-product-for-woocommerce' ) ) . ". product_id=" . $product_id . "; thisWalletAddress=" . $thisWalletAddress );
                                if ( !is_null( $order_id ) ) {
                                    update_post_meta( $order_id, 'status', __( 'Configuration error', 'cryptocurrency-product-for-woocommerce' ) );
                                }
                                return null;
                            }
                            
                            $to = $marketAddress;
                            $nonceb = \BitWasp\Buffertools\Buffer::int( $nonce );
                            $gasPrice = \BitWasp\Buffertools\Buffer::int( $gasPrice );
                            $gasLimit = \BitWasp\Buffertools\Buffer::int( $gasLimit );
                            $transactionData = [
                                'nonce'    => '0x' . $nonceb->getHex(),
                                'to'       => strtolower( $to ),
                                'gas'      => '0x' . $gasLimit->getHex(),
                                'gasPrice' => '0x' . $gasPrice->getHex(),
                                'value'    => '0x' . $eth_value_wei->toHex(),
                                'chainId'  => $chainId,
                                'data'     => null,
                            ];
                            $transaction = new \Web3p\EthereumTx\Transaction( $transactionData );
                            $signedTransaction = "0x" . $transaction->sign( $thisWalletPrivKey );
                            $txHash = null;
                            $eth->sendRawTransaction( (string) $signedTransaction, function ( $err, $transaction ) use( &$txHash, &$transactionData ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to sendRawTransaction: " . $err );
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to sendRawTransaction: transactionData=" . print_r( $transactionData, true ) );
                                    return;
                                }
                                
                                $txHash = $transaction;
                            } );
                            
                            if ( null === $txHash ) {
                                if ( !is_null( $order_id ) ) {
                                    update_post_meta( $order_id, 'status', __( 'Network error', 'cryptocurrency-product-for-woocommerce' ) );
                                }
                                return null;
                            }
                            
                            
                            if ( !is_null( $order_id ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_set_order_txhash( $order_id, $txHash, $blockchainNetwork );
                                update_post_meta( $order_id, 'txdata', sanitize_text_field( $signedTransaction ) );
                            }
                            
                            // the remaining balance
                            $eth_balance_remaining = $eth_balance->subtract( $eth_value_wei );
                            list( $eth_balance_remaining, $_ ) = $eth_balance_remaining->divide( new phpseclib\Math\BigInteger( pow( 10, 9 ) ) );
                            $eth_balance_f = doubleval( $eth_balance_remaining->toString() ) / pow( 10, 9 );
                            
                            if ( !is_null( $product_id ) ) {
                                $product = wc_get_product( $product_id );
                                
                                if ( $product ) {
                                    $minimumValue = apply_filters( 'woocommerce_quantity_input_min', 0, $product );
                                    if ( empty($minimumValue) || 0 == $minimumValue ) {
                                        $minimumValue = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_min( 0.01, $product );
                                    }
                                    $status = 'outofstock';
                                    if ( doubleval( $minimumValue ) < $eth_balance_f ) {
                                        $status = 'instock';
                                    }
                                    wc_update_product_stock_status( $product_id, $status );
                                    //            // adjust stock quantity for fee
                                    //            list($eth_value_diff_wei, $_) = $eth_value_diff_wei->divide(new phpseclib\Math\BigInteger(pow(10, 9)));
                                    //            $eth_value_f = floatval(doubleval($eth_value_diff_wei->toString()) / pow(10, 9));
                                    //            // the fee amount to decrease stock
                                    //            $eth_value_diff_wei = $eth_value_wei->subtract($eth_value_wei0);
                                    //            // adjust stock quantity for fee
                                    //            list($eth_value_diff_wei, $_) = $eth_value_diff_wei->divide(new phpseclib\Math\BigInteger(pow(10, 9)));
                                    //            $eth_value_f = floatval(doubleval($eth_value_diff_wei->toString()) / pow(10, 9));
                                    //            wc_update_product_stock( $product, $eth_value_f, 'decrease');
                                }
                            
                            }
                            
                            if ( !is_null( $order_id ) ) {
                                update_post_meta( $order_id, 'status', __( 'Success', 'cryptocurrency-product-for-woocommerce' ) );
                            }
                            return array( $txHash, $nonce, false );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_txhash_path( $txHash, $blockchainNetwork )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $view_transaction_url = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['view_transaction_url'] ) ? esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['view_transaction_url'] ) : '' );
                            if ( !empty($view_transaction_url) ) {
                                return sprintf( $view_transaction_url, $txHash );
                            }
                            $txHashPath = '';
                            switch ( $blockchainNetwork ) {
                                case 'mainnet':
                                    $txHashPath = 'https://etherscan.io/tx/' . $txHash;
                                    break;
                                case 'ropsten':
                                    $txHashPath = 'https://ropsten.etherscan.io/tx/' . $txHash;
                                    break;
                                case 'rinkeby':
                                    $txHashPath = 'https://rinkeby.etherscan.io/tx/' . $txHash;
                                    break;
                                default:
                                    break;
                            }
                            return $txHashPath;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_set_order_txhash( $order_id, $txHash, $blockchainNetwork )
                        {
                            $txHashPath = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_txhash_path( $txHash, $blockchainNetwork );
                            $order = wc_get_order( $order_id );
                            $order->add_order_note( sprintf( __( 'Sent to blockchain. Transaction hash  <a target="_blank" href="%1$s">%2$s</a>.', 'cryptocurrency-product-for-woocommerce' ), $txHashPath, $txHash ) );
                            update_post_meta( $order_id, 'ether_txhash', sanitize_text_field( $txHash ) );
                        }
                        
                        add_action(
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_send_tx",
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_send_tx",
                            0,
                            4
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_send_tx(
                            $contractAddress,
                            $data,
                            $gasLimit,
                            $providerUrl,
                            $restartOnError = true
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            // проверить, есть ли прошлая транзакция
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress();
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return;
                            }
                            
                            $lasttxhash = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_last_txhash( $thisWalletAddress );
                            $txhash = null;
                            $nonce = null;
                            $canceled = false;
                            
                            if ( $lasttxhash ) {
                                $lastnonce = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_last_nonce( $thisWalletAddress );
                                // если есть, проверить, завершена ли она
                                $tx_confirmed = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_tx_confirmed( $lasttxhash, $lastnonce, $providerUrl );
                                
                                if ( $tx_confirmed ) {
                                    //   - да, послать новую транзакцию
                                    list( $txhash, $nonce, $canceled ) = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_send_tx_impl(
                                        $contractAddress,
                                        $data,
                                        $gasLimit,
                                        $providerUrl
                                    );
                                } else {
                                    
                                    if ( is_null( $tx_confirmed ) ) {
                                        // nonce in last tx is outdated. remove it
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_delete_last_txhash( $thisWalletAddress );
                                        //            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_cancel_complete_order_task($order_id, $txhash, $nonce);
                                    }
                                
                                }
                            
                            } else {
                                // нет последней транзакции. послать новую транзакцию
                                list( $txhash, $nonce, $canceled ) = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_send_tx_impl(
                                    $contractAddress,
                                    $data,
                                    $gasLimit,
                                    $providerUrl
                                );
                            }
                            
                            
                            if ( $txhash ) {
                                // успех - запомнить новую последнюю транзакцию
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_set_last_txhash( $thisWalletAddress, $txhash, $nonce );
                            } else {
                                if ( !$canceled ) {
                                    // Неуспех - поставить себя снова в очередь
                                    if ( $restartOnError ) {
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_send_tx_task(
                                            $contractAddress,
                                            $data,
                                            $gasLimit,
                                            $providerUrl,
                                            1 * 60
                                        );
                                    }
                                }
                            }
                            
                            return $txhash;
                        }
                        
                        // TODO: wait for a configured number of blocks
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_tx_confirmed(
                            $txhash,
                            $lastnonce,
                            $providerUrl,
                            $product_id = null,
                            $from_user_id = null
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                            $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                            $eth = $web3->eth;
                            $is_confirmed = false;
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id, $from_user_id );
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return $is_confirmed;
                            }
                            
                            $eth->getTransactionByHash( $txhash, function ( $err, $transaction ) use(
                                &$is_confirmed,
                                $txhash,
                                $lastnonce,
                                $thisWalletAddress,
                                $providerUrl
                            ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to getTransactionByHash: " . $err );
                                    $nonce = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_nonce( $thisWalletAddress, $providerUrl );
                                    
                                    if ( !is_null( $nonce ) && intval( $lastnonce ) < intval( $nonce ) ) {
                                        // tx outdated flag
                                        $is_confirmed = null;
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "tx nonce({$lastnonce}) less then address nonce({$nonce})" );
                                    }
                                    
                                    return;
                                }
                                
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "transaction: " . print_r( $transaction, true ) );
                                
                                if ( is_null( $transaction ) ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "tx ({$txhash}) is not found in blockchain" );
                                    $is_confirmed = null;
                                } else {
                                    $is_confirmed = property_exists( $transaction, "blockHash" ) && !empty($transaction->blockHash) && '0x0000000000000000000000000000000000000000000000000000000000000000' != $transaction->blockHash;
                                }
                            
                            } );
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "is_confirmed({$txhash}): " . $is_confirmed );
                            return $is_confirmed;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_tx_succeeded( $txhash, $providerUrl )
                        {
                            $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                            $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                            $eth = $web3->eth;
                            $is_confirmed = false;
                            $gas = NULL;
                            $eth->getTransactionByHash( $txhash, function ( $err, $transaction ) use( &$gas, &$is_confirmed ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to getTransactionByHash: " . $err );
                                    return;
                                }
                                
                                //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("transaction: " . print_r($transaction, true));
                                $is_confirmed = property_exists( $transaction, "blockHash" ) && !empty($transaction->blockHash) && '0x0000000000000000000000000000000000000000000000000000000000000000' != $transaction->blockHash;
                                $gas = $transaction->gas;
                            } );
                            if ( !$is_confirmed ) {
                                return null;
                            }
                            $gasUsed = NULL;
                            $status = NULL;
                            $eth->getTransactionReceipt( $txhash, function ( $err, $transactionReceipt ) use( &$gasUsed, &$status ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to getTransactionReceipt: " . $err );
                                    return;
                                }
                                
                                //        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("transactionReceipt: " . print_r($transactionReceipt, true));
                                if ( property_exists( $transactionReceipt, "gasUsed" ) && !empty($transactionReceipt->gasUsed) ) {
                                    $gasUsed = $transactionReceipt->gasUsed;
                                }
                                if ( property_exists( $transactionReceipt, "status" ) && !empty($transactionReceipt->status) ) {
                                    $status = $transactionReceipt->status;
                                }
                            } );
                            if ( !is_null( $status ) ) {
                                return boolval( intval( $status, 16 ) );
                            }
                            if ( is_null( $gasUsed ) ) {
                                return null;
                            }
                            return intval( $gas, 16 ) != intval( $gasUsed, 16 );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_last_txhash( $thisWalletAddress )
                        {
                            $option = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue-txhash";
                            $txhash = get_option( $option );
                            return $txhash;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_last_nonce( $thisWalletAddress )
                        {
                            $option = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue-nonce";
                            $nonce = get_option( $option );
                            return $nonce;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_set_last_txhash( $thisWalletAddress, $txhash, $nonce )
                        {
                            $option = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue-txhash";
                            $new_value = $txhash;
                            $autoload = true;
                            update_option( $option, $new_value, $autoload );
                            $option = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue-nonce";
                            $new_value = $nonce;
                            $autoload = true;
                            update_option( $option, $new_value, $autoload );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_delete_last_txhash( $thisWalletAddress )
                        {
                            $option = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue-txhash";
                            delete_option( $option );
                            $option = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue-nonce";
                            delete_option( $option );
                        }
                        
                        add_action(
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_complete_order",
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_complete_order",
                            0,
                            1
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_complete_order( $order_id )
                        {
                            try {
                                // do the payment
                                $order = wc_get_order( $order_id );
                                $order_items = $order->get_items();
                                foreach ( $order_items as $product ) {
                                    $product_id = $product['product_id'];
                                    if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id ) ) {
                                        // skip non-cryptocurrency products
                                        continue;
                                    }
                                    $_product = wc_get_product( $product_id );
                                    
                                    if ( !$_product ) {
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "complete_order({$product_id}) not a product" );
                                        continue;
                                    }
                                    
                                    $cryptocurrency_option = get_post_meta( $product_id, '_select_cryptocurrency_option', true );
                                    do_action(
                                        'cryptocurrency_product_for_woocommerce_complete_order',
                                        $cryptocurrency_option,
                                        $order_id,
                                        $product_id
                                    );
                                }
                            } catch ( Exception $ex ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order: " . $ex->getMessage() );
                                // Неуспех - поставить себя снова в очередь +60сек
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_process_order_task( $order_id, 60 );
                            }
                        }
                        
                        add_action(
                            'cryptocurrency_product_for_woocommerce_complete_order',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_complete_order_hook',
                            10,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_complete_order_hook( $cryptocurrency_option, $order_id, $product_id )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            if ( 'Ether' !== $cryptocurrency_option ) {
                                return;
                            }
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id );
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                update_post_meta( $order_id, 'status', __( 'Configuration error', 'cryptocurrency-product-for-woocommerce' ) );
                                return null;
                            }
                            
                            $providerUrl = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint();
                            $txhash = get_post_meta( $order_id, 'ether_txhash', true );
                            
                            if ( empty($txhash) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "INTERNAL LOGIC ERROR: no ether_txhash in the order complete task for order: " . $order_id );
                                return;
                            }
                            
                            //    $nonce = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_last_nonce($thisWalletAddress);
                            $tx_succeeded = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_tx_succeeded( $txhash, $providerUrl );
                            
                            if ( $tx_succeeded ) {
                                // Load the order.
                                $order = wc_get_order( $order_id );
                                // Place the order on hold.
                                $res = $order->update_status( 'completed', __( 'Transaction confirmed.', 'cryptocurrency-product-for-woocommerce' ) );
                                
                                if ( !$res ) {
                                    // failed to complete order
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to complete order: " . $order_id );
                                    // Неуспех - поставить себя снова в очередь
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_complete_order_task( $order_id, 30 );
                                }
                                
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Order " . $order_id . " completed." );
                            } else {
                                
                                if ( is_null( $tx_succeeded ) ) {
                                    // tx is not confirmed yet
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to complete order: " . $order_id . ". tx is not confirmed yet. Restart processing." );
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_complete_order_task( $order_id, 30 );
                                } else {
                                    // transaction failed
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "transaction {$txhash} for {$order_id} has failed" );
                                    update_post_meta( $order_id, 'status', __( 'Transaction failed', 'cryptocurrency-product-for-woocommerce' ) );
                                    // Load the order.
                                    $order = wc_get_order( $order_id );
                                    // Place the order to failed.
                                    $blockchainNetwork = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBlockchainNetwork();
                                    $txHashPath = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_txhash_path( $txhash, $blockchainNetwork );
                                    $res = $order->update_status( 'failed', sprintf( __( 'Transaction <a target="_blank" href="%1$s">%2$s</a> has failed.', 'cryptocurrency-product-for-woocommerce' ), $txHashPath, $txhash ) );
                                    
                                    if ( !$res ) {
                                        // failed to complete order
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to fail order: " . $order_id );
                                        // Неуспех - поставить себя снова в очередь
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_complete_order_task( $order_id, 30 );
                                    }
                                
                                }
                            
                            }
                        
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_complete_order_task( $order_id, $offset = 0 )
                        {
                            $order = wc_get_order( $order_id );
                            
                            if ( !$order ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to create complete_order task for order: {$order_id}" );
                                return;
                            }
                            
                            $date = $order->get_date_created();
                            // fail order after one week of inactivity
                            $timeout = 3600 * 24 * CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getExpirationPeriod();
                            
                            if ( time() - $date->getTimestamp() > $timeout ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to create complete_order task for order {$order_id}: order timed out." );
                                update_post_meta( $order_id, 'status', __( 'Timed out', 'cryptocurrency-product-for-woocommerce' ) );
                                // Place the order to failed.
                                $res = $order->update_status( 'failed', __( 'Timed out', 'cryptocurrency-product-for-woocommerce' ) );
                                if ( !$res ) {
                                    // failed to complete order
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to fail order: " . $order_id );
                                }
                                return;
                            }
                            
                            $timestamp = time() + $offset;
                            $hook = "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_complete_order";
                            $args = array( $order_id );
                            $task_id = as_schedule_single_action( $timestamp, $hook, $args );
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Task complete_order with id {$task_id} scheduled for order: {$order_id}" );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_cancel_complete_order_task( $order_id, $txhash, $nonce )
                        {
                            //    global $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options;
                            $hook = "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_complete_order";
                            $args = array( $order_id, $txhash, $nonce );
                            as_unschedule_action( $hook, $args );
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Task complete_order with txhash {$txhash} unscheduled for order: {$order_id}" );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_send_tx_task(
                            $contractAddress,
                            $data,
                            $gasLimit,
                            $providerUrl,
                            $offset = 0
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $timestamp = time() + $offset;
                            $hook = "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_send_tx";
                            $args = array(
                                $contractAddress,
                                $data,
                                $gasLimit,
                                $providerUrl
                            );
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress();
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return;
                            }
                            
                            $group = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue";
                            $task_id = as_schedule_single_action(
                                $timestamp,
                                $hook,
                                $args,
                                $group
                            );
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Task send_tx({$contractAddress}) with id {$task_id} scheduled for group: {$group}" );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_enqueue_send_ether_task(
                            $order_id,
                            $product_id,
                            $marketAddress,
                            $product_quantity,
                            $providerUrl,
                            $offset = 0,
                            $from_user_id = null
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $timestamp = time() + $offset;
                            $hook = "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_send_ether";
                            $args = array(
                                $order_id,
                                $product_id,
                                $marketAddress,
                                $product_quantity,
                                $providerUrl,
                                $from_user_id
                            );
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id, $from_user_id );
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return;
                            }
                            
                            $group = $thisWalletAddress . "-cryptocurrency-product-for-woocommerce-queue";
                            $task_id = as_schedule_single_action(
                                $timestamp,
                                $hook,
                                $args,
                                $group
                            );
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Task send_ether with id {$task_id} for order {$order_id} scheduled for group: {$group}" );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_nonce( $accountAddress, $providerUrl, $eth = null )
                        {
                            
                            if ( !$eth ) {
                                $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                                $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                                $eth = $web3->eth;
                            }
                            
                            $nonce = 0;
                            $eth->getTransactionCount( $accountAddress, function ( $err, $transactionCount ) use( &$nonce ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to getTransactionCount: " . $err );
                                    $nonce = null;
                                    return;
                                }
                                
                                $nonce = intval( $transactionCount->toString() );
                            } );
                            return $nonce;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_send_tx_impl(
                            $contractAddress,
                            $data,
                            $gasLimit,
                            $providerUrl
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress();
                            
                            if ( is_null( $thisWalletAddress ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return null;
                            }
                            
                            $chainId = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getChainId();
                            
                            if ( null === $chainId ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Blockchain", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return null;
                            }
                            
                            // 4. call payToken if allowance is enough
                            $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                            $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                            $eth = $web3->eth;
                            $nonce = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_nonce( $thisWalletAddress, $providerUrl, $eth );
                            
                            if ( null === $nonce ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "nonce is null" );
                                return null;
                            }
                            
                            $gasPrice = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_gas_price_wei();
                            $thisWalletPrivKey = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletPrivateKey();
                            
                            if ( is_null( $thisWalletPrivKey ) ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( sprintf( __( 'Configuration error! The "%s" setting is not set.', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet private key", 'cryptocurrency-product-for-woocommerce' ) ) );
                                return null;
                            }
                            
                            $to = $contractAddress;
                            $nonceb = \BitWasp\Buffertools\Buffer::int( $nonce );
                            $gasPrice = \BitWasp\Buffertools\Buffer::int( $gasPrice );
                            $gasLimit = \BitWasp\Buffertools\Buffer::int( $gasLimit );
                            $transactionData = [
                                'nonce'    => '0x' . $nonceb->getHex(),
                                'to'       => strtolower( $to ),
                                'gas'      => '0x' . $gasLimit->getHex(),
                                'gasPrice' => '0x' . $gasPrice->getHex(),
                                'value'    => '0x0',
                                'chainId'  => $chainId,
                                'data'     => '0x' . $data,
                            ];
                            $transaction = new \Web3p\EthereumTx\Transaction( $transactionData );
                            $signedTransaction = "0x" . $transaction->sign( $thisWalletPrivKey );
                            $txHash = null;
                            $eth->sendRawTransaction( (string) $signedTransaction, function ( $err, $transaction ) use( &$txHash, &$transactionData ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to sendRawTransaction: " . $err );
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to sendRawTransaction: transactionData=" . print_r( $transactionData, true ) );
                                    return;
                                }
                                
                                $txHash = $transaction;
                            } );
                            if ( null === $txHash ) {
                                return null;
                            }
                            return array( $txHash, $nonce, false );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_encodeParameters( $types, $params )
                        {
                            $ethABI = new \Web3\Contracts\Ethabi( [
                                'address'      => new Web3\Contracts\Types\Address(),
                                'bool'         => new Web3\Contracts\Types\Boolean(),
                                'bytes'        => new Web3\Contracts\Types\Bytes(),
                                'dynamicBytes' => new Web3\Contracts\Types\DynamicBytes(),
                                'int'          => new Web3\Contracts\Types\Integer(),
                                'string'       => new Web3\Contracts\Types\Str(),
                                'uint'         => new Web3\Contracts\Types\Uinteger(),
                            ] );
                            $_data = $ethABI->encodeParameters( $types, $params );
                            return $_data;
                        }
                        
                        /**
                         * Log information using the WC_Logger class.
                         *
                         * Will do nothing unless debug is enabled.
                         *
                         * @param string $msg   The message to be logged.
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( $msg )
                        {
                            static  $logger = false ;
                            // Create a logger instance if we don't already have one.
                            if ( false === $logger ) {
                                $logger = new WC_Logger();
                            }
                            $logger->add( 'cryptocurrency-product-for-woocommerce', $msg );
                        }
                        
                        add_action(
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order",
                            "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order",
                            0,
                            1
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_is_order_payed( $order_id )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $txhash = get_post_meta( $order_id, 'ether_txhash', true );
                            return !empty($txhash);
                        }
                        
                        add_action(
                            'cryptocurrency_product_for_woocommerce_get_cryptocurrency_address',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_get_cryptocurrency_address_hook',
                            10,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_get_cryptocurrency_address_hook( $address, $cryptocurrency_option, $order_id )
                        {
                            if ( "ETHEREUM" !== apply_filters( 'cryptocurrency_product_for_woocommerce_get_base_blockchain', '', $cryptocurrency_option ) ) {
                                return $address;
                            }
                            $_billing_cryptocurrency_ethereum_address = get_post_meta( $order_id, '_billing_cryptocurrency_ethereum_address', true );
                            
                            if ( empty($_billing_cryptocurrency_ethereum_address) ) {
                                $order = wc_get_order( $order_id );
                                if ( !$order ) {
                                    return $address;
                                }
                                $user_id = $order->get_customer_id();
                                if ( $user_id <= 0 ) {
                                    return $address;
                                }
                                $_billing_cryptocurrency_ethereum_address = get_user_meta( $user_id, 'user_ethereum_wallet_address', true );
                            }
                            
                            if ( empty($_billing_cryptocurrency_ethereum_address) ) {
                                return $address;
                            }
                            return $_billing_cryptocurrency_ethereum_address;
                        }
                        
                        /**
                         * Check if order is not processed yet and process it in this case:
                         * sends Ether or ERC20 tokens to the customer Ethereum address
                         * 
                         * @param int $order_id The order id
                         */
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order( $order_id )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            try {
                                // do the payment
                                $order = wc_get_order( $order_id );
                                $order_items = $order->get_items();
                                foreach ( $order_items as $product ) {
                                    $product_id = $product['product_id'];
                                    if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id ) ) {
                                        // skip non-cryptocurrency products
                                        continue;
                                    }
                                    $_product = wc_get_product( $product_id );
                                    
                                    if ( !$_product ) {
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "process_order({$product_id}) not a product" );
                                        continue;
                                    }
                                    
                                    $cryptocurrency_option = get_post_meta( $product_id, '_select_cryptocurrency_option', true );
                                    $_billing_cryptocurrency_address = apply_filters(
                                        'cryptocurrency_product_for_woocommerce_get_cryptocurrency_address',
                                        '',
                                        $cryptocurrency_option,
                                        $order_id
                                    );
                                    
                                    if ( empty($_billing_cryptocurrency_address) ) {
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Ethereum address is empty for order {$order_id}. Skip processing." );
                                        continue;
                                    }
                                    
                                    $marketAddress = $_billing_cryptocurrency_address;
                                    $minimumValue = apply_filters( 'woocommerce_quantity_input_min', 0, $_product );
                                    if ( empty($minimumValue) || 0 == $minimumValue ) {
                                        $minimumValue = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_min( 0.01, $_product );
                                    }
                                    $rate = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_product_rate_for_1_store_currency( $product_id );
                                    //            $product_quantity = $product['qty'];
                                    $product_quantity = $product['total'] * $rate;
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order({$product_id}): rate = {$rate}, total: " . $product['total'] . ', total_tax: ' . $product['total_tax'] . ', product_quantity=' . $product_quantity );
                                    
                                    if ( floatval( $product_quantity ) < floatval( $minimumValue ) ) {
                                        // Place the order to failed.
                                        $res = $order->update_status( 'failed', sprintf( __( 'Product quantity %1$s less then the minimum allowed: %2$s.', 'cryptocurrency-product-for-woocommerce' ), $product_quantity, $minimumValue ) );
                                        if ( !$res ) {
                                            // failed to complete order
                                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to fail order: " . $order_id );
                                        }
                                        continue;
                                    }
                                    
                                    $maximumValue = apply_filters( 'woocommerce_quantity_input_max', -1, $_product );
                                    if ( empty($maximumValue) || $maximumValue ) {
                                        $maximumValue = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_max( -1, $_product );
                                    }
                                    if ( $maximumValue > 0 ) {
                                        //                $product_quantity = $product['qty'];
                                        
                                        if ( floatval( $product_quantity ) > floatval( $maximumValue ) ) {
                                            // Place the order to failed.
                                            $res = $order->update_status( 'failed', sprintf( __( 'Product quantity %1$s greater then the maximum allowed: %2$s.', 'cryptocurrency-product-for-woocommerce' ), $product_quantity, $maximumValue ) );
                                            if ( !$res ) {
                                                // failed to complete order
                                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to fail order: " . $order_id );
                                            }
                                            continue;
                                        }
                                    
                                    }
                                    do_action(
                                        'cryptocurrency_product_for_woocommerce_enqueue_send_task',
                                        $cryptocurrency_option,
                                        $order_id,
                                        $product_id,
                                        $marketAddress,
                                        $product_quantity
                                    );
                                }
                            } catch ( Exception $ex ) {
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order: " . $ex->getMessage() );
                                // Неуспех - поставить себя снова в очередь +60сек
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_process_order_task( $order_id, 60 );
                            }
                        }
                        
                        add_action(
                            'cryptocurrency_product_for_woocommerce_enqueue_send_task',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_enqueue_send_task_hook',
                            10,
                            5
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_enqueue_send_task_hook(
                            $cryptocurrency_option,
                            $order_id,
                            $product_id,
                            $marketAddress,
                            $product_quantity
                        )
                        {
                            if ( 'Ether' !== $cryptocurrency_option ) {
                                return;
                            }
                            // send Ether
                            
                            if ( CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_is_order_payed( $order_id ) ) {
                                $txhash = get_post_meta( $order_id, 'ether_txhash', true );
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Payment found for order {$order_id}: {$txhash}. Skip payment." );
                                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_complete_order_task( $order_id );
                                return;
                            }
                            
                            $providerUrl = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint();
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_enqueue_send_ether_task(
                                $order_id,
                                $product_id,
                                $marketAddress,
                                $product_quantity,
                                $providerUrl
                            );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_process_order_task( $order_id, $offset = 0 )
                        {
                            //    global $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options;
                            $timestamp = time() + $offset;
                            $hook = "CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_process_order";
                            $args = array( $order_id );
                            $task_id = as_schedule_single_action( $timestamp, $hook, $args );
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Task process_order with id {$task_id} scheduled for order: {$order_id}" );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint()
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $web3Endpoint = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['web3Endpoint'] ) ? esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['web3Endpoint'] ) : '' );
                            if ( !empty($web3Endpoint) ) {
                                return $web3Endpoint;
                            }
                            $infuraApiKey = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['infuraApiKey'] ) ? esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['infuraApiKey'] ) : '' );
                            $blockchainNetwork = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBlockchainNetwork();
                            if ( empty($blockchainNetwork) ) {
                                $blockchainNetwork = 'mainnet';
                            }
                            $web3Endpoint = "https://" . esc_attr( $blockchainNetwork ) . ".infura.io/v3/" . esc_attr( $infuraApiKey );
                            return $web3Endpoint;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getExpirationPeriod()
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $expiration_period = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['expiration_period'] ) ? esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['expiration_period'] ) : '7' );
                            return intval( $expiration_period );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getChainId()
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $web3Endpoint = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['web3Endpoint'] ) ? esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['web3Endpoint'] ) : '' );
                            
                            if ( !empty($web3Endpoint) ) {
                                $providerUrl = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint();
                                $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                                $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                                $net = $web3->net;
                                $_version = null;
                                $net->version( function ( $err, $version ) use( &$_version ) {
                                    
                                    if ( $err !== null ) {
                                        CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to get blockchain version: " . $err );
                                        return;
                                    }
                                    
                                    $_version = intval( $version );
                                } );
                                return $_version;
                            }
                            
                            $blockchainNetwork = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBlockchainNetwork();
                            if ( empty($blockchainNetwork) ) {
                                $blockchainNetwork = 'mainnet';
                            }
                            if ( $blockchainNetwork === 'mainnet' ) {
                                return 1;
                            }
                            if ( $blockchainNetwork === 'ropsten' ) {
                                return 3;
                            }
                            if ( $blockchainNetwork === 'rinkeby' ) {
                                return 4;
                            }
                            CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Bad blockchain_network setting:" . $blockchainNetwork );
                            return null;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBlockchainNetwork()
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $blockchainNetwork = 'mainnet';
                            if ( !isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['blockchain_network'] ) ) {
                                return $blockchainNetwork;
                            }
                            if ( empty($CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['blockchain_network']) ) {
                                return $blockchainNetwork;
                            }
                            $blockchainNetwork = esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['blockchain_network'] );
                            return $blockchainNetwork;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getBalanceEth( $thisWalletAddress, $providerUrl, $eth = null )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            
                            if ( is_null( $eth ) ) {
                                $requestManager = new \Web3\RequestManagers\HttpRequestManager( $providerUrl, 10 );
                                $web3 = new \Web3\Web3( new \Web3\Providers\HttpProvider( $requestManager ) );
                                $eth = $web3->eth;
                            }
                            
                            $ether_balance_wei = null;
                            $eth->getBalance( $thisWalletAddress, function ( $err, $balance ) use( &$ether_balance_wei ) {
                                
                                if ( $err !== null ) {
                                    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( "Failed to getBalance: " . $err );
                                    return;
                                }
                                
                                $ether_balance_wei = $balance;
                            } );
                            return $ether_balance_wei;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress( $product_id = null, $from_user_id = null )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $wallet = null;
                            
                            if ( !is_null( $from_user_id ) ) {
                                $vendor_id = $from_user_id;
                                
                                if ( user_can( $vendor_id, 'administrator' ) ) {
                                    if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'] ) ) {
                                        $wallet = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'];
                                    }
                                } else {
                                    if ( user_can( $vendor_id, 'vendor' ) ) {
                                    }
                                }
                            
                            }
                            
                            if ( !is_null( $wallet ) && !empty($wallet) ) {
                                return esc_attr( $wallet );
                            }
                            
                            if ( current_user_can( 'administrator' ) ) {
                                if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'] ) ) {
                                    $wallet = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'];
                                }
                            } else {
                                
                                if ( current_user_can( 'vendor' ) ) {
                                } else {
                                    $user_id = get_current_user_id();
                                    
                                    if ( $user_id <= 0 ) {
                                        // background task processing
                                        $vendor_id = get_post_field( 'post_author_override', $product_id );
                                        if ( empty($vendor_id) ) {
                                            $vendor_id = get_post_field( 'post_author', $product_id );
                                        }
                                        
                                        if ( user_can( $vendor_id, 'administrator' ) ) {
                                            if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'] ) ) {
                                                $wallet = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'];
                                            }
                                        } else {
                                            if ( user_can( $vendor_id, 'vendor' ) ) {
                                            }
                                        }
                                    
                                    }
                                
                                }
                            
                            }
                            
                            if ( is_null( $wallet ) || empty($wallet) ) {
                                if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'] ) ) {
                                    $wallet = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_address'];
                                }
                            }
                            if ( is_null( $wallet ) || empty($wallet) ) {
                                return null;
                            }
                            return esc_attr( $wallet );
                        }
                        
                        function _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletPrivateKey( $product_id = null, $from_user_id = null )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $privateKey = null;
                            
                            if ( !is_null( $from_user_id ) ) {
                                $vendor_id = $from_user_id;
                                
                                if ( user_can( $vendor_id, 'administrator' ) ) {
                                    if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'] ) ) {
                                        $privateKey = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'];
                                    }
                                } else {
                                    if ( user_can( $vendor_id, 'vendor' ) ) {
                                    }
                                }
                            
                            }
                            
                            if ( !is_null( $privateKey ) && !empty($privateKey) ) {
                                return esc_attr( $privateKey );
                            }
                            
                            if ( current_user_can( 'administrator' ) ) {
                                if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'] ) ) {
                                    $privateKey = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'];
                                }
                            } else {
                                
                                if ( current_user_can( 'vendor' ) ) {
                                } else {
                                    $user_id = get_current_user_id();
                                    
                                    if ( $user_id <= 0 ) {
                                        // background task processing
                                        $vendor_id = get_post_field( 'post_author_override', $product_id );
                                        if ( empty($vendor_id) ) {
                                            $vendor_id = get_post_field( 'post_author', $product_id );
                                        }
                                        
                                        if ( user_can( $vendor_id, 'administrator' ) ) {
                                            if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'] ) ) {
                                                $privateKey = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'];
                                            }
                                        } else {
                                            if ( user_can( $vendor_id, 'vendor' ) ) {
                                            }
                                        }
                                    
                                    }
                                
                                }
                            
                            }
                            
                            if ( is_null( $privateKey ) || empty($privateKey) ) {
                                if ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'] ) ) {
                                    $privateKey = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_private_key'];
                                }
                            }
                            if ( is_null( $privateKey ) || empty($privateKey) ) {
                                return null;
                            }
                            return esc_attr( $privateKey );
                        }
                        
                        //----------------------------------------------------------------------------//
                        //                            Enqueue Scripts                                 //
                        //----------------------------------------------------------------------------//
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_user_wallet()
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $value = '';
                            if ( !isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_meta'] ) ) {
                                return $value;
                            }
                            $userWalletMetaKey = esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_meta'] );
                            
                            if ( !empty($userWalletMetaKey) ) {
                                // https://stackoverflow.com/a/19722500/4256005
                                $user_id = get_current_user_id();
                                $key = $userWalletMetaKey;
                                $single = true;
                                $value = get_user_meta( $user_id, $key, $single );
                                if ( empty($value) ) {
                                    $value = get_user_meta( $user_id, 'billing_cryptocurrency_ethereum_address', $single );
                                }
                            }
                            
                            return $value;
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_scripts_()
                        {
                            wp_enqueue_script( 'cryptocurrency-product-for-woocommerce' );
                        }
                        
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_script()
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_url_path ;
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            $options = $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options;
                            $min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' );
                            
                            if ( !wp_script_is( 'web3', 'queue' ) && !wp_script_is( 'web3', 'done' ) ) {
                                wp_dequeue_script( 'web3' );
                                wp_deregister_script( 'web3' );
                                wp_register_script(
                                    'web3',
                                    $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_url_path . "/web3{$min}.js",
                                    array( 'jquery' ),
                                    '0.20.6'
                                );
                            }
                            
                            
                            if ( !wp_script_is( 'cryptocurrency-product-for-woocommerce', 'queue' ) && !wp_script_is( 'cryptocurrency-product-for-woocommerce', 'done' ) ) {
                                wp_dequeue_script( 'cryptocurrency-product-for-woocommerce' );
                                wp_deregister_script( 'cryptocurrency-product-for-woocommerce' );
                                wp_register_script(
                                    'cryptocurrency-product-for-woocommerce',
                                    $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_url_path . "/cryptocurrency-product-for-woocommerce{$min}.js",
                                    array( 'jquery', 'web3' ),
                                    '3.8.1'
                                );
                            }
                            
                            $thisWalletAddress = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getHotWalletAddress();
                            if ( is_null( $thisWalletAddress ) ) {
                                $thisWalletAddress = '';
                            }
                            wp_localize_script( 'cryptocurrency-product-for-woocommerce', 'cryptocurrency', apply_filters( 'cryptocurrency_product_for_woocommerce_wp_localize_script', [
                                'web3Endpoint'  => esc_html( CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_getWeb3Endpoint() ),
                                'walletAddress' => esc_html( $thisWalletAddress ),
                            ] ) );
                        }
                        
                        add_action( 'admin_enqueue_scripts', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_enqueue_script' );
                        //----------------------------------------------------------------------------//
                        //                               Admin Options                                //
                        //----------------------------------------------------------------------------//
                        if ( is_admin() ) {
                            include_once $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugin_dir . '/cryptocurrency-product-for-woocommerce.admin.php';
                        }
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_add_menu_link()
                        {
                            $page = add_options_page(
                                __( 'Cryptocurrency Product Settings', 'cryptocurrency-product-for-woocommerce' ),
                                __( 'Cryptocurrency Product', 'cryptocurrency-product-for-woocommerce' ),
                                'manage_options',
                                'cryptocurrency-product-for-woocommerce',
                                'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options_page'
                            );
                        }
                        
                        add_filter( 'admin_menu', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_add_menu_link' );
                        // Place in Option List on Settings > Plugins page
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_actlinks( $links, $file )
                        {
                            // Static so we don't call plugin_basename on every plugin row.
                            static  $this_plugin ;
                            if ( !$this_plugin ) {
                                $this_plugin = plugin_basename( __FILE__ );
                            }
                            
                            if ( $file == $this_plugin ) {
                                $settings_link = '<a href="options-general.php?page=cryptocurrency-product-for-woocommerce">' . __( 'Settings' ) . '</a>';
                                array_unshift( $links, $settings_link );
                                // before other links
                            }
                            
                            return $links;
                        }
                        
                        add_filter(
                            'plugin_action_links',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_actlinks',
                            10,
                            2
                        );
                        //----------------------------------------------------------------------------//
                        //                Use decimal in quantity fields in WooCommerce               //
                        //----------------------------------------------------------------------------//
                        // @see: http://codeontrack.com/use-decimal-in-quantity-fields-in-woocommerce-wordpress/
                        add_action( 'plugins_loaded', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugins_loaded' );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_plugins_loaded()
                        {
                            // Removes the WooCommerce filter, that is validating the quantity to be an int
                            remove_filter( 'woocommerce_stock_amount', 'intval' );
                            // Add a filter, that validates the quantity to be a float
                            add_filter( 'woocommerce_stock_amount', 'floatval' );
                        }
                        
                        //// Add unit price fix when showing the unit price on processed orders
                        //add_filter('woocommerce_order_amount_item_total', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_amount_item_total', 10, 5);
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_amount_item_total($total, $order, $item, $inc_tax = false, $round = true) {
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_amount_item_total: price=$total, item=" . print_r($item, true));
                        //    return $total;
                        ////    $product = $item->get_product();
                        ////    $new_total = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price( $total, $product );
                        ////    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_amount_item_total: new_total=$new_total");
                        ////    return $new_total;
                        //}
                        //add_filter('woocommerce_order_amount_item_subtotal', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_amount_item_subtotal', 10, 5);
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_amount_item_subtotal($subtotal, $order, $item, $inc_tax = false, $round = true) {
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_amount_item_subtotal: subtotal=$subtotal, item=" . print_r($item, true));
                        //    $product = $item->get_product();
                        //    $new_subtotal = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price( $subtotal, $product );
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_amount_item_subtotal: new_subtotal=$new_subtotal");
                        //    return $new_subtotal;
                        //}
                        //add_filter('woocommerce_order_get_total', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_get_total', 10, 2);
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_get_total($total, $order) {
                        ////    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_get_total: total=$total");
                        ////    return $total;
                        //    $new_total = 0;
                        //    foreach ( $order->get_items() as $item ) {
                        //        $new_total += $item->get_total();
                        //    }
                        ////    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_get_total: new_total=$new_total");
                        //    return $new_total;
                        //}
                        //// Add unit price fix when showing the unit price on processed orders
                        //add_filter('woocommerce_order_item_get_total', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_item_get_total', 10, 2);
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_item_get_total($total, $item) {
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_item_get_total: total=$total");
                        //    return $total;
                        ////    $product = $item->get_product();
                        ////    $new_total = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price( $total, $product );
                        ////    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_item_get_total: new_total=$new_total");
                        ////    return $new_total;
                        //}
                        //add_filter('woocommerce_order_item_get_subtotal', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_item_get_subtotal', 10, 2);
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_order_item_get_subtotal($subtotal, $item) {
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_item_get_subtotal: subtotal=$subtotal");
                        //    return $subtotal;
                        ////    $product = $item->get_product();
                        ////    $new_subtotal = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_product_get_price( $subtotal, $product );
                        ////    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_order_item_get_subtotal: new_subtotal=$new_subtotal");
                        ////    return $new_subtotal;
                        //}
                        //add_filter('woocommerce_get_formatted_order_total', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_formatted_order_total', 10, 2);
                        //function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_formatted_order_total($formatted_total, $order/*, $tax_display, $display_refunded*/) {
                        //    $order_total     = $order->get_total();
                        ////    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_get_formatted_order_total:  formatted_total: $formatted_total, tax_display: $tax_display, display_refunded: $display_refunded");
                        //    CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log("woocommerce_get_formatted_order_total: order_total: $order_total, formatted_total: $formatted_total");
                        //    return $formatted_total;
                        //}
                        add_filter(
                            'cryptocurrency_product_for_woocommerce_woocommerce_quantity_input_min',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_woocommerce_quantity_input_min_hook',
                            20,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_woocommerce_quantity_input_min_hook( $min, $cryptocurrency_option, $product_id )
                        {
                            if ( 'Ether' !== $cryptocurrency_option ) {
                                return $min;
                            }
                            return 0.001;
                        }
                        
                        // define the woocommerce_quantity_input_min callback
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_min( $min, $product )
                        {
                            $product_id = $product->get_id();
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id ) ) {
                                return $min;
                            }
                            $minimumValue = get_post_meta( $product_id, '_text_input_cryptocurrency_minimum_value', true );
                            if ( !empty($minimumValue) ) {
                                return floatval( $minimumValue );
                            }
                            $cryptocurrency_option = get_post_meta( $product_id, '_select_cryptocurrency_option', true );
                            return apply_filters(
                                'cryptocurrency_product_for_woocommerce_woocommerce_quantity_input_min',
                                $min,
                                $cryptocurrency_option,
                                $product_id
                            );
                        }
                        
                        add_filter(
                            'woocommerce_quantity_input_min',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_min',
                            10,
                            2
                        );
                        // define the woocommerce_quantity_input_max callback
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_max( $max, $product )
                        {
                            $product_id = $product->get_id();
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id ) ) {
                                return $max;
                            }
                            $cryptocurrency_option = get_post_meta( $product_id, '_select_cryptocurrency_option', true );
                            return apply_filters(
                                'cryptocurrency_product_for_woocommerce_woocommerce_quantity_input_max',
                                $max,
                                $cryptocurrency_option,
                                $product_id
                            );
                        }
                        
                        add_filter(
                            'woocommerce_quantity_input_max',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_max',
                            10,
                            2
                        );
                        add_filter(
                            'cryptocurrency_product_for_woocommerce_woocommerce_quantity_input_step',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_woocommerce_quantity_input_step_hook',
                            20,
                            3
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_woocommerce_quantity_input_step_hook( $step, $cryptocurrency_option, $product_id )
                        {
                            if ( 'Ether' !== $cryptocurrency_option ) {
                                return $step;
                            }
                            return 1.0E-5;
                        }
                        
                        // define the woocommerce_quantity_input_step callback
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_step( $step, $product )
                        {
                            $product_id = $product->get_id();
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency( $product_id ) ) {
                                return $step;
                            }
                            $step = get_post_meta( $product_id, '_text_input_cryptocurrency_step', true );
                            if ( !empty($step) ) {
                                return floatval( $step );
                            }
                            $cryptocurrency_option = get_post_meta( $product_id, '_select_cryptocurrency_option', true );
                            return apply_filters(
                                'cryptocurrency_product_for_woocommerce_woocommerce_quantity_input_step',
                                $step,
                                $cryptocurrency_option,
                                $product_id
                            );
                        }
                        
                        add_filter(
                            'woocommerce_quantity_input_step',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_woocommerce_quantity_input_step',
                            10,
                            2
                        );
                        //----------------------------------------------------------------------------//
                        //                                   L10n                                     //
                        //----------------------------------------------------------------------------//
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_load_textdomain()
                        {
                            /**
                             * Localise.
                             */
                            load_plugin_textdomain( 'cryptocurrency-product-for-woocommerce', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
                        }
                        
                        add_action( 'plugins_loaded', 'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_load_textdomain' );
                        //----------------------------------------------------------------------------//
                        //                      Ethereum address verification                         //
                        //----------------------------------------------------------------------------//
                        add_action(
                            'woocommerce_after_checkout_validation',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_after_checkout_validation',
                            10,
                            2
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_after_checkout_validation( $data, $errors )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            if ( !_CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_is_cryptocurrency_product_in_cart() ) {
                                return;
                            }
                            $cryptocurrency_option = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_type_in_cart();
                            $product_id = _CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_get_cryptocurrency_product_id_in_cart();
                            do_action(
                                'cryptocurrency_product_for_woocommerce_after_checkout_validation',
                                $cryptocurrency_option,
                                $product_id,
                                $data,
                                $errors
                            );
                        }
                        
                        add_filter(
                            'cryptocurrency_product_for_woocommerce_after_checkout_validation',
                            'CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_override_checkout_fields',
                            20,
                            4
                        );
                        function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_ETHER_ALL_after_checkout_validation(
                            $cryptocurrency_option,
                            $product_id,
                            $data,
                            $errors
                        )
                        {
                            global  $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options ;
                            if ( "ETHEREUM" !== apply_filters( 'cryptocurrency_product_for_woocommerce_get_base_blockchain', '', $cryptocurrency_option ) ) {
                                return;
                            }
                            $user_id = get_current_user_id();
                            $walletDisabled = ( isset( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_field_disable'] ) ? esc_attr( $CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options['wallet_field_disable'] ) : '' );
                            $isWalletFieldDisabled = !empty($walletDisabled);
                            if ( !($user_id > 0 || $isWalletFieldDisabled || !function_exists( 'ETHEREUM_WALLET_create_account' ) || !WC()->checkout()->is_registration_required()) ) {
                                // TODO: гость ввёл fd9422a2-eb92-46d7-a490-25ac1211a4e6 вместо адреса и смог оплатить биткойном
                                // Wallet плагин установлен
                                // "Allow customers to place orders without an account" is checked
                                return;
                            }
                            $value = (string) $data['billing_cryptocurrency_ethereum_address'];
                            if ( \Web3\Utils::isAddress( $value ) ) {
                                return;
                            }
                            // Do your data processing here and in case of an
                            // error add it to the errors array like:
                            $errors->add( 'validation', __( 'Please input correct Ethereum address in the form like 0x476Bb28Bc6D0e9De04dB5E19912C392F9a76535d.', 'cryptocurrency-product-for-woocommerce' ) );
                        }
                    
                    }
                    
                    //if ( ! function_exists( 'cryptocurrency_product_for_woocommerce_freemius_init' ) ) {
                }
                
                // WooCommerce activated
            }
        
        }
    
    }

}

// PHP version