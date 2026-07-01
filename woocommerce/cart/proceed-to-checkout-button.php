<?php
/**
 * Override: Botao "Finalizar compra" - Expansao Teologica
 *
 * Mesma URL/logica do WooCommerce, apenas com icone adicional.
 *
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-button button alt wc-forward">
	<?php esc_html_e( 'Proceed to checkout', 'woocommerce' ); ?>
	<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="checkout-button__icon"><path d="M5 12h14M13 6l6 6-6 6"></path></svg>
</a>
