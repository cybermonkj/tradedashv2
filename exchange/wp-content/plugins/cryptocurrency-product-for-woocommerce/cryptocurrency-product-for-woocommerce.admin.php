<?php

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
function CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_options_page()
{
    // Require admin privs
    if ( !current_user_can( 'manage_options' ) ) {
        return false;
    }
    $new_options = array();
    // Which tab is selected?
    $possible_screens = array(
        'default' => esc_html( __( 'Standard', 'cryptocurrency-product-for-woocommerce' ) ),
    );
    $possible_screens = apply_filters( 'cryptocurrency_product_for_woocommerce_settings_tabs', $possible_screens );
    asort( $possible_screens );
    $current_screen = ( isset( $_GET['tab'] ) && isset( $possible_screens[$_GET['tab']] ) ? $_GET['tab'] : 'default' );
    
    if ( isset( $_POST['Submit'] ) ) {
        // Nonce verification
        check_admin_referer( 'cryptocurrency-product-for-woocommerce-update-options' );
        // Standard options screen
        
        if ( 'default' == $current_screen ) {
            //            $new_options['wallet_address']        = ( ! empty( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_address'] )       /*&& is_numeric( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_address'] )*/ )       ? sanitize_text_field($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_address'])        : '';
            $new_options['gas_limit'] = ( !empty($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_limit']) && is_numeric( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_limit'] ) ? intval( sanitize_text_field( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_limit'] ) ) : 200000 );
            $new_options['gas_price'] = ( !empty($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_price']) && is_numeric( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_price'] ) ? floatval( sanitize_text_field( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_price'] ) ) : 0 );
            if ( !empty($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_private_key']) ) {
                $new_options['wallet_private_key'] = sanitize_text_field( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_private_key'] );
            }
            $new_options['blockchain_network'] = ( !empty($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_blockchain_network']) ? sanitize_text_field( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_blockchain_network'] ) : 'mainnet' );
            $new_options['infuraApiKey'] = ( !empty($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_infuraApiKey']) ? sanitize_text_field( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_infuraApiKey'] ) : '' );
            $new_options['wallet_meta'] = ( !empty($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_meta']) ? sanitize_text_field( $_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_meta'] ) : '' );
            $new_options['wallet_field_disable'] = ( !empty($_POST['CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_field_disable']) ? 'on' : '' );
        }
        
        $new_options = apply_filters( 'cryptocurrency_product_for_woocommerce_get_save_options', $new_options, $current_screen );
        // Get all existing Cryptocurrency Product options
        $existing_options = get_option( 'cryptocurrency-product-for-woocommerce_options', array() );
        
        if ( (!isset( $new_options['wallet_private_key'] ) || empty($new_options['wallet_private_key'])) && (!isset( $existing_options['wallet_private_key'] ) || empty($existing_options['wallet_private_key'])) ) {
            // neither old nor new pkey value is set
            list( $ethAddressChkSum, $privateKeyHex ) = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_create_account();
            $new_options['wallet_address'] = $ethAddressChkSum;
            $new_options['wallet_private_key'] = $privateKeyHex;
        }
        
        
        if ( isset( $existing_options['wallet_private_key'] ) && !empty($existing_options['wallet_private_key']) && isset( $new_options['wallet_private_key'] ) && !empty($new_options['wallet_private_key']) && $existing_options['wallet_private_key'] != $new_options['wallet_private_key'] ) {
            // new pkey value is set. let's backup the old value
            $backup = "";
            if ( isset( $existing_options['_backup_wallet_private_keys'] ) ) {
                $backup = $existing_options['_backup_wallet_private_keys'];
            }
            if ( FALSE === strpos( $backup, $existing_options['wallet_private_key'] ) ) {
                $new_options['_backup_wallet_private_keys'] = $backup . ":" . $existing_options['wallet_private_key'];
            }
            // and calculate the new address from a pkey
            try {
                $ethAddressChkSum = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_address_from_key( $new_options['wallet_private_key'] );
                $new_options['wallet_address'] = $ethAddressChkSum;
            } catch ( \InvalidArgumentException $ex ) {
                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( $ex->getMessage() );
                CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_log( $ex->getTraceAsString() );
                add_settings_error(
                    'wallet_private_key',
                    esc_attr( 'bad_private_key_value' ),
                    sprintf( 'The "%1$s" value entered is not correct.', __( "Ethereum wallet private key", 'cryptocurrency-product-for-woocommerce' ) ),
                    'error'
                );
                unset( $new_options['wallet_private_key'] );
            }
        }
        
        // Merge $new_options into $existing_options to retain Cryptocurrency Product options from all other screens/tabs
        if ( $existing_options ) {
            $new_options = array_merge( $existing_options, $new_options );
        }
        
        if ( false !== get_option( 'cryptocurrency-product-for-woocommerce_options' ) ) {
            update_option( 'cryptocurrency-product-for-woocommerce_options', $new_options );
        } else {
            $deprecated = '';
            $autoload = 'no';
            add_option(
                'cryptocurrency-product-for-woocommerce_options',
                $new_options,
                $deprecated,
                $autoload
            );
        }
        
        ?>
		<div class="updated"><p><?php 
        _e( 'Settings saved.' );
        ?></p></div>
		<?php 
    } else {
        
        if ( isset( $_POST['Reset'] ) ) {
            // Nonce verification
            check_admin_referer( 'cryptocurrency-product-for-woocommerce-update-options' );
            delete_option( 'cryptocurrency-product-for-woocommerce_options' );
        }
    
    }
    
    $existing_options = get_option( 'cryptocurrency-product-for-woocommerce_options', array() );
    
    if ( !isset( $existing_options['wallet_private_key'] ) || empty($existing_options['wallet_private_key']) ) {
        // no pkey is set yet. Let's generate one
        list( $ethAddressChkSum, $privateKeyHex ) = CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_create_account();
        $existing_options['wallet_address'] = $ethAddressChkSum;
        $existing_options['wallet_private_key'] = $privateKeyHex;
        
        if ( false !== get_option( 'cryptocurrency-product-for-woocommerce_options' ) ) {
            update_option( 'cryptocurrency-product-for-woocommerce_options', $existing_options );
        } else {
            $deprecated = '';
            $autoload = 'no';
            add_option(
                'cryptocurrency-product-for-woocommerce_options',
                $existing_options,
                $deprecated,
                $autoload
            );
        }
    
    }
    
    $options = stripslashes_deep( get_option( 'cryptocurrency-product-for-woocommerce_options', array() ) );
    ?>
	
	<div class="wrap">
	
	<h1><?php 
    _e( 'Cryptocurrency Product Settings', 'cryptocurrency-product-for-woocommerce' );
    ?></h1>
    
    <?php 
    settings_errors();
    ?>

    <section>
        <h1><?php 
    _e( 'Install and Configure Guide', 'cryptocurrency-product-for-woocommerce' );
    ?></h1>
        <p><?php 
    echo  sprintf( __( 'Use the official %1$sInstall and Configure%2$s step by step guide to configure this plugin.', 'cryptocurrency-product-for-woocommerce' ), '<a href="https://ethereumico.io/knowledge-base/cryptocurrency-product-for-woocommerce-plugin-install-and-configure/" target="_blank">', '</a>' ) ;
    ?></p>
    </section>
	
    <?php 
    
    if ( cryptocurrency_product_for_woocommerce_freemius_init()->is_not_paying() ) {
        echo  '<section><h1>' . esc_html__( 'Awesome Premium Features', 'cryptocurrency-product-for-woocommerce' ) . '</h1>' ;
        echo  esc_html__( 'ERC20 tokens support and more.', 'cryptocurrency-product-for-woocommerce' ) ;
        echo  ' <a href="' . cryptocurrency_product_for_woocommerce_freemius_init()->get_upgrade_url() . '">' . esc_html__( 'Upgrade Now!', 'cryptocurrency-product-for-woocommerce' ) . '</a>' ;
        echo  '</section>' ;
    }
    
    ?>
	
	<h2 class="nav-tab-wrapper">
        <?php 
    if ( $possible_screens ) {
        foreach ( $possible_screens as $s => $sTitle ) {
            ?>
		<a href="<?php 
            echo  admin_url( 'options-general.php?page=cryptocurrency-product-for-woocommerce&tab=' . esc_attr( $s ) ) ;
            ?>" class="nav-tab<?php 
            if ( $s == $current_screen ) {
                echo  ' nav-tab-active' ;
            }
            ?>"><?php 
            echo  $sTitle ;
            ?></a>
        <?php 
        }
    }
    ?>
	</h2>

	<form id="cryptocurrency-product-for-woocommerce_admin_form" method="post" action="">
	
	<?php 
    wp_nonce_field( 'cryptocurrency-product-for-woocommerce-update-options' );
    ?>

		<table class="form-table">
		
		<?php 
    
    if ( 'default' == $current_screen ) {
        ?>
			<tr valign="top">
			<th scope="row"><?php 
        _e( "Ethereum wallet address", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input disabled class="text" autocomplete="off" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_address" type="text" maxlength="42" placeholder="0x0000000000000000000000000000000000000000" value="<?php 
        echo  ( !empty($options['wallet_address']) ? esc_attr( $options['wallet_address'] ) : '' ) ;
        ?>">
                    <p><?php 
        _e( "The Ethereum address of your wallet from which you would sell Ether or ERC20 tokens.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                    <p><?php 
        echo  sprintf( __( "This Ethereum address is auto generated first time you install this plugin. You can change it by changing the \"%s\" setting.", 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum wallet private key", 'cryptocurrency-product-for-woocommerce' ) ) ;
        ?></p>
                    <p><?php 
        _e( "Send your Ether and/or ERC20/ERC721 tokens to this address to be able to sell it.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                </label>
			</fieldset></td>
			</tr>
			
			<tr valign="top">
			<th scope="row"><?php 
        _e( "Ethereum wallet private key", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input class="text" autocomplete="off" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_private_key" type="password" maxlength="128" value="">
                    <p><?php 
        _e( "The private key of your Ethereum wallet from which you will sell Ether or ERC20 tokens. It is kept in a secret and <strong>never</strong> sent to the client side. See plugin documentation for additional security considerations.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                    <p><?php 
        _e( "This private key is auto generated first time you install this plugin. You can change it to your own if needed here.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                </label>
			</fieldset></td>
			</tr>
			
			<tr valign="top">
			<th scope="row"><?php 
        _e( "Infura.io API Key", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input class="text" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_infuraApiKey" type="text" maxlength="35" placeholder="<?php 
        _e( "Put your Infura.io API Key here", 'cryptocurrency-product-for-woocommerce' );
        ?>" value="<?php 
        echo  ( !empty($options['infuraApiKey']) ? esc_attr( $options['infuraApiKey'] ) : '' ) ;
        ?>">
                    <p><?php 
        echo  sprintf( __( 'The API key for the %1$s. You need to register on this site to obtain it. Use this guide please: %2$s.', 'cryptocurrency-product-for-woocommerce' ), '<a target="_blank" href="https://infura.io/register">https://infura.io/</a>', '<a target="_blank" href="https://ethereumico.io/knowledge-base/infura-api-key-guide/">Get infura API Key</a>' ) ;
        ?></p>
                    <p><strong><?php 
        echo  sprintf( __( 'Note that this setting is ignored if the "%1$s" setting is set', 'cryptocurrency-product-for-woocommerce' ), __( "Ethereum Node JSON-RPC Endpoint", 'cryptocurrency-product-for-woocommerce' ) ) ;
        ?></strong></p>
                </label>
			</fieldset></td>
			</tr>
			
			<tr valign="top">
			<th scope="row"><?php 
        _e( "Blockchain", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input class="text" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_blockchain_network" type="text" maxlength="128" placeholder="mainnet" value="<?php 
        echo  ( !empty($options['blockchain_network']) ? esc_attr( $options['blockchain_network'] ) : 'mainnet' ) ;
        ?>">
                    <p><?php 
        _e( "The blockchain used: mainnet or ropsten. Use mainnet in production, and ropsten in test mode. See plugin documentation for the testing guide.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                </label>
			</fieldset></td>
			</tr>

            <?php 
        ?>
			
			<tr valign="top">
			<th scope="row"><?php 
        _e( "Gas Limit", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input class="text" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_limit" type="number" min="0" step="10000" maxlength="8" placeholder="200000" value="<?php 
        echo  ( !empty($options['gas_limit']) ? esc_attr( $options['gas_limit'] ) : '200000' ) ;
        ?>">
                    <p><?php 
        _e( "The default gas limit to to spend on your transactions. 200000 is a reasonable default value.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                </label>
			</fieldset></td>
			</tr>
			
			<tr valign="top">
			<th scope="row"><?php 
        _e( "Gas price", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input class="text" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_gas_price" type="number" min="0" step="1" maxlength="8" value="<?php 
        echo  ( !empty($options['gas_price']) || '0' == $options['gas_price'] ? esc_attr( $options['gas_price'] ) : '2' ) ;
        ?>">
                    <p><?php 
        _e( "The gas price in Gwei. Reasonable values are in a 2-40 ratio. The default value is 2 that is cheap but not very fast. Increase if you want transactions to be mined faster, decrease if you want pay less fee per transaction.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                </label>
			</fieldset></td>
			</tr>

			<tr valign="top">
			<th scope="row"><?php 
        _e( "Ethereum Wallet meta key", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input class="text" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_meta" type="text" value="<?php 
        echo  ( !empty($options['wallet_meta']) ? esc_attr( $options['wallet_meta'] ) : '' ) ;
        ?>">
                    <p><?php 
        _e( "The meta key used in plugin like Ultimate Member for an Ethereum wallet address field in user registration form. It can be used here to pre-fill the Ethereum wallet field on the Checkout page.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                </label>
			</fieldset></td>
			</tr>

			<tr valign="top">
			<th scope="row"><?php 
        _e( "Disable Ethereum Wallet field?", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                    <input class="checkbox" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_wallet_field_disable" type="checkbox" <?php 
        echo  ( !empty($options['wallet_field_disable']) ? 'checked' : '' ) ;
        ?> >
                    <p><?php 
        _e( "If the Ethereum Wallet meta key value is used, you can disable the Ethereum wallet field on the Checkout page. It prevents user to buy tokens to any other address except the registered one.", 'cryptocurrency-product-for-woocommerce' );
        ?></p>
                </label>
			</fieldset></td>
			</tr>

			<tr valign="top">
			<th scope="row"><?php 
        _e( "Vendor Fee", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                <input <?php 
        if ( !cryptocurrency_product_for_woocommerce_freemius_init()->is__premium_only() || !cryptocurrency_product_for_woocommerce_freemius_init()->is_plan( 'pro', true ) ) {
            echo  'disabled' ;
        }
        ?> class="text" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_vendor_fee" type="number" min="0" step="1" maxlength="8" placeholder="0" value="<?php 
        echo  ( !empty($options['vendor_fee']) ? esc_attr( $options['vendor_fee'] ) : '' ) ;
        ?>">
                    <p><?php 
        echo  sprintf( __( 'The fee in %1$s vendor should pay to publish cryptocurrency product. This fee would be taken from a vendor\'s Ethereum Wallet account in Ether.', 'cryptocurrency-product-for-woocommerce' ), esc_attr( get_woocommerce_currency_symbol() ) ) ;
        ?></p>
                    <?php 
        
        if ( !cryptocurrency_product_for_woocommerce_freemius_init()->is__premium_only() || !cryptocurrency_product_for_woocommerce_freemius_init()->is_plan( 'pro', true ) ) {
            ?>
                    <p><?php 
            echo  sprintf( __( '%1$sUpgrade Now!%2$s to enable this feature.', 'cryptocurrency-product-for-woocommerce' ), '<a href="' . cryptocurrency_product_for_woocommerce_freemius_init()->get_upgrade_url() . '" target="_blank">', '</a>' ) ;
            ?></p>
                    <?php 
        }
        
        
        if ( in_array( 'wc-vendors-pro/wcvendors-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && (!function_exists( 'cryptocurrency_product_for_woocommerce_wcv_freemius_init' ) || !cryptocurrency_product_for_woocommerce_wcv_freemius_init()->is__premium_only() || !cryptocurrency_product_for_woocommerce_wcv_freemius_init()->is_plan( 'pro', true )) ) {
            ?>
                    <p><?php 
            
            if ( function_exists( 'cryptocurrency_product_for_woocommerce_wcv_freemius_init' ) ) {
                echo  sprintf( __( 'Consider the %1$sCryptocurrency Product for WooCommerce WC Vendors Marketplace Addon%2$s for frontend multi-vendor features support.', 'cryptocurrency-product-for-woocommerce' ), '<a href="' . cryptocurrency_product_for_woocommerce_wcv_freemius_init()->get_upgrade_url() . '" target="_blank">', '</a>' ) ;
            } else {
                echo  sprintf( __( 'Consider the %1$sCryptocurrency Product for WooCommerce WC Vendors Marketplace Addon%2$s for frontend multi-vendor features support.', 'cryptocurrency-product-for-woocommerce' ), '<a href="https://checkout.freemius.com/mode/dialog/plugin/4888/plan/7859/" target="_blank">', '</a>' ) ;
            }
            
            ?></p>
                    <?php 
        }
        
        ?>
                    <?php 
        if ( !in_array( 'wc-vendors-pro/wcvendors-pro.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && !in_array( 'wc-vendors/class-wc-vendors.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
            echo  '<p>' . sprintf(
                __( 'Install the free %1$sWC Vendors Marketplace%2$s plugin for simple multi-vendor features support, or the %3$sWC Vendors Marketplace PRO%4$s plugin for advanced frontend multi-vendor features support.', 'cryptocurrency-product-for-woocommerce' ),
                '<a href="https://wordpress.org/plugins/wc-vendors/" target="_blank">',
                '</a>',
                '<a href="https://www.wcvendors.com/" target="_blank">',
                '</a>'
            ) . '</p>' ;
        }
        ?>
                </label>
			</fieldset></td>
			</tr>

			<tr valign="top">
			<th scope="row"><?php 
        _e( "Expiration period", 'cryptocurrency-product-for-woocommerce' );
        ?></th>
			<td><fieldset>
				<label>
                <input <?php 
        if ( !cryptocurrency_product_for_woocommerce_freemius_init()->is__premium_only() || !cryptocurrency_product_for_woocommerce_freemius_init()->is_plan( 'pro', true ) ) {
            echo  'disabled' ;
        }
        ?> class="text" name="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_expiration_period" type="number" min="0" step="1" maxlength="8" placeholder="7" value="<?php 
        echo  ( !empty($options['expiration_period']) ? esc_attr( $options['expiration_period'] ) : '7' ) ;
        ?>">
                    <p><?php 
        echo  _e( 'Number of days to wait till mark an order as expired if no payment or blockchain transaction confirmation is detected.', 'cryptocurrency-product-for-woocommerce' ) ;
        ?></p>
                    <?php 
        
        if ( !cryptocurrency_product_for_woocommerce_freemius_init()->is__premium_only() || !cryptocurrency_product_for_woocommerce_freemius_init()->is_plan( 'pro', true ) ) {
            ?>
                    <p><?php 
            echo  sprintf( __( '%1$sUpgrade Now!%2$s to enable this feature.', 'cryptocurrency-product-for-woocommerce' ), '<a href="' . cryptocurrency_product_for_woocommerce_freemius_init()->get_upgrade_url() . '" target="_blank">', '</a>' ) ;
            ?></p>
                    <?php 
        }
        
        ?>
                </label>
			</fieldset></td>
			</tr>

		<?php 
    }
    
    ?>
		<?php 
    do_action( 'cryptocurrency_product_for_woocommerce_print_options', $options, $current_screen );
    ?>
		
		</table>

        <h2><?php 
    _e( "Need help to configure this plugin?", 'cryptocurrency-product-for-woocommerce' );
    ?></h2>
        <p><?php 
    echo  sprintf( __( 'Feel free to %1$shire me!%2$s', 'cryptocurrency-product-for-woocommerce' ), '<a target="_blank" href="https://www.upwork.com/freelancers/~0134e80b874bd1fa5f">', '</a>' ) ;
    ?></p>

        <h2><?php 
    _e( "Need help to develop a ERC20 token for your ICO?", 'cryptocurrency-product-for-woocommerce' );
    ?></h2>
        <p><?php 
    echo  sprintf( __( 'Feel free to %1$shire me!%2$s', 'cryptocurrency-product-for-woocommerce' ), '<a target="_blank" href="https://ethereumico.io/product/crowdsale-contract-development/">', '</a>' ) ;
    ?></p>

        <h2><?php 
    _e( "Want to perform an ICO Crowdsale from your Wordpress site?", 'cryptocurrency-product-for-woocommerce' );
    ?></h2>
        <p><?php 
    echo  sprintf( __( 'Install the %1$sEthereum ICO WordPress plugin%2$s!', 'cryptocurrency-product-for-woocommerce' ), '<a target="_blank" href="https://ethereumico.io/product/ethereum-ico-wordpress-plugin/">', '</a>' ) ;
    ?></p>

        <h2><?php 
    _e( "Want to create Ethereum wallets on your Wordpress site?", 'cryptocurrency-product-for-woocommerce' );
    ?></h2>
        <p><?php 
    echo  sprintf( __( 'Install the %1$sWordPress Ethereum Wallet plugin%2$s!', 'cryptocurrency-product-for-woocommerce' ), '<a target="_blank" href="https://ethereumico.io/product/wordpress-ethereum-wallet-plugin/">', '</a>' ) ;
    ?></p>

        <?php 
    
    if ( cryptocurrency_product_for_woocommerce_freemius_init()->is_not_paying() ) {
        ?>
        <h2><?php 
        _e( "Want to sell ERC20 token for fiat and/or Bitcoin?", 'cryptocurrency-product-for-woocommerce' );
        ?></h2>
        <p><?php 
        echo  sprintf( __( 'Install the %1$sPRO plugin version%2$s!', 'cryptocurrency-product-for-woocommerce' ), '<a target="_blank" href="' . cryptocurrency_product_for_woocommerce_freemius_init()->get_upgrade_url() . '">', '</a>' ) ;
        ?></p>

        <?php 
    }
    
    ?>

		<p class="submit">
			<input class="button-primary" type="submit" name="Submit" value="<?php 
    _e( 'Save Changes', 'cryptocurrency-product-for-woocommerce' );
    ?>" />
			<input id="CRYPTOCURRENCY_PRODUCT_FOR_WOOCOMMERCE_reset_options" type="submit" name="Reset" onclick="return confirm('<?php 
    _e( 'Are you sure you want to delete all Cryptocurrency Product options?', 'cryptocurrency-product-for-woocommerce' );
    ?>')" value="<?php 
    _e( 'Reset', 'cryptocurrency-product-for-woocommerce' );
    ?>" />
		</p>
	
	</form>
    
    <p class="alignleft"><?php 
    echo  sprintf( __( 'If you like <strong>Cryptocurrency Product for WooCommerce</strong> please leave us a %1$s rating. A huge thanks in advance!', 'cryptocurrency-product-for-woocommerce' ), '<a href="https://wordpress.org/support/plugin/cryptocurrency-product-for-woocommerce/reviews?rate=5#new-post" target="_blank">★★★★★</a>' ) ;
    ?></p>
    
    
    </div>

<?php 
}
