<?php
/**
 * Expansao Teologica - functions.php
 *
 * Setup do tema, suporte a recursos e carregamento de assets.
 *
 * @package ExpansaoTeologica
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'TPT_VERSION', '1.0.0' );
define( 'TPT_DIR', get_template_directory() );
define( 'TPT_URI', get_template_directory_uri() );

/**
 * Recursos suportados pelo tema.
 */
function tpt_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	// Declara compatibilidade com WooCommerce.
	add_theme_support( 'woocommerce' );

	register_nav_menus(
		array(
			'primary' => __( 'Menu principal', 'expansao-teologica' ),
			'footer'  => __( 'Menu rodape', 'expansao-teologica' ),
		)
	);
}
add_action( 'after_setup_theme', 'tpt_theme_setup' );

/**
 * Favicon / icone do site.
 * Usa o SVG da marca em /assets/img. Se o usuario definir um Site Icon
 * nativo do WordPress, este nao sobrescreve (so adiciona o SVG moderno).
 */
function tpt_favicon() {
	$favicon = TPT_URI . '/assets/img/favicon.svg';
	echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( $favicon ) . '">' . "\n";
	echo '<link rel="mask-icon" href="' . esc_url( $favicon ) . '" color="#0F1B2D">' . "\n";
	echo '<meta name="theme-color" content="#0F1B2D">' . "\n";
}
add_action( 'wp_head', 'tpt_favicon' );

/**
 * Carregamento de estilos e scripts.
 * Ordem importa: variables (tokens) primeiro, depois base, components e tutor.
 */
function tpt_enqueue_assets() {

	// Poppins via Google Fonts (pesos 300, 400, 600, 700).
	// Para producao, considere baixar a fonte para /assets/fonts e servir local (melhor performance/LCP).
	wp_enqueue_style(
		'tpt-poppins',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'tpt-variables', TPT_URI . '/assets/css/variables.css', array(), TPT_VERSION );
	wp_enqueue_style( 'tpt-base', TPT_URI . '/assets/css/base.css', array( 'tpt-variables' ), TPT_VERSION );
	wp_enqueue_style( 'tpt-components', TPT_URI . '/assets/css/components.css', array( 'tpt-base' ), TPT_VERSION );
	wp_enqueue_style( 'tpt-layout', TPT_URI . '/assets/css/layout.css', array( 'tpt-components' ), TPT_VERSION );

	// CSS da home so carrega na pagina inicial (performance).
	if ( is_front_page() ) {
		wp_enqueue_style( 'tpt-home', TPT_URI . '/assets/css/home.css', array( 'tpt-layout' ), TPT_VERSION );
	}

	// CSS especifico do LMS so carrega nas telas do Tutor (performance).
	if ( function_exists( 'tutor_utils' ) && ( is_singular( 'courses' ) || is_post_type_archive( 'courses' ) || is_singular( 'lesson' ) ) ) {
		wp_enqueue_style( 'tpt-tutor', TPT_URI . '/assets/css/tutor.css', array( 'tpt-components' ), TPT_VERSION );
	}

	// CSS do WooCommerce so carrega nas paginas de loja/carrinho/checkout/conta.
	if ( function_exists( 'is_woocommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {
		wp_enqueue_style( 'tpt-woocommerce', TPT_URI . '/assets/css/woocommerce.css', array( 'tpt-components' ), TPT_VERSION );
	}

	// Garante o script de fragmentos do Woo (contador de carrinho via AJAX).
	if ( function_exists( 'WC' ) ) {
		wp_enqueue_script( 'wc-cart-fragments' );
	}

	wp_enqueue_script( 'tpt-main', TPT_URI . '/assets/js/main.js', array(), TPT_VERSION, true );

	// Camada de tracking (GA4 / Meta Pixel). Carrega no rodape.
	wp_enqueue_script( 'tpt-tracking', TPT_URI . '/assets/js/tracking.js', array( 'tpt-main' ), TPT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'tpt_enqueue_assets' );

/**
 * Helper: duracao formatada do curso (compatibilidade entre versoes do Tutor).
 */
function tpt_course_duration( $course_id ) {
	if ( function_exists( 'get_tutor_course_duration_context' ) ) {
		return get_tutor_course_duration_context( $course_id, true );
	}
	return '';
}

/**
 * Renderiza uma linha de estrelas (avaliacao). Padrao: 5 estrelas cheias.
 *
 * @param int $count Quantidade de estrelas cheias (0-5).
 */
function tpt_stars( $count = 5 ) {
	$count = max( 0, min( 5, (int) round( $count ) ) );
	$path  = '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>';
	echo '<span class="lp-testimonial__stars" role="img" aria-label="' . esc_attr( $count ) . ' de 5 estrelas">';
	for ( $i = 1; $i <= 5; $i++ ) {
		$opacity = $i <= $count ? '1' : '0.25';
		echo '<svg viewBox="0 0 24 24" fill="currentColor" style="opacity:' . esc_attr( $opacity ) . '" aria-hidden="true">' . $path . '</svg>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
	echo '</span>';
}

/**
 * URL da Area do Aluno: dashboard do Tutor, com fallback para
 * Minha Conta (Woo) e, por ultimo, login do WordPress.
 */
function tpt_student_area_url() {
	if ( function_exists( 'tutor_utils' ) ) {
		$dash = tutor_utils()->get_tutor_dashboard_page_permalink();
		if ( $dash ) {
			return $dash;
		}
	}
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$acc = wc_get_page_permalink( 'myaccount' );
		if ( $acc ) {
			return $acc;
		}
	}
	return wp_login_url();
}

/**
 * URL de matricula: curso em destaque (mais recente) ou a listagem de cursos.
 */
function tpt_enroll_url() {
	$courses = get_posts(
		array(
			'post_type'      => 'courses',
			'posts_per_page' => 1,
			'post_status'    => 'publish',
			'fields'         => 'ids',
		)
	);
	if ( ! empty( $courses ) ) {
		return get_permalink( $courses[0] );
	}
	$archive = get_post_type_archive_link( 'courses' );
	return $archive ? $archive : home_url( '/' );
}

/**
 * Menu de fallback: aparece no header enquanto nenhum menu for
 * configurado em Aparencia > Menus (local "primary").
 * Assim o header nunca fica vazio.
 */
function tpt_default_menu() {
	echo '<ul class="site-nav__list">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Inicio</a></li>';

	// Link para a listagem de cursos do Tutor, se existir.
	if ( function_exists( 'tutor_utils' ) ) {
		$courses_url = get_post_type_archive_link( 'courses' );
		if ( $courses_url ) {
			echo '<li><a href="' . esc_url( $courses_url ) . '">Cursos</a></li>';
		}
	}

	echo '<li><a href="' . esc_url( home_url( '/sobre' ) ) . '">Sobre</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/contato' ) ) . '">Contato</a></li>';
	echo '</ul>';
}

/**
 * Atualiza o contador do carrinho via AJAX do WooCommerce.
 * O Woo substitui o elemento span.site-cart__count quando um item
 * e adicionado, sem recarregar a pagina.
 */
function tpt_cart_count_fragment( $fragments ) {
	if ( function_exists( 'WC' ) && null !== WC()->cart ) {
		ob_start();
		?>
		<span class="site-cart__count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
		<?php
		$fragments['span.site-cart__count'] = ob_get_clean();
	}
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'tpt_cart_count_fragment' );
