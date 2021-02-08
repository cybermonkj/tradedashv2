<?php
/**
 * MCWallet Ajax
 */


function mcwallet_backup_user() {
  $data = json_decode( file_get_contents( 'php://input' ), true );

  if (intval($data['WPuserUid']) !== get_current_user_id()) {
    wp_die('Access deny', 403);
  }

  $user_id = get_current_user_id();

  $userData = get_userdata($user_id)->data;
  $userHashString = $user_id.':'.$userData->user_login.':'.$userData->user_registered.':'.$userData->user_pass.':'.NONCE_SALT;
  $user_uniqhash = md5($userHashString);

  if ($user_uniqhash != $data['WPuserHash']) {
    wp_die('Access deny', 403);
  }

  $backup = get_user_meta( $user_id, '_mcwallet_backup' );
  if (is_array($backup)
    and isset($backup[0])
    and is_array($backup[0])
  ) {
    $backup = $backup[0];
  } else {
    $backup = false;
  }

  if ($data[ 'action' ] && $data[ 'action' ] == 'cleanup') {

     wp_die( '{"answer":"ok"}', 200);
  }

  if ($backup
    and $backup[ 'twentywords' ]
    and $data[ 'twentywords' ]
    and ($backup[ 'twentywords' ] != $data[ 'twentywords' ])
    and ($backup[ 'twentywords' ] != '-')
    and ($data[ 'twentywords' ] != '-')
  ) {
    wp_die( '{"error":"rewrite seed"}', 200);
  }

  $arr = [];
  $arr[ 'btcMnemonic' ]                       = $data[ 'btcMnemonic' ];
  $arr[ 'ethMnemonic' ]                       = $data[ 'ethMnemonic' ];
  $arr[ 'eth' ]                               = $data[ 'eth' ];
  $arr[ 'btc' ]                               = $data[ 'btc' ];
  $arr[ 'ghost' ]                             = $data[ 'ghost' ];
  $arr[ 'ethOld' ]                            = $data[ 'ethOld' ];
  $arr[ 'btcOld' ]                            = $data[ 'btcOld' ];
  $arr[ 'twentywords' ]                       = $data[ 'twentywords' ];
  $arr[ 'btcMultisig' ]                       = $data[ 'btcMultisig' ];
  $arr[ 'btcMultisigOtherOwnerKey' ]          = $data[ 'btcMultisigOtherOwnerKey' ];
  $arr[ 'btcMultisigOtherOwnerKeyMnemonic' ]  = $data[ 'btcMultisigOtherOwnerKeyMnemonic' ];
  $arr[ 'btcMultisigOtherOwnerKeyOld' ]       = $data[ 'btcMultisigOtherOwnerKeyOld' ];
  $arr[ 'btcSmsMnemonicKey' ]                 = $data[ 'btcSmsMnemonicKey' ];
  $arr[ 'btcSmsMnemonicKeyGenerated' ]        = $data[ 'btcSmsMnemonicKeyGenerated' ];
  $arr[ 'btcSmsMnemonicKeyMnemonic' ]         = $data[ 'btcSmsMnemonicKeyMnemonic' ];
  $arr[ 'btcSmsMnemonicKeyOld' ]              = $data[ 'btcSmsMnemonicKeyOld' ];
  $arr[ 'btcPinMnemonicKey' ]                 = $data[ 'btcPinMnemonicKey' ];
  $arr[ 'hiddenCoinsList' ]                   = $data[ 'hiddenCoinsList' ];
  
  $arr[ 'isWalletCreate' ]                    = $data[ 'isWalletCreate' ];
  $arr[ 'didProtectedBtcCreated' ]            = $data[ 'didProtectedBtcCreated' ];
  $arr[ 'didPinBtcCreated' ]                  = $data[ 'didPinBtcCreated' ];

  $arr[ 'orders' ]                            = $data[ 'orders' ];

  update_user_meta( $user_id, '_mcwallet_backup', $arr);
  wp_die( '{"answer":"ok"}', 200);
}

add_action( 'wp_ajax_mcwallet_backup_userwallet', 'mcwallet_backup_user' );
// debug action - for allow request from http://localhost:9001/ with hardcore writed userid
// add_action( 'wp_ajax_nopriv_mcwallet_backup_userwallet', 'mcwallet_backup_user' );

