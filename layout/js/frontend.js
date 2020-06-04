
$(function () 
{
	// body...
	'use strict';

	//Switch Between login & Signup

	$('.login-page h1 span').click(function () {

		$(this).addClass('selected').siblings().removeClass('selected');

		$('login-page form').hide();

		$('.' + $(this).data('class')).fadeIn(100);

    });


	//Trigger The Selectboxit

    $("select").selectBoxIt({
		autoWidth:false
	});

	//Hide Placeholder On Form Foucs

	$(function () {

		$('.form-control').data('holder', $('.form-control').attr('placeholder'));
	
		$('.form-control').focusin(function () {
			$(this).attr('placeholder', '');
		});
		$('.form-control').focusout(function () {
			$(this).attr('placeholder', $(this).data('holder'));
		});
	
	
	});
	

	//Add Asterisk on Required Field

	$('input').each(function () {
		if ($(this).attr('required') === 'requierd') {

			$(this).after('<span class="asterisk">*</span>');
		}
    });

	//Confirmation Message On Button
	$('.confirm').click(function () {
		return confirm('Are You Sure');
    });


    $('.live').keyup(function (){
    	$($(this).data('class')).text($(this).val());
    });



}); 









/*
$(function () 
{
	// body...
	'use strict';

	//Switch Between login & Signup

	$('.login-page h1 span').click(function () {

		$(this).addClass('selected').siblings().removeClass('selected');

		$('login-page form').hide();

		$('.' + $(this).data('class')).fadeIn(100);

    });


	//Trigger The Selectboxit

    $("select").selectBoxIt({
		autoWidth:false
	});

	//Hide Placeholder On Form Foucs
    
	$(['placeholder'].foucs(function () {
		$(this).attr('data-text', $(this).attr('placeholder'));
		$(this).attr('placeholder', '');

	}).blur(function (){

		$(this).attr('placeholder', $(this).attr('data-text'));

	});
    
    
    $(function () {
		$('.form-control').data('holder', $('.form-control').attr('placeholder'));
		$('.form-control').focusin(function () {
			$(this).attr('placeholder', '');
		});
		$('.form-control').focusout(function () {
			$(this).attr('placeholder', $(this).data('holder'));
		});
	});
      
      


	//Add Asterisk on Required Field

	$('input').each(function () {
		if ($(this).attr('required') === 'requierd') {

			$(this).after('<span class="asterisk">*</span>');
		}
    });

	//Confirmation Message On Button
	$('.confirm').click(function () {
		return confirm('Are You Sure');
    });


}); */