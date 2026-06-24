<?php
/**
 * Override: Arquivo de Cursos - Expansao Teologica
 *
 * Adiciona um cabecalho branded acima da listagem e mantem
 * intacta a logica de filtro, grade e paginacao do Tutor.
 *
 * @package Tutor\Templates
 * @subpackage CourseArchive
 */

use TUTOR\Input;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

tutor_utils()->tutor_custom_header();

$get = isset( $_GET['course_filter'] ) ? Input::sanitize_array( $_GET ) : array(); // phpcs:ignore
if ( isset( $get['course_filter'] ) ) {
	$filter = ( new \Tutor\Course_Filter( false ) )->load_listing( $get, true );
	query_posts( $filter );
}
?>

<section class="course-archive-hero">
	<div class="container">
		<span class="eyebrow">Cursos</span>
		<h1>Explore os cursos da Expansao Teologica</h1>
		<p class="lead">
			Do basico ao preparo ministerial completo. Escolha por onde comecar
			a sua jornada de estudos teologicos.
		</p>
	</div>
</section>

<div class="course-archive-body">
	<?php
	tutor_load_template(
		'archive-course-init',
		array_merge(
			$get,
			array(
				'course_filter'     => (bool) tutor_utils()->get_option( 'course_archive_filter', false ),
				'supported_filters' => tutor_utils()->get_option( 'supported_course_filters', array() ),
				'loop_content_only' => false,
			)
		)
	);
	?>
</div>

<?php
tutor_utils()->tutor_custom_footer();
