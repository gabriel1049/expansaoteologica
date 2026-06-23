<?php
/**
 * Home > Depoimentos
 *
 * Estrutura pronta para receber avaliacoes reais futuramente.
 *
 * @package ExpansaoTeologica
 */

$items = array(
	array(
		'quote'  => 'O conteudo me deu uma base que eu buscava ha anos. Claro e profundo ao mesmo tempo.',
		'name'   => 'Ana Paula',
		'role'   => 'Lider de celula',
		'avatar' => 'AP',
	),
	array(
		'quote'  => 'Estudei no meu tempo, entre o trabalho e a familia. Mudou minha forma de ler a Biblia.',
		'name'   => 'Marcos Vinicius',
		'role'   => 'Aluno',
		'avatar' => 'MV',
	),
	array(
		'quote'  => 'Me preparou de verdade para ensinar na igreja. Recomendo para quem leva a fe a serio.',
		'name'   => 'Juliana Reis',
		'role'   => 'Professora de EBD',
		'avatar' => 'JR',
	),
);
?>
<section class="section hp-tst">
	<div class="container">
		<div class="hp-head">
			<span class="eyebrow">Depoimentos</span>
			<h2>Historias de quem ja estuda conosco</h2>
		</div>

		<div class="hp-tst__grid">
			<?php foreach ( $items as $t ) : ?>
				<blockquote class="card hp-tst__card">
					<?php tpt_stars( 5 ); ?>
					<p>"<?php echo esc_html( $t['quote'] ); ?>"</p>
					<footer>
						<span class="hp-tst__avatar" aria-hidden="true"><?php echo esc_html( $t['avatar'] ); ?></span>
						<span>
							<strong><?php echo esc_html( $t['name'] ); ?></strong>
							<span><?php echo esc_html( $t['role'] ); ?></span>
						</span>
					</footer>
				</blockquote>
			<?php endforeach; ?>
		</div>
	</div>
</section>
