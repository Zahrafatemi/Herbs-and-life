jQuery(document).ready(function() {
    jQuery('.search-icon').click(function(e) {
        jQuery('.search-form').slideToggle(500);
 
        e.preventDefault();
    });

    jQuery('.hm-icon').click(function(e) {
        jQuery('.menu-main-menu-container').slideToggle(200);
 
        e.preventDefault();
    });
    
});