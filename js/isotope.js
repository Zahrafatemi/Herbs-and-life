
jQuery(document).ready(function($){
  var $container = $('.blog-feed');

  $container.isotope({
      itemSelector: '.blog-post',
      mansory:{
        holizontalOrder:true,
        fitWidth: true
      },
      percentPosition: true
  });

  var filters = {};

  // ------------------------------------------
  // Recipes Filters toggle
  // ------------------------------------------
  $('.main.filter-group').on( 'change', 'input', function() {
      if( $( '#recipes' ).is( ':checked' ) ){
        $( '.recipes-filters' ).addClass( 'show' );
      }else{
        $( '.recipes-filters' ).removeClass( 'show' );
        resetFilters();
      }
      
  });

  // ------------------------------------------
  // Filtering
  // ------------------------------------------
  $('.filters').on( 'change', '.filter-option', function() {
      var category = $( this ).parents( '.filter-group' ).attr( 'data-filter-cat' );
      
      if( $( this ).is( 'select' ) ) {
        filters[ category ] = $( this ).find( 'option:selected' ).attr( 'data-filter');
      }else {
        filters[ category ] = $( this ).attr( 'data-filter' );
      }

      applyFilters();
  });

  function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) {
      value += obj[ prop ];
    }
    return value;
  }

  function applyFilters() {
    console.log(`filters is ${concatValues(filters)}`);
    $container.isotope( {filter: concatValues( filters )} );
  }

  function resetFilters() {
    filters = {};
    applyFilters();
  }

  // ------------------------------------------
  // Infinite Scroll
  // ------------------------------------------

});

