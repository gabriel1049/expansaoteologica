<?php
/**
 * Home > Chamada final
 *
 * @package ExpansaoTeologica
 */

$img_bible  = isset( $args['img_bible'] ) ? $args['img_bible'] : '';
$enroll_url = isset( $args['enroll_url'] ) ? $args['enroll_url'] : '#';
?>
<section class="hp-final">
	<img class="hp-final__bg" src="<?php echo esc_url( $img_bible ); ?>" alt="" aria-hidden="true" loading="lazy">
	<div class="hp-final__overlay"></div>

	<div class="container hp-final__inner">
		<span class="eyebrow">Comece hoje</span>
		<h2>Formacao teologica de qualidade nao precisa ser cara</h2>
		<p>
			De o proximo passo na sua jornada de fe e conhecimento. Matricule-se agora e
			tenha acesso imediato as aulas, com garantia de 7 dias.
		</p>
		<a class="btn btn--primary btn--lg js-track-cta-final" href="<?php echo esc_url( $enroll_url ); ?>">
			Quero me matricular
		</a>
	</div>
</section>
