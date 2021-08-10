<?php
// var_dump($proiect);
$proiect_image = '';
if(!is_null($proiect->images))
{
	$proiect_images = explode(',', $proiect->images);
	$proiect_image = SITE_URL . 'public/upload/img/proiecte/m/' . $proiect_images[0];
	unset($proiect_images[0]);
}
?>


 <div id="mySidenav" class="sidenav">
  <a href="<?=base_url()?>/mobilpay/index.php" class="online">
  	<i class="fa fa-credit-card padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Plateste online
  </a>

  <a href="#" class="info">
  	<i class="fa fa-info-circle padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Informatii utile
  </a>

  <a href="#" class="factura">
  	<i class="fa fa-file-pdf-o padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Factura electronica
  </a>

  <a href="#" class="dispecerat">
  	<i class="fa fa-phone-square padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Dispecerat
  </a>

</div>

<!--  content -->
<div class="col-lg-<?=($page->s->left_sidebar ? '8' : '12')?> col-md-<?=($page->s->left_sidebar ? '8' : '12')?> sticky-content">
	<!-- post -->
	<div class="blog-entry background-white border-1 border-grey-1 margin-bottom-35px">
		<?php if(!empty($proiect_image)): ?>
		<div class="img-in"><img src="<?=$proiect_image?>" alt=""></div>
		<?php endif; ?>
		<div class="padding-30px">
			<div class="meta">
				<?php if(!empty($proiect->diriginte_santier)): ?>
				<span class="margin-right-20px text-extra-small">Diriginte santier : <a href="#" class="text-main-color"><?=$proiect->diriginte_santier?></a></span>
				<?php endif; ?>
				<?php if(!empty($proiect->data_proiect)): ?>
				<span class="margin-right-20px text-extra-small">Data :  <a href="#" class="text-main-color"><?=date_format(date_create($proiect->data_proiect), 'd/n Y')?></a></span>
				<?php endif; ?>
				<span class="text-extra-small">Status proiect :  <a href="#" class="text-main-color"><?=($proiect->status_proiect == "0" ? 'In derulare' : 'Finalizat')?></a></span>
			</div>
			<h1 class="d-block  text-capitalize text-large text-dark font-weight-700 margin-bottom-10px" href="javascript:void(0);">
			<?=$proiect->{'atom_name_' . $site_lang}?>
			</h1>
			<div class="post-entry">
				<div class="d-block text-up-small text-grey-4 margin-bottom-15px">
					<?=$proiect->{'i_content_' . $site_lang}?>
				</div>
			</div>
		</div>

		<?php if(isset($proiect_images) && !empty($proiect_images)): ?>
			<div class="row">
				<?php foreach($proiect_images as $pi): ?>
				<div class="col-lg-6">
					<div class="background-white">
						<div class="post-img">
							<a href="javascript:void(0);"><img src="<?=SITE_URL . 'public/upload/img/proiecte/m/' . $pi;?>" alt=""></a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<!-- // row -->
		<?php endif; ?>
	</div>
	<!-- // post -->

<!-- Related Posts -->
<!-- 	<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px">
	<h4 class="table-title margin-bottom-30px"><span>Promovarea proiectului</span></h4>-->
		<?php if(!is_null($proiect->promo_images)) {
			$proiect_promo_images = explode(',', $proiect->promo_images);
		}
		?>
		<?php if(isset($proiect_promo_images) && !empty($proiect_promo_images)): ?>
			<div class="row">
				<?php foreach($proiect_promo_images as $ppi): ?>
				<div class="col-lg-6">
					<div class="background-white">
						<div class="post-img">
							<a href="javascript:void(0);"><img src="<?=SITE_URL . 'public/upload/img/proiecte/m/' . $ppi;?>" alt=""></a>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
			<!-- // row -->
		<?php endif; ?>
			<h1 class="d-block  text-capitalize text-large text-dark font-weight-700 margin-bottom-10px" href="javascript:void(0);">
			<?=$proiect->{'promovare_titlu_' . $site_lang}?>
			</h1>
			<div class="post-entry">
				<div class="d-block text-up-small text-grey-4 margin-bottom-15px">
					<?=$proiect->{'promovare_content_' . $site_lang}?>
				</div>
			</div>
	</div>
	<!-- // row -->
</div>