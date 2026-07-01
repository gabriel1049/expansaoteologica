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
  var TOAST_DURATION = 6000;
  var toastTimer = null;
  var toastStartedAt = 0;
  var toastRemaining = TOAST_DURATION;

  // Encontra o nome do curso a partir do botao clicado (card do arquivo/home)
  // ou, na pagina do proprio curso, a partir do titulo do hero.
  function resolveCourseTitle( sourceEl ) {
    if ( sourceEl && sourceEl.closest ) {
      var cardScopes = [ '.tutor-card', '.hp-course' ];
      for ( var i = 0; i < cardScopes.length; i++ ) {
        var scope = sourceEl.closest( cardScopes[ i ] );
        if ( scope ) {
          var titleEl = scope.querySelector( '.tutor-course-name, .hp-course__title' );
          if ( titleEl && titleEl.textContent.trim() ) { return titleEl.textContent.trim(); }
        }
      }
    }
    // Fallback: estamos na propria pagina do curso (caixa de compra ou pos-reload)
    var heroTitle = document.querySelector( '.course-hero__title' );
    if ( heroTitle && heroTitle.textContent.trim() ) { return heroTitle.textContent.trim(); }
    return null;
  }

  function scheduleHide() {
    window.clearTimeout( toastTimer );
    toastStartedAt = Date.now();
    toastTimer = window.setTimeout( hideCartToast, toastRemaining );
  }

  function pauseCartToast() {
    if ( ! toast || toast.hidden || ! toast.classList.contains( 'is-visible' ) ) { return; }
    window.clearTimeout( toastTimer );
    toastRemaining -= ( Date.now() - toastStartedAt );
    if ( toastRemaining < 300 ) { toastRemaining = 300; }
    toast.classList.add( 'is-paused' );
  }

  function resumeCartToast() {
    if ( ! toast || toast.hidden || ! toast.classList.contains( 'is-visible' ) ) { return; }
    toast.classList.remove( 'is-paused' );
    scheduleHide();
  }

  function showCartToast( sourceEl ) {
    if ( ! toast ) { return; }

    var textEl = document.getElementById( 'cart-toast-text' );
    if ( textEl ) {
      var title = resolveCourseTitle( sourceEl );
      textEl.textContent = title ? title : 'Continue navegando ou finalize sua matricula.';
    }

    var countEl = document.getElementById( 'cart-toast-count' );
    var cartCount = document.querySelector( '.site-cart__count' );
    if ( countEl && cartCount ) {
      var n = parseInt( cartCount.textContent, 10 ) || 0;
      if ( n > 1 ) {
        countEl.textContent = n + ' cursos no carrinho';
        countEl.hidden = false;
      } else {
        countEl.hidden = true;
      }
    }

    toast.hidden = false;
    void toast.offsetWidth; // forca reflow para a transicao de entrada funcionar
    toast.classList.remove( 'is-paused' );
    toast.classList.add( 'is-visible' );

    // Reinicia a animacao da barra de progresso
    var bar = toast.querySelector( '.cart-toast__progress-bar' );
    if ( bar ) {
      bar.style.animation = 'none';
      void bar.offsetWidth;
      bar.style.animation = '';
    }

    toastRemaining = TOAST_DURATION;
    scheduleHide();
  }

  function hideCartToast() {
    if ( ! toast ) { return; }
    toast.classList.remove( 'is-visible', 'is-paused' );
    window.clearTimeout( toastTimer );
    window.setTimeout( function () { if ( ! toast.classList.contains( 'is-visible' ) ) { toast.hidden = true; } }, 300 );
  }

  if ( toast ) {
    var closeBtn = toast.querySelector( '.cart-toast__close' );
    if ( closeBtn ) { closeBtn.addEventListener( 'click', hideCartToast ); }

    // Pausa a contagem enquanto o usuario le/interage (mouse ou teclado)
    toast.addEventListener( 'mouseenter', pauseCartToast );
    toast.addEventListener( 'mouseleave', resumeCartToast );
    toast.addEventListener( 'focusin', pauseCartToast );
    toast.addEventListener( 'focusout', resumeCartToast );

    // Esc fecha a notificacao
    document.addEventListener( 'keydown', function ( e ) {
      if ( e.key === 'Escape' && toast.classList.contains( 'is-visible' ) ) { hideCartToast(); }
    } );

    // 1) Adicao via AJAX (arquivo de cursos, mini-cart): evento padrao do WooCommerce.
    // O 4o argumento e o botao clicado, usado para identificar o curso.
    if ( window.jQuery ) {
      window.jQuery( document.body ).on( 'added_to_cart', function ( event, fragments, cartHash, $button ) {
        var btnEl = $button && $button.get ? $button.get( 0 ) : null;
        showCartToast( btnEl );
      } );
    }

    // 2) Adicao com recarregamento (pagina do curso): detecta a mensagem de sucesso do Woo
    var msg = document.querySelector( '.woocommerce-message' );
    var isCartPage = document.body.classList.contains( 'woocommerce-cart' ) || document.body.classList.contains( 'woocommerce-checkout' );
    if ( msg && ! isCartPage ) {
      var txt = ( msg.textContent || '' ).toLowerCase();
      if ( txt.indexOf( 'adicionad' ) !== -1 || txt.indexOf( 'added' ) !== -1 || txt.indexOf( 'carrinho' ) !== -1 ) {
        msg.style.display = 'none'; // esconde o aviso padrao, mostramos o nosso
        showCartToast( null );
      }
    }
  }

  // ===== Destaque do metodo de pagamento selecionado (checkout) =====
  function updatePaymentMethodHighlight() {
    var items = document.querySelectorAll( '.wc_payment_methods .wc_payment_method' );
    Array.prototype.forEach.call( items, function ( li ) {
      var radio = li.querySelector( 'input.input-radio' );
      li.classList.toggle( 'is-selected', !! ( radio && radio.checked ) );
    } );
  }
  if ( document.querySelector( '.wc_payment_methods' ) ) {
    updatePaymentMethodHighlight();
    document.addEventListener( 'change', function ( e ) {
      if ( e.target.matches && e.target.matches( '.wc_payment_methods input[name="payment_method"]' ) ) {
        updatePaymentMethodHighlight();
      }
    } );
    // O WooCommerce recria essa area via AJAX ao recalcular o checkout
    // (ex.: troca de endereco). Reaplica o destaque quando isso acontece.
    if ( window.jQuery ) {
      window.jQuery( document.body ).on( 'updated_checkout', updatePaymentMethodHighlight );
    }
  }

  // ===== Scroll-reveal (entrada suave ao rolar) =====
  var revealEls = document.querySelectorAll( '.reveal' );
  var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
  if ( revealEls.length ) {
    if ( ! reduceMotion && 'IntersectionObserver' in window ) {
      var io = new IntersectionObserver( function ( entries ) {
        entries.forEach( function ( entry ) {
          if ( entry.isIntersecting ) {
            entry.target.classList.add( 'is-in' );
            io.unobserve( entry.target );
          }
        } );
      }, { rootMargin: '0px 0px -10% 0px', threshold: 0.15 } );
      Array.prototype.forEach.call( revealEls, function ( el, i ) {
        el.style.setProperty( '--i', i % 6 );
        io.observe( el );
      } );
    } else {
      Array.prototype.forEach.call( revealEls, function ( el ) { el.classList.add( 'is-in' ); } );
    }
  }
}() );
