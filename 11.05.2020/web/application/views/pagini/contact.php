
<?php
if(strlen($company->adresa_pl) > 5) {

  $makeadr = $company->adresa_pl .', '. $company->adresa_plloc. ', ' .$company->adresa_pljud;

} else {

  $makeadr = $company->adresa_ss .', '. $company->adresa_ssloc. ', ' .$company->adresa_ssjud;

}
?>

 <div id="mySidenav" class="sidenav">
  <a href="<?=base_url()?>/mobilpay/index.php" class="online">
  	<i class="fa fa-credit-card padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Plateste online
  </a>
  <a href="<?=base_url()?>intrebari_frecvente" class="info">
  	<i class="fa fa-info-circle padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Informatii utile
  </a>
  <a href="<?=base_url()?>p/factura-in-format-electronic" class="factura">
  	<i class="fa fa-file-pdf-o padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Factura electronica
  </a>

  <a href="<?=base_url()?>contact" class="dispecerat">
  	<i class="fa fa-phone-square padding-icon fa-2x pull-left" aria-hidden="true"></i>
  	Dispecerat
  </a>
</div>


<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11146.232418862419!2d27.171048198980884!3d45.699839404251335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b4189f8c8c94cd%3A0x6b6fc38c024dc11e!2sSC+CUP+SA!5e0!3m2!1sro!2sro!4v1551789615090" width="100%" height="450" frameborder="0" style="border:0" zoom="8" allowfullscreen></iframe>


<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="alert alert-success" role="alert">
				  <h1 class="text-center">Tel. verde: <a href="tel:<?=$company->telefon_mobil?>"  style="color:#246332; "><?=$company->telefon_mobil?></a></h1>
				</div>
			</div>
		</div>
	</div>
