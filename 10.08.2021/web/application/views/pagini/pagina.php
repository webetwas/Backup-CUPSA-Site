<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<?php
/*
echo "<pre>";
print_r($page->p); die;
echo "</pre>";
*/
// print_r($categorii_structura); die;
//var_dump($page);die();
$strip = str_replace(array("'", ","), '', $title_browser_ro);
$body_ar = explode(' ', $strip);
$words = array_slice($body_ar, 0, 3);
$down = implode('-', $words);
$body_class = strtolower($down);


?>



<style>
	.back-subtitle {
		padding: 5px;
		border-radius: 10px;
		line-height: 150%;
		text-align: justify;
		background-color: rgba(70, 113, 153, 0.1);
		background: rgba(70, 113, 153, 0.1);
		color: rgba(70, 113, 153, 0.1);
	}

	.ml-30{
		margin-left:30px;
	}
</style>

<!-- page output -->



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



	<!-- <div id="right-menu" class="text-right hidden-xs">
		<a href="<?= base_url() ?>/mobilpay/index.php"><i class="fa fa-credit-card padding-icon" aria-hidden="true"></i> Plateste factura online</a>
	</div>
			-->
	<!--  content -->
	<div class="col-lg-<?= ($page->s->left_sidebar ? '8' : '12') ?> col-md-<?= ($page->s->left_sidebar ? '8' : '12') ?> sticky-content2" style="padding-bottom: 20px;">

		<?php
		//if (!empty($page->p->{'title_content_' . $site_lang}) || !empty($page->p->{'content_' . $site_lang}) || $page->i) {
		?>
		<!-- post -->
		<div class="blog-entry background-white border-grey-1">
		<?php if ($page->i) : ?>
			<div class="img-in"><img src="<?= base_url() . 'public/upload/img/page/page/l/' . $page->i[0]->img ?>" alt=""></div>
		<?php endif; ?>
		<!-- <div class="padding-30px"> -->

		<h1 class="d-block  text-capitalize text-large text-dark font-weight-700 margin-bottom-10px" href="javascript:void(0);"><?= $page->p->{'title_content_' . $site_lang} ?></h1>
		<h3 class="d-block  text-capitalize text-large text-dark font-weight-400 margin-bottom-10px back-subtitle" href="javascript:void(0);"><?= $page->p->{'subtitle_content_' . $site_lang} ?></h3>
		<div class="post-entry">
			<div class="d-block text-up-small text-grey-4 margin-bottom-15px">
				<p>
					<?= $page->p->{'content_' . $site_lang} ?>
				</p>
			</div>
		</div>

		<!--buletine de verificare a apei-->

		<div class="col-lg-12">
			<?php
			if (($page->p->slug) == "calitatea-apei") { ?>
				<div id="buletin" style="position: relative;bottom: 100px;"></div>
				<form action="/p/calitatea-apei" class="filtreaza_buletine">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-6 float-left">
								<select class="form-control" style="max-width:300px;" name="s">
									<option value="">Alege sucursala</option>
									<?php foreach ($sucursale as $s) {
										$sucursala = intval($_GET['s']);
										$selected = "";
										if ($sucursala == ($s->atom_id)) {
											$selected = "selected";
										}
										?>
										<option value="<?= $s->atom_id ?>" <?php echo $selected ?>><?= $s->{'atom_name_' . $site_lang} ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3 float-left">
								<select class="form-control" name="an">
									<option value="">Alege an</option>
									<?php
									$current_year = date("Y");
									for ($i = ($current_year - 2); $i <= ($current_year); $i++) {
										$an = intval($_GET['an']);
										$selected = "";
										if ($an == $i) {
											$selected = "selected";
										}
										?>
										<option value="<?= $i ?>" <?php echo $selected ?>><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3 float-left">
								<select class="form-control" name="luna">
									<option value="">Alege luna</option>
									<?php for ($i = 1; $i <= 12; $i++) {
										$luna = intval($_GET['luna']);
										$selected = "";
										if ($luna == $i) {
											$selected = "selected";
										}
										?>
										<option value="<?= $i ?>" <?php echo $selected ?>><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-white btn-sm">Filtreaza </button>
							<a href="<?= base_url() ?>p/calitatea-apei?buletine=toate" class="btn btn-white btn-sm">Vezi toate buletinele</a>
						</div>
					</div>
				</form>

				<br>

				<?php if ($buletine) { ?>
					<table id="buletine-table" class="table">
						<thead>
							<tr>
								<th>Denumire buletin</th>
								<th>an</th>
								<th>luna</th>
								<th>PDF</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($buletine as $b) {?>
							<tr>

								<td><?= $b->{'atom_name_' . $site_lang} ?></td>

								<?php if (!(is_null($b->pdf_name))) { ?>
									<td><?= $b->an ?></td>
									<td><?= $b->luna ?></td>
									<td>
										<a href="/public/upload/documents/buletine_meteo/<?= $b->pdf_file ?>" target="_blank">
											<i class="fa fa-file-pdf-o"></i> <!--<?= $b->pdf_name ?><-->
										</a>
									</td>
								<?php } else {
									echo "<td>Nu exista</td>";
								} ?>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				<?php } else {
					echo "<div class='alert alert-danger text-center'>Nu exista rezultate</div>";
				} ?>

				<?php
			}
			?>
		</div>

		<!--buletine de verificare a apei-->

		<!--AFISARE PDF-->
			<div class="col-lg-12">
				<section class="padding-tb-10px">
					<div class="container">	
						<? if (!empty($page->p->pdf_file) && !is_null($page->p->pdf_file)) { ?>
							<div class="row text-center padding-tb-20px d-block text-capitalize text-large text-dark font-weight-400 margin-bottom-10px back-subtitle" style="padding-top: 10px">
								<div class="col-lg-12">
									<h5>
										<a href="/public/upload/documents/fe_pages_pdf/<?= $page->p->pdf_file ?>" target="_blank">
											<?php $pdf_name = str_replace('.pdf', '', $page->p->pdf_name);?>
											<i class="fa fa-file-pdf-o" style="margin: 0 10px 0 10px"></i><?= $pdf_name ?>
										</a>
									</h5>
								</div>
							</div>
						<? } ?>
					</div>
				</section>
			</div>	
		<!--AFISARE PDF-->


		<!--apa meteorica -->

		<div class="col-lg-12">
			<?php
			if (($page->p->slug) == "apa-meteorica") { ?>
				<div id="buletin" style="position: relative;bottom: 100px;"></div>
				<form action="/p/apa-meteorica" class="filtreaza_buletine">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-md-6 float-left">
								<select class="form-control" style="max-width:300px;" name="s">
									<option value="">Alege sucursala</option>
									<?php foreach ($sucursale as $s) {
										$sucursala = intval($_GET['s']);
										$selected = "";
										if ($sucursala == ($s->atom_id)) {
											$selected = "selected";
										}
										?>
										<?php if($s->atom_id ==35 || $s->atom_id ==36){ ?>
											<option value="<?= $s->atom_id ?>" <?php echo $selected ?>><?= $s->{'atom_name_' . $site_lang} ?></option>
										<?php } ?>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3 float-left">
								<select class="form-control" name="an">
									<option value="">Alege an</option>
									<?php
									$current_year = date("Y");
									for ($i = ($current_year - 1); $i <= ($current_year); $i++) {
										$an = intval($_GET['an']);
										$selected = "";
										if ($an == $i) {
											$selected = "selected";
										}
										?>
										<option value="<?= $i ?>" <?php echo $selected ?>><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3 float-left">
								<select class="form-control" name="luna">
									<option value="">Alege luna</option>
									<?php for ($i = 1; $i <= 12; $i++) {
										$luna = intval($_GET['luna']);
										$selected = "";
										if ($luna == $i) {
											$selected = "selected";
										}
										?>
										<option value="<?= $i ?>" <?php echo $selected ?>><?= $i ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-white btn-sm">Filtreaza </button>
							<a href="<?= base_url() ?>p/apa-meteorica?buletine=toate" class="btn btn-white btn-sm">Vezi toate buletinele</a>
						</div>
					</div>
				</form>

				<br>

				<?php if (isset($calitatea_apei_valori)){ ?>
					<table id="apa-meteorica-table" class="table">
						<thead>
							<tr>
								<th>Stația Meteorologică</th>
								<th>an</th>
								<th>luna</th>
								<th class="text-center">Cantitate (litri/mp)</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($calitatea_apei_valori as $b) {?>
							<tr>
								<td><?= $b->{'atom_name_' . $site_lang} ?></td>
								<td><?= $b->an ?></td>
								<td><?= $b->luna ?></td>
								<td class="text-center"><?= $b->valoare ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				<?php } else {
					echo "<div class='alert alert-danger text-center'>Nu exista rezultate</div>";
				} ?>

				<?php
			}
			?>
		</div>

		<!--apa meteorica-->


		<!-- // post -->
		<?php
		//}
		?>

		<!--texte diverse-->
			<?php if (!empty($texte_diverse)) : $td_items = count($texte_diverse); ?>
				<?php $ctr_td = 0;
				$ctr_item = 0;
				foreach ($texte_diverse as $td) : $ctr_td++;
					$ctr_item++; ?>

					<?php if ($ctr_td == 1) : ?>
						<div class="row padding-tb-50px">
					<?php endif; ?>
					<div class="col-lg-<?= ($td_items == $ctr_item && $ctr_td == 1 ? '12' : '6') ?> background-white">
						<h1 class="font-weight-300 text-title-large font-3"><?= $td->{'atom_name_' . $site_lang} ?></h1>
						<div class="opacity-7"><?= $td->{'i_content_' . $site_lang} ?></div>
					</div>
					<?php if ($ctr_td == 2) : $ctr_td = 0; ?>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			<?php endif; ?>
		<!--texte diverse-->


		<?php
		# - Afisare pdf-uri pagina
		if (!empty($page->pdf)) {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-12 mt-30 col-sm-12">
						<h3 style="font-family:Open Sans;"><?= $page->p->title_content_ro; ?> <i class="fa fa-file-pdf-o" aria-hidden="true"></i></h3>
						<hr>
						<ul class="utils-links">
							<?php
							foreach ($page->pdf as $item) {
								?>
								<li><i class="fa fa-file-pdf" aria-hidden="true"></i> <a href="<?= base_url() . PATH_PDF_PAGINI . $item->item_pdf; ?>" title="<?= $item->item_name; ?>"><?= $item->item_name; ?></a></li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		<?php
		}
		?>

		<?php
		if (!empty($lista_declaratii) && $this->uri->segment(2) == 'actionariat') {
			?>
			<div class="row">
				<div class="col-md-12">
					<?php
					foreach ($categorii_structura as $cat) {
						?>
					<?= $cat->nume; ?></h1>
						<table class="table table-hover table-bordered" style="margin-bottom:3rem;">
							<thead style="background-color:#F5F5F6;">
								<tr class="font-weight text-center">
									<th>#</th>
									<th>Nume & Prenume</th>
									<th>Functia detinuta</th>
									<th>CV</th>
								</tr>
							</thead>

							<!-- <thead>
							<tr>
								<td></td>
							</tr>
							</thead> -->
							<tbody>
							<?php
							$nr_item = 1;
							foreach ( $this->_Object->msqlGetAll('structura_manageriala', array('id_info' => $cat->id_item)) as $item ) {
								?>
								<tr>
									<td><?= $nr_item; ?></td>
									<td><?= $item->nume . ' ' . $item->prenume; ?></td>
									<td><?= $item->functie; ?></td>
									<td class="text-navy"><?= (!empty($item->pdf)) ? '<a href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
								</tr>
								<?php
								++$nr_item;
							}
							?>
							</tbody>
						</table>
					<?php
					}
					?>

					<table class="table table-hover sortable tabel-actionariat">
						<?php
						for ($i = 2019; $i <= date("Y"); $i++) {}
						for ($i = 2019; $i <= date("Y"); $i++) {}

							$nr_item = 1;
							foreach ( $this->_Object->msqlGetAll('structura_manageriala', array('id_info' => $cat->id_item)) as $item ) {
								?>
								<tr>
									<td><?= $nr_item; ?></td>
									<td><?= $item->nume . ' ' . $item->prenume; ?></td>
									<td><?= $item->functie; ?></td>
									<td class="text-navy"><?= (!empty($item->pdf)) ? '<a href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
								</tr>
								<?php
								++$nr_item;
							}
							?>
						<tbody>
						<?php

						echo '<tr><th></th><th></th><th style="font-size: 18px">Adunarea Generala a Actionarilor</th><th></th><th></th><th></th></tr>';
						$nr_item = 1;
						foreach ( $lista_declaratii as $item ) {
							$aga = implode(' ', array_slice(explode(' ', $item->functie), 0, 2));


							if ( $aga == "Membru AGA" ) { ?>

								<tr>
									<td><?= $nr_item; ?></td>
									<td><?= $item->nume . ' ' . $item->prenume; ?></td>
									<td><?= $item->functie; ?></td>

									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_avere_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de avere ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_avere_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_interes_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de interes ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_interes_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<td class="text-navy"><?= (!empty($item->cv_pdf)) ? '<a data-toggle="tooltip" title="CV" href="' . SITE_URL . PATH_DECLARATII_AVERE . 'cv_folder/' . $item->cv_pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
								</tr>
							<?php	++$nr_item; }

							?>

							<?php

						}


						echo '<tr><th></th><th></th><th style="font-size: 18px">Consiliul de administratie</th><th></th><th></th><th></th></tr>';
						foreach ($lista_declaratii as $item) {
							$aga = implode(' ', array_slice(explode(' ', $item->functie), 0, 2));

							if ( $aga == "Presedinte" ) { ?>
								<tr>
									<td><?= $nr_item; ?></td>
									<td><?= $item->nume . ' ' . $item->prenume; ?></td>
									<td><?= $item->functie; ?></td>
									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_avere_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de avere ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_avere_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_interes_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de interes ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_interes_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<td class="text-navy"><?= (!empty($item->cv_pdf)) ? '<a data-toggle="tooltip" title="CV" href="' . SITE_URL . PATH_DECLARATII_AVERE . 'cv_folder/' . $item->cv_pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
								</tr>
								<?php ++$nr_item;
								}
							?>

							<?php

						}
						foreach ($lista_declaratii as $item) {
							$aga = implode(' ', array_slice(explode(' ', $item->functie), 0, 2));

							if ( $aga == 'Administrator provizoriu' || $aga == 'Membru CA' ) { ?>
								<tr>
									<td><?= $nr_item; ?></td>
									<td><?= $item->nume . ' ' . $item->prenume; ?></td>
									<td><?= $item->functie; ?></td>
									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_avere_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de avere ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_avere_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_interes_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de interes ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_interes_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<td class="text-navy"><?= (!empty($item->cv_pdf)) ? '<a data-toggle="tooltip" title="CV" href="' . SITE_URL . PATH_DECLARATII_AVERE . 'cv_folder/' . $item->cv_pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
								</tr>
								<?php ++$nr_item;
							}
							?>

							<?php

						}

						echo '<tr><th></th><th></th><th style="font-size: 18px">Conducere Executiva</th><th></th><th></th><th></th></tr>';
						// $nr_item = 1;
						foreach ( $lista_declaratii as $item ) {
							$aga = implode(' ', array_slice(explode(' ', $item->functie), 0, 2));


							if ( $aga == "Director Economic" || $aga == "Director General" ) { ?>

								<tr>
									<td><?= $nr_item; ?></td>
									<td><?= $item->nume . ' ' . $item->prenume; ?></td>
									<td><?= $item->functie; ?></td>

									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_avere_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de avere ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_avere_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<?php
									for ($i = 2020; $i <= 2020; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_interes_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de interes ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_interes_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
										<?php
									}
									?>
									<td class="text-navy"><?= (!empty($item->cv_pdf)) ? '<a data-toggle="tooltip" title="CV" href="' . SITE_URL . PATH_DECLARATII_AVERE . 'cv_folder/' . $item->cv_pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
								</tr>
							<?php	++$nr_item; }

							?>

							<?php

						}

						// echo '<tr><th></th><th></th><th style="font-size: 18px">Membri</th><th></th><th></th><th></th></tr>';
						foreach ($lista_declaratii as $item) {
							$aga = implode(' ', array_slice(explode(' ', $item->functie), 0, 2));;
						 if ( ! $aga == 'Membru' || ! $aga == "Director Economic" || ! $aga == "Director General" || ! $aga == 'Administrator provizoriu' || ! $aga == "Presedinte" || ! $aga == 'Membru CA' || ! $aga == "Membru AGA" ){ ?>
							<tr>
								<td><?= $nr_item; ?></td>
								<td><?= $item->nume . ' ' . $item->prenume; ?></td>
								<td><?= $item->functie; ?></td>
								<?php
								for ($i = 2020; $i <= 2020; $i++) {
									?>
									<td class="text-navy"><?= (!empty($item->{'pdf_decl_avere_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de avere ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_avere_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
									<?php
								}
								?>
								<?php
								for ($i = 2020; $i <= 2020; $i++) {
									?>
									<td class="text-navy"><?= (!empty($item->{'pdf_decl_interes_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de interes ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_interes_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
									<?php
								}
								?>
								<td class="text-navy"><?= (!empty($item->cv_pdf)) ? '<a data-toggle="tooltip" title="CV" href="' . SITE_URL . PATH_DECLARATII_AVERE . 'cv_folder/' . $item->cv_pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
							</tr>
							<?php ++$nr_item; }
							?>
							<?php
						}
						?>
						</tbody>
					</table>


				</div>
			</div>
			<?php
		}
		?>



		<?php
		if (!empty($actionariat) && $this->uri->segment(2) == 'guvernanta-corporativa') {
			// print_r($actionariat); die;
			?>
			<div class="container">
				<!--  content -->
				<div class="col-lg-12 col-md-12">
					<?php if (empty($actionariat)) : ?>
						<span style="font-size:20px;padding:30px;margin:30px;"><?= ($site_lang == "en" ? 'There are no data..' : "Nu exista date...") ?></span>
					<?php else : ?>
						<div id="accordion" role="tablist" aria-multiselectable="true">
							<?php foreach ($actionariat as $key_if => $if) : ?>
								<!-- faq 1 -->
								<div class="card">
									<div class="card-header" role="tab" id="heading<?= $key_if ?>">
										<h5 class="mb-0">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $key_if ?>" aria-expanded="true" aria-controls="collapseOne" class="d-block text-dark text-up-small font-weight-700"><i class="fa fa-info margin-right-10px"></i> <?= $if->denumire_ro; ?> </a>
										</h5>
									</div>
									<div id="collapse-<?= $key_if ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $key_if ?>">
										<div class="card-block padding-30px">
											<table class="table table-hover table-bordered">
												<tbody>
												<?php
												$nr_item = 1;
												foreach ($if->items as $item) {
													?>
													<tr>
														<td><a href="<?= SITE_URL . 'singlep/' . $item->atom_id; ?>"><?= $item->atom_name_ro; ?></a></td>
														<td width="100"><?= $item->insert_date; ?></td>
													</tr>
													<?php
													++$nr_item;
												}
												?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- //  faq 1 -->
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
				<!-- //  content col-8 -->
				<!-- //  content -->
			</div>

			<?php
		}

		if (!empty($sitfinanciare) && $this->uri->segment(2) == 'situatii-financiare') {
			//var_dump($sitfinanciare); die();
			?>
			<div class="container">
				<!--  content -->
				<div class="col-lg-12 col-md-12">
					<?php if (empty($sitfinanciare)) : ?>
						<span style="font-size:20px;padding:30px;margin:30px;"><?= ($site_lang == "en" ? 'There are no data..' : "Nu exista date...") ?></span>
					<?php else : ?>
						<div id="accordion" role="tablist" aria-multiselectable="true">
							<?php foreach ($sitfinanciare as $key_if => $if) : ?>
								<!-- faq 1 -->
								<div class="card">
									<div class="card-header" role="tab" id="heading<?= $key_if ?>">
										<h5 class="mb-0">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?= $key_if ?>" aria-expanded="true" aria-controls="collapseOne" class="d-block text-dark text-up-small font-weight-700"><i class="fa fa-info margin-right-10px"></i> <?= $if->denumire_ro; ?> </a>
										</h5>
									</div>
									<div id="collapse-<?= $key_if ?>" class="collapse" role="tabpanel" aria-labelledby="heading<?= $key_if ?>">
										<div class="card-block padding-30px">
											<table class="table table-hover table-bordered">
												<tbody>
												<?php
												$nr_item = 1;
												foreach ($if->items as $item) {
													?>
													<?php foreach ($item->pdf as $pdf) { ?>
													<tr>
														<td>
															<a href="<?php echo SITE_URL ."/public/upload/documents/sitfinanciare/".$pdf->pdf_file ?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> <?= $pdf->name?>
															</a>
														</td>
													</tr>
													<?php } ?>
													<?php
													++$nr_item;
														}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- //  faq 1 -->
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
				<!-- //  content col-8 -->
				<!-- //  content -->
			</div>

			<?php
		}

		if ($body_class === "factura-in-format") { ?>



			<!-- <section class="padding-tb-100px">
					<div class="container">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<form>
									<h4 class="text-center">
										SOLICITARE EMITERE FACTURĂ ELECTRONICĂ
									</h4>

									<p class="opacity-7 margin-bottom-20px"></p>
									<p class="opacity-7">
										<p>
											Subsemnatul/(a),
										</p>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span> Nune / Prenume | Companie</label>
												<input type="text" class="form-control" id="inputName4" placeholder="Nune / Prenume | Companie" required>
											</div>
											<div class="form-group col-md-6">
												<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span> Cod client</label>
												<input type="text" class="form-control" id="inputName4" placeholder="Completati codul client de pe factura" required>
											</div>
										</div>
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="inputAddress">Adresa</label>
												<input type="text" class="form-control" id="inputAddress" placeholder="Introdu adresa sediu (domiciliu)">
											</div>
											<div class="form-group col-md-6">
												<label for="inputAddress"> Telefon mobil</label>
												<input type="number" class="form-control" id="inputPhone" placeholder="Introdu nr. telefon" required>
											</div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-12">
												<label for="inputEmail4"><span class="fa fa-star fa-xs" style="color:red;"></span> îmi dau acordul pentru primirea facturii în format electronic pe adresa de email
												</label>

												<div class="row">
													<div class="col-sm">
														<input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
													</div>

													<div class="col-sm">
														<input type="email" class="form-control" id="inputEmail" placeholder="Confirma Email" required>
													</div>
												</div>


											</div>
										</div>
										<p style="text-align: justify">
											Prin acest acord, consimt că Operatorul COMPANIA DE UTILITĂȚI PUBLICE SA Focșani să-mi prelucreze datele cu caracter personal, în scopul transmiterii pe adresa de e-mail și/sau telefonul mobil a facturii aferente serviciilor de apă și/sau canalizare, a informărilor diverse legate strict de furnizarea și/sau încasarea acestor servicii (exclus mesaje de marketing).
										</p>
										<hr />


										<div class="form-row">
											<span style="text-align: justify;">
												<strong>
													Oricând vă puteți retrage consimțământul dat. Retragerea consimțământului nu afectează legalitatea prelucrării efectuate pe baza consimțământului înainte de retragerea acestuia.
												</strong>
											</span>


										</div>

										<label style="margin: 30px 0 30px;"><span class="fa fa-star fa-xs" style="color:red;"></span> Câmp obligatoriu</label>

										<a href="#" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">Trimitere cerere</a>
								</form>
							</div>
						</div>
					</div>
				</section> -->


		<?php	}

		if ($body_class === "drepturile-persoanelor-vizate") {


		?>

		<!-- <section class="padding-tb-100px">
			<div class="container">
				<div class="row">
					<div class="col-lg col-md">
						<form action="" method="">
							<h4 class="text-center">
								CERERE ÎN LEGATURĂ CU PRELUCRAREA DATELOR CU CARACTER PERSONAL
							</h4>

							<p class="opacity-7 margin-bottom-20px"></p>
							<p class="opacity-7">
								<div class="form-row">
									<div class="form-group">

										<h3>
											I. Persoana vizată <input type="checkbox" name="pers_vizata" value="persoana vizata" style="margin-left:20px;">
										</h3>
									</div>
								</div>
								<p>
									Subsemnatul/(a),
								</p>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span> Nune / Prenume | Companie</label>
										<input type="text" class="form-control" id="inputName4" placeholder="Nune / Prenume | Companie" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress">Adresa</label>
										<input type="text" class="form-control" id="inputAddress" placeholder="introdu areasa">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputEmail4"><span class="fa fa-star fa-xs" style="color:red;"></span> Email</label>
										<input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress"> Telefon</label>
										<input type="number" class="form-control" id="inputPhone" placeholder="introdu telefon" required>
									</div>
								</div>
								<p>
									în calitate de persoană vizată, în sensul Regulamentului nr. 679/2016 privind protecţia persoanelor
									fizice în ceea ce priveşte prelucrarea datelor cu caracter personal şi privind libera circulaţie a
									acestor date,
								</p>
								<hr />
								<div class="form-row">
									<div class="form-group">
										<h3>
											II. Reprezentant legal <input type="checkbox" name="rep_legal" value="reprezentant legal" style="margin-left:20px;">
										</h3>
									</div>
								</div>
								<p>
									Subsemnatul/(a),
								</p>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span> Nune / Prenume | Companie</label>
										<input type="text" class="form-control" id="inputName4" placeholder="Nune / Prenume | Companie" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress">Adresa</label>
										<input type="text" class="form-control" id="inputAddress" placeholder="introdu areasa">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-md-6">
										<label for="inputEmail4"><span class="fa fa-star fa-xs" style="color:red;"></span> Email</label>
										<input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
									</div>
									<div class="form-group col-md-6">
										<label for="inputAddress"> Telefon</label>
										<input type="number" class="form-control" id="inputPhone" placeholder="introdu telefon" required>
									</div>
								</div>
								<p style="text-align: justify;">
									în calitate de reprezentant, prin semnarea prezentei declar că sunt
									autorizat legal să reprezint cu drepturi depline persoana vizată (va fi completată doar în
									cazul în care acționați în calitate de reprezentant al persoanei vizate în numele căreia faceți
									cererea) <strong><sup>1</sup></strong>,<br />
									formulez în temeiul prevederilor Regulamentului (UE) 2016/679 privind protecția
									persoanelor fizice în ceea ce privește prelucrarea datelor cu caracter personal și privind libera
									circulație a acestor date și de abrogare a Directivei 95/46/CE (Regulamentul general privind
									protecția datelor),
								</p>
							</p>

							<h4 class="text-center">
								CERERE <strong>DE ACCES/ RECTIFICARE/ COMPLETARE/ ȘTERGERE/ OPOZIȚIE/<br />
									RESTRICȚIONAREA PRELUCRĂRII / PORTABILITATEA</strong><br />
								DATELOR CU CARACTER PERSONAL <strong><sup>2</sup></strong>
							</h4>
							<div class="form-group">
								<label for="exampleFormControlTextarea1"> <span style="font-size: 30px; color: #4f90c5;">&#8226;</span> Prin prezenta vă solicit:</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label for="exampleFormControlTextarea2"> <span style="font-size: 30px; color: #4f90c5;">&#8226;</span> Motivele care stau la baza cererii (optional):</label>
								<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
							</div>
							<div class="form-group">
								<label for="">
									<span style="font-size: 30px; color: #4f90c5;">&#8226;</span>
									Date privind identitatea persoanei care face cererea <strong><sup>3</sup></strong> :<br />
									Tipul relației cu operatorul CUP SA Focșani:
								</label>
								<div class="form-row">
									<div class="form-group col-md-3">
										<input type="checkbox" name="angajat" value="angajat"> Angajat
									</div>
									<div class="form-group col-md-3">
										<input type="checkbox" name="colaborator" value="colaborator"> Colaborator/Partener
									</div>
									<div class="form-group col-md-3">
										<input type="checkbox" name="utilizator" value="utilizator"> Utilizator al serviciilor
									</div>
									<div class="form-group col-md-3">
										<input type="checkbox" name="angajat" value="angajat"> Altul
									</div>
								</div>
								<div class="form-row col-md-12">
									<input type="text" class="form-control" id="altul" placeholder="Altul">
								</div>
							</div>
							<div class="form-group">
								<label for="">
									<span style="font-size: 30px; color: #4f90c5;">&#8226;</span>
									Alegeți modalitatea de contact preferată:</label>
								<div class="form-row">
									<div class="form-group col-md-6">
										<input type="checkbox" name="" value=""> Email
									</div>
									<div class="form-group col-md-6">
										<input type="checkbox" name="" value=""> Posta
									</div>
								</div>
							</div>


							<div class="form-row">
								<p style="text-align: justify;">
									<strong>
										Confirm faptul că informațiile furnizate de mine prin această cerere sunt reale și corecte.
										Am înțeles că SC CUP SA Focșani trebuie să confirme identitatea mea / a persoanei vizate
										și că, în scopul localizării datelor personale, ar putea fi necesar să furnizez ulterior
										informații mai detaliate. Am luat la cunoștință că aceste informații vor fi utilizate numai în
										scopul soluționării cererii mele. Am luat la cunoștință faptul că lipsa răspunsurilor exacte
										la toate întrebările din formular sau necompletarea corectă a acestora poate face
										imposibilă soluționarea cererii.
									</strong>
								</p>



								<hr />

								<p style="text-align: justify;">
									<strong><sup>1</sup></strong> Este posibil ca Societatea să contacteze Solicitantul în vederea validării calității de reprezentant.<br />
									<strong><sup>2</sup></strong> În funcție de ce anume se dorește prin cerere, persoana vizată va sublinia/încercui una/sau mai multe dintre opțiunile enumerate
									mai sus și care va/vor forma obiectul cererii. Persoana vizată va primi un răspuns în cel mai scurt timp posibil, dar nu mai târziu
									de o lună de zile de la primirea acesteia.<br />
									<strong><sup>3</sup></strong> În cazul în care Operatorul CUP SA Focșani nu este în măsură să identifice în mod corespunzător persoana solicitantă, respectiv
									persoana vizată, exclusiv în baza informațiilor transmise de către aceasta, atunci Operatorul CUP SA Focșani își rezervă dreptul
									de a solicita alte informații suplimentare și/sau alte dovezi care să permită identificarea acesteia.
								</p>

								<p>
									<label><span class="fa fa-star fa-xs" style="color:red;"></span> Camp obligatoriu</label>
								</p>

							</div>

							<div class="form-row text-center">
								<div class="form-group">
									<input type="checkbox" name=""> Am citit Politica de Confidentialitate a CUP SA Focsani
								</div>
							</div>

							<a href="#" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">Salveaza PDF</a>
						</form>
					</div>
				</div>
			</div>
		</section> -->


		</div>
			<?php	} ?>
		</div>
	
	



	<!--fe--daca nu merge ceva treci pe factura-in-format-electronic si schimba utilizator-->
	<?php
		if (($page->p->slug) == "factura-in-format-electronic") {

			if(isset($_POST['submit'])){
				//$to = "office@cupfocsani.ro"; // this is your Email address
				$to = "utilizator@cupfocsani.ro";
				$from = $_POST['email']; // this is the sender's Email address
				$nume = $_POST['nume'];
				$cod_client = $_POST['cod_client'];
				$adresa = $_POST['adresa'];
				$telefon = $_POST['telefon'];
				$email = $_POST['email'];
				$cnp_cif = $_POST['cnp_cif'];
				
				// $factura_email = $_POST['factura_email'];

				$trimitere_factura = $_POST['trans_factura'];
				$trimitere_sms =  $_POST['trans_sms'];

				$subject = "Cerere Factura Format Electronic";
				$subject2 = "Copie Cerere Factura Format Electronic";
	
	
					if(isset($trimitere_factura)){
					$trimitere_factura = "----DA----";
					} else {
					$trimitere_factura = "----NU----";
					}
	
					if(isset($trimitere_sms )){
					$trimitere_sms = "----DA----";
					} else{
					$trimitere_sms = "----NU----"; 
					}
	
				$message2 = 'VA RUGAM SA NU DATI REPLY LA ACEST MESAJ';	
				
				$message =
				'Nume Client: ' . $nume . "\n\n Cod Client: " . $cod_client . " \n\n Adresa punctului de consum: " . $adresa . "\n\n Telefon: " . $telefon . "\n\n Email: " . $email . "\n\n CNP: " . $cnp_cif."\n\n ";
							
				$message .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere factura pentru serviciile de apa si/sau canalizare pe adresa de e-mail: ' . $trimitere_factura."\n\n " ;
				
				$message .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia plătilor, a soldului debitor/creditor etc exclus mesaje de marketing): ' . $trimitere_sms."\n\n " ;	
				
				$message .= 'Am fost informat ca imi pot retrage consimtamantul oricand. Retragerea consimtamantului nu afecteaza legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia' . "\n\n " . '------------------------------------------------------------------------------------------------' . "\n\n " . 'Informare conform cu art. 13 din Regulamentul GDPR 679/2016' . "\n\n " . '1) identitatea si datele de contact ale operatorului:' . "\n " .
				'S.C. COMPANIA DE UTILITATI PUBLICE S.A. FOCSANI, str. N.Titulescu, Nr. 9, tel. 0237 226 401, e-mail secretariat@cupfocsani.ro' . "\n\n " . '2) datele de contact ale responsabilului cu protectia datelor:' . "\n " . 'dpo@cupfocsani.ro, tel. 0237238531' . "\n\n " . '3) scopurile in care sunt prelucrate datele cu caracter personal, precum si temeiul juridic al prelucrarii:' . "\n " . 'scop 1. transmiterea facturii pentru serviciile de apa si/sau canalizare pe adresa de e-mail' . "\n " . 'scop 2. transmiterii de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia platilor, exclus mesaje de marketing). Temeiul juridic al prelucrarii il reprezinta:' . "\n " . '- executarea Contractului pentru serviciile de apa si canalizare la care persoana vizata este parte' . "\n " . '- interesul legitim urmarit de operator pentru care s-a facut Evaluarea interesului legitim. Interesul legitim este reprezentat de transmiterea facturilor cat mai rapid, in siguranta si avand costuri scazute catre utilizatori. Un alt interes legitim este reprezentat de informarea in timp real a utilizatorilor despre aparitia unor avarii pe reteaua publica sau despre situatia facturilor emise, a soldului debitor/creditor etc.' . "\n\n " . '4) destinatarii sau categoriile de destinatari ai datelor cu caracter personal' . "\n " .
				'Personalul CUP Focsani care are sarcini de serviciu sa prelucreze aceste date cu caracter personal, institutiile statului care in baza legii pot solicita aceste date, iar operatorul este obligat sa le transmita' . "\n\n " . '5) perioada pentru care vor fi stocate datele cu caracter personal sau, daca acest lucru nu este posibil, criteriile utilizate pentru a stabili aceasta perioada;' . "\n " . 'Datele sunt stocate pe toata perioada contractuala sau pana cand utilizatorul isi exercita dreptul de stergere (pentru datele care pot fi sterse) al lor.' . "\n\n " . '6) aveti dreptul de a solicita operatorului, rectificarea sau stergerea datelor sau restrictionarea prelucrarii sau dreptul de a va opune prelucrarii, precum si dreptul la portabilitatea datelor; atunci cand prelucrarea se bazeaza pe articolul 6 alineatul (1) litera (a) sau pe articolul 9 alineatul (2) litera (a), aveti dreptului de va retrage consimtamantul in orice moment, fara a afecta legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia; aveti <b>dreptul de a depune o plangere in fata unei autoritati de supraveghere;' . "\n\n " . '7) daca furnizarea de date cu caracter personal reprezinta o obligatie legala sau contractuala sau o obligatie necesara pentru incheierea unui contract, precum si daca persoana vizata este obligata sa furnizeze aceste date cu caracter personal si care sunt eventualele consecinte ale nerespectarii acestei obligatii;' . "\n " . 'In situatia in care va exercitati dreptul de stergere sau dreptul de a va opune prelucrarii asupra datelor cu caracter personal de genul nume, prenume, adresa, informatii referitoare la distributia retelelor in interiorul imobilului etc, nu vom mai putea fi masura continuarii relatiilor contractuale.' . "\n\n " . '8) existenta unui proces decizional automatizat incluzand crearea de profiluri, mentionat la articolul 22 alineatele (1) si (4), precum si, cel putin in cazurile respective, informatii pertinente privind logica utilizata si privind importanta si consecintele preconizate ale unei astfel de prelucrari pentru persoana vizata.' . "\n" . 'În cadrul activitatii operatorului NU exista un proces decizional automatizat sau crearea de profiluri.' . "\n\n " . '9) In cazul in care operatorul intentioneaza sa prelucreze ulterior datele cu caracter personal intr-un alt scop decat cel pentru care acestea au fost colectate, operatorul furnizeaza persoanei vizate, inainte de aceasta prelucrare ulterioara, informatii privind scopul secundar respectiv si orice informatii suplimentare relevante, in conformitate cu alineatul (2).' . "\n " . 'In masura in care obligatiile legale NU impun o alta prelucrare, datele colectate NU vor fi prelucrate in alt scop decat cel mentionat mai sus.' . "\n "  ;
	
	
				$message2 = "Aceasta este o copie a mesajului " . "\n\n" . "VA RUGAM SA NU DATI REPLY LA ACEST MESAJ" . "\n\n" .' Nume Client: ' . $nume . "\n Cod Client: " . $cod_client . " \n Adresa punctului de consum: " . $adresa . "\n Telefon: " . $telefon . "\n Email: " . $email . "\n CNP: " . $cnp_cif . "\n\n Selectie: " . "\n\n " ;
				
				$message2 .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere factura pentru serviciile de apa si/sau canalizare pe adresa de e-mail: ' . $trimitere_factura."\n\n " ;
				
				$message2 .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia plătilor, a soldului debitor/creditor etc exclus mesaje de marketing): ' . $trimitere_sms."\n\n " ;
	
				$message2 .= 'Am fost informat ca imi pot retrage consimtamantul oricand. Retragerea consimtamantului nu afecteaza legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia' . "\n\n " . 'Informare conform cu art. 13 din Regulamentul GDPR 679/2016' . "\n\n " . '1) identitatea si datele de contact ale operatorului:' . "\n " .
				'S.C. COMPANIA DE UTILITATI PUBLICE S.A. FOCSANI, str. N.Titulescu, Nr. 9, tel. 0237 226 401, e-mail secretariat@cupfocsani.ro' . "\n\n " . '2) datele de contact ale responsabilului cu protectia datelor:' . "\n " . 'dpo@cupfocsani.ro, tel. 0237238531' . "\n\n " . '3) scopurile in care sunt prelucrate datele cu caracter personal, precum si temeiul juridic al prelucrarii:' . "\n " . 'scop 1. transmiterea facturii pentru serviciile de apa si/sau canalizare pe adresa de e-mail' . "\n " . 'scop 2. transmiterii de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia platilor, exclus mesaje de marketing). Temeiul juridic al prelucrarii il reprezinta:' . "\n " . '- executarea Contractului pentru serviciile de apa si canalizare la care persoana vizata este parte' . "\n " . '- interesul legitim urmarit de operator pentru care s-a facut Evaluarea interesului legitim. Interesul legitim este reprezentat de transmiterea facturilor cat mai rapid, in siguranta si avand costuri scazute catre utilizatori. Un alt interes legitim este reprezentat de informarea in timp real a utilizatorilor despre aparitia unor avarii pe reteaua publica sau despre situatia facturilor emise, a soldului debitor/creditor etc.' . "\n\n " . '4) destinatarii sau categoriile de destinatari ai datelor cu caracter personal' . "\n " .
				'Personalul CUP Focsani care are sarcini de serviciu sa prelucreze aceste date cu caracter personal, institutiile statului care in baza legii pot solicita aceste date, iar operatorul este obligat sa le transmita' . "\n\n " . '5) perioada pentru care vor fi stocate datele cu caracter personal sau, daca acest lucru nu este posibil, criteriile utilizate pentru a stabili aceasta perioada;' . "\n " . 'Datele sunt stocate pe toata perioada contractuala sau pana cand utilizatorul isi exercita dreptul de stergere (pentru datele care pot fi sterse) al lor.' . "\n\n " . '6) aveti dreptul de a solicita operatorului, rectificarea sau stergerea datelor sau restrictionarea prelucrarii sau dreptul de a va opune prelucrarii, precum si dreptul la portabilitatea datelor; atunci cand prelucrarea se bazeaza pe articolul 6 alineatul (1) litera (a) sau pe articolul 9 alineatul (2) litera (a), aveti dreptului de va retrage consimtamantul in orice moment, fara a afecta legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia; aveti <b>dreptul de a depune o plangere in fata unei autoritati de supraveghere;' . "\n\n " . '7) daca furnizarea de date cu caracter personal reprezinta o obligatie legala sau contractuala sau o obligatie necesara pentru incheierea unui contract, precum si daca persoana vizata este obligata sa furnizeze aceste date cu caracter personal si care sunt eventualele consecinte ale nerespectarii acestei obligatii;' . "\n " . 'In situatia in care va exercitati dreptul de stergere sau dreptul de a va opune prelucrarii asupra datelor cu caracter personal de genul nume, prenume, adresa, informatii referitoare la distributia retelelor in interiorul imobilului etc, nu vom mai putea fi masura continuarii relatiilor contractuale.' . "\n\n " . '8) existenta unui proces decizional automatizat incluzand crearea de profiluri, mentionat la articolul 22 alineatele (1) si (4), precum si, cel putin in cazurile respective, informatii pertinente privind logica utilizata si privind importanta si consecintele preconizate ale unei astfel de prelucrari pentru persoana vizata.' . "\n" . 'În cadrul activitatii operatorului NU exista un proces decizional automatizat sau crearea de profiluri.' . "\n\n " . '9) In cazul in care operatorul intentioneaza sa prelucreze ulterior datele cu caracter personal intr-un alt scop decat cel pentru care acestea au fost colectate, operatorul furnizeaza persoanei vizate, inainte de aceasta prelucrare ulterioara, informatii privind scopul secundar respectiv si orice informatii suplimentare relevante, in conformitate cu alineatul (2).' . "\n " . 'In masura in care obligatiile legale NU impun o alta prelucrare, datele colectate NU vor fi prelucrate in alt scop decat cel mentionat mai sus.' . "\n "  ;
	
	
				$headers = "De la:" . $from;
				$headers2 = "De la:" . $to;
				mail($to,$subject,$message,$headers);
				mail($from,$subject2,$message2,$headers2); 
				echo '<h3 style="background-color: red; color: #fff; padding: 10px; text-align: center; " id="#cerere-trimisa">Cererea a fost trimisa ' . $first_name . '. Multumim!</h3>';
				


				define("SERVERNAME_CUPFOCSANI", "mysql.cupfocsani.ro");
				define("USER_CUPFOCSANI", "cupfocsaniro");
				define("PASS_CUPFOCSANI", "Canap1");
				define("DB_CUPFOCSANI", "cupfocsaniro_cupfcs");
				
				$con=mysqli_connect('mysql.cupfocsani.ro','cupfocsaniro','Canap1','cupfocsaniro_cupfcs');
				
				// Check connection
				if ($con->connect_error) {
				  die("Connection failed: " . $con->connect_error);
				}
					
				
				
				$sql = "INSERT INTO factura_electronica(nume,adresa,cod_client,telefon,email,cnp_cif,trimitere_factura,trimitere_sms)
				VALUES ('$nume','$adresa','$cod_client','$telefon','$email','$cnp_cif','$trimitere_factura','$trimitere_sms')";
				
				if ($con->query($sql) === TRUE) {
				  echo " ";
				} else {
				  echo "Error: " . $sql . "<br>" . $con->error;
				}

				}
			?>

		<div class="col-lg-12 col-md-12">
			<form id="factura_electronica_form" method="post" action="">
				<h4 class="text-center">
					SOLICITARE EMITERE FACTURĂ ELECTRONICĂ
				</h4>

				<p class="opacity-7 margin-bottom-20px"></p>
				<p class="opacity-7">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="nume"><span class="fa fa-star fa-xs" style="color:red;"></span> <b>Nume, Prenume / Denumire Societate</b></label>
							<input type="text" class="form-control" id="nume" placeholder="Nume, Prenume / Denumire Societate" name="nume" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="adresa"><span class="fa fa-star fa-xs" style="color:red;"></span><b>Adresa punctului de consum</b></label>
							<input type="text" class="form-control" id="adresa" placeholder="Adresa punctului de consum" name="adresa">
						</div>
						<div class="form-group col-md-6">
							<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span><b>Cod client</b></label>
							<input type="text" class="form-control" id="inputName4" placeholder="Completati codul client de pe factura" name="cod_client" maxlength="6" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="telefon"><b>Telefon mobil</b></label>
							<input type="text" class="form-control" id="telefon" placeholder="Introduceți nr. telefon" name="telefon">
						</div>
						<div class="form-group col-md-6">
							<label for="email"><span class="fa fa-star fa-xs" style="color:red;"></span> <b>Email</b></label>
							<input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="cnp_cif"><span class="fa fa-star fa-xs" style="color:red;"></span> <b>CNP / CUI</b> (vă solicităm CNP-ul / CUI pentru a fi siguri că solicitantul este și utilizatorul serviciilor asigurate de operator)</label>
							<input type="text" class="form-control" id="cnp_cif" name="cnp_cif" placeholder="CNP / CUI" required>
						</div>
					</div>
					<p>
						<label style="margin: 10px 0 10px;"><span class="fa fa-star fa-xs" style="color:red;"></span> Câmp obligatoriu</label><br>
						<input type="submit" name="submit" value="Trimitere" style="display:none" id="factura_electronica_submit" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">
					</p>

					<p style="text-align: justify">
						îmi exprim <b>CONSIMTĂMÂNTUL</b> pentru prelucrarea datelor cu caracter personal menționate mai sus de către operatorul CUP Focșani în <b>scopurile</b>:<br />

						<div><b style="color: red">Bifați scopul (urile) dorit (e)</b></div>
						<div class="ml-30">
							<input type="checkbox" id="trans_factura" name="trans_factura" value="Factura email" required>
							<label for="factura_email"> <b>transmiterii facturii pentru serviciile de apă și/sau canalizare pe adresa de e-mail</b>;</label>
							<hr>

							<input type="checkbox" id="trans_sms" name="trans_sms" value="Mesaj SMS">
							<label for="mesaj_sms"> <b>transmiterii de mesaje tip SMS referitoare la serviciile de apă și canalizare (avarii, lucrări <br>programate, situația plăților, a soldului debitor/creditor etc, exclus mesaje de marketing)</b>.</label>
						</div>
						
						<br>

						Am fost informat că îmi pot retrage consimțământul oricând. Retragerea consimțământului nu afectează legalitatea prelucrării efectuate pe baza consimțământului înainte de retragerea acestuia.<br /><br />

						Informare conform art. 13 din Regulamentul GDPR 679/2016<br /><br />

						<b>1) identitatea şi datele de contact ale operatorului:</b><br />
						COMPANIA DE UTILITĂȚI PUBLICE S.A. FOCȘANI, str. N.Titulescu nr. 9, tel. 0237 226 401, e-mail <a href="mailto:secretariat@cupfocsani.ro">secretariat@cupfocsani.ro</a><br /><br />

						<b>2) datele de contact ale responsabilului cu protecţia datelor:</b><br />
						<a href="mailto:dpo@cupfocsani.ro">dpo@cupfocsani.ro</a>, tel. <a href="tel:0237238531">0237 238 531</a><br /><br />

						<b>3) scopurile în care sunt prelucrate datele cu caracter personal, precum şi temeiul juridic al prelucrării:</b><br>
						scop 1. transmiterea facturii pentru serviciile de apă și/sau canalizare pe adresa de e-mail<br>
						scop 2. transmiterii de mesaje tip SMS referitoare la serviciile de apă și canalizare (avarii, lucrări programate, situația plăților, exclus mesaje de marketing).
						Temeiul juridic al prelucrării îl reprezintă:<br>
						<div class="ml-30">
							-	executarea Contractului pentru serviciile de apă și canalizare la care persoana vizată este parte<br>
							-	interesul legitim urmărit de operator pentru care s-a făcut Evaluarea interesului legitim. Interesul legitim este reprezentat de transmiterea facturilor cât mai rapid, în siguranță și având costuri scăzute către utilizatori. Un alt interes legitim este reprezentat de informarea în timp real a utilizatorilor despre apariția unor avarii pe rețeaua publică sau despre situația facturilor emise, a soldului debitor/creditor etc.
						</div> <br>

						<b>4) destinatarii sau categoriile de destinatari ai datelor cu caracter personal</b><br>
						Personalul CUP Focșani care are sarcini de serviciu să prelucreze aceste date cu caracter personal, instituțiile statului care în baza legii pot solicita aceste date iar operatorul este obligat să le transmită.<br><br>

						<b>5) perioada pentru care vor fi stocate datele cu caracter personal sau, dacă acest lucru nu este posibil, criteriile utilizate pentru a stabili această perioadă;</b><br>
						Datele sunt stocate pe toată perioada contractuală sau până când utilizatorul își exercită dreptul de ștergere (pentru datele care pot fi șterse) al lor.<br><br>

						<b>6)</b> aveți <b>dreptul</b> de a solicita operatorului, <b>rectificarea</b> sau <b>ştergerea</b> datelor sau <b>restricţionarea prelucrării</b> sau dreptul de a vă <b>opune prelucrării</b>, precum şi dreptul la <b>portabilitatea</b> datelor; atunci când prelucrarea se bazează pe articolul 6 alineatul (1) litera (a) sau pe articolul 9 alineatul (2) litera (a), aveți dreptului de vă <b>retrage consimţământul</b> în orice moment, fără a afecta legalitatea prelucrării efectuate pe baza consimţământului înainte de retragerea acestuia; aveți <b>dreptul de a depune o plângere</b> în faţa unei autorităţi de supraveghere; <br><br>

						<b>7) dacă furnizarea de date cu caracter personal reprezintă o obligaţie legală sau contractuală sau o obligaţie necesară pentru încheierea unui contract, precum şi dacă persoana vizată este obligată să furnizeze aceste date cu caracter personal şi care sunt eventualele consecinţe ale nerespectării acestei obligaţii; </b><br>
						În situația în care vă exercitați dreptul de ștergere sau dreptul de a vă opune prelucrării asupra datelor cu caracter personal de genul nume, prenume, adresă, informații referitoare la distribuția rețelelor în interiorul imobilului etc, nu vom mai putea fi în măsura continuării relațiilor contractuale.<br><br>

						<b>8) existenţa unui proces decizional automatizat incluzând crearea de profiluri, menţionat la articolul 22 alineatele (1) şi (4), precum şi, cel puţin în cazurile respective, informaţii pertinente privind logica utilizată şi privind importanţa şi consecinţele preconizate ale unei astfel de prelucrări pentru persoana vizată.</b><br>
						În cadrul activității operatorului NU există un proces decizional automatizat sau crearea de profiluri. <br><br>

						<b>9) În cazul în care operatorul intenţionează să prelucreze ulterior datele cu caracter personal într-un alt scop decât cel pentru care acestea au fost colectate, operatorul furnizează persoanei vizate, înainte de această prelucrare ulterioară, informaţii privind scopul secundar respectiv şi orice informaţii suplimentare relevante, în conformitate cu alineatul (2).</b><br>
						În măsura în care obligațiile legale NU impun o altă prelucrare, datele colectate NU vor fi prelucrate în alt scop decât cel menționat mai sus.<br><br>

					</p>
					
					<!-- <button type="submit" name="submit" id="submit" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">Trimite Cerere</button>	 -->


					<button type="submit" name="submit" id="submit" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px"  data-toggle="modal" data-target="#myModal2">Trimite Cerere</button>
			</form>
		</div>

	<?php
	}
	?>

<!--fe-->







	<!--cerere factura electronica -->
		<?php
		if (($page->p->slug) == "test") {

		if(isset($_POST['submit'])){
			//$to = "office@cupfocsani.ro"; // this is your Email address
            $to = "utilizator@cupfocsani.ro";
			$from = $_POST['email']; // this is the sender's Email address
			$name = $_POST['name'];
			$cod_client = $_POST['cod_client'];
			$adresa = $_POST['adresa'];
			$telefon = $_POST['telefon'];
			$email = $_POST['email'];
			$cnp = $_POST['cnp'];
			$factura_email = $_POST['factura_email'];
			$mesaj_sms = $_POST['trans_sms'];
            $mesaj_factura_email =  $_POST['trans_factura'];
			$subject = "Cerere Factura Format Electronic";
			$subject2 = "Copie Cerere Factura Format Electronic";


				if(isset($mesaj_factura_email)){
				$mesaj_factura_email = "DA";
				} else {
				$mesaj_factura_email = "NU";
				}

				if(isset($mesaj_sms )){
				$mesaj_sms = "DA";
				} else{
				$mesaj_sms = "NU"; 
				}

			$message2 = 'VA RUGAM SA NU DATI REPLY LA ACEST MESAJ';	
			
			$message =
			'Nume Client: ' . $name . "\n\n Cod Client: " . $cod_client . " \n\n Adresa punctului de consum: " . $adresa . "\n\n Telefon: " . $telefon . "\n\n Email: " . $email . "\n\n CNP: " . $cnp."\n\n ";
                        
			$message .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere factura pentru serviciile de apa si/sau canalizare pe adresa de e-mail: ' . $mesaj_factura_email."\n\n " ;
			
			$message .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia plătilor, a soldului debitor/creditor etc exclus mesaje de marketing): ' . $mesaj_sms."\n\n " ;	
			
			$message .= 'Am fost informat ca imi pot retrage consimtamantul oricand. Retragerea consimtamantului nu afecteaza legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia' . "\n\n " . '------------------------------------------------------------------------------------------------' . "\n\n " . 'Informare conform cu art. 13 din Regulamentul GDPR 679/2016' . "\n\n " . '1) identitatea si datele de contact ale operatorului:' . "\n " .
			'S.C. COMPANIA DE UTILITATI PUBLICE S.A. FOCSANI, str. N.Titulescu, Nr. 9, tel. 0237 226 401, e-mail secretariat@cupfocsani.ro' . "\n\n " . '2) datele de contact ale responsabilului cu protectia datelor:' . "\n " . 'dpo@cupfocsani.ro, tel. 0237238531' . "\n\n " . '3) scopurile in care sunt prelucrate datele cu caracter personal, precum si temeiul juridic al prelucrarii:' . "\n " . 'scop 1. transmiterea facturii pentru serviciile de apa si/sau canalizare pe adresa de e-mail' . "\n " . 'scop 2. transmiterii de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia platilor, exclus mesaje de marketing). Temeiul juridic al prelucrarii il reprezinta:' . "\n " . '- executarea Contractului pentru serviciile de apa si canalizare la care persoana vizata este parte' . "\n " . '- interesul legitim urmarit de operator pentru care s-a facut Evaluarea interesului legitim. Interesul legitim este reprezentat de transmiterea facturilor cat mai rapid, in siguranta si avand costuri scazute catre utilizatori. Un alt interes legitim este reprezentat de informarea in timp real a utilizatorilor despre aparitia unor avarii pe reteaua publica sau despre situatia facturilor emise, a soldului debitor/creditor etc.' . "\n\n " . '4) destinatarii sau categoriile de destinatari ai datelor cu caracter personal' . "\n " .
			'Personalul CUP Focsani care are sarcini de serviciu sa prelucreze aceste date cu caracter personal, institutiile statului care in baza legii pot solicita aceste date, iar operatorul este obligat sa le transmita' . "\n\n " . '5) perioada pentru care vor fi stocate datele cu caracter personal sau, daca acest lucru nu este posibil, criteriile utilizate pentru a stabili aceasta perioada;' . "\n " . 'Datele sunt stocate pe toata perioada contractuala sau pana cand utilizatorul isi exercita dreptul de stergere (pentru datele care pot fi sterse) al lor.' . "\n\n " . '6) aveti dreptul de a solicita operatorului, rectificarea sau stergerea datelor sau restrictionarea prelucrarii sau dreptul de a va opune prelucrarii, precum si dreptul la portabilitatea datelor; atunci cand prelucrarea se bazeaza pe articolul 6 alineatul (1) litera (a) sau pe articolul 9 alineatul (2) litera (a), aveti dreptului de va retrage consimtamantul in orice moment, fara a afecta legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia; aveti <b>dreptul de a depune o plangere in fata unei autoritati de supraveghere;' . "\n\n " . '7) daca furnizarea de date cu caracter personal reprezinta o obligatie legala sau contractuala sau o obligatie necesara pentru incheierea unui contract, precum si daca persoana vizata este obligata sa furnizeze aceste date cu caracter personal si care sunt eventualele consecinte ale nerespectarii acestei obligatii;' . "\n " . 'In situatia in care va exercitati dreptul de stergere sau dreptul de a va opune prelucrarii asupra datelor cu caracter personal de genul nume, prenume, adresa, informatii referitoare la distributia retelelor in interiorul imobilului etc, nu vom mai putea fi masura continuarii relatiilor contractuale.' . "\n\n " . '8) existenta unui proces decizional automatizat incluzand crearea de profiluri, mentionat la articolul 22 alineatele (1) si (4), precum si, cel putin in cazurile respective, informatii pertinente privind logica utilizata si privind importanta si consecintele preconizate ale unei astfel de prelucrari pentru persoana vizata.' . "\n" . 'În cadrul activitatii operatorului NU exista un proces decizional automatizat sau crearea de profiluri.' . "\n\n " . '9) In cazul in care operatorul intentioneaza sa prelucreze ulterior datele cu caracter personal intr-un alt scop decat cel pentru care acestea au fost colectate, operatorul furnizeaza persoanei vizate, inainte de aceasta prelucrare ulterioara, informatii privind scopul secundar respectiv si orice informatii suplimentare relevante, in conformitate cu alineatul (2).' . "\n " . 'In masura in care obligatiile legale NU impun o alta prelucrare, datele colectate NU vor fi prelucrate in alt scop decat cel mentionat mai sus.' . "\n "  ;


			$message2 = "Aceasta este o copie a mesajului " . "\n\n" . "VA RUGAM SA NU DATI REPLY LA ACEST MESAJ" . "\n\n" .' Nume Client: ' . $name . "\n Cod Client: " . $cod_client . " \n Adresa punctului de consum: " . $adresa . "\n Telefon: " . $telefon . "\n Email: " . $email . "\n CNP: " . $cnp . "\n\n Selectie: " . $factura_email . "\n\n " ;
			
			$message2 .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere factura pentru serviciile de apa si/sau canalizare pe adresa de e-mail: ' . $mesaj_factura_email."\n\n " ;
			
			$message2 .= 'Imi exprim CONSIMTAMANTUL pentru prelucrarea datelor cu caracter personal mentionate mai sus de catre operatorul CUP Focsani in scopul:' . "\n\n " . 'Transmitere de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia plătilor, a soldului debitor/creditor etc exclus mesaje de marketing): ' . $mesaj_sms."\n\n " ;

			$message2 .= 'Am fost informat ca imi pot retrage consimtamantul oricand. Retragerea consimtamantului nu afecteaza legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia' . "\n\n " . 'Informare conform cu art. 13 din Regulamentul GDPR 679/2016' . "\n\n " . '1) identitatea si datele de contact ale operatorului:' . "\n " .
			'S.C. COMPANIA DE UTILITATI PUBLICE S.A. FOCSANI, str. N.Titulescu, Nr. 9, tel. 0237 226 401, e-mail secretariat@cupfocsani.ro' . "\n\n " . '2) datele de contact ale responsabilului cu protectia datelor:' . "\n " . 'dpo@cupfocsani.ro, tel. 0237238531' . "\n\n " . '3) scopurile in care sunt prelucrate datele cu caracter personal, precum si temeiul juridic al prelucrarii:' . "\n " . 'scop 1. transmiterea facturii pentru serviciile de apa si/sau canalizare pe adresa de e-mail' . "\n " . 'scop 2. transmiterii de mesaje tip SMS referitoare la serviciile de apa si canalizare (avarii, lucrari programate, situatia platilor, exclus mesaje de marketing). Temeiul juridic al prelucrarii il reprezinta:' . "\n " . '- executarea Contractului pentru serviciile de apa si canalizare la care persoana vizata este parte' . "\n " . '- interesul legitim urmarit de operator pentru care s-a facut Evaluarea interesului legitim. Interesul legitim este reprezentat de transmiterea facturilor cat mai rapid, in siguranta si avand costuri scazute catre utilizatori. Un alt interes legitim este reprezentat de informarea in timp real a utilizatorilor despre aparitia unor avarii pe reteaua publica sau despre situatia facturilor emise, a soldului debitor/creditor etc.' . "\n\n " . '4) destinatarii sau categoriile de destinatari ai datelor cu caracter personal' . "\n " .
			'Personalul CUP Focsani care are sarcini de serviciu sa prelucreze aceste date cu caracter personal, institutiile statului care in baza legii pot solicita aceste date, iar operatorul este obligat sa le transmita' . "\n\n " . '5) perioada pentru care vor fi stocate datele cu caracter personal sau, daca acest lucru nu este posibil, criteriile utilizate pentru a stabili aceasta perioada;' . "\n " . 'Datele sunt stocate pe toata perioada contractuala sau pana cand utilizatorul isi exercita dreptul de stergere (pentru datele care pot fi sterse) al lor.' . "\n\n " . '6) aveti dreptul de a solicita operatorului, rectificarea sau stergerea datelor sau restrictionarea prelucrarii sau dreptul de a va opune prelucrarii, precum si dreptul la portabilitatea datelor; atunci cand prelucrarea se bazeaza pe articolul 6 alineatul (1) litera (a) sau pe articolul 9 alineatul (2) litera (a), aveti dreptului de va retrage consimtamantul in orice moment, fara a afecta legalitatea prelucrarii efectuate pe baza consimtamantului inainte de retragerea acestuia; aveti <b>dreptul de a depune o plangere in fata unei autoritati de supraveghere;' . "\n\n " . '7) daca furnizarea de date cu caracter personal reprezinta o obligatie legala sau contractuala sau o obligatie necesara pentru incheierea unui contract, precum si daca persoana vizata este obligata sa furnizeze aceste date cu caracter personal si care sunt eventualele consecinte ale nerespectarii acestei obligatii;' . "\n " . 'In situatia in care va exercitati dreptul de stergere sau dreptul de a va opune prelucrarii asupra datelor cu caracter personal de genul nume, prenume, adresa, informatii referitoare la distributia retelelor in interiorul imobilului etc, nu vom mai putea fi masura continuarii relatiilor contractuale.' . "\n\n " . '8) existenta unui proces decizional automatizat incluzand crearea de profiluri, mentionat la articolul 22 alineatele (1) si (4), precum si, cel putin in cazurile respective, informatii pertinente privind logica utilizata si privind importanta si consecintele preconizate ale unei astfel de prelucrari pentru persoana vizata.' . "\n" . 'În cadrul activitatii operatorului NU exista un proces decizional automatizat sau crearea de profiluri.' . "\n\n " . '9) In cazul in care operatorul intentioneaza sa prelucreze ulterior datele cu caracter personal intr-un alt scop decat cel pentru care acestea au fost colectate, operatorul furnizeaza persoanei vizate, inainte de aceasta prelucrare ulterioara, informatii privind scopul secundar respectiv si orice informatii suplimentare relevante, in conformitate cu alineatul (2).' . "\n " . 'In masura in care obligatiile legale NU impun o alta prelucrare, datele colectate NU vor fi prelucrate in alt scop decat cel mentionat mai sus.' . "\n "  ;


			$headers = "De la:" . $from;
			$headers2 = "De la:" . $to;
			mail($to,$subject,$message,$headers);
			mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
			echo '<h3 style="background-color: red; color: #fff; padding: 10px; text-align: center; " id="#cerere-trimisa">Cererea a fost trimisa ' . $first_name . '. Multumim!</h3>';
			// You can also use header('Location: thank_you.php'); to redirect to another page.
			}
		?>


		<div class="col-lg-12 col-md-12">
			<form name="" id="factura_electronica_form" method="post" action="">
				<h4 class="text-center">
					SOLICITARE EMITERE FACTURĂ ELECTRONICĂ
				</h4>

				<p class="opacity-7 margin-bottom-20px"></p>
				<p class="opacity-7">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span> <b>Nume, Prenume / Denumire</b></label>
							<input type="text" class="form-control" id="inputName" placeholder="Nume, Prenume / Denumire" name="name" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputAddress"><span class="fa fa-star fa-xs" style="color:red;"></span><b>Adresa punctului de consum</b></label>
							<input type="text" class="form-control" id="inputAddress" placeholder="Adresa punctului de consum" name="adresa">
						</div>
						<div class="form-group col-md-6">
							<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span><b>Cod client</b></label>
							<input type="text" class="form-control" id="inputName4" placeholder="Completati codul client de pe factura" name="cod_client" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputAddress"><b>Telefon mobil</b></label>
							<input type="text" class="form-control" id="inputPhone" placeholder="Introduceți nr. telefon" name="telefon">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4"><span class="fa fa-star fa-xs" style="color:red;"></span> <b>Email</b></label>
							<input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="inputCNP"><span class="fa fa-star fa-xs" style="color:red;"></span> <b>CNP / CIF</b> (vă solicităm CNP-ul / CIF pentru a fi siguri că solicitantul este și utilizatorul serviciilor asigurate de operator)</label>
							<input type="text" class="form-control" id="inputCNP" name="cnp" placeholder="CNP / CIF" required>
						</div>
					</div>
					<p>
						<label style="margin: 10px 0 10px;"><span class="fa fa-star fa-xs" style="color:red;"></span> Câmp obligatoriu</label><br>
						<input type="submit" name="submit" value="Trimitere" style="display:none" id="factura_electronica_submit" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">
					</p>

					<p style="text-align: justify">
						îmi exprim <b>CONSIMTĂMÂNTUL</b> pentru prelucrarea datelor cu caracter personal menționate mai sus de către operatorul CUP Focșani în <b>scopurile</b>:<br />

						<div><b style="color: red">Bifați scopul (urile) dorit (e)</b></div>
						<div class="ml-30">
							<input type="checkbox" id="trans_factura" name="trans_factura" value="factura_email" required>
							<label for="factura_email"> <b>transmiterii facturii pentru serviciile de apă și/sau canalizare pe adresa de e-mail</b>;</label>
							<hr>

							<input type="checkbox" id="trans_sms" name="trans_sms" value="mesaj_sms">
							<label for="mesaj_sms"> <b>transmiterii de mesaje tip SMS referitoare la serviciile de apă și canalizare (avarii, lucrări <br>programate, situația plăților, a soldului debitor/creditor etc, exclus mesaje de marketing)</b>.</label>
						</div>
						
						<br>

						Am fost informat că îmi pot retrage consimțământul oricând. Retragerea consimțământului nu afectează legalitatea prelucrării efectuate pe baza consimțământului înainte de retragerea acestuia.<br /><br />

						Informare conform art. 13 din Regulamentul GDPR 679/2016<br /><br />

						<b>1) identitatea şi datele de contact ale operatorului:</b><br />
						COMPANIA DE UTILITĂȚI PUBLICE S.A. FOCȘANI, str. N.Titulescu nr. 9, tel. 0237 226 401, e-mail <a href="mailto:secretariat@cupfocsani.ro">secretariat@cupfocsani.ro</a><br /><br />

						<b>2) datele de contact ale responsabilului cu protecţia datelor:</b><br />
						<a href="mailto:dpo@cupfocsani.ro">dpo@cupfocsani.ro</a>, tel. <a href="tel:0237238531">0237 238 531</a><br /><br />

						<b>3) scopurile în care sunt prelucrate datele cu caracter personal, precum şi temeiul juridic al prelucrării:</b><br>
						scop 1. transmiterea facturii pentru serviciile de apă și/sau canalizare pe adresa de e-mail<br>
						scop 2. transmiterii de mesaje tip SMS referitoare la serviciile de apă și canalizare (avarii, lucrări programate, situația plăților, exclus mesaje de marketing).
						Temeiul juridic al prelucrării îl reprezintă:<br>
						<div class="ml-30">
							-	executarea Contractului pentru serviciile de apă și canalizare la care persoana vizată este parte<br>
							-	interesul legitim urmărit de operator pentru care s-a făcut Evaluarea interesului legitim. Interesul legitim este reprezentat de transmiterea facturilor cât mai rapid, în siguranță și având costuri scăzute către utilizatori. Un alt interes legitim este reprezentat de informarea în timp real a utilizatorilor despre apariția unor avarii pe rețeaua publică sau despre situația facturilor emise, a soldului debitor/creditor etc.
						</div> <br>

						<b>4) destinatarii sau categoriile de destinatari ai datelor cu caracter personal</b><br>
						Personalul CUP Focșani care are sarcini de serviciu să prelucreze aceste date cu caracter personal, instituțiile statului care în baza legii pot solicita aceste date iar operatorul este obligat să le transmită.<br><br>

						<b>5) perioada pentru care vor fi stocate datele cu caracter personal sau, dacă acest lucru nu este posibil, criteriile utilizate pentru a stabili această perioadă;</b><br>
						Datele sunt stocate pe toată perioada contractuală sau până când utilizatorul își exercită dreptul de ștergere (pentru datele care pot fi șterse) al lor.<br><br>

						<b>6)</b> aveți <b>dreptul</b> de a solicita operatorului, <b>rectificarea</b> sau <b>ştergerea</b> datelor sau <b>restricţionarea prelucrării</b> sau dreptul de a vă <b>opune prelucrării</b>, precum şi dreptul la <b>portabilitatea</b> datelor; atunci când prelucrarea se bazează pe articolul 6 alineatul (1) litera (a) sau pe articolul 9 alineatul (2) litera (a), aveți dreptului de vă <b>retrage consimţământul</b> în orice moment, fără a afecta legalitatea prelucrării efectuate pe baza consimţământului înainte de retragerea acestuia; aveți <b>dreptul de a depune o plângere</b> în faţa unei autorităţi de supraveghere; <br><br>

						<b>7) dacă furnizarea de date cu caracter personal reprezintă o obligaţie legală sau contractuală sau o obligaţie necesară pentru încheierea unui contract, precum şi dacă persoana vizată este obligată să furnizeze aceste date cu caracter personal şi care sunt eventualele consecinţe ale nerespectării acestei obligaţii; </b><br>
						În situația în care vă exercitați dreptul de ștergere sau dreptul de a vă opune prelucrării asupra datelor cu caracter personal de genul nume, prenume, adresă, informații referitoare la distribuția rețelelor în interiorul imobilului etc, nu vom mai putea fi în măsura continuării relațiilor contractuale.<br><br>

						<b>8) existenţa unui proces decizional automatizat incluzând crearea de profiluri, menţionat la articolul 22 alineatele (1) şi (4), precum şi, cel puţin în cazurile respective, informaţii pertinente privind logica utilizată şi privind importanţa şi consecinţele preconizate ale unei astfel de prelucrări pentru persoana vizată.</b><br>
						În cadrul activității operatorului NU există un proces decizional automatizat sau crearea de profiluri. <br><br>

						<b>9) În cazul în care operatorul intenţionează să prelucreze ulterior datele cu caracter personal într-un alt scop decât cel pentru care acestea au fost colectate, operatorul furnizează persoanei vizate, înainte de această prelucrare ulterioară, informaţii privind scopul secundar respectiv şi orice informaţii suplimentare relevante, în conformitate cu alineatul (2).</b><br>
						În măsura în care obligațiile legale NU impun o altă prelucrare, datele colectate NU vor fi prelucrate în alt scop decât cel menționat mai sus.<br><br>

					</p>
					
					<button type="button" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px" data-toggle="modal" data-target="#myModal2">Trimite Cerere</button>


				

			</form>
		</div>
	</div>


	<?php
	}
	?>


<!--cerere factura electronica-->



<script>
	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();
	});

	jQuery('#buletine-table, #apa-meteorica-table').DataTable({
		paging: true,
		responsive: true,
		order: [],
	});


	if ( window.history.replaceState ) {
	  window.history.replaceState( null, null, window.location.href );
	}
</script>		