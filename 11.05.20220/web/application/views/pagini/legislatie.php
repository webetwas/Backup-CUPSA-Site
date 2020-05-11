<?php
// var_dump($articole);
// die();
?>

<?php foreach($articole as $articol): ?>
	<hr>
	<?php
	$pdf_href = 'javascript:void(0);';
	if(!empty($articol->pdf_file))
	{
		$pdf_target = '_blank';
		$pdf_href = SITE_URL.'public/upload/documents/legislatie/'.$articol->pdf_file;
	}
	
	?>
	<a <?=isset($pdf_target) ? 'target="_blank"' : ''?> class="d-block text-up-small text-dark font-weight-700 margin-bottom-8px" href="<?=$pdf_href?>"><?=$articol->{'atom_name_' .$site_lang}?></a>
	<div class="meta">
		<?php if(!empty($articol->pdf_file)): ?>
		<span class="margin-right-20px text-extra-small">Document :  <a target="_blank" href="<?=SITE_URL.'public/upload/documents/legislatie/'.$articol->pdf_file;?>" class="text-main-color"><?=$articol->pdf_name?></a></span>
		<?php endif; ?>
	</div>

<?php endforeach; ?>