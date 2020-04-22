jQuery(document).ready(function($) {
    const body_tag = document.getElementsByTagName('body');
    let shop_cat_page = body_tag[0].classList.contains('tax-product_cat');

    if(shop_cat_page){
        let $i = 10;
        let total_products_count = $("ul.product-list").children().length;
        console.log(total_products_count);
        jQuery("li.status-publish:nth-child(n+"+$i+")").css("display", "none");
        $last_product = "li.status-publish:last-child";
        $continue = true;
        
        if ($(window).width() < 600) {
            $mobile = true;
        }else{
            $mobile = false;
        }

        $("div.columns-3").append('<button class="woo-btn" id="load-more-button">Load More</button>');
        const load_more_button = document.getElementById('load-more-button');
        load_more_button.style = 'background-color: #5E6850; border-radius: 0; margin: 70px auto 0; max-width: 300px; color: white; height: 50px;';
        load_more_button.style.display = 'none';

        if($mobile){
            $(window).scroll(function() {
                var scrollHeight = $(document).height();
                var scrollPosition = $(window).height() + $(window).scrollTop();
                if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
                    // when scroll to bottom of the page
                    load_more();
                }
                
            });
            }else{
                    if(total_products_count>$i){
                        load_more_button.style.display = 'block';
                        load_more_button.onclick = function() {
                            if($continue){
                                load_more();
                            }else{
                                load_more();
                                load_more_button.style.display = 'none';
                            }
                        };
                    }
                    
            }

        function load_more(){
            let $j = $i + 5;
            for($i; $i<$j; $i++){
            $class_name_to_display = "li.status-publish:nth-child("+$i+")";
            $class_name_to_not_display = "li.status-publish:nth-child(n+"+$j+")";
            jQuery($class_name_to_display).css("display", "block");
            jQuery($class_name_to_not_display).css("display", "none");
            if($($class_name_to_display).is($last_product)){
                $continue = false;
            }
            }
            $i = $j;
        }
    }
    
  });

  