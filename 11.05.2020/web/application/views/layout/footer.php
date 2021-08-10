
<style type="text/css">
	.background-aqua{
		background: url('<?=base_url()?>public/assets/img/div/banner-aqua-1.jpg') no-repeat;
		background-size: cover;
	}
	#cookie_div { background: #222222; color: #ffffff; position: fixed; bottom: 0; left: 25%; width: 50%; padding: 8px 20px; display: none; z-index: 999; -webkit-box-shadow: -1px -5px 21px 1px rgba(0, 0, 0, 0.12); -moz-box-shadow: -1px -5px 21px 1px rgba(0, 0, 0, 0.12); box-shadow: -1px -5px 21px 1px rgba(0, 0, 0, 0.12); border-radius: 6px; }
#cookie_div .button { float: right; padding: 5px 20px; font-size: 12px; margin-top: 3px; }
	/*.background-aqua img {
	    opacity: 0.5;
	    filter: alpha(opacity=50);
	}*/

	/*.text-black{
		color: #56595c;
		}*/
	/*.transparence{
		padding:20px 10px 0 10px;
		border-radius: 20px;
		background-color: rgba(228, 227, 226, 0.5);
		background: rgba(228, 227, 226, 0.5);
		color: rgba(228, 227, 226, 0.5);
	}*/
	.line-ue{
		border-top: solid 1px #eeeded;
	}
	.link-ue a{
		color: #5091c8 !important;
	}

</style>

	<section class="background-light-grey">
		<div class="container">
			<div class="row padding-tb-25px line-ue">
				<div class="col-lg-6">
					<span style="text-align: justify;">
							Proiect cofinanțat din Fondul de Coeziune prin Programul Operațional Infrastructura Mare 2014-2020.
							Conținutul acestui material nu reprezintă în mod obligatoriu poziția oficiala a Uniunii Europene  sau a Guvernului României.
					</span>
				</div>
				<div class="col-lg-6">
					<span style="text-align: justify;">Pentru informații detaliate despre celelalte programe cofinanțate de Uniunea Europeană, vă invităm să vizitați
					<a href="www.fonduri-ue.ro" target="_blank" class="link-ue">www.fonduri-ue.ro</a></span>
				</div>
			</div>
		</div>

	</section>
	<!-- <footer class="background-dark padding-top-100px"> -->


	<footer class="background-aqua">
		<div class="container">
			<div class="row padding-tb-25px">
				<?php if(!is_null($stiri_articole)): ?>
				<div class="col-lg-6 col-sm-6 hidden-xs">
					<ul class="last-posts margin-0px padding-0px list-unstyled text-black d-none d-sm-block">
						<?php 
						$three_elements = array_slice($stiri_articole, 0, 3);
						foreach($three_elements as $sta): ?>
						<li>
							<?php if(!is_null($sta->images)): ?>
							<?php $sta_image = explode(',', $sta->images)[0];?>
							<a href="<?=base_url()?>blog/articol/<?=$sta->airdrop_id;?>" class="float-left margin-right-15px d-block width-60px"><img src="<?=base_url()?>public/upload/img/stiri/s/<?=$sta_image?>?>" alt=""></a>
							<?php endif; ?>
							<a href="<?=base_url()?>blog/articol/<?=$sta->airdrop_id;?>" class="d-block text-capitalize"><?=$sta->{'i_titlu_' . $site_lang}?></a>
							<!-- <span class="text-extra-small pull-right">data : <?=date_format(date_create($sta->insert_date) ,"F d, Y");?></span> -->
							<hr class="border-grey-3">
							<div class="clearfix"></div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>

				<?php
				if(strlen($company->adresa_pl) > 5) {

				  $makeadr = 'Adresa: '.$company->adresa_pl. ', Loc.: ' .$company->adresa_plloc. ', Judet: ' .$company->adresa_pljud. ', Cod Postal ' .$company->adresa_plcodpostal;

				} else {

				  $makeadr = 'Adresa: '.$company->adresa_ss. ', Loc.: ' .$company->adresa_ssloc. ', Judet: ' .$company->adresa_ssjud. ', Cod Postal ' .$company->adresa_plcodpostal;

				}
				?>
				<div class="col-lg-6 col-sm-6">
					<div class="text-black">
						<ul class="margin-0px padding-0px list-unstyled text-black">
							<li class="text-black"><i class="fa fa-hospital margin-right-10px"></i><strong style="color:#666666;"><?=$owner->company?></strong></li>
							<li><i class="fa fa-map margin-right-10px"></i><?=$makeadr?></li>

							<li><i class="fa fa-map margin-right-10px"></i>CUI: <?=$company->cui?> | Nr. inreg: <?=$company->nrinreg?></li>

							<?php if(!empty($company->telefon_fix)): ?>
							<li><i class="fa fa-phone margin-right-10px"></i> Telefon: <a href="tel:<?=$company->telefon_fix?>"><?=$company->telefon_fix?></a></li>
							<?php endif; ?>

							<?php if(!empty($company->telefon_mobil)): ?>
							<li><i class="fa fa-phone margin-right-10px"></i> Fax: <?=$company->telefon_fax?></li>
							<?php endif; ?>

							<li class=""><i class="fa fa-envelope-open margin-right-10px"></i>Email: <a href="mailto:<?=$owner->oemail?>?Subject=Mesaj din Website: " target="_top"><?=$owner->oemail?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>


	<script type="text/javascript">
		$(document).ready(function(){
		  $(".owl-carousel").owlCarousel({
		        items: 1,
				pagination: false,
				autoPlay: true,
				// autoPlay: false,
				navigation: true,
				autoplayTimeout:1000,
				slideSpeed: 100,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive:false,

			});
		});

		$(document).ready(function(){
		  $(".owl-carousel-1").owlCarousel({
				items: 1,
				pagination: false,
				autoPlay: true,
				autoplayTimeout:1000,
				navigation: true,
				slideSpeed : 2000,
				navigationText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				itemsDesktop: [1199, 1],
		    itemsDesktopSmall: [979, 1],
        itemsMobile : [767,1]
			});
		});

		var stickymenu = document.getElementById("main-nav-bar")
		var stickymenuoffset = stickymenu.offsetTop

		window.addEventListener("scroll", function(e){
		    requestAnimationFrame(function(){
		        if (window.pageYOffset > stickymenuoffset){
		            stickymenu.classList.add('sticky')
		        }
		        else{
		            stickymenu.classList.remove('sticky')
		        }
		    })
		});



	</script>


</footer>
