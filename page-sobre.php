<?php
/**
 * Template: Pagina Sobre
 *
 * Carregado automaticamente pelo WordPress para a pagina com slug
 * "sobre" (convencao page-{slug}.php). Conteudo fixo, focado em
 * missao e proposta da plataforma.
 *
 * @package ExpansaoTeologica
 */

get_header();

$img_dir    = get_template_directory_uri() . '/assets/img/';
$img_bible  = $img_dir . 'imagem-da-biblia.jpg';
$enroll_url = function_exists( 'tpt_enroll_url' ) ? tpt_enroll_url() : home_url( '/' );
?>

<main id="content" class="about">

	<!-- ===== HERO ===== -->
	<section class="hp-hero about-hero">
		<img class="hp-hero__bg" src="<?php echo esc_url( $img_bible ); ?>" alt="" aria-hidden="true" loading="eager">
		<div class="hp-hero__overlay"></div>

		<div class="container">
			<div class="hp-hero__inner">
				<span class="eyebrow hp-hero__eyebrow">Sobre nos</span>
				<h1 class="hp-hero__title">Existimos para expandir o conhecimento da <em>Palavra</em></h1>
				<p class="hp-hero__lead">
					Uma plataforma dedicada a tornar o ensino teologico serio acessivel a
					qualquer pessoa que deseje aprender mais sobre a Biblia e o ministerio.
				</p>
			</div>
		</div>
	</section>

	<!-- ===== MISSAO E PROPOSITO ===== -->
	<section class="section hp-why about-mission">
		<div class="container hp-why__grid">
			<figure class="hp-why__media reveal">
				<img src="<?php echo esc_url( $img_bible ); ?>" alt="Biblia aberta sobre a mesa de estudo" loading="lazy">
				<figcaption class="hp-why__caption">Fieis ao texto, acessiveis na linguagem</figcaption>
			</figure>

			<div class="hp-why__content reveal">
				<span class="eyebrow">Nossa missao</span>
				<h2>Democratizar o ensino teologico no Brasil</h2>
				<hr class="divider">

				<p>
					Acreditamos que o conhecimento biblico de qualidade nao deveria ser
					privilegio de poucos. Por muito tempo, uma formacao teologica seria
					exigiu tempo, dinheiro e, com frequencia, deslocamento at cidades onde
					havia seminarios ou institutos de ensino.
				</p>
				<p>
					A Expansao Teologica nasce para mudar essa realidade. Reunimos conteudo
					fiel as Escrituras, professores qualificados e uma estrutura 100% online
					para que qualquer pessoa, em qualquer lugar do Brasil, possa estudar
					teologia com profundidade e a um preco justo.
				</p>
				<p>
					Nossa proposta e simples: oferecer trilhas de aprendizado que vao do
					fundamento a especializacao, sempre com linguagem acessivel e foco na
					aplicacao pratica da fe no dia a dia e no ministerio.
				</p>

				<ul class="hp-why__list about-mission__list">
					<li>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
						<span>Conteudo fiel as Escrituras e a tradicao crista</span>
					</li>
					<li>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
						<span>Preco justo, pensado para caber no seu bolso</span>
					</li>
					<li>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
						<span>Acesso de qualquer lugar, no seu ritmo</span>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- ===== CTA FINAL ===== -->
	<section class="hp-final about-cta">
		<img class="hp-final__bg" src="<?php echo esc_url( $img_bible ); ?>" alt="" aria-hidden="true" loading="lazy">
		<div class="hp-final__overlay"></div>

		<div class="container hp-final__inner">
			<span class="eyebrow">Faca parte</span>
			<h2>Comece sua jornada de <strong>estudos hoje</strong></h2>
			<p>
				Conheca a Formacao Ministerial e de o primeiro passo na sua trilha
				de conhecimento teologico.
			</p>
			<a class="btn btn--primary btn--lg" href="<?php echo esc_url( $enroll_url ); ?>">
				Conhecer o curso
			</a>
		</div>
	</section>

</main>

<?php
get_footer();