function mcwallet_restory_user() {
  $data = json_decode( file_get_contents( 'php://input' ), true );

  if (intval($data['WPuserUid']) !== get_current_user_id()) {
    wp_die('Access deny', 403);
  }

  $user_id = get_current_user_id();

  $userData = get_userdata($user_id)->data;
  $userHashString = $user_id.':'.$userData->user_login.':'.$userData->user_registered.':'.$userData->user_pass.':'.NONCE_SALT;
  $user_uniqhash = md5($userHashString);

  if ($user_uniqhash != $data['WPuserHash']) {
    wp_die('Access deny', 403);
  }

  $backup = get_user_meta( $user_id, '_mcwallet_backup' );
  if (is_array($backup)
    and isset($backup[0])
    and is_array($backup[0])
  ) {
    $backup = $backup[0];

    $data = array();
    $data['btcMnemonic']                        = $backup['btcMnemonic'];
    $data['ethMnemonic']                        = $backup['ethMnemonic'];
    $data['eth']                                = $backup['eth'];
    $data['btc']                                = $backup['btc'];
    $data['ghost']                              = $backup['ghost'];
    $data['ethOld']                             = $backup['ethOld'];
    $data['btcOld']                             = $backup['btcOld'];
    $data['twentywords']                        = $backup['twentywords'];
    $data['btcMultisig']                        = $backup['btcMultisig'];
    $data['btcMultisigOtherOwnerKey']           = $backup['btcMultisigOtherOwnerKey'];
    $data['btcMultisigOtherOwnerKeyMnemonic']   = $backup['btcMultisigOtherOwnerKeyMnemonic'];
    $data['btcMultisigOtherOwnerKeyOld']        = $backup['btcMultisigOtherOwnerKeyOld'];
    $data['btcSmsMnemonicKey']                  = $backup['btcSmsMnemonicKey'];
    $data['btcSmsMnemonicKeyGenerated']         = $backup['btcSmsMnemonicKeyGenerated'];
    $data['btcSmsMnemonicKeyMnemonic']          = $backup['btcSmsMnemonicKeyMnemonic'];
    $data['btcSmsMnemonicKeyOld']               = $backup['btcSmsMnemonicKeyOld'];
    $data['btcPinMnemonicKey']                  = $backup['btcPinMnemonicKey'];
    $data['hiddenCoinsList']                    = $backup['hiddenCoinsList'];
    $data[ 'isWalletCreate' ]                   = $backup[ 'isWalletCreate' ];
    $data[ 'didProtectedBtcCreated' ]           = $backup[ 'didProtectedBtcCreated' ];
    $data[ 'didPinBtcCreated' ]                 = $backup[ 'didPinBtcCreated' ];
    $data[ 'orders' ]                           = $backup[ 'orders' ];

    $json = array(
      'answer' => 'ok',
      'data' => $data
    );
    wp_send_json($json);
  } else {
    wp_die('{"answer":"not found"}', 200);
  }
}
add_action( 'wp_ajax_mcwallet_restore_userwallet', 'mcwallet_restory_user' );
// debug action - for allow request from http://localhost:9001/ with hardcore writed userid
// add_action( 'wp_ajax_nopriv_mcwallet_restore_userwallet', 'mcwallet_restory_user' );


function mcwallet_update_user_meta() {


	$data = json_decode( file_get_contents( 'php://input' ), true );
	$arr  = [];
	$arr  = array_merge( $arr, mcwallet_santize_date_react( $data, 'ethData' ) );
	$arr  = array_merge( $arr, mcwallet_santize_date_react( $data, 'btcData' ) );
	$arr  = array_merge( $arr, mcwallet_santize_date_react( $data, 'btcMultisigSMSData' ) );
	$arr  = array_merge( $arr, mcwallet_santize_date_react( $data, 'btcMultisigPinData' ) );
	$arr  = array_merge( $arr, mcwallet_santize_date_react( $data, 'btcMultisigUserData' ) );
	$arr  = array_merge( $arr, mcwallet_santize_date_react( $data, 'usdtData' ) );
	$arr  = array_merge( $arr, mcwallet_santize_date_react( $data, 'usdt' ) );

	if ( $arr ) {
		update_user_meta( get_current_user_id(), '_mcwallet_data', $arr );
	}

	wp_die( 2 );
}

