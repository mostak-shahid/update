jQuery(document).ready(function($){    
    $(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.mos-sticky-header').addClass('tiny');
		} else {
			$('.mos-sticky-header').removeClass('tiny');
		}
	}); 
    
    $(".mos-select-menu").submit(function (e) {
        var fields = $(this).serializeArray();
        //console.log(fields[0].value);
        $.each(fields, function (i, field) {
            console.log(field.value + " ");
        });
    });
});