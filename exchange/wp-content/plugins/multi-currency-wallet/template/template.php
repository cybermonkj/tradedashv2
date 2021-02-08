<?php
/**
 * MCWallet Widget Template
 *
 * @package MCWallet
 */

if ( get_option( 'mcwallet_is_logged' ) && ! is_user_logged_in() ) {
	auth_redirect();
}

/** Action before template load */
do_action( 'mcwallet_before_template' );

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php wp_head(); ?>
<?php mcwallet_head(); ?>
</head>
<body>
<?php mcwallet_body_open(); ?>

	<div id="root">
		<!-- Loader before any JS -->
		<div id="wrapper_element" class="overlay">
			<div class="center">
				<div id="loader" class="loader">
					<img id="loaderImg" class="logo-light" src="<?php echo esc_url( mcwallet_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<img id="loaderImg" class="logo-dark" src="<?php echo esc_url( mcwallet_dark_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
				</div>
				<div id="beforeJSTip" class="tips">
					<?php esc_html_e( 'Do not forget to save your private keys!', 'multi-currency-wallet' );?>
				</div>
			</div>
      <div class="mb-4 show-on-fail-ls d-none" id="onFailLocalStorageMessage">
        <span>Not every function works In this window, please open new tab.
          If the error will repeat please contact admin
          <br />
          <a href="https://t.me/sashanoxon">
            https://t.me/sashanoxon
          </a>
        </span>
        <button class="btn btn-primary btc-open-in-new-tab">
          <a href="https://wallet.wpmix.net" id="onFailLocalStorageLink" target="_blank">
            Open App in new tab
          </a>
        </button>
      </div>
			<div id="usersInform" class="usersInform"></div>
		</div>
	</div><!-- #root -->

	<div id="portal"></div>

<?php mcwallet_footer(); ?>
</body>
</html>
