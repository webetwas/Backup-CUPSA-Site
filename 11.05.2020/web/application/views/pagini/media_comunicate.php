<div>
	<?php foreach($media as $key_m => $m): ?>
		<?php
		if($m->slug=="comunicate-de-presa"){
		?>
			<div class="tab-pane <?=($key_m == 0 ? 'active' : '')?> padding-30px" id="m-<?=$m->slug?>" role="tabpanel">
				<?php if(!empty($m->iteme)): ?>
					<?php foreach($m->iteme as $item): ?>
					<?php if(!empty($item->pdf_file)):
								$downloat_document = SITE_URL . 'public/upload/documents/media/' . $item->pdf_file ;
							 endif; ?>
							<hr>
							<i class="fa fa-angle-right" aria-hidden="true"></i>
							<?php if(!empty($item->item_date)): ?>
								<span class=""><a href="#" class="text-main-color"><?=date_format(date_create(
								$item->item_date), 'd-n-Y')?></a></span> /
								<?php endif; ?>
							<a target="_blank" class="d-inline text-up-small font-weight-400 margin-bottom-8px" href="<? echo $downloat_document; ?>">
								<?=$item->{'atom_name_' .$site_lang}?>
							</a>
							<div class="d-block text-up-small text-grey-2 margin-bottom-10px"><?=$item->{'i_content_'.$site_lang}?></div>
							<div class="meta">

							</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<?php
			}
		?>
	<?php endforeach; ?>
</div>