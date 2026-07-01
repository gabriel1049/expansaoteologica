<?php
/**
 * Template: Pagina Contato
 *
 * Carregado automaticamente pelo WordPress para a pagina com slug
 * "contato" (convencao page-{slug}.php). WhatsApp como canal
 * principal, e-mail como alternativa.
 *
 * @package ExpansaoTeologica
 */

get_header();

$img_dir      = get_template_directory_uri() . '/assets/img/';
$img_bible    = $img_dir . 'imagem-da-biblia.jpg';
$whatsapp_msg = 'Ola! Gostaria de saber mais sobre os cursos da Expansao Teologica.';
$whatsapp_url = tpt_whatsapp_url( $whatsapp_msg );
$email        = 'contato@expansaoteologica.com.br';
?>

<main id="content" class="about">

	<!-- ===== HERO ===== -->
	<section class="hp-hero about-hero">
		<img class="hp-hero__bg" src="<?php echo esc_url( $img_bible ); ?>" alt="" aria-hidden="true" loading="eager">
		<div class="hp-hero__overlay"></div>

		<div class="container">
			<div class="hp-hero__inner">
				<span class="eyebrow hp-hero__eyebrow">Contato</span>
				<h1 class="hp-hero__title">Fale com a <em>gente</em></h1>
				<p class="hp-hero__lead">
					Duvidas sobre os cursos, a matricula ou o acesso a plataforma?
					Escolha o canal mais facil para voce.
				</p>
			</div>
		</div>
	</section>

	<!-- ===== CANAIS DE CONTATO ===== -->
	<section class="section contact-section">
		<div class="container">
			<div class="contact-grid">

				<article class="card contact-card contact-card--highlight reveal">
					<div class="contact-card__icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
					</div>
					<span class="badge badge--gold">Resposta mais rapida</span>
					<h2 class="contact-card__title">WhatsApp</h2>
					<p class="contact-card__text">
						Fale direto com a equipe da Expansao Teologica.
					</p>
					<p class="contact-card__value"><?php echo esc_html( tpt_whatsapp_display() ); ?></p>
					<a class="btn btn--primary btn--lg contact-card__cta" href="<?php echo esc_url( $whatsapp_url ); ?>" target="_blank" rel="noopener noreferrer">
						Conversar no WhatsApp
					</a>
				</article>

				<article class="card contact-card reveal">
					<div class="contact-card__icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="m22 7-10 6L2 7"></path></svg>
					</div>
					<span class="badge badge--level">Para assuntos gerais</span>
					<h2 class="contact-card__title">E-mail</h2>
					<p class="contact-card__text">
						Prefere escrever com calma? Nossa equipe responde em ate 1 dia util.
					</p>
					<p class="contact-card__value"><?php echo esc_html( $email ); ?></p>
					<a class="btn btn--secondary btn--lg contact-card__cta" href="<?php echo esc_url( 'mailto:' . $email ); ?>">
						Enviar e-mail
					</a>
				</article>

			</div>
		</div>
	</section>

</main>

<?php
get_footer();
