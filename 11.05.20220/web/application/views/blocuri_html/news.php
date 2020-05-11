<?php

// var_dump($stiri_articole);

?>

<?php if(!is_null($stiri_articole)): ?>

<section class="padding-tb-100px">

		<div class="container">

		<div class="margin-bottom-40px font-weight-300 text-center">

			<h1 class="font-weight-300 text-title-large font-3"><?=$stiri_articole[0]->{'node_titlu_' . $site_lang}?></h1>

			<p><?=$stiri_articole[0]->{'node_subtitlu_' . $site_lang}?></h1></p>

		</div>

		<div class="owl-carousel-1">

			<?php foreach($stiri_articole as $sta): ?>

			<div class="one-slider row">

				<div class="col-lg-4">

					<div class="blog-item thum-hover border-radius-15 hidden background-white hvr-float hvr-sh2">

						<div class="position-relative">

							<div class="date z-index-10 border-radius-15 width-50px padding-10px background-main-color text-white text-center position-absolute top-20px left-20px">

								<?=date_format(date_create($sta->insert_date) ,"d/m Y");?>

							</div>

							<a href="javascript:void(0);">

								<?php if(!is_null($sta->images)): ?>

								<?php $sta_image = explode(',', $sta->images)[0];?>

								<div class="item-thumbnail background-dark"><img src="<?=base_url()?>public/upload/img/stiri/m/<?=$sta_image?>" alt=""></div>

								<?php else: ?>

								<div class="item-thumbnail background-dark"><img src="<?=base_url()?>public/assets/img/default-no-image.jpg" alt=""></div>

								<?php endif; ?>

							</a>

						</div>

					</div>

				</div>

				<div class="col-lg-8">

					<a href="javascript:void(0);" class="text-extra-large margin-tb-20px d-block padding-lr-30px"><?=$sta->{'i_titlu_' . $site_lang}?></a>

					<hr>

					<p class="padding-lr-30px opacity-6"><?=$sta->{'i_content_' . $site_lang}?></p>

					<hr>

					<div class="padding-lr-30px">

						<?php if(!empty($sta->sursa_scris_de)): ?>

						<span class="margin-right-30px"><?=($site_lang == "en" ? 'Wrote by: ': 'De: ')?> <a href="javascript:void(0);"><?=$sta->sursa_scris_de?></a></span>

						<?php endif; ?>

						<?php if(!empty($sta->sursa_in)): ?>

						<span class="margin-right-30px"><?=($site_lang == "en" ? 'Article source: ': 'In : ')?>  <a href="javascript:void(0);"><?=$sta->sursa_in?></a></span>

						<?php endif; ?>

					</div>

					<hr class="margin-bottom-0px border-white">

				</div>

			</div>

			<?php endforeach; ?>

		</div>



	</div>

</section>

<?php endif; ?>




