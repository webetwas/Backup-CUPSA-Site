<?php
// var_dump($p_acasa);
// var_dump($texte_diverse_prima_pagina);
?>
<style>
	.row {
		margin: 0;
	}
</style>

<style>
	.shortcut {
		border: solid 1px #f2f2f2;
		min-height: 250px;
		/* margin-left:10px; */
		border-radius: 10px;
		margin-bottom: 20px;
	}

	.col-green h3 {
		color: #4caf50;
		padding: 5px 0 5px 0;
		text-align: center;
	}

	.col-green p {
		text-align: center;
		line-height: 80px;
	}

	.col-green:hover {
		-moz-box-shadow: 0px 4px 32px #4c7ca1;
		-webkit-box-shadow: 0px 4px 32px #4c7ca1;
		box-shadow: 0px 4px 32px #4c7ca1;
		border-radius: 10px;
	}


	.col-blue:hover {
		-moz-box-shadow: 0px 4px 32px #4c7ca1;
		-webkit-box-shadow: 0px 4px 32px #4c7ca1;
		box-shadow: 0px 4px 32px #4c7ca1;
		border-radius: 10px;
	}

	.col-blue h3 {
		color: #2196f3;
		padding: 5px 0 5px 0;
		text-align: center;
	}

	.col-blue p {
		text-align: center;
		line-height: 80px;
	}

	.col-red:hover {
		-moz-box-shadow: 0px 4px 32px #4c7ca1;
		-webkit-box-shadow: 0px 4px 32px #4c7ca1;
		box-shadow: 0px 4px 32px #4c7ca1;
		border-radius: 10px;
	}

	.col-red h3 {
		color: #f44336;
		padding: 5px 0 5px 0;
		text-align: center;
	}

	.col-red p {
		text-align: center;
		line-height: 80px;
	}


	.col-grey:hover {
		-moz-box-shadow: 0px 4px 32px #4c7ca1;
		-webkit-box-shadow: 0px 4px 32px #4c7ca1;
		box-shadow: 0px 4px 32px #4c7ca1;
		border-radius: 10px;
	}

	.col-grey h3 {
		color: #999999;
		padding: 5px 0 5px 0;
		text-align: center;
	}

	.col-grey p {
		text-align: center;
		line-height: 80px;
	}

	.my-alert{
		/*border-left:solid 3px #5090c7;*/
		border-right: solid 1px #f2f2f2;
		border-top: solid 1px #f2f2f2;
		border-bottom: solid 1px #f2f2f2;
		margin-bottom: 10px;

	}

	.my-alert:hover{
		-moz-box-shadow: 0px 4px 32px #4c7ca1;
		-webkit-box-shadow: 0px 4px 32px #4c7ca1;
		box-shadow: 0px 4px 32px #4c7ca1;
		border-radius: 10px;
	}

	.intelegem{
		/*border-left:solid 3px #5090c7;*/
		border-right: solid 1px #f2f2f2;
		border-top: solid 1px #f2f2f2;
		border-bottom: solid 1px #f2f2f2;
		margin-bottom: 10px;
	}

	.intelegem:hover{
		-moz-box-shadow: 0px 4px 32px #4c7ca1;
		-webkit-box-shadow: 0px 4px 32px #4c7ca1;
		box-shadow: 0px 4px 32px #4c7ca1;
		border-radius: 10px;
	}
	.detalii{
		margin: 5px 0 10px 0;
	}

	.justify{
		text-align: justify;
	}



	.collapsing-button {
		position: relative;
		color: #0864b2;
	}
	.collapsing-button[aria-expanded="true"]::after {
		content: '';
		position: absolute;
		display: block;
		height: 10px;
		width: 10px;
		left: calc( 50% - 7px );
		transform: rotate(-135deg);
		border-right: 2px solid #0864b2;
		border-bottom: 2px solid #0864b2;
		border-left: 0;
		border-top: 0;
		transition: all .2s linear;
	}
	.collapsing-button[aria-expanded="false"]::after {
		content: '';
		position: absolute;
		display: block;
		height: 10px;
		width: 10px;
		left: calc( 50% - 7px );
		transform: rotate(45deg);
		border-right: 2px solid #0864b2;
		border-bottom: 2px solid #0864b2;
		border-left: 0;
		border-top: 0;
		transition: all .2s linear;
	}
	.widget {
		padding: 30px 30px 13px;
	}

	.b-radius-10 {
		border-radius: 10px;
		margin-right: 10px;
		/* margin-left: -10px; */
		border: 1px solid #ccc;
	}

	.collapsing-button.boxes-home[aria-expanded="true"]::after {
		content: '';
		position: absolute;
		display: block;
		height: 10px;
		width: 10px;
		right: -21px;
    left: auto;
    top: 4px;
		transform: rotate(-135deg);
		border-right: 2px solid #0864b2;
		border-bottom: 2px solid #0864b2;
		border-left: 0;
		border-top: 0;
		transition: all .2s linear;
	}
	.collapsing-button.boxes-home[aria-expanded="false"]::after {
		content: '';
		position: absolute;
		display: block;
		height: 10px;
		width: 10px;
		right: -21px;
    left: auto;
    top: 4px;
		transform: rotate(45deg);
		border-right: 2px solid #0864b2;
		border-bottom: 2px solid #0864b2;
		border-left: 0;
		border-top: 0;
		transition: all .2s linear;
	}
	.box-image-service {
		display: block;
		padding-bottom: 200px;
		background-size: cover;
		background-position: center;
		background-repeat: no-repeat;
	}
