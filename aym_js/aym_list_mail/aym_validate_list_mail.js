
/* --------------------------- LIST MAIL --------------------------- */

$(function() {
	$('#aym_send_list_mail').click(function() { 
		
		aym_lis_ema = $('#lis_ema');
		aym_lis_nam = $('#lis_nam');
		aym_action = $('#action');
		aym_lis_ema_error = 'Digite un E-mail valido.';
		
		if (!/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(aym_lis_ema.val())) {
			aym_lis_ema.addClass('aym_validate_list_mail');
			aym_lis_ema.val(aym_lis_ema_error);
		}
		
		if ($(':input').hasClass('aym_validate_list_mail')) {
			return false;
		} else {
			// Process form with AJAX
			$.ajax({
				url:'/send_mail',
				type: 'POST',
				data: {lis_ema:aym_lis_ema.val(), lis_nam:aym_lis_nam.val(), action:aym_action.val()},
				success: function(datos){
					datos = JSON.parse(datos);
					$('#aym_message').html(datos.Msg);
					$('#frm_list_mail').addClass('aym_hide_list_mail');
					$('#frm_list_mail input[type=text]').val('');
					$('#aym_wrap_message').addClass('aym_show_message');
					setTimeout(function () {$('#frm_list_mail').removeClass('aym_hide_list_mail'); $('#aym_wrap_message').removeClass('aym_show_message');}, 3000);
				}
			});
			return false;
		}

	});
	$(':input').focus(function(){
	   if ($(this).hasClass('aym_validate_list_mail') ) {
			$(this).val('');
			$(this).removeClass('aym_validate_list_mail');
	   }
	});

});
