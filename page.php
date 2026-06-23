<?php
/**
 * Template padrao de Pagina (page).
 *
 * Usado por paginas comuns e pelas paginas do WooCommerce/Tutor
 * (Carrinho, Finalizar compra, Minha conta). Renderiza o conteudo
 * completo via the_content(), inclusive shortcodes e blocos.
 *
 * @package ExpansaoTeologica
 */

get_header();
?>

<main id="content" class="page-wrap">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'page-article' ); ?>>
				<header class="page-article__header">
					<h1 class="page-article__title"><?php the_title(); ?></h1>
					<hr class="divider">
				</header>

				<div class="page-article__content">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
