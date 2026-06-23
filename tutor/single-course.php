<?php
/**
 * Template Override: Single Course
 * Tema: Expansao Teologica  |  Compativel com Tutor LMS 3.9.x
 *
 * Mantem o esqueleto funcional do Tutor (abas, entry-box com WooCommerce,
 * estados de matricula) e aplica marcacao semantica, gatilhos de conversao
 * e classes de tracking (.js-track-*).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$course_id   = get_the_ID();
$is_enrolled = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );
$is_mobile   = wp_is_mobile();
$is_public   = \TUTOR\Course_List::is_public( $course_id );

$course_nav_item = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), $course_id );
$has_video       = apply_filters( 'tutor_course_has_video', tutor_utils()->has_video_in_single(), $course_id );

$student_must_login = tutor_utils()->get_option( 'student_must_login_to_view_course' );

tutor_utils()->tutor_custom_header();

if ( ! is_user_logged_in() && ! $is_public && $student_must_login ) {
	tutor_load_template( 'login' );
	tutor_utils()->tutor_custom_footer();
	return;
}

// --- Dados para conversao ---
$total_lessons  = tutor_utils()->get_lesson_count_by_course( $course_id );
$total_duration = tpt_course_duration( $course_id );
$students       = (int) tutor_utils()->count_enrolled_users_by_course( $course_id );
$rating         = tutor_utils()->get_course_rating( $course_id );
$rating_avg     = isset( $rating->rating_avg ) ? (float) $rating->rating_avg : 0;
$rating_count   = isset( $rating->rating_count ) ? (int) $rating->rating_count : 0;

// Nivel do curso (label em portugues)
$level_raw    = get_post_meta( $course_id, '_tutor_course_level', true );
$level_labels = array(
	'beginner'     => 'Iniciante',
	'intermediate' => 'Intermediario',
	'expert'       => 'Avancado',
	'all_levels'   => 'Todos os niveis',
);
$level_label = isset( $level_labels[ $level_raw ] ) ? $level_labels[ $level_raw ] : '';
?>

<?php do_action( 'tutor_course/single/before/wrap' ); ?>

<main id="content" class="single-course" data-course-id="<?php echo esc_attr( $course_id ); ?>">

	<!-- ===== HERO DE VENDA ===== -->
	<section class="course-hero">
		<div class="container course-hero__inner">
			<div class="course-hero__content">

				<?php if ( has_term( '', 'course-category', $course_id ) ) : ?>
					<span class="badge badge--gold">
						<?php echo get_the_term_list( $course_id, 'course-category', '', ', ' ); // phpcs:ignore ?>
					</span>
				<?php endif; ?>

				<h1 class="course-hero__title"><?php the_title(); ?></h1>

				<p class="course-hero__excerpt"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>

				<!-- Prova social -->
				<div class="course-hero__trust">
					<?php if ( $rating_count > 0 ) : ?>
						<span class="rating">
							<span class="rating__score"><?php echo esc_html( number_format_i18n( $rating_avg, 1 ) ); ?></span>
							<?php tpt_stars( round( $rating_avg ) ); ?>
							<span class="rating__count">(<?php echo esc_html( $rating_count ); ?>)</span>
						</span>
					<?php endif; ?>

					<?php if ( $students > 0 ) : ?>
						<span class="course-hero__trust-item"><strong><?php echo esc_html( $students ); ?></strong> alunos matriculados</span>
					<?php endif; ?>

					<?php if ( $level_label ) : ?>
						<span class="badge badge--level"><?php echo esc_html( $level_label ); ?></span>
					<?php endif; ?>
				</div>

				<?php if ( $is_enrolled ) : ?>
					<span class="badge badge--success">Voce ja tem acesso a este curso</span>
				<?php endif; ?>
			</div>

			<div class="course-hero__media">
				<?php $has_video ? tutor_course_video() : get_tutor_course_thumbnail(); ?>
			</div>
		</div>
	</section>

	<div class="container course-layout">

		<!-- ===== COLUNA PRINCIPAL: descricao, curriculo, avaliacoes (abas do Tutor) ===== -->
		<div class="course-main">
			<?php do_action( 'tutor_course/single/before/inner-wrap' ); ?>

			<div class="tutor-course-details-tab">
				<?php if ( is_array( $course_nav_item ) && count( $course_nav_item ) > 1 ) : ?>
					<div class="tutor-is-sticky course-nav">
						<?php tutor_load_template( 'single.course.enrolled.nav', array( 'course_nav_item' => $course_nav_item ) ); ?>
					</div>
				<?php endif; ?>

				<div class="tutor-tab tutor-pt-24">
					<?php foreach ( $course_nav_item as $key => $subpage ) : ?>
						<div id="tutor-course-details-tab-<?php echo esc_attr( $key ); ?>"
							class="tutor-tab-item<?php echo 'info' === $key ? ' is-active' : ''; ?>">
							<?php
							do_action( 'tutor_course/single/tab/' . $key . '/before' );

							$method = $subpage['method'];
							if ( is_string( $method ) ) {
								$method();
							} else {
								$_object = $method[0];
								$_method = $method[1];
								$_object->$_method( $course_id );
							}

							do_action( 'tutor_course/single/tab/' . $key . '/after' );
							?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

			<?php do_action( 'tutor_course/single/after/inner-wrap' ); ?>
		</div>

		<!-- ===== SIDEBAR: caixa de compra profissional ===== -->
		<aside class="course-sidebar" aria-label="Compra do curso">
			<?php $sidebar_attr = apply_filters( 'tutor_course_details_sidebar_attr', '' ); ?>
			<div class="purchase-box tutor-is-sticky js-track-view-price" <?php echo esc_attr( $sidebar_attr ); ?>>
				<?php do_action( 'tutor_course/single/before/sidebar' ); ?>

				<?php
				/**
				 * Preco + botao de compra (entry-box). Com WooCommerce ativo,
				 * renderiza "Adicionar ao carrinho" -> checkout. Apos a compra,
				 * o Tutor troca por "Continuar curso" automaticamente.
				 */
				tutor_load_template( 'single.course.course-entry-box' );
				?>

				<?php if ( ! $is_enrolled ) : ?>
					<div class="guarantee purchase-box__guarantee">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
							<path d="M9 12l2 2 4-4"></path>
						</svg>
						<span>Garantia de 7 dias. Nao gostou? Devolvemos seu dinheiro.</span>
					</div>
				<?php endif; ?>

				<!-- Este curso inclui -->
				<div class="purchase-box__includes">
					<h3 class="purchase-box__title">Este curso inclui</h3>
					<ul class="feature-list">
						<?php if ( $total_lessons ) : ?>
							<li>
								<svg class="feature-list__ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2"></rect></svg>
								<span><strong><?php echo esc_html( $total_lessons ); ?></strong> aulas em video</span>
							</li>
						<?php endif; ?>
						<?php if ( $total_duration ) : ?>
							<li>
								<svg class="feature-list__ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path></svg>
								<span><strong><?php echo esc_html( $total_duration ); ?></strong> de conteudo</span>
							</li>
						<?php endif; ?>
						<?php if ( $level_label ) : ?>
							<li>
								<svg class="feature-list__ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" y1="20" x2="4" y2="14"></line><line x1="12" y1="20" x2="12" y2="10"></line><line x1="20" y1="20" x2="20" y2="6"></line></svg>
								<span>Nivel <strong><?php echo esc_html( $level_label ); ?></strong></span>
							</li>
						<?php endif; ?>
						<li>
							<svg class="feature-list__ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="6"></circle><path d="M8.5 13.5L7 22l5-3 5 3-1.5-8.5"></path></svg>
							<span>Certificado de conclusao</span>
						</li>
						<li>
							<svg class="feature-list__ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2v20"></path><path d="M2 7l10-5 10 5"></path><path d="M2 17l10 5 10-5"></path></svg>
							<span>Acesso vitalicio</span>
						</li>
						<li>
							<svg class="feature-list__ic" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="2" width="14" height="20" rx="2"></rect><line x1="12" y1="18" x2="12" y2="18"></line></svg>
							<span>Acesso no computador e celular</span>
						</li>
					</ul>
				</div>

				<!-- Instrutor e demais infos do Tutor -->
				<div class="purchase-box__extra">
					<?php tutor_course_instructors_html(); ?>
					<?php tutor_course_requirements_html(); ?>
					<?php tutor_course_tags_html(); ?>
					<?php tutor_course_target_audience_html(); ?>
				</div>

				<?php do_action( 'tutor_course/single/after/sidebar' ); ?>
			</div>
		</aside>

	</div>
</main>

<?php do_action( 'tutor_course/single/after/wrap' ); ?>

<?php
tutor_utils()->tutor_custom_footer();
