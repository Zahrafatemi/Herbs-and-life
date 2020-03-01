jQuery(document).ready(function($){
    // Hide 'None' option on radio buttons
    function removeNoneOption( radioAddon ){
        $(`${radioAddon} p:first-of-type`).hide();
    }

    $(document).on('load', removeNoneOption('.wc-pao-addon-colour'));
    $(document).on('load', removeNoneOption('.wc-pao-addon-custom-text-location'));

    // Toggle additional options for Custom Packaging
    $( 'body' ).on( 'change', 'input[name="addon-185-custom-packaging-0[]"]', function() {
        $( '.wc-pao-addon-container' ).toggle();
        $( '.wc-pao-addon-custom-packaging' ).show();
        $( '.wc-pao-addon-custom-text-location' ).hide();
    });

    // Only show Custom Text Location if Custom Text has value
    $( 'body' ).on( 'change paste keyup', 'input[name="addon-185-custom-text-2"]', function() {
        if( $(this).val().trim() != '' ){
            $( '.wc-pao-addon-custom-text-location' ).show();
        }else{
            $( '.wc-pao-addon-custom-text-location' ).hide();
        }
    });
});