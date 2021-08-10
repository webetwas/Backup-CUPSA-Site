<script src="<?=base_url();?>public/scripts/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=base_url();?>public/scripts/realperson/jquery.plugin.js" type="text/javascript"></script>
<script src="<?=base_url();?>public/scripts/realperson/jquery.realperson3.js" type="text/javascript"></script>
<script type="text/javascript">
$().ready(function() {
	$('#captcha').realperson({length: 4});
	
	$('form#<?=$form->item->id?>').submit(function(e){
		console.log("q");
		if($("input#gdpr-cons").prop('checked') == false) {
			e.preventDefault();
			alert("Te rugam sa accepti Regulamentul European Privind Datele cu Caracter Personal.");
			return;
		}
	});	
	
});
</script>