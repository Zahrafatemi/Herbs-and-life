jQuery(document).ready(function($){
    $( 'body' ).on( 'change', 'input[name="addon-185-custom-packaging-0[]"]', function() {
        $( '.wc-pao-addon-container' ).toggle();
        $( '.wc-pao-addon-custom-packaging' ).show();
    });
});