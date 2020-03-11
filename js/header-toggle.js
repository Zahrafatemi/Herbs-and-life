jQuery(document).ready(function() {

    jQuery('.hm-icon').click(function(e) {
        jQuery('.menu-main-menu-container').slideToggle(200);
 
        e.preventDefault();
    });
    
});