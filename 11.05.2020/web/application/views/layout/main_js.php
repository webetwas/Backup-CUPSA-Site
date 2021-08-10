<script type="text/javascript">

$(document).ready(function() {
	$("button#register_newsletter").on('click', function() {
		// $("p#captcha-error-newsletter").empty();
		let data = {
			email : $("input#register_newsletter_data").val()
			// captcha : $('input[name="newsletter-captcha"]').val(),
			// captchaHash: $('#newsletter-captcha').realperson('getHash')
		};
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(data.email))
		{
		
		} else {
			alert("Te rugam sa introduci adresa de E-mail pentru inscriere..");
			return false;
		}
		
		if($('input[name="tsc-newsletter"]').prop('checked') == false) {
			alert("Te rugam sa bifezi ca ai citit si esti de acord cu Termeni si conditii");
			return false;
		}
		
		// if($(data.captcha).val() == "")
		// {
			// alert("Completeaza cod captcha");
			// return false;
		// }
		
		  $.ajax({
			url: "<?=base_url()?>contact/register_newletter",
			dataType: "JSON",
			data: { data : data },
			type: 'POST',
			success: function( data ) {
			  if(data.status == 1) {
				alert(data.success);
			  } else if(data.status == 0) {
				$("p#captcha-error-newsletter").text(data.error);
				alert(data.error);
			  }
			}
		  });
	});
});
</script>