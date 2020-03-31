jQuery(document).ready(function($){
  
    // ------------------------------------------
    // Recipes Filters toggle
    // ------------------------------------------
    let radio_first= $('.wpcf7-list-item.first');
    let radio_last= $('.wpcf7-list-item.last');
   
    radio_first.on("click", function(){
        $(this).addClass('selected');
        if(radio_last.hasClass('selected')){
        radio_last.removeClass('selected');
        }
    });
    radio_last.on("click", function(){
        $(this).addClass('selected');
        radio_first.children('input[type="radio"]:checked').removeAttr('checked'); 
        if(radio_first.hasClass('selected')){  
            radio_first.removeClass('selected');
            }
    
    });  
  });