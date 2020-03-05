
jQuery(document).ready(function($){
  console.log('isotope test');

  var $grid = $('.grid').isotope({
    itemSelector: '.blog-post'
  });
  
  // store filter for each group
  var filters = {};
  
  $('.filters').on( 'click', '.option', function( event ) {
    var $button = $( event.currentTarget );
    // get group key
    var $buttonGroup = $button.parents('.filter-group');
    var filterGroup = $buttonGroup.attr('data-filter-group');
    // set filter for group
    filters[ filterGroup ] = $button.attr('data-filter');
    // combine filters
    var filterValue = concatValues( filters );
    // set filter for Isotope
    $grid.isotope({ filter: filterValue });
  });
  
  // change is-checked class on buttons
  $('.filter-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'option', function( event ) {
      $buttonGroup.find('.is-checked').removeClass('is-checked');
      var $button = $( event.currentTarget );
      $button.addClass('is-checked');
    });
  });
    
  // flatten object by concatinating values
  function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) {
      value += obj[ prop ];
    }
    return value;
  }
});

