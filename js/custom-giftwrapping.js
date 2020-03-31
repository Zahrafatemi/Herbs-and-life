jQuery(document).ready(function($){
    // Hide 'None' option on radio buttons
    function removeNoneOption( radioAddon ){
        $(`${radioAddon} p:first-of-type`).hide();
    }

    $(document).on('load', removeNoneOption('.wc-pao-addon-wrap'));
    $(document).on('load', removeNoneOption('.wc-pao-addon-custom-text-location'));

    // Toggle additional options for Custom Packaging
    $( 'body' ).on( 'change', '[data-label="Custom Giftwrapping"]', function() {
        $( '.wc-pao-addon-select-a-design, .wc-pao-addon-custom-image, .wc-pao-addon-additional-instructions, .wc-pao-addon-custom-text' ).toggle();
        $( '.wc-pao-addon-custom-text-location' ).hide();
    });

    // Only show Custom Text Location if Custom Text has value
    $( 'body' ).on( 'change paste keyup', 'input.wc-pao-addon-custom-text', function() {
        if( $(this).val().trim() != '' ){
            $( '.wc-pao-addon-custom-text-location' ).show();
        }else{
            $( '.wc-pao-addon-custom-text-location' ).hide();
        }
    });
});