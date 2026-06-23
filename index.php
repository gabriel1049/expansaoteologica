<?php
/**
 * Fallback principal do tema (obrigatorio).
 *
 * @package TeologiaParaTodos
 */

get_header();
?>

<main id="content" class="container section">
	<?php if ( have_posts() ) : ?>
		<div class="post-list">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'card post-list__item' ); ?>>
					<header>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</header>
					<div class="post-list__excerpt"><?php the_excerpt(); ?></div>
				</article>
				<?php
			endwhile;

			the_posts_pagination();
			?>
		</div>
	<?php else : ?>
		<p>Nenhum conteudo encontrado.</p>
	<?php endif; ?>
</main>

<?php
get_footer();
