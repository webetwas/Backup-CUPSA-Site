<?php
    // echo 'x';
    //print_r($sucursale); die;
$key_sucursala = 1;
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




<div class="col-md-4 sticky-sidebar">
	<div class="widget widget_categories">
		<h4 class="widget-title clearfix"><span>Sucursale</span></h4>
		<ul id="">
			<?php foreach($toate_sucursalele as $key_sucursala => $sucursala): ?>
			<li><i class="fa fa-angle-right" aria-hidden="true"></i> <a href="<?=SITE_URL . 'sucursale/p/' . $sucursala->atom_id;?>" class="text-grey-4"><?=$sucursala->{'atom_name_' . $site_lang}?></a></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<div class="col-md-8">
	<h3 class="text-large text-center d-block margin-top-10px">
		<a href="javascript:void(0);" class="text-grey-4"><?=$sucursale[0]->atom_name_ro;?></a>
	</h3>
	<?php if(!empty($sucursale[0]->harta_suc)): ?>
		<div class="margin-tb-20px">
			<iframe src="<?=$sucursale[0]->harta_suc?>" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	<?php endif; ?>

	<?php if(!empty($sucursale[0]->pdf_file)): ?>
		<div class="text-grey-2">Document: <a target="_blank"href="<?=SITE_URL.'public/upload/documents/sucursale/'.$sucursale[0]->pdf_file?>"><?=$sucursale[0]->pdf_name?></a></div>
	<?php endif; ?>
	<span class="d-block padding-tb-8px"><?=$sucursale[0]->{'i_content_' . $site_lang}?></span>

	<div class="panel-group" id="accordion">
		<?php if(!empty($sucursale[0]->pers_contact_suc)): ?>
			<a class="btn btn-light btn-sm m-t-20" data-parent="#accordion" data-toggle="collapse" href="#sc-c-contact-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-contact-<?=$key_sucursala?>">Contact</a>
		<?php endif; ?>
		<?php if(!empty(strip_tags($sucursale[0]->program_caserie))): ?>
			<a class="btn btn-light btn-sm m-t-20" data-parent="#accordion" data-toggle="collapse" href="#sc-c-program-caserie-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-program-caserie-<?=$key_sucursala?>">Program casierie</a>
		<?php endif; ?>
		<?php if(!empty(strip_tags($sucursale[0]->anunturi))): ?>
			<a class="btn btn-light btn-sm m-t-20" data-toggle="collapse" data-parent="#accordion" href="#sc-c-anunturi-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-anunturi-<?=$key_sucursala?>">Anunturi</a>
		<?php endif; ?>
		<?php if(!empty(strip_tags($sucursale[0]->lucrari_programate))): ?>
		<a class="btn btn-light btn-sm m-t-20" data-parent="#accordion" data-toggle="collapse" href="#sc-c-lucrari-programate-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-lucrari-programate-<?=$key_sucursala?>">Lucrari programate</a>
		<?php endif; ?>
		<?php if(!empty(strip_tags($sucursale[0]->localitati_deservite))): ?>
		<a class="btn btn-light btn-sm m-t-20" data-parent="#accordion" data-toggle="collapse" href="#sc-c-localitati-deservite-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-localitati-deservite-<?=$key_sucursala?>">Localitati Deservite</a>
		<?php endif; ?>
		<?php if(!empty($sucursale[0]->investitii)): ?>
		<a class="btn btn-warning btn-sm m-t-20" data-parent="#accordion" data-toggle="collapse" href="#sc-c-investitii-<?=$key_sucursala?>" role="button" aria-expanded="false" aria-controls="sc-c-investitii-<?=$key_sucursala?>">Investitii</a>
		<?php endif; ?>
		<div class="panel panel-default">
			<?php if(!empty($sucursale[0]->pers_contact_suc)): ?>
				<div class="panel-collapse collapse" id="sc-c-contact-<?=$key_sucursala?>">
					<div class="card card-body">
						<ul>
							<li>
								<i class="fa fa-user text-main-color margin-right-10px" aria-hidden="true"></i>
								<a href="javascript:void(0)"><?=$sucursale[0]->pers_contact_suc?></a>
							</li>
							<li>
								<i class="fa fa-map text-main-color margin-right-10px" aria-hidden="true"></i>
								<a href="javascript:void(0)"><?=$sucursale[0]->adresa_suc?></a>
							</li>
							<li>
								<i class="fa fa-envelope-open text-main-color margin-right-10px" aria-hidden="true"></i>
								<a href="mailto:<?=$sucursale[0]->email_suc?>?subject=Email CUP Focsani:"><?=$sucursale[0]->email_suc?></a>
							</li>
							<li>
								<?php if(!empty($sucursale[0]->tel_fix_suc)): ?>
									<a href="tel:<?=$sucursale[0]->tel_fix_suc?>">
										<i class="fa fa-phone text-main-color margin-right-10px" aria-hidden="true"></i>
										<span><?=$sucursale[0]->tel_fix_suc?></span>
									</a>
								<?php endif; ?>
							</li>
						</ul>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="panel panel-default">
			<?php if(!empty($sucursale[0]->anunturi) && isset($sucursale[0]->anunturi)): ?>
			<div class="collapse" id="sc-c-anunturi-<?=$key_sucursala?>">
			  <div class="card card-body">
				<?=$sucursale[0]->anunturi?>
			  </div>
			</div>
			<?php endif; ?>
		</div>
		<div class="panel panel-default">
			<?php if(!empty($sucursale[0]->localitati_deservite) && isset($sucursale[0]->localitati_deservite)): ?>
			<div class="collapse" id="sc-c-localitati-deservite-<?=$key_sucursala?>">
			  <div class="card card-body">
				<?=$sucursale[0]->localitati_deservite?>
			  </div>
			</div>
			<?php endif; ?>
		</div>
		<div class="panel panel-default">
			<div class="collapse" id="sc-c-lucrari-programate-<?=$key_sucursala?>">
			  <div class="card card-body">
				<?=$sucursale[0]->lucrari_programate?>
			  </div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="collapse" id="sc-c-program-caserie-<?=$key_sucursala?>">
			  <div class="card card-body">
				<?=$sucursale[0]->program_caserie?>
			  </div>
			</div>
		</div>
		<div class="panel panel-default">
			<?php if(!empty($sucursale[0]->investitii)): ?>
			<div class="collapse" id="sc-c-investitii-<?=$key_sucursala?>">
			  <div class="card card-body">
				<?php if(!empty($sucursale[0]->investitii)): ?>

					<ul class="list-style-2 padding-0px">
						<?php foreach($sucursale[0]->investitii as $si): ?>
						<li><a href="<?=SITE_URL.'investitii/proiect/'.$si->slug?>"><?=$si->{'atom_name_' . $site_lang}?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			  </div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

