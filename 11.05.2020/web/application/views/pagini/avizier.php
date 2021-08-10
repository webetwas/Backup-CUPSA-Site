<?php
// var_dump($articole);
// die();
?>

<?php foreach($articole as $key_articol => $articol): ?>
	<hr>
	<a target="blank" class="d-block  text-capitalize text-up-small text-dark font-weight-700 margin-bottom-8px" data-toggle="collapse" href="#art-<?=$key_articol?>" role="button" aria-expanded="false" aria-controls="art-<?=$key_articol?>"><?=$articol->{'atom_name_' .$site_lang}?></a>	
	<!-- <div class="meta"> -->
		<?php if(!empty($articol->item_date)): ?>
		<span class="margin-right-20px text-extra-small ">Data :  <a href="#" class="text-main-color"><?=date_format(date_create(
		$articol->item_date), 'd/n Y')?></a></span>
		<?php endif; ?>
	<!-- </div> -->
	
	<div class="collapse" id="art-<?=$key_articol?>">
		<div class="d-block text-up-small text-grey-2 margin-bottom-10px"><?=$articol->{'i_content_'.$site_lang}?></div>
	</div>
<?php endforeach; ?>