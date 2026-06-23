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
}() );
