/* tracking.js - camada base para GA4 / Meta Pixel
   Escuta as classes .js-track-* e empurra eventos para o dataLayer.
   Conecte aqui o gtag() ou fbq() quando instalar as tags. */
( function () {
  'use strict';
  window.dataLayer = window.dataLayer || [];

  function push( event, data ) {
    window.dataLayer.push( Object.assign( { event: event }, data || {} ) );
    // Exemplos (descomente ao instalar as tags):
    // if ( window.gtag ) { gtag( 'event', event, data ); }
    // if ( window.fbq )  { fbq( 'trackCustom', event, data ); }
  }

  document.addEventListener( 'DOMContentLoaded', function () {
    var main = document.querySelector( '.single-course' );
    var courseId = main ? main.getAttribute( 'data-course-id' ) : null;

    // Viu o preco / caixa de compra
    var priceBox = document.querySelector( '.js-track-view-price' );
    if ( priceBox && 'IntersectionObserver' in window ) {
      var obs = new IntersectionObserver( function ( entries ) {
        entries.forEach( function ( entry ) {
          if ( entry.isIntersecting ) {
            push( 'view_item', { course_id: courseId } );
            obs.disconnect();
          }
        } );
      } );
      obs.observe( priceBox );
    }

    // Clique em comprar (delegacao para o botao do Tutor/Woo dentro da caixa)
    document.addEventListener( 'click', function ( e ) {
      if ( e.target.closest( '.purchase-box button, .purchase-box .single_add_to_cart_button, .js-track-checkout' ) ) {
        push( 'add_to_cart', { course_id: courseId } );
      }
      if ( e.target.closest( '.js-track-continue' ) ) {
        push( 'continue_course', { course_id: courseId } );
      }
      // CTAs da landing page
      if ( e.target.closest( '.js-track-cta-hero' ) ) {
        push( 'cta_click', { location: 'hero' } );
      }
      if ( e.target.closest( '.js-track-cta-course' ) ) {
        push( 'cta_click', { location: 'course_card' } );
      }
      if ( e.target.closest( '.js-track-cta-final' ) ) {
        push( 'cta_click', { location: 'footer_cta' } );
      }
      if ( e.target.closest( '.js-track-cta-header' ) ) {
        push( 'cta_click', { location: 'header' } );
      }
      if ( e.target.closest( '.js-track-cart' ) ) {
        push( 'view_cart', {} );
      }
    } );
  } );
}() );
