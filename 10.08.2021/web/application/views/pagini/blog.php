<?php
// print_r($stiri_articole); die;
if(!empty($stiri_articole))
{
?>

<div id="mySidenav" class="sidenav">
	<a href="<?= base_url() ?>mobilpay/index.php" class="online">
		<i class="fa fa-credit-card padding-icon fa-2x pull-left" aria-hidden="true"></i>
		Plateste online
	</a>

	<a href="<?= base_url() ?>intrebari_frecvente" class="info">
		<i class="fa fa-info-circle padding-icon fa-2x pull-left" aria-hidden="true"></i>
		Informatii utile
	</a>

	<a href="<?= base_url() ?>p/factura-in-format-electronic" class="factura">
		<i class="fa fa-file-pdf-o padding-icon fa-2x pull-left" aria-hidden="true"></i>
		Factura electronica
	</a>

	<a href="<?= base_url() ?>contact" class="dispecerat">
		<i class="fa fa-phone-square padding-icon fa-2x pull-left" aria-hidden="true"></i>
		Dispecerat
	</a>

</div>


<section class="padding-tb-100px">

<div class="container">
	<div class="text-center margin-bottom-35px fadeInUp">
		<h1 class="font-weight-300 text-title-large font-3">Stiri / Articole</h1>
	</div>

	<div class="row">
	<?php foreach($stiri_articole as $sta): ?>
					<?php $sta_image_banner = null; ?>
					<?php if(!is_null($sta->images)): ?>
					<?php $sta_image_banner = explode(',', $sta->images)[0];?>
					<?php else: $sta_image_banner = null; endif;

					$description = $sta->{'i_content_' . $site_lang};
					$the_title = $sta->{'i_titlu_' . $site_lang};

					?>
		<div class="col-lg-4 col-md-6 sm-mb-30px wow fadeInUp mb-4">
			<div class="blog-item thum-hover background-white hvr-float hvr-sh2">
				<div class="position-relative">
					<!-- <div class="date z-index-10 width-50px padding-10px background-main-color text-white text-center position-absolute top-20px left-20px">
						<?=date_format(date_create($sta->insert_date) ,"d/m Y");?>
					</div> -->
					<a href="<?=base_url()?>blog/articol/<?=$sta->airdrop_id;?>">
						<div class="item-thumbnail background-dark"><img src=" <?=(!is_null($sta_image_banner) ? '/public/upload/img/stiri/l/' . $sta_image_banner : '')?>" alt=""></div>
					</a>
				</div>
				<a href="<?=base_url()?>blog/articol/<?=$sta->airdrop_id;?>" class="text-extra-large margin-tb-20px d-block padding-lr-30px js-equal">
					<?=trimmer($the_title, 5); ?>
				</a>
				<span class=" d-block padding-lr-30px">
					<hr>
				</span>
				<span class="jslimiter margin-tb-20px d-block padding-lr-30px js-equal-2">
					<a href="<?=base_url()?>blog/articol/<?=$sta->airdrop_id;?>"><?=trimmer($description); ?></a></span>
					<!-- <hr> -->
				</span>


				<div class="padding-lr-30px">
				<?php if(!empty($sta->sursa_scris_de)) {?>
					<span class="margin-right-30px">Diriginte Santier : <a href="#">Ing. <?=$sta->sursa_scris_de?></a></span>
				<?php } ?>
				</div>
				<!-- <hr class="margin-bottom-0px border-white"> -->
			</div>
		</div>
			<?php endforeach; ?>
	</div>
</div>

<!-- //container -->
</section>
<?php
}
?>


