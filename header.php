<?php
/**
 * Header do tema Expansao Teologica
 *
 * @package ExpansaoTeologica
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="container site-header__inner">

		<!-- Marca: logo customizado OU icone SVG + nome -->
		<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<img class="site-header__icon" src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/icon.svg' ); ?>"
					 alt="" width="36" height="36">
				<span><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
			<?php endif; ?>
		</a>

		<?php
		$tpt_student_url = tpt_student_area_url();
		$tpt_enroll_url  = tpt_enroll_url();
		?>

		<!-- Menu principal (com fallback caso nenhum menu esteja configurado) -->
		<nav class="site-nav js-primary-nav" aria-label="Menu principal">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'site-nav__list',
					'fallback_cb'    => 'tpt_default_menu',
				)
			);
			?>

			<!-- Acoes dentro do menu (visiveis so no mobile) -->
			<div class="site-nav__cta">
				<a class="btn btn--secondary btn--block" href="<?php echo esc_url( $tpt_student_url ); ?>">Area do Aluno</a>
				<a class="btn btn--primary btn--block js-track-cta-header" href="<?php echo esc_url( $tpt_enroll_url ); ?>">Matricular</a>
			</div>
		</nav>

		<!-- Acoes a direita (desktop): carrinho + area do aluno + matricula -->
		<div class="site-header__actions">

			<?php if ( function_exists( 'WC' ) && null !== WC()->cart ) : ?>
				<a class="site-cart js-track-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="Ver carrinho">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<circle cx="9" cy="21" r="1"></circle>
						<circle cx="20" cy="21" r="1"></circle>
						<path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
					</svg>
					<span class="site-cart__count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
				</a>
			<?php endif; ?>

			<a class="btn btn--secondary btn--sm site-header__account" href="<?php echo esc_url( $tpt_student_url ); ?>">
				<svg class="btn__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
					<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
					<circle cx="12" cy="7" r="4"></circle>
				</svg>
				Area do Aluno
			</a>

			<a class="btn btn--primary btn--sm site-header__cta js-track-cta-header" href="<?php echo esc_url( $tpt_enroll_url ); ?>">
				Matricular
			</a>

			<button class="site-header__toggle js-menu-toggle" aria-expanded="false" aria-label="Abrir menu">
				<span></span><span></span><span></span>
			</button>
		</div>

	</div>
</header>

<div class="site-content">