add_action( 'wp_ajax_mcwallet_update_user_meta', 'mcwallet_update_user_meta' );

/**
 * @param $data
 * @param $name
 *
 * @return array
 */
function mcwallet_santize_date_react( $data, $name ) {
	$arr = [];
	if ( isset( $data[ $name ] ) && is_array( $data[ $name ] ) ) {
		$arr[ $name ] = [
			'address' => sanitize_text_field( isset( $data[ $name ]['address'] ) ? $data[ $name ]['address'] : '' ),
			'balance' => floatval( isset( $data[ $name ]['balance'] ) ? $data[ $name ]['balance'] : '' ),
		];

		return $arr;
	}

	return [];

}

/**
 * Add token
 */
function mcwallet_add_token() {

	/* Check nonce */
	check_ajax_referer( 'mcwallet-nonce', 'nonce' );

	/* Stop if the current user is not an admin or do not have administrative access */
	if ( ! current_user_can( 'manage_options' ) ) {
		die();
	}

	$status = 'false';
	$token  = array();
	$html   = '';
	$tokens = get_option( 'mcwallet_tokens' );
	if ( ! $tokens ) {
		$tokens = array();
	}

	if ( isset( $_POST['address'] ) && $_POST['address'] ) {
		$status = 'true';

		$address     = sanitize_text_field( $_POST['address'] );
		$custom_name = sanitize_text_field( $_POST['name'] );

		if ( mcwallet_is_address( $address ) ) {

			$status = 'success';

			$name = mcwallet_hex_to_string( mcwallet_get_remote_result( 'name', $address ) );
			$key  = strtolower( $name );
			if ( $custom_name ) {
				$name = $custom_name;
			}
			$symbol       = mcwallet_hex_to_string( mcwallet_get_remote_result( 'symbol', $address ) );
			$decimals     = mcwallet_hex_to_number( mcwallet_get_remote_result( 'decimals', $address ) );
			$icon         = sanitize_text_field( $_POST['icon'] );
			$rate         = sanitize_text_field( $_POST['rate'] );
			$icon_bg      = sanitize_hex_color( $_POST['bg'] );
			$how_deposit  = esc_html( wp_kses_post( wp_unslash( $_POST['howdeposit'] ) ) );
			$how_withdraw = esc_html( wp_kses_post( wp_unslash( $_POST['howwithdraw'] ) ) );

			$img = '<span class="token-letter">' . mcwallet_token_letter( $name ) . '</span>';
			if ( mcwallet_remote_image_file_exists( $icon ) ) {
				$img = '<img src="' . esc_attr( $icon ) . '" alt="' . esc_attr( $name ) . '">';
			}

			$html = '<tr class="item item-fade item-adding">
				<th class="item-count">
					<span></span>
				</th>
				<td class="item-icon">
					<a href="' . esc_url( mcwallet_page_url() ) . '#/' . esc_html( strtoupper( $key ) ) . '/' . $address . '" target="_blank" style="background-color: ' . $icon_bg . '">
						' . wp_kses_post( $img ) . '
					</span>
				</td>
				<td class="item-name">
					<strong>' . esc_html( $name ) . '</strong>
				</td>
				<td class="item-symbol">
					<span>' . esc_html( $symbol ) . '</span>
				</td>
				<td class="item-decimals">
					<span>' . esc_html( $decimals ) . '</span>
				</td>
				<td class="item-address">
					<code>' . esc_html( $address ) . '</code>
				</td>
				<td class="item-echange-rate">
					<span>' . esc_html( $rate ) . '</span>
				</td>
				<td class="item-action">
					<a href="#" class="button-link-delete mcwallet-btn-remove" data-name="' . esc_attr( $key ) . '"><span class="dashicons dashicons-trash"></span></a>

				</td>
			</tr>';

			$token[ $key ] = array(
				'name'        => $name,
				'symbol'      => $symbol,
				'address'     => $address,
				'decimals'    => $decimals,
				'icon'        => $icon,
				'rate'        => $rate,
				'bg'          => $icon_bg,
				'howdeposit'  => $how_deposit,
				'howwithdraw' => $how_withdraw,
			);

			if ( ! is_array( $tokens ) ) {
				$tokens = $token;
				update_option( 'mcwallet_tokens', $tokens );
			} elseif ( ! array_key_exists( $key, $tokens ) ) {
				$tokens[ $key ] = array(
					'name'        => $name,
					'symbol'      => $symbol,
					'address'     => $address,
					'decimals'    => $decimals,
					'icon'        => $icon,
					'rate'        => $rate,
					'bg'          => $icon_bg,
					'howdeposit'  => $how_deposit,
					'howwithdraw' => $how_withdraw,
				);
				update_option( 'mcwallet_tokens', $tokens );
			} else {
				$status = 'false';
			}

		} else {
			$status = 'invalid';
		}
	}

	$result_arr = array(
		'status' => $status,
		'tokens' => $tokens,
		'html'   => $html,
	);

	wp_send_json( $result_arr );

}

