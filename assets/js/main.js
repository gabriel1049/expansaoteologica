/* main.js - interacoes gerais do tema Expansao Teologica */
( function () {
  'use strict';

  var header = document.querySelector( '.site-header' );

  // Menu mobile (toggle pelo botao .js-menu-toggle no header)
  document.addEventListener( 'click', function ( e ) {
    var toggle = e.target.closest( '.js-menu-toggle' );
    if ( toggle ) {
      var nav = document.querySelector( '.js-primary-nav' );
      if ( nav ) {
        var open = nav.classList.toggle( 'is-open' );
        toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
      }
      return;
    }
    // Fecha o menu ao clicar fora dele
    if ( ! e.target.closest( '.js-primary-nav' ) && ! e.target.closest( '.js-menu-toggle' ) ) {
      var openNav = document.querySelector( '.js-primary-nav.is-open' );
      if ( openNav ) { openNav.classList.remove( 'is-open' ); }
    }
  } );

  // Sombra sutil no header ao rolar a pagina
  if ( header ) {
    var onScroll = function () {
      header.classList.toggle( 'is-scrolled', window.scrollY > 8 );
    };
    window.addEventListener( 'scroll', onScroll, { passive: true } );
    onScroll();
  }

  // ===== Toast de notificacao do carrinho =====
  var toast = document.getElementById( 'cart-toast' );
  var toastTimer = null;

  function showCartToast() {
    if ( ! toast ) { return; }
    toast.hidden = false;
    // forca reflow para a transicao de entrada funcionar
    void toast.offsetWidth;
    toast.classList.add( 'is-visible' );
    window.clearTimeout( toastTimer );
    toastTimer = window.setTimeout( hideCartToast, 5000 );
  }

  function hideCartToast() {
    if ( ! toast ) { return; }
    toast.classList.remove( 'is-visible' );
    window.clearTimeout( toastTimer );
    window.setTimeout( function () { if ( ! toast.classList.contains( 'is-visible' ) ) { toast.hidden = true; } }, 300 );
  }

  if ( toast ) {
    var closeBtn = toast.querySelector( '.cart-toast__close' );
    if ( closeBtn ) { closeBtn.addEventListener( 'click', hideCartToast ); }

    // 1) Adicao via AJAX (arquivo de cursos, mini-cart): evento padrao do WooCommerce
    if ( window.jQuery ) {
      window.jQuery( document.body ).on( 'added_to_cart', showCartToast );
    }

    // 2) Adicao com recarregamento (pagina do curso): detecta a mensagem de sucesso do Woo
    var msg = document.querySelector( '.woocommerce-message' );
    var isCartPage = document.body.classList.contains( 'woocommerce-cart' ) || document.body.classList.contains( 'woocommerce-checkout' );
    if ( msg && ! isCartPage ) {
      var txt = ( msg.textContent || '' ).toLowerCase();
      if ( txt.indexOf( 'adicionad' ) !== -1 || txt.indexOf( 'added' ) !== -1 || txt.indexOf( 'carrinho' ) !== -1 ) {
        msg.style.display = 'none'; // esconde o aviso padrao, mostramos o nosso
        showCartToast();
      }
    }
  }
}() );
