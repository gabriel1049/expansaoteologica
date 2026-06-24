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
		<h2>Formacao teologica de qualidade <strong>nao precisa ser cara</strong></h2>
		<p>
			De o proximo passo na sua jornada de fe e conhecimento. Matricule-se agora e
			tenha acesso imediato as aulas.
		</p>
		<a class="btn btn--primary btn--lg js-track-cta-final" href="<?php echo esc_url( $enroll_url ); ?>">
			Quero me matricular
		</a>
		<p class="hp-final__seal">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg>
			<span>7 dias de garantia. Risco zero.</span>
		</p>
	</div>
</section>
