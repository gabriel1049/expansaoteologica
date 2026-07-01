<?php
/**
 * Footer do tema Expansao Teologica
 *
 * @package ExpansaoTeologica
 */

$tpt_student_url = function_exists( 'tpt_student_area_url' ) ? tpt_student_area_url() : home_url( '/' );
$tpt_courses_url = get_post_type_archive_link( 'courses' ) ? get_post_type_archive_link( 'courses' ) : home_url( '/' );
?>
</div><!-- .site-content -->

<footer class="site-footer">
	<div class="container site-footer__grid">

		<!-- Marca + missao -->
		<div class="site-footer__brandcol">
			<a class="site-footer__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon.svg' ); ?>" alt="" width="36" height="36">
				<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			</a>
			<p class="site-footer__tagline">
				Ensino teologico de qualidade, acessivel a qualquer pessoa que deseje
				aprender mais sobre a Biblia e o ministerio.
			</p>
			<div class="site-footer__social">
				<a href="#" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><line x1="17.5" y1="6.5" x2="17.5" y2="6.5"></line></svg></a>
				<a href="#" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22.5 7s-.2-1.5-.8-2.1c-.8-.8-1.7-.8-2.1-.9C16.7 3.7 12 3.7 12 3.7h0s-4.7 0-7.6.3c-.4.1-1.3.1-2.1.9C1.7 5.5 1.5 7 1.5 7S1.3 8.8 1.3 10.6v1.8c0 1.8.2 3.6.2 3.6s.2 1.5.8 2.1c.8.8 1.8.8 2.3.9 1.7.2 7.4.3 7.4.3s4.7 0 7.6-.3c.4-.1 1.3-.1 2.1-.9.6-.6.8-2.1.8-2.1s.2-1.8.2-3.6v-1.8c0-1.8-.2-3.6-.2-3.6z"></path><polygon points="9.8 14.6 15 11.7 9.8 8.8"></polygon></svg></a>
				<a href="#" aria-label="Facebook"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
			</div>
		</div>

		<!-- Cursos -->
		<nav class="site-footer__col" aria-label="Cursos">
			<h3>Cursos</h3>
			<ul>
				<li><a href="<?php echo esc_url( $tpt_courses_url ); ?>">Todos os cursos</a></li>
				<li><a href="<?php echo esc_url( $tpt_courses_url ); ?>">Formacao Ministerial</a></li>
				<li><a href="<?php echo esc_url( $tpt_courses_url ); ?>">Em breve</a></li>
			</ul>
		</nav>

		<!-- Institucional -->
		<nav class="site-footer__col" aria-label="Institucional">
			<h3>Institucional</h3>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/sobre' ) ); ?>">Sobre nos</a></li>
				<li><a href="<?php echo esc_url( $tpt_student_url ); ?>">Area do Aluno</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contato' ) ); ?>">Contato</a></li>
			</ul>
		</nav>

		<!-- Contato -->
		<div class="site-footer__col">
			<h3>Contato</h3>
			<ul>
				<?php if ( function_exists( 'tpt_whatsapp_url' ) ) : ?>
					<li><a href="<?php echo esc_url( tpt_whatsapp_url( 'Ola! Gostaria de saber mais sobre os cursos da Expansao Teologica.' ) ); ?>" target="_blank" rel="noopener noreferrer">WhatsApp: <?php echo esc_html( tpt_whatsapp_display() ); ?></a></li>
				<?php endif; ?>
				<li><a href="mailto:contato@expansaoteologica.com.br">contato@expansaoteologica.com.br</a></li>
				<li><a href="<?php echo esc_url( $tpt_student_url ); ?>">Acessar minha conta</a></li>
			</ul>
		</div>
	</div>

	<div class="site-footer__bottom">
		<div class="container">
			<p class="site-footer__copy">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>. Todos os direitos reservados.</p>
		</div>
	</div>
</footer>

<?php if ( function_exists( 'WC' ) ) : ?>
<!-- Toast de notificacao do carrinho (conteudo dinamico via JS no evento added_to_cart) -->
<div class="cart-toast" id="cart-toast" role="status" aria-live="polite" aria-atomic="true" hidden>
	<span class="cart-toast__icon" aria-hidden="true">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"></path></svg>
	</span>
	<div class="cart-toast__body">
		<strong class="cart-toast__title">Adicionado ao carrinho</strong>
		<span class="cart-toast__text" id="cart-toast-text">Continue navegando ou finalize sua matricula.</span>
		<span class="cart-toast__count" id="cart-toast-count" hidden></span>
	</div>
	<div class="cart-toast__actions">
		<a class="btn btn--primary btn--sm" href="<?php echo esc_url( wc_get_cart_url() ); ?>">Ver carrinho</a>
		<a class="cart-toast__checkout" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">Finalizar &rarr;</a>
	</div>
	<button class="cart-toast__close" type="button" aria-label="Fechar notificacao">
		<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18M6 6l12 12"></path></svg>
	</button>
	<div class="cart-toast__progress" aria-hidden="true"><span class="cart-toast__progress-bar"></span></div>
</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
