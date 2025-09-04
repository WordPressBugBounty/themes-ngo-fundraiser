function ngo_fundraiser_openNav() {
  jQuery(".sidenav").addClass('show');
}
function ngo_fundraiser_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function ngo_fundraiser_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const ngo_fundraiser_nav = document.querySelector( '.sidenav' );

      if ( ! ngo_fundraiser_nav || ! ngo_fundraiser_nav.classList.contains( 'show' ) ) {
        return;
      }
      const elements = [...ngo_fundraiser_nav.querySelectorAll( 'input, a, button' )],
        ngo_fundraiser_lastEl = elements[ elements.length - 1 ],
        ngo_fundraiser_firstEl = elements[0],
        ngo_fundraiser_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && ngo_fundraiser_lastEl === ngo_fundraiser_activeEl ) {
        e.preventDefault();
        ngo_fundraiser_firstEl.focus();
      }

      if ( shiftKey && tabKey && ngo_fundraiser_firstEl === ngo_fundraiser_activeEl ) {
        e.preventDefault();
        ngo_fundraiser_lastEl.focus();
      }
    } );
  }
  ngo_fundraiser_keepFocusInMenu();
} )( window, document );

var ngo_fundraiser_btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    ngo_fundraiser_btn.addClass('show');
  } else {
    ngo_fundraiser_btn.removeClass('show');
  }
});

ngo_fundraiser_btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).ready(function() {
    var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
    margin: 0,
    nav:true,
    autoplay : true,
    lazyLoad: true,
    autoplayTimeout: 5000,
    loop: false,
    dots: false,
    navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
    responsive: {
      0: {
        items: 1
      },
      576: {
        items: 1
      },
      768: {
        items: 1
      },
      1000: {
        items: 1
      },
      1200: {
        items: 1
      }
    },
    autoplayHoverPause : false,
    mouseDrag: true
  });
})

window.addEventListener('load', (event) => {
  jQuery(".loading").delay(2000).fadeOut("slow");
});

jQuery('.header-search-wrapper .search-main').click(function(){
    jQuery('.search-form-main').toggleClass('active-search');
    jQuery('.search-form-main .search-field').focus();
});