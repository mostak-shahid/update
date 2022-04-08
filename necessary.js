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
/*Add more*/

$('.add_more_fleet').on('click', function(){
    let id = $('#add_more_fleet_count').val();
    let clone = $(this).siblings('.mos-container').find('.unit:first-of-type').clone().appendTo('.mos-container');
    clone.find('.form-control').val('');
    clone.find('.form-control.fleet-type').attr('name', 'fleet['+id+'][type]');
    clone.find('.form-control.fleet-nov').attr('name', 'fleet['+id+'][nov]');
    clone.find('.form-control.fleet-onboard').attr('name', 'fleet['+id+'][onboard]');
    //console.log(id);
    id++;
    $('#add_more_fleet_count').val(id);
});
/*Add more*/
console.table()
console.time("anylevel")
for(let i =0; i < 1000000; i++) {
    // Do Something
}
console.timeEnd("samelevel")
//It will calculate the time
console.dir(elem)
//It will show the object version of the element