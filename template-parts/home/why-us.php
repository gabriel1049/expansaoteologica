<?php
/**
 * Home > Por que estudar conosco
 *
 * @package ExpansaoTeologica
 */

$img_bible  = isset( $args['img_bible'] ) ? $args['img_bible'] : '';
$enroll_url = isset( $args['enroll_url'] ) ? $args['enroll_url'] : '#';

$diffs = array(
	'Conteudo fiel as Escrituras e a tradicao crista',
	'Trilhas que vao do fundamento a especializacao',
	'Aulas objetivas, pensadas para a vida real do aluno',
	'Comunidade e suporte ao longo da sua jornada',
);
?>
<section class="section hp-why">
	<div class="container hp-why__grid">
		<figure class="hp-why__media">
			<img src="<?php echo esc_url( $img_bible ); ?>" alt="Biblia aberta sobre a mesa de estudo" loading="lazy">
			<figcaption class="hp-why__caption">A Palavra no centro de cada licao</figcaption>
			<span class="hp-why__badge"><strong>7 dias</strong><span>de garantia</span></span>
		</figure>

		<div class="hp-why__content reveal">
			<span class="eyebrow">Por que estudar conosco</span>
			<h2>Seriedade no ensino, cuidado com cada aluno</h2>
			<hr class="divider">
			<ul class="hp-why__list">
				<?php foreach ( $diffs as $d ) : ?>
					<li>
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6L9 17l-5-5"></path></svg>
						<span><?php echo esc_html( $d ); ?></span>
					</li>
				<?php endforeach; ?>
			</ul>
			<a class="btn btn--primary" href="<?php echo esc_url( $enroll_url ); ?>">Quero estudar</a>
		</div>
	</div>
</section>
