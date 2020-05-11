<?php
// var_dump($site_lang);
?>
<style>
	.align{
		vertical-align: middle;
	}
/*
	.icon{
		margin: 0 10px;
	} */
	.just-a-box {
		display: table;
		height: 100%;
	}
	.just-a-box .unknown-el {
		display: table-cell;
		vertical-align: middle;
	}
	@media screen and (min-width: 1024px) {
		.no-pad-col {
			padding-right: 0;
		}
		.no-pad-col .just-a-box {
			padding-right: 0;
		}
	}

</style>

	<div class="padding-tb-5px position-relative" style="background-color:#5091c8;">
		<div class="container">
			<div class="row">
				<!-- <div class="col-xl-2 col-lg-3 d-lg-block">

					<div class="lang-dropdown dropdown show">
						<a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?=($site_lang == "en" ? '<span class="flag-icon flag-icon-us margin-right-8px"></span> English</a>' : '<span class="flag-icon flag-icon-ro margin-right-8px"></span> Romana')?>
	                    </a>

						<div class="dropdown-menu text-small" aria-labelledby="dropdownMenuLink">
							<a class="dropdown-item" href="<?=base_url()?>pagini/site_lang/<?=($site_lang == "ro" ? 'en' : 'ro')?>">
							<?=($site_lang == "ro" ? '<span class="flag-icon flag-icon-us margin-right-8px"></span> English' : '<span class="flag-icon flag-icon-ro margin-right-8px"></span> Romana')?>
							</a>
						</div>
					</div>

				</div> -->
				<div class="col-xl-3 col-lg-3 col-3 align align js-equal-8">
					<ul class="list-inline text-center margin-0px text-white pull-left just-a-box ">
						<?php if(!is_null($owner->facebook)): ?>
						<li class="list-inline-item unknown-el"><a class="facebook" href="<?=$owner->facebook?>" target="_blank"><i class="fa fa-facebook-square fa-3x"></i></a></li>
						<?php endif; ?>
						<?php if(!is_null($owner->youtube)): ?>
						<li class="list-inline-item"><a class="youtube" href="<?=$owner->youtube?>" target="_blank"><i class="fa fa-youtube fa-2x"></i></a></li>
						<?php endif; ?>
						<?php if(!is_null($owner->twitter)): ?>
						<li class="list-inline-item"><a class="twitter" href="<?=$owner->twitter?>" target="_blank"><i class="fa fa-twitter fa-2x"></i></a></li>
						<?php endif; ?>
					</ul>
					<!-- // Social -->
				</div>
				<div class="col-xl-6 col-lg-6 d-none d-xl-block js-equal-8">
					<div class="contact-info text-white text-center align">
						<!-- <span class="margin-right-10px"><?=($site_lang == "en" ? 'Phone: ': 'Tel: ')?> <a href="tel:<?=$company->telefon_fix?>"><?=$company->telefon_fix?></a></span>
						<span>Email: <a href="mailto:<?=$owner->oemail?>"><?=$owner->oemail?></a></span> -->
						<h3 style="letter-spacing: 3px;">COMPANIA DE UTILITĂȚI PUBLICE FOCȘANI</h3><h5>operator regional al serviciilor de apă și canalizare</h5>
					</div>
				</div>
				<div class="col-xl-3 col-9 js-equal-8 no-pad-col">
					<div class="container just-a-box">
						<div class="unknown-el">
							<form name="search_site" method="POST" action="<?=base_url()?>search_site" class="pull-right row">
								<input class="rounded-0 col-9" name="search_site_query" type="text" placeholder="Cauta in site">
								<button type="submit" style="background: none; border: none;" class="col-3"><i class="fa fa-search text-white fa-2x align icon"></i></button>
								<!-- <button type="submit" name="search_site" href="#" class="btn text-white text-uppercase text-small btn-block margin-top-15px background-grey-3 rounded-0 border-0">Cauta in site!</a> -->
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<div id="main-nav-bar">
