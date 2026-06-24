<?php
/**
 * Override: Login (Area do Aluno) - Expansao Teologica
 *
 * Split editorial: arte + citacao biblica a esquerda, cartao do
 * formulario a direita. Reusa as classes reais do Tutor e nao toca
 * no formulario/hooks/AJAX (apenas envolve e estiliza).
 *
 * @package Tutor\Templates
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) {
	// Redireciona para o login nativo do WordPress.
	header( 'Location: ' . wp_login_url( tutor_utils()->get_current_url() ) );
	exit;
}

tutor_utils()->tutor_custom_header();

//phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
do_action( 'tutor/template/login/before/wrap' );
?>

<div <?php tutor_post_class( 'tutor-page-wrap' ); ?>>
	<div class="tutor-template-segment tutor-login-wrap et-auth">

		<aside class="et-auth__aside">
			<img class="et-auth__img" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/imagem-de-jesus-ensinando.jpg' ); ?>" alt="" aria-hidden="true">
			<div class="et-auth__aside-inner">
				<span class="eyebrow">Area do aluno</span>
				<p class="et-auth__quote">Lampada para os meus pes e a tua palavra, e luz para o meu caminho.</p>
				<span class="et-auth__cite">Salmos 119:105</span>
			</div>
		</aside>

		<div class="et-auth__panel">
			<div class="tutor-login-form-wrapper">
				<span class="eyebrow et-auth__eyebrow">Bem-vindo de volta</span>
				<h1 class="et-auth__title">Continue de onde parou</h1>
				<?php
					// Carrega o formulario padrao do Tutor (intacto).
					$login_form = trailingslashit( tutor()->path ) . 'templates/login-form.php';
					tutor_load_template_from_custom_path( $login_form, false );
				?>
			</div>
			<?php do_action( 'tutor_after_login_form_wrapper' ); ?>
		</div>

	</div>
</div>

<?php
//phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores
do_action( 'tutor/template/login/after/wrap' );
tutor_utils()->tutor_custom_footer();
