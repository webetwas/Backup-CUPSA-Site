
<!-- Chosen -->
<script src="<?=base_url()?>public/assets/js/plugins/chosen/chosen.jquery.js"></script>

<script type="text/javascript">

$(document).ready(function() {
	$('.choose_breadcrumbs').chosen({width: "100%"});
	$('.choose_breadcrumbs').on('change', function(evt, params) {		
		insert_breadcrumbs_assoc(params);
	});		  

});

<?php if(!is_null($item)): ?>
function insert_breadcrumbs_assoc(params) {
	$.ajax({
	url: '<?=base_url()?>servicii/insert_breadcrumbs_assoc/',
	dataType: "JSON",
	type: 'POST',
	data: { id_page : <?=$item->atom_id?>, params : params },
	beforeSend: function() {
		showloader();
	},
	success: function( data ) {
		
	  if(data.status == 1) {
		hideloader();
	  } else if(data.status == 0) {
		// do something
		
	  }

	}
	});	
}
<?php endif; ?>


</script>