add_action( 'wp_ajax_mcwallet_add_token', 'mcwallet_add_token' );


/**
 * Remove token
 */
function mcwallet_remove_token() {

	/* Check nonce */
	check_ajax_referer( 'mcwallet-nonce', 'nonce' );

	/* Stop if the current user is not an admin or do not have administrative access */
	if ( ! current_user_can( 'manage_options' ) ) {
		die();
	}

	$result = 'true';

	$tokens = get_option( 'mcwallet_tokens' );

	if ( $_POST['name'] ) {

		$name = sanitize_text_field( $_POST['name'] );
		unset( $tokens[ $name ] );

		if ( $tokens != get_option( 'mcwallet_tokens' ) ) {
			update_option( 'mcwallet_tokens', $tokens );
		} else {
			$result = 'false';
		}

	} else {
		$result = 'false';
	}

	wp_send_json( $result );
}

add_action( 'wp_ajax_remove_token', 'mcwallet_remove_token' );


/**
 * Update options
 */
function mcwallet_update_options() {

	/* Check nonce */
	check_ajax_referer( 'mcwallet-nonce', 'nonce' );

	/* Stop if the current user is not an admin or do not have administrative access */
	if ( ! current_user_can( 'manage_options' ) ) {
		die();
	}

	$status = 'false';

	if ( isset( $_POST['url'] ) && isset( $_POST['slug'] ) ) {

		$url              = sanitize_text_field( $_POST['url'] );
		$dark_logo_url    = sanitize_text_field( $_POST['darkLogoUrl'] );
		$logo_link        = sanitize_text_field( $_POST['logoLink'] );
		$page_title       = sanitize_text_field( $_POST['pageTitle'] );
		$btc_fee          = sanitize_text_field( $_POST['btcFee'] );
		$btc_min          = sanitize_text_field( $_POST['btcMin'] );
		$btc_fee_address  = sanitize_text_field( $_POST['btcFeeAddress'] );
		$eth_fee          = sanitize_text_field( $_POST['ethFee'] );
		$eth_min          = sanitize_text_field( $_POST['ethMin'] );
		$eth_fee_address  = sanitize_text_field( $_POST['ethFeeAddress'] );
		$tokens_fee       = sanitize_text_field( $_POST['tokensFee'] );
		$tokens_min       = sanitize_text_field( $_POST['tokensMin'] );
		$fiat_currency    = sanitize_text_field( $_POST['fiatCurrency'] );
		$fiat_gateway_url = sanitize_text_field( $_POST['fiatGatewayUrl'] );
		$code_head        = esc_html( wp_unslash( $_POST['codeHead'] ) );
		$code_body        = esc_html( wp_unslash( $_POST['codeBody'] ) );
		$code_footer      = esc_html( wp_unslash( $_POST['codeFooter'] ) );
		$slug             = 'mcwallet';
		$is_home          = 'false';
		$is_logged        = 'false';

		$strings      = array();
		$replacements = array();
		if ( isset( $_POST['strings'] ) ) {
			$strings = $_POST['strings'];
		}

		if ( $strings ) {
			foreach ( $strings as $string ) {
				$id    = esc_attr( $string['name'] );
				$value = $string['value'];
				if ( $value ) {
					$value                 = trim( esc_attr( wp_strip_all_tags( $value ) ) );
					$replacements[ $id ][] = $value;
				}
			}
		}

		if ( untrailingslashit( $_POST['slug'] ) ) {
			$slug = untrailingslashit( sanitize_title( $_POST['slug'] ) );
		}

		update_option( 'mcwallet_logo', $url );
		update_option( 'mcwallet_dark_logo', $dark_logo_url );
		update_option( 'mcwallet_logo_link', $logo_link );
		update_option( 'mcwallet_page_title', $page_title );
		update_option( 'mcwallet_slug', $slug );
		update_option( 'btc_fee', $btc_fee );
		update_option( 'btc_min', $btc_min );
		update_option( 'btc_fee_address', $btc_fee_address );
		update_option( 'eth_fee', $eth_fee );
		update_option( 'eth_min', $eth_min );
		update_option( 'eth_fee_address', $eth_fee_address );
		update_option( 'tokens_fee', $tokens_fee );
		update_option( 'tokens_min', $tokens_min );
		update_option( 'fiat_currency', $fiat_currency );
		update_option( 'fiat_gateway_url', $fiat_gateway_url );
		update_option( 'mcwallet_head_code', $code_head );
		update_option( 'mcwallet_body_code', $code_body );
		update_option( 'mcwallet_footer_code', $code_footer );

		update_option( 'mcwallet_strings', $replacements );

    if ( $_POST['footerDisabled'] == 'true' ) {
      update_option( 'mcwallet_disable_footer', sanitize_text_field( $_POST['footerDisabled'] ) );
    } else {
      delete_option( 'mcwallet_disable_footer' );
    }
    if ( $_POST['rememberUserWallet'] == 'true' ) {
      update_option( 'mcwallet_remember_userwallet', sanitize_text_field( $_POST['rememberUserWallet'] ) );
    } else {
      delete_option( 'mcwallet_remember_userwallet' );
    }

    if ( $_POST['btcDisabled'] == 'true' ) {
      update_option( 'mcwallet_btc_disabled', sanitize_text_field( $_POST['btcDisabled'] ) );
    } else {
      delete_option( 'mcwallet_btc_disabled' );
    }
    if ( $_POST['ethDisabled'] == 'true' ) {
      update_option( 'mcwallet_eth_disabled', sanitize_text_field( $_POST['ethDisabled'] ) );
    } else {
      delete_option( 'mcwallet_eth_disabled' );
    }
    if ( $_POST['exchangeDisabled'] == 'true' ) {
      update_option( 'mcwallet_exchange_disabled', sanitize_text_field( $_POST['exchangeDisabled'] ) );
    } else {
      delete_option( 'mcwallet_exchange_disabled' );
    }

    if ( $_POST['ghostEnabled'] == 'true' ) {
      update_option( 'mcwallet_ghost_enabled', sanitize_text_field( 'true' ) );
    } else {
      delete_option( 'mcwallet_ghost_enabled' );
    }

    if ( $_POST['nextEnabled'] == 'true' ) {
      update_option( 'mcwallet_next_enabled', sanitize_text_field( 'true' ) );
    } else {
      delete_option( 'mcwallet_next_enabled' );
    }

		if ( $_POST['ishome'] == 'true' ) {
			update_option( 'mcwallet_is_home', sanitize_text_field( $_POST['ishome'] ) );
			$is_home = 'true';
		} else {
			delete_option( 'mcwallet_is_home' );
		}

		if ( $_POST['islogged'] == 'true' ) {
			update_option( 'mcwallet_is_logged', sanitize_text_field( $_POST['islogged'] ) );
			update_option( 'users_can_register', true );
			$is_logged = 'true';
		} else {
			delete_option( 'mcwallet_is_logged' );
			update_option( 'users_can_register', false );
		}

		if ( $_POST['isHowitworks'] == 'true' ) {
			update_option( 'show_howitworks', sanitize_text_field( $_POST['isHowitworks'] ) );
		} else {
			delete_option( 'show_howitworks' );
		}

		$result = esc_attr( mcwallet_page_url() );
		$status = 'success';

	}

	mcwallet_add_rewrite_rules();
	flush_rewrite_rules();

	$result_arr = array(
		'status'   => $status,
		'url'      => esc_attr( mcwallet_page_url() ),
		'slug'     => esc_attr( untrailingslashit( sanitize_title( $slug ) ) ),
		'thickbox' => esc_attr( mcwallet_thickbox_url() ),
		'ishome'   => $is_home,
		'islogged' => $is_logged,
		'strings'  => $replacements,
	);

	wp_send_json( $result_arr );

}

add_action( 'wp_ajax_mcwallet_update_options', 'mcwallet_update_options' );
