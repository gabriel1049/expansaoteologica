<?php
/**
 * Override: Carrinho vazio - Expansao Teologica
 *
 * Estado vazio branded. Em vez de so mandar o aluno de volta para a
 * listagem, sugere o curso em destaque diretamente aqui, com um
 * link de adicionar ao carrinho em um clique (add-to-cart nativo
 * do WooCommerce via query string, sem depender de JS).
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;

// Mantem o hook de compatibilidade (outros plugins podem usar).
do_action( 'woocommerce_cart_is_empty' );

// Destino de fallback: listagem de cursos do Tutor, ou a loja, ou a home.
$browse_url = function_exists( 'tutor_utils' ) ? get_post_type_archive_link( 'courses' ) : '';
if ( ! $browse_url && wc_get_page_id( 'shop' ) > 0 ) {
	$browse_url = wc_get_page_permalink( 'shop' );
}
if ( ! $browse_url ) {
	$browse_url = home_url( '/' );
}

// Curso em destaque para sugerir direto no carrinho vazio.
$featured_course = null;
if ( function_exists( 'tutor_utils' ) ) {
	$courses = get_posts(
		array(
			'post_type'      => 'courses',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
		)
	);
	if ( ! empty( $courses ) ) {
		$featured_course = $courses[0];
	}
}

$course_permalink  = $featured_course ? get_permalink( $featured_course->ID ) : '';
$course_price      = $featured_course ? tutor_utils()->get_course_price( $featured_course->ID ) : '';
$course_lessons    = $featured_course ? tutor_utils()->get_lesson_count_by_course( $featured_course->ID ) : 0;
$course_thumb      = ( $featured_course && has_post_thumbnail( $featured_course->ID ) ) ? get_the_post_thumbnail_url( $featured_course->ID, 'medium' ) : '';
$course_product_id = $featured_course ? tutor_utils()->get_course_product_id( $featured_course->ID ) : 0;

// Se o curso tem produto Woo vinculado, adiciona direto ao carrinho (1 clique).
// Sem produto, o botao leva para a pagina do curso (e o texto reflete isso).
$course_cta_url  = $course_product_id
	? add_query_arg( 'add-to-cart', $course_product_id, wc_get_cart_url() )
	: $course_permalink;
$course_cta_label = $course_product_id ? 'Adicionar ao carrinho' : 'Ver curso';
?>

<div class="cart-empty-state">
	<div class="cart-empty-state__icon" aria-hidden="true">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
			<circle cx="9" cy="21" r="1"></circle>
			<circle cx="20" cy="21" r="1"></circle>
			<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
		</svg>
	</div>

	<span class="eyebrow cart-empty-state__eyebrow">Carrinho vazio</span>
	<h2 class="cart-empty-state__title">Ainda nao ha nada por aqui</h2>
	<p class="cart-empty-state__text">
		Que tal comecar sua jornada de estudos? De o primeiro passo na sua formacao teologica.
	</p>

	<?php if ( $featured_course ) : ?>
		<article class="cart-empty-course">
			<div class="cart-empty-course__media">
				<?php if ( $course_thumb ) : ?>
					<img src="<?php echo esc_url( $course_thumb ); ?>" alt="" loading="lazy">
				<?php endif; ?>
			</div>
			<div class="cart-empty-course__body">
				<span class="badge badge--gold">Curso disponivel</span>
				<h3 class="cart-empty-course__title">
					<a href="<?php echo esc_url( $course_permalink ); ?>"><?php echo esc_html( get_the_title( $featured_course->ID ) ); ?></a>
				</h3>
				<?php if ( $course_lessons ) : ?>
					<span class="cart-empty-course__meta"><?php echo esc_html( $course_lessons ); ?> aulas &middot; Acesso vitalicio</span>
				<?php endif; ?>
				<div class="cart-empty-course__foot">
					<?php if ( $course_price ) : ?>
						<span class="cart-empty-course__price"><?php echo wp_kses_post( $course_price ); ?></span>
					<?php endif; ?>
					<a class="btn btn--primary btn--sm" href="<?php echo esc_url( $course_cta_url ); ?>"><?php echo esc_html( $course_cta_label ); ?></a>
				</div>
			</div>
		</article>
	<?php endif; ?>

	<ul class="cart-empty-state__perks">
		<li>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
			Acesso vitalicio
		</li>
		<li>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
			Certificado de conclusao
		</li>
		<li>
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
			Garantia de 7 dias
		</li>
	</ul>

	<a class="cart-empty-state__link" href="<?php echo esc_url( $browse_url ); ?>">Ver todos os cursos &rarr;</a>
</div>
