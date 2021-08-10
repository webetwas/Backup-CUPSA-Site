<?php
// var_dump($application->owner);die();
// var_dump($listpages);die();
?>

<?php
$ctrl = "admin";
$ctrl2 = false;

// var_dump($this->uri);
// var_dump($this->uri->segment());
if(!empty($this->uri->segment(1, 0))) $ctrl = $this->uri->segment(1, 0);
if(!empty($this->uri->segment(2, 0))) $ctrl2 = $this->uri->segment(2, 0);
?>

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                      <span style="color:white;font-size:20px;">
                        <img alt="image" class="img-circle" style="border-radius:0;" src="<?=(isset($application->owner->image_logo) && !is_null($application->owner->image_logo) ? SITE_URL.PATH_IMG_MISC. '/' .$application->owner->image_logo : 'public/assets/img/logo/default-logo.png');?>" />
                      </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
													<span class="text-muted text-xs block"><?=((int)$application->user->privilege < 3 ? "SUPERADMIN" : $application->user->user_name)?> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="<?=base_url();?>platforma/setari/companie/item/u/id/<?=$application->owner->id;?>">Contul meu</a></li>
                            <li class="divider"></li>
                            <li><a class="swloader" href="<?=base_url();?>platforma/setari/utilizator/item/u/id/<?=$application->user->id;?>"><?=$application->user->user_name;?></a></li>
                            <li><a href="<?=base_url();?>login/getout">Iesi din cont</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                      WEW
                    </div>
                </li>
                <li <?=($ctrl == "admin" || $ctrl == "platforma" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>"><i class="fa fa-home" style="color:#fff;"></i> <span class="nav-label">Pagini site</span></a>
					<?php
						if($ctrl == "admin" || $ctrl == "platforma"){
					?>
						<a class="swloader" href="<?=base_url()?>pagini/item/i"><i class="fa fa-plus-circle" style="color:#fff;"></i> Creaza pagina</a>
					<?php
						}
					?>
                </li>

                <li <?=($ctrl == "factura_electronica" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>factura_electronica"><i class="fa fa-newspaper-o" style="color:#f44336;"></i><span class="nav-label">Factura electronica</span></a>
                </li>

				<!--
                <li <?=($ctrl == "pagini" ? 'class="active"' : "");?>>
					<a href="<?=base_url()?>"><i class="fa fa-files-o" style="color:#fff;"></i> <span class="nav-label">Pagini site</span></a>
                </li>
				-->
                <li <?=($ctrl == "sucursale" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>sucursale"><i class="fa fa-university" style="color:#fff;"></i> <span class="nav-label">Sucursale</span></a>
                </li>				
				
                <li <?=($ctrl == "servicii" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>servicii"><i class="fa fa-suitcase" style="color:#fff;"></i> <span class="nav-label">Servicii</span></a>
                </li>
				
                <li <?=($ctrl == "proiecte" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>proiecte"><i class="fa fa-tasks" style="color:#fff;"></i> <span class="nav-label">Investitii</span></span></a>
                </li>
				
                <li <?=($ctrl == "stiri" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>stiri"><i class="fa fa-newspaper-o" style="color:#fff;"></i> <span class="nav-label">Stiri</span></a>
                </li>
				
                <li <?=($ctrl == "buletine_meteo" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>buletine_meteo"><i class="fa fa-cloud" style="color:#fff;"></i> <span class="nav-label">Buletine calitatea ape</span></a>
                </li>
				
					<li <?=($ctrl == "apa_meteorica" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>apa_meteorica"><i class="fa fa-tint" style="color:#fff;"></i> <span class="nav-label">Apa meteorica</span></a>
                </li>
				
                <li <?=($ctrl == "texte_diverse" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>texte_diverse"><i class="fa fa-paragraph" style="color:#fff;"></i> <span class="nav-label">Texte diverse</span></a>
                </li>
                <li <?=($ctrl == "echipa" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>echipa"><i class="fa fa-handshake-o" style="color:#fff;"></i> <span class="nav-label">Echipa</span></a>
                </li>
                <li <?=($ctrl == "intrebari_frecvente" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>intrebari_frecvente"><i class="fa fa-question" style="color:#fff;"></i> <span class="nav-label">Intrebari frecvente</span></a>
                </li>
				<!--
                <li <?=($ctrl == "branduri" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>branduri"><i class="fa fa-suitcase" style="color:#fff;"></i> <span class="nav-label">Branduri</span></a>
                </li>
				-->
                <li <?=($ctrl == "media" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>media"><i class="fa fa-newspaper-o" style="color:#fff;"></i> <span class="nav-label">Media</span></a>
                </li>
				<?php if((int)$application->user->privilege < 3): ?>
                <li <?=($ctrl == "newsletter" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>newsletter"><i class="fa fa-envelope-open-o"></i> <span class="nav-label">Newsletter</span></a>
                </li>
				<?php endif; ?>
                <li <?=($ctrl == "avizier" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>avizier"><i class="fa fa-book"></i><span class="nav-label">Avizier</span></a>
                </li>
                <li <?=($ctrl == "legislatie" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>legislatie"><i class="fa fa-balance-scale"></i><span class="nav-label">Legislatie</span></a>
                </li>
                <li <?=($ctrl == "setari_pdf" ? 'class="active"' : "");?>>
                    <a href="<?=base_url()?>setari_pdf"><i class="fa fa-file-text"></i> <span class="nav-label">Declaratii avere & interes</span></a>
                </li>

                <li <?=($ctrl == "sitfinanciare" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>sitfinanciare"><i class="fa fa-address-card-o"></i><span class="nav-label">Situatii Financiare</span></a>
                </li>

                <li <?=($ctrl == "guvernanta" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>guvernanta"><i class="fa fa-address-card-o"></i><span class="nav-label">Guvernanta corporativa</span></a>
                </li>
                <li <?=($ctrl == "structura_manageriala" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>structura_manageriala"><i class="fa fa-users"></i><span class="nav-label">Structura Manageriala</span></a>
                </li>

               <li <?=($ctrl == "galerie_foto" || $ctrl == "galerie_video"  ? 'class="active"' : "");?>>
               <a href="#"><i class="fa fa-files-o" style="color:#fff;"></i> <span class="nav-label">Galerie</span><span class="fa arrow"></span></a>
               <ul class="nav nav-second-level collapse">
                  <li <?=($ctrl == "galerie_foto" ? 'class="active"' : "");?>>
                  <a href="<?=base_url()?>galerie_foto">
                     <i class="fa fa-camera-retro"></i> 
                     <span class="nav-label">Galerie foto</span>
                  </a>
               </li>
               <li <?=($ctrl == "galerie_video" ? 'class="active"' : "");?>>
                  <a href="<?=base_url()?>galerie_video">
                     <i class="fa fa-video-camera"></i> 
                     <span class="nav-label">Galerie video</span>
                  </a>
               </li>
  				</ul>
        </li>


				<!--
				<!--
                <li <?=($ctrl == "aranjarea_elementelor_in_pagina" ? 'class="active special_link"' : 'class="special_link"');?>>
                   <a href="<?=base_url()?>aranjarea_elementelor_in_pagina"><i class="fa fa-heart-o"></i> <span class="nav-label">Aranjare elemente</span></a>
                </li>
				-->
                <?php if((int)$application->user->privilege < 3): ?>
                <li <?=($ctrl == "meniuri" ? 'class="active"' : "");?>>
                   <a href="<?=base_url()?>meniuri"><i class="fa fa-list-ul" style="color:#fff;"></i> <span class="nav-label">Meniuri</span></a>
                </li>
				<?php endif; ?>

            </ul>

        </div>
    </nav>