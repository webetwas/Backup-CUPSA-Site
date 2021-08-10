<?php
// var_dump($site_lang);
?>

<div id="main-nav-bar">
	<div class="padding-tb-5px position-relative" style="background-color:#5091c8; ">
		<div class="container">
			<div class="row">
				<div class="col-xl-2 col-lg-3 d-lg-block">
					<!-- lang dropdown -->
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
					<!-- // lang dropdown -->
				</div>
				<div class="col-xl-6 d-none d-xl-block">
					<div class="contact-info text-white text-center">
						<span class="margin-right-10px"><?=($site_lang == "en" ? 'Phone: ': 'Tel: ')?> <a href="tel:<?=$company->telefon_fix?>"><?=$company->telefon_fix?></a></span>
						<span>Email: <a href="mailto:<?=$owner->oemail?>"><?=$owner->oemail?></a></span>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-12">
					<ul class="list-inline text-center margin-0px text-white">
						<?php if(!is_null($owner->facebook)): ?>
						<li class="list-inline-item"><a class="facebook" href="<?=$owner->facebook?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
						<?php endif; ?>
						<?php if(!is_null($owner->youtube)): ?>
						<li class="list-inline-item"><a class="youtube" href="<?=$owner->youtube?>" target="_blank"><i class="fab fa-youtube"></i></a></li>
						<?php endif; ?>
						<?php if(!is_null($owner->twitter)): ?>
						<li class="list-inline-item"><a class="twitter" href="<?=$owner->twitter?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
						<?php endif; ?>
					</ul>
					<!-- // Social -->
				</div>
				<div class="col-xl-3 col-lg-4  d-none d-lg-block">
					<ul class="user-area list-inline float-right margin-0px text-white">
						<li class="list-inline-item  padding-right-10px"><a href=admin"><i class="fa fa-lock padding-right-5px"></i>intra</a></li>
						<li class="list-inline-item"><a href="admin"><i class="fa fa-user-plus padding-right-5px"></i>creeaza cont</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>
