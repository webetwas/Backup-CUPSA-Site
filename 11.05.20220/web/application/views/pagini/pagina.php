<?php
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
<div class="col-lg-<?= ($page->s->left_sidebar ? '8' : '12') ?> col-md-<?= ($page->s->left_sidebar ? '8' : '12') ?> sticky-content">

	<?php if (!empty($page->p->{'title_content_' . $site_lang}) || !empty($page->p->{'content_' . $site_lang}) || $page->i) : ?>
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
										for ($i = ($current_year - 10); $i <= ($current_year); $i++) {
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
						<table class="table">
							<thead>
								<tr>
									<th>Denumire buletin</th>
									<th>an</th>
									<th>luna</th>
									<th>PDF</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($buletine as $b) { ?>
									<tr>

										<td><?= $b->{'atom_name_' . $site_lang} ?></td>

										<?php if (!(is_null($b->pdf_name))) { ?>
											<td>an</td>
											<td>luna</td>
											<td>
												<a href="/public/upload/documents/buletine_meteo/<?= $b->pdf_file ?>" target="_blank">
													<i class="fa fa-file-pdf-o"></i> <?= $b->pdf_name ?>
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


			<!-- // post -->
		<?php endif; ?>


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
						<!--<h1 style="text-align:center;margin-bottom:10px;text-decoration:underline;"><?= $cat->nume; ?></h1> -->
						<table class="table table-hover table-bordered" style="margin-bottom:3rem;">
							<!--<thead style="background-color:#F5F5F6;">
                          																																																																																						<tr class="font-weight text-center">
                            																																																																																						<th>#</th>
                            																																																																																						<th>Nume & Prenume</th>
                            																																																																																						<th>Functia detinuta</th>
                            																																																																																						<th>CV</th>
                          																																																																																						</tr>
                        																																																																																						</thead> -->

							<thead>
								<tr>
									<td>xxx</td>
								</tr>
							</thead>
							<tbody>
								<?php
								$nr_item = 1;
								foreach ($this->_Object->msqlGetAll('structura_manageriala', array('id_info' => $cat->id_item)) as $item) {
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
					<!--<h1 style="text-align:center;margin-bottom:10px;text-decoration:underline;">Declaratii Avere & Interes</h1> -->
					<table class="table table-hover">
						<!-- <thead style="background-color:#F5F5F6;">
																		<tr class="font-weight text-center">
																				<th>#</th>
																				<th>Nume & Prenume</th>
																				<th>Functia detinuta</th>
																				<th colspan="4">Conformare la normele legale in vigoare aplicabile</th>

																				<th width="15%" colspan="2">Declaratie Avere</th>
																				<th width="15%" colspan="2">Declaratie Interes</th>
																			</tr>
																			<tr style="font-weight:bold;color:blue;">
																				<th></th>
																				<th></th>
																				<th></th>
																																											<?php
																																											for ($i = 2019; $i <= date("Y"); $i++) {
																																												?>
                            																																																																																						<th colspan="1"><?= $i; ?></th>
																																											<?php
																																											}
																																											for ($i = 2019; $i <= date("Y"); $i++) {
																																												?>
                            																																																																																						<th colspan="1"><?= $i; ?></th>
																																											<?php
																																											}
																																											?>
                          																																											</tr>
                        																																											</thead> -->
						<tbody>
							<?php
							$nr_item = 1;
							foreach ($lista_declaratii as $item) {
								?>
								<tr>
									<td><?= $nr_item; ?></td>
									<td><?= $item->nume . ' ' . $item->prenume; ?></td>
									<td><?= $item->functie; ?></td>
									<?php
									for ($i = 2019; $i <= 2019; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_avere_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de avere ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_avere_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
									<?php
									}
									?>
									<?php
									for ($i = 2019; $i <= 2019; $i++) {
										?>
										<td class="text-navy"><?= (!empty($item->{'pdf_decl_interes_' . $i})) ? '<a data-toggle="tooltip" title="Declaratie de interes ' . $i . '" href="' . SITE_URL . PATH_DECLARATII_AVERE . $item->{'pdf_decl_interes_' . $i} . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
									<?php
									}
									?>
									<td class="text-navy"><?= (!empty($item->cv_pdf)) ? '<a data-toggle="tooltip" title="CV" href="' . SITE_URL . PATH_DECLARATII_AVERE . 'cv_folder/' . $item->cv_pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : ''; ?></td>
								</tr>
								<?php
								++$nr_item;
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
																<a 
																href="
																<?php echo SITE_URL ."/public/upload/documents/sitfinanciare/".$pdf->pdf_file ?>" 
																target="_blank">
																<i class="fa fa-file-pdf-o"></i>
																<?= $pdf->name?>
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



		<?php	} ?>
	</div>




	<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>