</style>



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

<section class="operator-regio padding-tb-30px">
	<div class="container">
		<div class="row">
			<?php $page_acasa_image = false;
			if ($p_acasa->i) { }
			?>
			<div class="col-lg-<?= $p_acasa->i ? '6' : '12' ?> hidden text-center text-white" >
				<?php if ($p_acasa->i) : ?>
					<div class="padding-tb-100px z-index-2 position-relative js-equal-3 border-radius-10  background-overlay" <?= ($p_acasa->i ? 'style=" background-image: url(\'' . base_url() . 'public/upload/img/page/page/m/' . $p_acasa->i[0]->img . '\');' : '') ?>">
						<?php if (!empty($p_acasa->p->yt_link)) : ?>
							<a href="<?= $p_acasa->p->yt_link ?>" id="yt-preview"><img src="<?= base_url() ?>/public/assets/img/play-button-light.png" alt=""></a>
						<?php endif; ?>
						<h1 class="font-weight-700 margin-top-30px"><?= $p_acasa->p->yt_link_desc ?></h1>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-lg-<?= $p_acasa->i ? '6' : '12' ?>">
				<div class="js-equal-3">
					<h1 class="text-main-color margin-bottom-10px"><?= $p_acasa->p->{'title_content_' . $site_lang} ?></h1>
					<h2 class="margin-bottom-20px opacity-8"><?= $p_acasa->p->{'subtitle_content_' . $site_lang} ?></h2>
					<p class="opacity-7 margin-bottom-20px"><?= $p_acasa->p->{'content_' . $site_lang} ?></p>
					<a href="despre_noi" class="btn btn-md  border-2 border-radius-0  text-dark width-120px opacity-9"><?= ($site_lang == "en" ? 'Read more..' : 'Citește ...') ?></a>
				</div>
			</div>
		</div>
	</div>
