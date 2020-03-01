jQuery(document).ready(function($){
    $('body').on('change', 'input[name="addon-185-custom-packaging-0[]"]', function() {
        console.log(`${$(this).attr('name')}`);
    });
});