<?php
/**
 * Home > Cursos em destaque
 *
 * Lista os cursos publicados (Tutor) e completa a grade com cards
 * "Em breve" para comunicar o ecossistema em crescimento.
 *
 * @package ExpansaoTeologica
 */

$img_course  = isset( $args['img_course'] ) ? $args['img_course'] : '';
$courses_url = isset( $args['courses_url'] ) ? $args['courses_url'] : '#';

$courses = get_posts(
	array(
		'post_type'      => 'courses',
		'posts_per_page' => 3,
		'post_status'    => 'publish',
	)
);

// Quantos cards "Em breve" exibir para preencher a grade (minimo 3 colunas).
$soon_slots = max( 0, 3 - count( $courses ) );
?>
<section class="section hp-courses" id="cursos">
	<div class="container">
		<div class="hp-head hp-head--row">
			<div>
				<span class="eyebrow">Cursos</span>
				<h2>Comece sua jornada de estudos</h2>
			</div>
			<a class="hp-head__link" href="<?php echo esc_url( $courses_url ); ?>">Ver todos os cursos &rarr;</a>
		</div>

		<div class="hp-courses__grid">
			<?php
			$first = true;
			foreach ( $courses as $course ) :
				$permalink = get_permalink( $course->ID );
				$price     = function_exists( 'tutor_utils' ) ? tutor_utils()->get_course_price( $course->ID ) : '';
				$lessons   = function_exists( 'tutor_utils' ) ? tutor_utils()->get_lesson_count_by_course( $course->ID ) : 0;

				// Imagem: destaque do curso, com fallback para o banner enviado.
				$thumb = has_post_thumbnail( $course->ID ) ? get_the_post_thumbnail_url( $course->ID, 'large' ) : ( $first ? $img_course : '' );
				?>
				<article class="card is-interactive hp-course">
					<a class="hp-course__media" href="<?php echo esc_url( $permalink ); ?>" aria-hidden="true" tabindex="-1">
						<?php if ( $thumb ) : ?>
							<img src="<?php echo esc_url( $thumb ); ?>" alt="" loading="lazy">
						<?php endif; ?>
					</a>
					<div class="hp-course__body">
						<span class="badge badge--gold">Curso</span>
						<h3 class="hp-course__title">
							<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( get_the_title( $course->ID ) ); ?></a>
						</h3>
						<?php if ( $lessons ) : ?>
							<ul class="hp-course__meta">
								<li><?php echo esc_html( $lessons ); ?> aulas</li>
								<li>Acesso vitalicio</li>
							</ul>
						<?php endif; ?>
						<div class="hp-course__foot">
							<?php if ( $price ) : ?>
								<span class="hp-course__price"><?php echo wp_kses_post( $price ); ?></span>
							<?php endif; ?>
							<a class="btn btn--primary btn--sm js-track-cta-course" href="<?php echo esc_url( $permalink ); ?>">Ver curso</a>
						</div>
					</div>
				</article>
				<?php
				$first = false;
			endforeach;
			?>

			<?php for ( $i = 0; $i < $soon_slots; $i++ ) : ?>
				<article class="card hp-course hp-course--soon" aria-hidden="true">
					<div class="hp-course__media hp-course__media--soon">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
					</div>
					<div class="hp-course__body">
						<span class="badge badge--level">Em breve</span>
						<h3 class="hp-course__title">Novos cursos a caminho</h3>
						<p class="text-muted">Trilhas de lideranca, ministerio e desenvolvimento espiritual.</p>
					</div>
				</article>
			<?php endfor; ?>
		</div>
	</div>
</section>
