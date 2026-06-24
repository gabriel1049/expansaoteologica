<?php
/**
 * Home > Beneficios da plataforma
 *
 * @package ExpansaoTeologica
 */

$benefits = array(
	array(
		'title' => 'Certificado de conclusao',
		'text'  => 'Receba um certificado ao concluir cada curso.',
		'icon'  => '<circle cx="12" cy="8" r="6"></circle><path d="M8.5 13.5L7 22l5-3 5 3-1.5-8.5"></path>',
	),
	array(
		'title' => 'Professores qualificados',
		'text'  => 'Aprenda com quem une conhecimento teologico e experiencia.',
		'icon'  => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle>',
	),
	array(
		'title' => 'Acesso 100% online',
		'text'  => 'Estude pelo computador ou celular, de onde estiver.',
		'icon'  => '<rect x="2" y="3" width="20" height="14" rx="2"></rect><path d="M8 21h8M12 17v4"></path>',
	),
	array(
		'title' => 'Conteudo atualizado',
		'text'  => 'Material revisado e ampliado conforme a plataforma cresce.',
		'icon'  => '<path d="M21 2v6h-6"></path><path d="M3 12a9 9 0 0 1 15-6.7L21 8"></path><path d="M3 22v-6h6"></path><path d="M21 12a9 9 0 0 1-15 6.7L3 16"></path>',
	),
	array(
		'title' => 'Formacao acessivel',
		'text'  => 'Valores justos para democratizar o ensino teologico.',
		'icon'  => '<line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>',
	),
	array(
		'title' => 'Aprenda no seu ritmo',
		'text'  => 'Acesso vitalicio. Avance quando e como quiser.',
		'icon'  => '<circle cx="12" cy="12" r="9"></circle><path d="M12 7v5l3 2"></path>',
	),
);
?>
<section class="section hp-benefits">
	<div class="container">
		<div class="hp-head reveal">
			<span class="eyebrow">Vantagens</span>
			<h2>Tudo que voce precisa para evoluir</h2>
		</div>

		<div class="hp-benefits__grid">
			<?php foreach ( $benefits as $b ) : ?>
				<article class="hp-benefit reveal">
					<div class="hp-benefit__icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><?php echo $b['icon']; // phpcs:ignore ?></svg>
					</div>
					<div>
						<h3><?php echo esc_html( $b['title'] ); ?></h3>
						<p class="text-muted"><?php echo esc_html( $b['text'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
