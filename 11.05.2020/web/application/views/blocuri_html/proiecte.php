<?php if(!is_null($proiecte)): ?>
	<section class="padding-tb-20px background-white">

		<div class="container">
			<?php foreach($proiecte as $proiect_node): ?>
				<div class="text-center margin-bottom-35px fadeInUp">
					<h1 class="font-weight-300 text-title-large font-3"><?=$proiect_node->{'denumire_' . $site_lang}?></h1>
					<span class="opacity-7"><?=$proiect_node->{'i_subtitlu_' . $site_lang}?></span>
				</div>

				<div class="row">
					<?php foreach($proiect_node->proiecte as $proiect): ?>
						<?php
						$proiect_image = base_url() . 'public/assets/img/850x600-no-image.png';
						if(!is_null($proiect->images))
						{
							$proiect_image = base_url() . 'public/upload/img/proiecte/m/' . explode(',', $proiect->images)[0];
						}
						?>
					<div class="col-md-4 sm-mb-30px wow fadeInUp margin-bottom-10px">
						<div class="blog-item thum-hover background-white hvr-float hvr-sh2">
							<div class="position-relative">

								<div class="date z-index-10 width-50px padding-10px background-main-color text-white text-center position-absolute top-20px left-20px">
									<?=date_format(date_create($proiect->data_proiect), 'd/n Y')?>
								</div>

								<a href="<?=base_url()?>investitii/proiect/<?=$proiect->slug?>">
									<div class="item-thumbnail background-dark"><img src="<?=$proiect_image?>" alt=""></div>
								</a>
							</div>
							<a href="<?=base_url()?>investitii/proiect/<?=$proiect->slug?>" class="text-extra-large margin-tb-20px d-block padding-lr-30px"><?=$proiect->{'atom_name_' .$site_lang}?></a>
							<hr>
							<?php if(!empty($proiect->diriginte_santier)): ?>
							<div class="padding-lr-30px">
								<span class="margin-right-30px">Diriginte Santier : <a href="javascript:void(0);"><?=$proiect->diriginte_santier?>	</a></span>
							</div>
							<hr>
							<?php endif; ?>

							<hr class="margin-bottom-0px border-white">

							<div class="padding-lr-30px">
								<span class="margin-right-30px">Status Proiect: <strong><?=($proiect->status_proiect == "0" ? 'In derulare' : 'Finalizat')?></strong></span>
							</div>

						</div>
					</div>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- //container -->
	</section>
<?php endif; ?>