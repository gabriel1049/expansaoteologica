<?php
/**
 * Home > Hero
 *
 * @package ExpansaoTeologica
 */

$img_jesus   = isset( $args['img_jesus'] ) ? $args['img_jesus'] : '';
$enroll_url  = isset( $args['enroll_url'] ) ? $args['enroll_url'] : '#';
$student_url = isset( $args['student_url'] ) ? $args['student_url'] : '#';
$courses_url = isset( $args['courses_url'] ) ? $args['courses_url'] : '#';
?>
<section class="hp-hero">
	<img class="hp-hero__bg" src="<?php echo esc_url( $img_jesus ); ?>" alt="" aria-hidden="true" loading="eager" fetchpriority="high">
	<div class="hp-hero__overlay"></div>

	<div class="container">
		<div class="hp-hero__inner">
		<span class="eyebrow hp-hero__eyebrow">Ensino teologico para todos</span>
		<h1 class="hp-hero__title">Formacao teologica de excelencia, acessivel a qualquer pessoa</h1>
		<p class="hp-hero__lead">
			Um ecossistema completo de cursos, trilhas e especializacoes para quem deseja
			conhecer a Biblia, crescer na fe e se preparar para o ministerio. No seu tempo,
			com valores que cabem no seu bolso.
		</p>

		<div class="hp-hero__actions">
			<a class="btn btn--primary btn--lg js-track-cta-hero" href="<?php echo esc_url( $courses_url ); ?>">
				Conheca os Cursos
			</a>
			<a class="btn btn--ghost btn--lg" href="<?php echo esc_url( $student_url ); ?>">
				Area do Aluno
			</a>
		</div>

		<ul class="hp-hero__stats">
			<li><strong>100%</strong><span>online</span></li>
			<li><strong>Acesso</strong><span>vitalicio</span></li>
			<li><strong>Certificado</strong><span>de conclusao</span></li>
		</ul>
		</div>
	</div>
</section>
