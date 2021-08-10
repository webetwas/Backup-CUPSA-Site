<?php
    // echo 'x';
    // print_r($sucursale); die;
//$key_media = 1;
//var_dump($toate_elementele_media);die();
?>
<div class="col-md-8">
	<h3 class="text-large text-center d-block margin-top-10px">
		<a href="javascript:void(0);" class="text-grey-4"><?=$media_item[0]->{'atom_name_' .$site_lang}?></a>
	</h3>
	<?php if(!empty($media_item[0]->item_date)): ?>
	<span class="margin-right-20px text-extra-small">Data :  <a href="#" class="text-main-color"><?=date_format(date_create(
	$media_item[0]->item_date), 'd-n-Y')?></a></span>
	<?php endif; ?>	
	<?php if(!empty($media_item[0]->pdf_file)): ?>
	<span class="margin-right-20px text-extra-small">Document :  <a target="_blank" href="<?=SITE_URL.'public/upload/documents/media/'.$media_item[0]->pdf_file;?>" class="text-main-color"><?=$media_item[0]->pdf_name?></a></span>
	<?php endif; ?>
	<div class="d-block text-up-small text-grey-2 margin-bottom-10px"><?=$media_item[0]->{'i_content_'.$site_lang}?></div>
</div>

