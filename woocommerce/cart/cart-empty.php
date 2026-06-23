<?php
/**
 * Override: Carrinho vazio - Expansao Teologica
 *
 * Estado vazio branded, com chamada para conhecer os cursos.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

// Mantem o hook de compatibilidade (outros plugins podem usar).
do_action( 'woocommerce_cart_is_empty' );

// Destino do botao: listagem de cursos do Tutor, com fallback para a loja/home.
$browse_url = function_exists( 'tutor_utils' ) ? get_post_type_archive_link( 'courses' ) : '';
if ( ! $browse_url && wc_get_page_id( 'shop' ) > 0 ) {
	$browse_url = wc_get_page_permalink( 'shop' );
}
if ( ! $browse_url ) {
	$browse_url = home_url( '/' );
}
?>

<div class="cart-empty-state">
	<div class="cart-empty-state__icon" aria-hidden="true">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
			<circle cx="9" cy="21" r="1"></circle>
			<circle cx="20" cy="21" r="1"></circle>
			<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
		</svg>
	</div>

	<h2 class="cart-empty-state__title">Seu carrinho esta vazio</h2>
	<p class="cart-empty-state__text">
		Que tal comecar sua jornada de estudos? Conheca o curso e de o primeiro passo
		na sua formacao teologica.
	</p>

	<a class="btn btn--primary btn--lg" href="<?php echo esc_url( $browse_url ); ?>">
		Ver cursos
	</a>
</div>
