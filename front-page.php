<?php
/**
 * Front Page - Home da plataforma Expansao Teologica
 *
 * Homepage componentizada. Cada secao vive em /template-parts/home.
 * Estrutura preparada para o crescimento do ecossistema de cursos.
 *
 * @package ExpansaoTeologica
 */

get_header();

// Recursos compartilhados pelas secoes.
$img_dir   = get_template_directory_uri() . '/assets/img/';
$ctx = array(
	'img_jesus'   => $img_dir . 'imagem-de-jesus-ensinando.jpg',
	'img_bible'   => $img_dir . 'imagem-da-biblia.jpg',
	'img_course'  => $img_dir . 'imagem-do-curso-formacao-ministerial.png',
	'enroll_url'  => function_exists( 'tpt_enroll_url' ) ? tpt_enroll_url() : home_url( '/' ),
	'student_url' => function_exists( 'tpt_student_area_url' ) ? tpt_student_area_url() : home_url( '/' ),
	'courses_url' => get_post_type_archive_link( 'courses' ) ? get_post_type_archive_link( 'courses' ) : home_url( '/' ),
);
?>

<main id="content" class="home">
	<?php
	get_template_part( 'template-parts/home/hero', null, $ctx );
	get_template_part( 'template-parts/home/mission', null, $ctx );
	get_template_part( 'template-parts/home/courses', null, $ctx );
	get_template_part( 'template-parts/home/benefits', null, $ctx );
	get_template_part( 'template-parts/home/why-us', null, $ctx );
	get_template_part( 'template-parts/home/testimonials', null, $ctx );
	get_template_part( 'template-parts/home/cta', null, $ctx );
	?>
</main>

<?php
get_footer();
