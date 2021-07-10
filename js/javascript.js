jQuery(function(){
    var topbtn = jQuery(".back-to-top");    
    topbtn.hide();
    
    jQuery(window).on("scroll", function (){
        if(jQuery(this).scrollTop() > 100)
        {
            topbtn.fadeIn();
        }
        else
        {
            topbtn.fadeOut();
        }
    });

    topbtn.on("click", function (){
        jQuery("body, html").animate(
            {"scrollTop": 0}, 500);
    });
});