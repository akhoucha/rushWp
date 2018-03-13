<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() )
	return;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'north' ) );
$info_message .= ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'north' ) . '</a>';

//wc_print_notice( $info_message, 'notice' );
?>

<div class="checkout-coupon">
	<div class="row align-center">
		<div class="small-12 medium-7 large-5 text-center columns">
			<div class="thb-checkout-coupon">
				<?php esc_html_e("Have a coupon?", 'north'); ?> <a class="showcoupon"><?php esc_html_e("Click here to enter your code", 'north'); ?></a>
			</div>
			<form class="checkout_coupon" method="post" style="display:none">
				<div class="coupon">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'north' ); ?>" id="coupon_code" value="" />
					<input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'north' ); ?>" />
				</div>
			</form>
		</div>
	</div>
</div>