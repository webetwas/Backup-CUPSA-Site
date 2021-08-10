<?php
    // print_r($stiri_articole); die;
?>

<style>
	.col-section{
		/*border: solid 1px #fefefe;*/
		text-align: center;

	}

	.col-section:hover{
		-moz-box-shadow: 0px 4px 32px #4c7ca1;
		-webkit-box-shadow: 0px 4px 32px #4c7ca1;
		box-shadow: 0px 4px 32px #4c7ca1;
		border-radius: 10px;
	}



</style>

<?php if(!is_null($stiri_articole)): ?>
<section>
	<div class="">
		<div class="margin-bottom-40px font-weight-300 text-center">
			<h1 class="font-weight-300 text-title-large font-3"><?=$stiri_articole[0]->{'node_titlu_' . $site_lang}?></h1>
			<p><?=$stiri_articole[0]->{'node_subtitlu_' . $site_lang}?></p>
		</div>

		<div class="owl-carousel main-one">
			<?php foreach($stiri_articole as $key=>$sta): ?>
					<?php if($key==3) break;?>
					<?php $sta_image_banner = null; ?>
					<?php if(!is_null($sta->images)): ?>
					<?php $sta_image_banner = explode(',', $sta->images)[0];?>
					<?php else: $sta_image_banner = null; endif;?>
			<div class="one-slide" <?=(!is_null($sta_image_banner) ? 'style="background-image:url(\'' .base_url(). 'public/upload/img/stiri/l/' . $sta_image_banner . '\')"' : '')?>>
				<div class="row">
					<div class="col-sm-3">
						<div class="blog-item thum-hover border-radius-15 hidden background-white hvr-float hvr-sh2">
							<div class="position-relative">
								<!-- <div class="date z-index-10 border-radius-15 width-50px padding-10px background-main-color text-white text-center position-absolute top-20px left-20px">
									<?//date_format(date_create($sta->insert_date) ,"d/m Y");?>
								</div> -->
								<!-- <a href="#">
									<div class="item-thumbnail background-dark"><img src="assets/img/pamblica/news-1.jpg" alt=""></div>
								</a> -->
							</div>
						</div>
					</div>
					<div class="col-lg-6"></div>
				</div>
				<div class="slider-content ">
							<a href="<?=base_url()?>blog/articol/<?=$sta->airdrop_id;?>" class="text-extra-large text-center text-whitemargin-tb-20px d-block padding-lr-30px"><?=$sta->{'i_titlu_' . $site_lang}?></a>
							<!-- <div style="text-align:center;">Data: <?=date_format(date_create($sta->insert_date) ,"d/m Y");?></div> -->
							<!-- <hr> -->
							<!-- <p class="padding-lr-30px opacity-6"><? //trimmer($sta->{'i_content_' . $site_lang}, 40);?></p> -->
							<!-- <hr> -->
							<!-- <div class="padding-lr-30px">
							<?php if(!empty($sta->sursa_scris_de)): ?>
								<span class="margin-right-30px"><?=($site_lang == "en" ? 'Wrote by: ': 'De: ')?> <a href="javascript:void(0);"><?=$sta->sursa_scris_de?></a></span>
								<?php endif; ?>
								<?php if(!empty($sta->sursa_in)): ?>
								<span class="margin-right-30px"><?=($site_lang == "en" ? 'Article source: ': 'In : ')?>  <a href="javascript:void(0);"><?=$sta->sursa_in?></a></span>
								<?php endif; ?>
							</div> -->
							<!-- <p class="padding-lr-30px opacity-6 pull-right"> -->
								<!-- <a href="<? //base_url()?>blog/articol/<?//$sta->airdrop_id;?>"></a> -->
							<!-- </p> -->
							<!-- <hr class="margin-bottom-0px border-white"> -->
						</div>
			</div>
			<?php endforeach; ?>

		</div>
	</div>
</section>
<?php endif; ?>


<section class="info-boxes-section padding-tb-50px">
	<div class="container">
		<div class="row">
			<div class="col-6 col-lg ">
				<div class="info-box p-2 shortcut col-section">
					<h3 class="js-equal-5">Apa Media</h3>
					<p>
						<a href="https://www.facebook.com/cupfocsani.ro/" target="_blank"><img src="<?=base_url()?>web/public/upload/img/apa-media.jpg" alt=""></a>
					</p>
					<p>
						<a href="https://www.facebook.com/cupfocsani.ro/" target="_blank" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9">Fii sociabil</a>
					</p>
				</div>
			</div>
			<div class="col-6 col-lg ">
				<div class="info-box p-2 shortcut col-section">
					<h3 class="js-equal-5">Intelege Facturarea</h3>
					<p>
						<a href="<?=base_url()?>intrebari_frecvente"><img src="<?=base_url()?>web/public/upload/img/contor-apa.jpg" alt=""></a>
					</p>
					<p>
						<a href="<?=base_url()?>intrebari_frecvente" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9">Informatii</a>
					</p>
				</div>

			</div>
			<div class="col-6 col-lg ">
				<div class="info-box p-2 shortcut col-section">
					<h3 class="js-equal-5">Calitatea Apei</h3>
					<p>
						<a href="<?=base_url()?>p/calitatea-apei"><img src="<?=base_url()?>web/public/upload/img/laborator-apa.jpg" alt=""></a>
					</p>
					<p>
						<a href="<?=base_url()?>p/factura-in-format-electronic" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9">Laborator</a>
					</p>
				</div>

			</div>
			<div class="col-6 col-lg ">
				<div class="info-box p-2 shortcut col-section">
					<h3 class="js-equal-5">Apă meteorică</h3>
					<p>
						<a href="<?=base_url()?>p/apa-meteorica"><img src="<?=base_url()?>web/public/upload/img/apa-meteorica.jpg" alt=""></a>
					</p>
					<p>
						<a href="<?=base_url()?>p/apa-meteorica" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9" class="btn btn-md border-2 border-radius-0  text-dark width-120px opacity-9">Detalii</a>
					</p>
				</div>

			</div>
		</div>
	</div>
</section>
