<?php
// var_dump($sucursale);
// die();
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




<div class="col-lg-4 col-md-4 sticky-sidebar">
	<div class="widget widget_categories">
		<h4 class="widget-title clearfix"><span>Sucursale</span></h4>
		<ul id="">
			<?php foreach($sucursale as $key_sucursala => $sucursala): ?>
			<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?=SITE_URL . 'sucursale/p/' . $sucursala->atom_id;?>" class="text-grey-4"><?=$sucursala->{'atom_name_' . $site_lang}?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="row">

	<?php foreach($sucursale as $key_sucursala => $sucursala): ?>
	<!--
	<div class="col-md-8">
		<h3 class="text-large d-block margin-top-10px">
			<a href="javascript:void(0);" class="text-grey-4"><?=$sucursala->{'atom_name_' . $site_lang}?></a>
		</h3>
		<div class="margin-tb-20px">
			<?php if(!empty($sucursala->harta_suc)): ?>
			<iframe src="<?=$sucursala->harta_suc?>" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		<?php endif; ?>

		</div>
		<?php if(!empty($sucursala->pdf_file)): ?>
			<div class="text-grey-2">Document: <a target="_blank"href="<?=SITE_URL.'public/upload/documents/sucursale/'.$sucursala->pdf_file?>"><?=$sucursala->pdf_name?></a></div>
		<?php endif; ?>




		<div class="margin-tb-20px">
			<a class="btn btn-light btn-sm m-t-20" data-toggle="collapse" href="#sc-c-anunturi-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-anunturi-<?=$key_sucursala?>">Anunturi</a>
			<a class="btn btn-light btn-sm m-t-20" data-toggle="collapse" href="#sc-c-lucrari-programate-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-lucrari-programate-<?=$key_sucursala?>">Lucrari programate</a>
			<a class="btn btn-light btn-sm m-t-20" data-toggle="collapse" href="#sc-c-program-caserie-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-program-caserie-<?=$key_sucursala?>">Program casierie</a>
			<?php if(!empty($sucursala->investitii)): ?>
			<a class="btn btn-warning btn-sm m-t-20" data-toggle="collapse" href="#sc-c-investitii-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-investitii-<?=$key_sucursala?>">Investitii</a>
			<?php endif; ?>
		</div>
		<i class="d-block padding-tb-8px text-grey-2 "><?=$sucursala->{'i_content_' . $site_lang}?></i>

		<div class="collapse" id="sc-c-anunturi-<?=$key_sucursala?>">
		  <div class="card card-body">
			<?=$sucursala->anunturi?>
		  </div>
		</div>

		<div class="collapse" id="sc-c-lucrari-programate-<?=$key_sucursala?>">
		  <div class="card card-body">
			<?=$sucursala->lucrari_programate?>
		  </div>
		</div>

		<div class="collapse" id="sc-c-program-caserie-<?=$key_sucursala?>">
		  <div class="card card-body">
			<?=$sucursala->program_caserie?>
		  </div>
		</div>
		<?php if(!empty($sucursala->investitii)): ?>
		<div class="collapse" id="sc-c-investitii-<?=$key_sucursala?>">
		  <div class="card card-body">
			<?php if(!empty($sucursala->investitii)): ?>

				<ul class="list-style-2 padding-0px">
					<?php foreach($sucursala->investitii as $si): ?>
					<li><a href="<?=SITE_URL.'investitii/proiect/'.$si->slug?>"><?=$si->{'atom_name_' . $site_lang}?></a></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		  </div>
		</div>
		<?php endif; ?>
	</div>
	-->
	<?php endforeach; ?>
</div>
