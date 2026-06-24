<?php
/**
 * Home > Trilha de Formacao Teologica
 *
 * Caminho de niveis (Basico -> Medio -> Formacao Ministerial) que
 * comunica o ecossistema de ensino e a progressao do aluno.
 *
 * @package ExpansaoTeologica
 */

$enroll_url = isset( $args['enroll_url'] ) ? $args['enroll_url'] : '#';

$steps = array(
	array(
		'num'    => '01',
		'title'  => 'Basico em Teologia',
		'text'   => 'Os fundamentos da fe crista para quem esta comecando.',
		'status' => 'Em breve',
		'state'  => 'soon',
	),
	array(
		'num'    => '02',
		'title'  => 'Medio em Teologia',
		'text'   => 'Aprofundamento em doutrina, Biblia e historia da Igreja.',
		'status' => 'Em breve',
		'state'  => 'soon',
	),
	array(
		'num'    => '03',
		'title'  => 'Formacao Ministerial',
		'text'   => 'Preparo completo para servir e ensinar com seguranca.',
		'status' => 'Disponivel agora',
		'state'  => 'live',
		'url'    => $enroll_url,
	),
);
?>
<section class="section hp-path">
	<div class="container">
		<div class="hp-head reveal">
			<span class="eyebrow">Trilha de formacao</span>
			<h2>Uma jornada do basico ao ministerio</h2>
			<p class="lead">
				Avance por niveis no seu ritmo. Cada etapa prepara voce para a proxima,
				do primeiro contato com a Biblia ate o preparo ministerial completo.
			</p>
		</div>

		<ol class="hp-path__steps">
			<?php foreach ( $steps as $step ) : ?>
				<li class="hp-path__step hp-path__step--<?php echo esc_attr( $step['state'] ); ?> reveal">
					<div class="hp-path__num"><?php echo esc_html( $step['num'] ); ?></div>
					<div class="hp-path__body">
						<span class="hp-path__status hp-path__status--<?php echo esc_attr( $step['state'] ); ?>">
							<?php echo esc_html( $step['status'] ); ?>
						</span>
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<p class="text-muted"><?php echo esc_html( $step['text'] ); ?></p>
						<?php if ( 'live' === $step['state'] && ! empty( $step['url'] ) ) : ?>
							<a class="hp-path__link" href="<?php echo esc_url( $step['url'] ); ?>">Comecar agora &rarr;</a>
						<?php endif; ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