</section>		
<section>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="text-center padding-tb-50px">Date contact</h1>
			</div>
			<div class="col-sm-4" style="line-height: 250%">


				<span class="d-block"><i class="fa fa-building text-main-color margin-right-10px" aria-hidden="true"></i> <strong><?=$owner->company?></strong></span>

				<?php if(!empty($company->telefon_fix)): ?>

				<span class="d-block">
					<i class="fa fa-phone text-main-color margin-right-10px" aria-hidden="true"></i>
				 	Dispecerat: <a href="tel:<?=$company->telefon_fix?>"><strong><?=$company->telefon_fix?></strong></a>
				 </span>
				<?php endif; ?>

				<span class="d-block">
					<i class="fa fa-phone text-main-color margin-right-10px" aria-hidden="true"></i>
				 	Relatii cu publicul: <a href="tel:0237 238 531"><strong>+40 237 238 531</strong></a>
				 </span>

				<?php if(!empty($company->telefon_mobil)): ?>
				<span class="d-block">
					<i class="fa fa-mobile text-main-color margin-right-10px" aria-hidden="true"></i>
					Tel verde: <a href="tel:<?=$company->telefon_mobil?>"><strong><?=$company->telefon_mobil?></strong></a>
				</span>
				<?php endif; ?>
				<!-- <h5 class="margin-top-20px">Adresa :</h5> -->
				<span class="d-block">
					<i class="fa fa-map text-main-color margin-right-10px" aria-hidden="true"></i>Adresa:  <strong><?=$makeadr?></strong>
				</span>
				<!-- <h5 class="margin-top-20px">Email :</h5> -->
				<span class="d-block">
					<i class="fa fa-envelope-open text-main-color margin-right-10px" aria-hidden="true"></i>
					Email: <a href="mailto:<?=$owner->oemail?>?Subject=Mesaj din Website: "><strong><?=$owner->oemail?></strong> </a>
				</span>
				<!-- <h5 class="margin-top-20px">Web :</h5> -->
				<span class="d-block">
					<i class="fa fa-globe text-main-color margin-right-10px" aria-hidden="true"></i>
					Website: <strong><?=$owner->website?></strong>
				</span>
			</div>

			<div class="col-sm-8">
				<?=$page->p->{'content_'.$site_lang}?>
			</div>

		</div>

		<div>
			<h3 class="text-center mt-150px">Sucursale</h3>
			<div class="row margin-top-30px">
				<?php foreach($sucursale as $key=>$s){?>
				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<span class="d-block"><i class="fa fa-building text-main-color margin-right-10px" aria-hidden="true"></i> <strong><?=$s->atom_name_ro?></strong></span>
					<p>
						<ul>
							<?php if(!empty($s->pers_contact_suc)){?>
							<li>
								<i class="fa fa-user text-main-color margin-right-10px" aria-hidden="true"></i>
								<?=$s->pers_contact_suc?>
							</li>
							<?php }?>
							<?php if(!empty($s->adresa_suc)){?>
							<li>
								<i class="fa fa-map text-main-color margin-right-10px" aria-hidden="true"></i>
								<?=$s->adresa_suc?>
							</li>
								<?php }?>
							<?php if(!empty($s->email_suc)){?>
							<li>
								<i class="fa fa-envelope-open text-main-color margin-right-10px" aria-hidden="true"></i>
								<a href="mailto:<?=$s->email_suc?>"><?=$s->email_suc?> </a>
							</li>
								<?php }?>
							<?php if(!empty($s->tel_fix_suc)){?>
							<li>
								<i class="fa fa-phone text-main-color margin-right-10px" aria-hidden="true"></i>
								<a href="tel:<?=$s->tel_fix_suc?>"><?=$s->tel_fix_suc?> </a>
							</li>
							<?php }?>
							<?php if(!empty($s->tel_mob_suc)){?>
								<li>
									<i class="fa fa-phone text-main-color margin-right-10px" aria-hidden="true"></i>
									<a href="tel:<?=$s->tel_mob_suc?>"><?=$s->tel_mob_suc?></a>
								</li>
							<?php }?>
						</ul>
					</p>
				</div>
				<?php } ?>
			</div>
		</div>
	<hr>
		<div class="row padding-tb-50px">
			<div class="col-lg-12 col-md-12">
				<h3 class="text-center">Formular contact</h3>
				<?=(!is_null($form->item->error) ? '<span style="color:red;font-weight:bold">' .$form->item->error. '</span>' : "")?>
				<?php if(is_null($form->item->success)): ?>



				<form name="<?=$form->item->name?>" id="<?=$form->item->id?>" method="post" action="<?=base_url().$form->item->segments?>">

					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="Subject"><span class="fa fa-star fa-xs" style="color:red;"></span> Subiect</label>
							<input type="text" class="form-control" name="cf-subject" id="inputSubject" placeholder="Subiect" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputName"><span class="fa fa-star fa-xs" style="color:red;"></span> Nume / Prenume | Companie</label>
							<input type="text" class="form-control" name="cf-name" id="inputName4" placeholder="Nume / Prenume | Companie" required>
						</div>
						<div class="form-group col-md-6">
							<label for="inputAddress"><span class="fa fa-star fa-xs" style="color:red;"></span> Adresa</label>
							<input type="text" class="form-control" id="inputAddress" name="cf-address" placeholder="introdu adresa" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="inputAddress"> Telefon</label>
							<input type="number" class="form-control" name="cf-phone" id="inputPhone" placeholder="introdu telefon">
						</div>
						<div class="form-group col-md-6">
							<label for="inputEmail4"> Email</label>
							<input type="email" class="form-control" name="cf-email" id="inputEmail" placeholder="Email" >
						</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1"><span class="fa fa-star fa-xs" style="color: red;"></span> Mesaj</label>
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="cf-message"></textarea>
					</div>

					<div class="form-group text-center">
						<?=(!is_null($form->item->error) ? '<span style="color:red; font-weight:bold">' .$form->item->error. '</span>' : "")?>
						<div class="col-sm-12">
							<input type="text" class="form-control" name="captcha" value="" placeholder="introduceti codul de mai sus" id="captcha" required>
						</div>
					</div>

					<div class="form-row">
						<span>
							<input type="checkbox" name="GDPR" id="gdpr-cons" required>
							Am fost informat despre <strong><a href="<?=SITE_URL?>p/politica-de-confidentialitate">Politica de confidentialitate a operatorului</a></strong> si consimt ca datele mele cu caracter personal scrise mai sus sa fie prelucrate de operator in scopul solutionarii aspectelor  transmise prin formularul de contact sau pentru primirea informatiilor de interes public referitoare la asigurarea serviciilor de utilitati publice.

							<hr/>
							
							<input type="checkbox" name="faq" id="faq" required> Sunt de acord cu Termeni si Conditii
						</span>
					</div>

						<label><br/><span class="fa fa-star fa-xs" style="color:red;"></span> Camp-uri obligatoriu</label><br>

					<button type="submit" name="cf-submit" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px">Trimite</button>
				</form>



				<?php endif; ?>
				<?php if(!is_null($form->item->success)): ?>
					<h1 style="text-align:center;margin:100px;"><?=$form->item->success?></h1>
				<?php endif;?>
			</div>
		</div>
	</div>

</section>