</section>

 <section class="section-alerts">
	<div class="container">
	    <div class="row">
	    	<div class="col-lg-6 mb-3">
				<div class="alert-container my-alert p-3 b-radius-10 row">
					<div class="col-md-6 hidden-xs float-left">
						<a href="<?=base_url()?>contact"><div class="box-image-service" style="background-image: url('<?=base_url()?>web/public/upload/img/my-alert.jpg');"></div></a>
					</div>

					<div class="col-md-6 col-xs-12 float-right js-equal">
						<h3>Alertele mele</h3>
						<p class="justify">
							Pentru a veni în întâmpinarea nevoilor dumneavoastră, CUP SA Focșani vă poate anunța în timp real despre oprirea alimentării cu apă, cauzată de o avarie sau de o lucrare programată pe rețeaua publică.
							<br><a class="collapsing-button boxes-home" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Citeste mai mult</a>
						</p>
					</div>
					<div class="collapse" id="collapseExample">
						Singura condiție este ca dumneavoastră să ne puneți la dipoziție numărul de telefon mobil, astfel încât să vă putem trimite, cu ajutorul operatorului Netopia, respectivul mesaj de interes public.<br />
						<p class="pull-right"><a href="<?=base_url()?>contact" class="btn btn-md  border-2 border-radius-0  text-dark width-120px opacity-9">Detalii</a>.</p>
					</div>
				</div>
		    </div>

		    <div class="col-lg-6 mb-3">
				<div class="alert-container intelegem p-3 b-radius-10 row">
			        <div class="col-md-6 col-sm-6 hidden-xs float-left">
						<a href="<?=base_url()?>servicii"><div class="box-image-service" style="background-image: url('<?=base_url()?>web/public/upload/img/servicii.jpg');"></div></a>
			        </div>
			        <div class="col-md-6 col-sm-6 col-xs-12 float-right js-equal">
							<h3>Servicii</h3>
							<p class="justify">
								Serviciile de alimentare cu apă şi de canalizare cuprind totalitatea activităţilor de utilitate publică şi de interes economic şi social realizate în scopul captării, tratării, transportului, înmagazinării şi ...
								<br><a class="collapsing-button boxes-home" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample"> Citeste mai mult</a>
							</p>
					</div>
					<div class="collapse" id="collapseExample2">
						... distribuirii apei potabile tuturor utilizatorilor de pe teritoriul unei localităţi,respectiv pentru colectarea, transportul, epurarea şi evacuarea apelor uzate şi a apelor meteorice.
						<br />
						<p class="pull-right"><a href="<?=base_url()?>contact" class="btn btn-md  border-2 border-radius-0  text-dark width-120px opacity-9">Detalii</a>.</p>
					</div>
				</div>
		    </div>

		</div>
	</div>
</section>

<section class="shortcut-section padding-top-20px">
	<div class="container">
		<div class="row">
			<div class="col-6 col-lg-3">
				<div class="shortcut p-3 col-green">
					<h3 class="js-equal-2">Plata online cu cardul</h3>
					<p>
						<a href="<?= base_url() ?>mobilpay/index.php"><img src="<?= base_url() ?>web/public/upload/img/pay.png" alt=""><!-- </a> -->
					</p>
					<p>
						<a href="" class="btn btn-md border-2 border-radius-0 text-dark opacity-9">Plateste</a>
					</p>
				</div>

			</div>
			<div class="col-6 col-lg-3">
				<div class="shortcut p-3 col-blue">
					<h3 class="js-equal-2">Informatii utile</h3>
					<p>
						<a href="<?= base_url() ?>intrebari_frecvente"><img src="<?= base_url() ?>web/public/upload/img/info.png" alt=""></a>
					</p>
					<p>
						<a href="<?= base_url() ?>intrebari_frecvente" class="btn btn-md border-2 border-radius-0 text-dark opacity-9">Informatii</a>
					</p>
				</div>

			</div>
			<div class="col-6 col-lg-3">
				<div class="shortcut p-3 col-red">
					<h3 class="js-equal-2">Factura electronica</h3>
					<p>
						<a href="<?= base_url() ?>p/factura-in-format-electronic"><img src="<?= base_url() ?>web/public/upload/img/factura.png" alt=""></a>
					</p>
					<p>
						<a href="<?= base_url() ?>p/factura-in-format-electronic" class="btn btn-md border-2 border-radius-0  text-dark opacity-9">Factura</a>
					</p>
				</div>

			</div>
			<div class="col-6 col-lg-3">
				<div class="shortcut p-3 col-grey">
					<h3 class="js-equal-2">Dispecerat</h3>
					<p>
						<a href="<?= base_url() ?>contact"><img src="<?= base_url() ?>web/public/upload/img/dispecerat.png" alt=""></a>
					</p>
					<p>
						<a href="<?= base_url() ?>contact" class="btn btn-md border-2 border-radius-0 text-dark opacity-9">Dispecerat</a>
					</p>
				</div>

			</div>
		</div>
	</div>
</section>