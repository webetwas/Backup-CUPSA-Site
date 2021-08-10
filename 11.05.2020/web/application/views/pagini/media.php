<?php

// ini_set('xdebug.var_display_max_depth', -1);

// ini_set('xdebug.var_display_max_children', -1);

// ini_set('xdebug.var_display_max_data', -1);

// var_dump($media);

// die();

?>





<!-- Nav tabs -->

<!-- <ul class="nav nav-tabs" role="tablist">

	<?php foreach($media as $key_m => $m): ?>

	<li class="nav-item">

		<a class="nav-link <?=($key_m == 0 ? 'active' : '')?>" data-toggle="tab" href="#m-<?=$m->slug?>" role="tab" style="font-size:14px;"><?=$m->{'denumire_' .$site_lang}?></a>

	</li>

	<?php endforeach; ?>

</ul> -->



<!-- Tab panes -->

<div class="tab-content">
	<?php foreach($media as $key_m => $m): ?>

	<div class="tab-pane <?=($key_m == 0 ? 'active' : '')?> padding-30px" id="m-<?=$m->slug?>" role="tabpanel">

		<?php if(!empty($m->iteme)): ?>

			<?php foreach($m->iteme as $item): ?>

				<hr>

				<a target="blank" class="d-block text-up-small text-dark font-weight-400 margin-bottom-8px" href="/media/p/<?=(!empty($item->atom_id) ? $item->atom_id : 'javascript:void(0);')?>">

					<i class="fa fa-angle-right" aria-hidden="true"></i> <?=$item->{'atom_name_' .$site_lang}?>

				</a>

				





				<div class="d-block text-up-small text-grey-2 margin-bottom-10px"><?=$item->{'i_content_'.$site_lang}?></div>

				<div class="meta">

					<?php if(!empty($item->item_date)): ?>

					<span class="margin-right-20px text-extra-small">Data :  <a href="#" class="text-main-color"><?=date_format(date_create(

					$item->item_date), 'd-n-Y')?></a></span>

					<?php endif; ?>

					

					<?php if(!empty($item->pdf_file)): ?>

					<span class="margin-right-20px text-extra-small">Document :  <a target="_blank" href="<?=SITE_URL.'public/upload/documents/media/'.$item->pdf_file;?>" class="text-main-color"><?=$item->pdf_name?></a></span>

					<?php endif; ?>

				</div>			

			<?php endforeach; ?>

		<?php endif; ?>

	</div>

	<?php endforeach; ?>

</div>

<!-- // Nav tabs -->