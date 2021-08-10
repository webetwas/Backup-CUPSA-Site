
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




	<div class="container">
		<div class="row">


			<div class="col-sm-8">
				<?=$page->p->{'content_'.$site_lang}?>

			</div>

		</div>

	<hr	>	<div class="row padding-tb-50px">
			<div class="col-lg-12 col-md-12">
				<h3 class="text-center">Cerere pentru exercitarea dreptului de acces</h3>
				<?=(!is_null($form->item->error) ? '<span style="color:red;font-weight:bold">' .$form->item->error. '</span>' : "")?>
				<?php if(is_null($form->item->success)): ?>








				<form name="<?=$form->item->name?>" id="<?=$form->item->id?>" method="post" action="<?=base_url().$form->item->segments?>">
					<div class="form-row">
						<div class="form-group col-md-12">
							<label for="Subject"><span class="fa fa-star fa-xs" style="color:red;"></span> Subiect</label>
							<input type="text" class="form-control" name="cf-subject" id="subject" placeholder="Subiect" required>
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
						<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
							Am fost informat despre <strong class="padding-15px"><a href="<?=SITE_URL?>p/politica-de-confidentialitate">Politica de consiferntialitate a operatorului</a></strong> <strong>si consimt</strong> ca datele mele cu caracter personal scrise mai sus sa fie prelucrate de operator in scopul solutionarii aspectelor  transmise prin formularul de contact sau pentru primirea informatiilor de interes public referitoare la asigurarea serviciilor de utilitati publice.

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