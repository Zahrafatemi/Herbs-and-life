jQuery(document).ready(function($){
    $('body').on('change', 'input.product-option', function() {
        $(`.product-option-price`).hide();
        var selectedOption = $( 'input.product-option:checked' ).val();
        $(`#${selectedOption}-price`).show();
    });
});