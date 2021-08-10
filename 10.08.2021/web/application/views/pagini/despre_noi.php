<?php
// var_dump($texte_diverse);
// var_dump($proiecte);
// var_dump($echipa);
?>

<!-- <section class="background-grey padding-tb-50px">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="text-blue margin-top-10px">
					<?//=($site_lang == "en" ? 'Type your e-mail address for Newsletter' : 'Introdu adresa de email pentru Newsletter')?>
				</h2>
			</div>
			<div class="col-lg-6">
				<form class="dark-form row">
					<div class="col-7">
						<input type="text" name="inregnl" id="register_newsletter_data" class="form-control" /><br />
						<input type="checkbox" name="newsletter" value="test" checked /> sunt de acord cu prelucarea datelor <br>cu caracter personal<br />
					</div>
					<div class="col-sm-5">
						<button type="button" id="register_newsletter" class="btn-sm margin-left-20px col-5 btn-md border-2 border-blue text-blue text-center font-weight-bold text-uppercase rounded-0 padding-15px">Trimite</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
 -->

 <style>
	.about-content p {
		display: none;
	}
	.about-content p:first-of-type {
		display: block;
	}

 </style>
<?php if(!empty($echipa)): ?>

<section class="padding-tb-50px">

	<div class="container text-center">
		<div class="text-center margin-bottom-35px wow fadeInUp">
			<h1 class="font-weight-300 text-title-large font-3"><?=$echipa[0]->{'node_titlu_' . $site_lang}?></h1>
			<span class="opacity-7"><?=$echipa[0]->{'node_subtitlu_' . $site_lang}?></span>
		</div>
		<div class="row">
			<?php foreach($echipa as $membru): ?>
			<?php
			$membru_image = base_url() . 'public/assets/img/team/team.jpg';
			if(!is_null($membru->images))
			{
				$membru_image = base_url() . 'public/upload/img/echipa/m/' . explode(',', $membru->images)[0];
			}
			?>
			<div class="col-lg-3 col-md-4 sm-mb-30px wow fadeInUp">
				<div class="team with-hover text-center hvr-float">
					<div class="margin-bottom-20px position-relative overflow-hidden">
						<img src="<?=$membru_image?>" alt="">
						<div class="hover-option bag-dark text-center padding-top-n-20">
							<!-- <div class="position-relative hight-full">
								<ul class="social-list light bottom-30px position-absolute">
									<?php if(!empty($membru->facebook)): ?>
									<li><a class="facebook" href="<?=$membru->facebook?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
									<?php endif; ?>
									<?php if(!empty($membru->linkedin)): ?>
									<li><a class="linkedin" href="<?=$membru->linkedin?>" target="_blank"><i class="fab fa-linkedin"></i></a></li>
									<?php endif; ?>
									<?php if(!empty($membru->googleplus)): ?>
									<li><a class="google" href="<?=$membru->googleplus?>" target="_blank"><i class="fab fa-google-plus"></i></a></li>
									<?php endif; ?>
									<?php if(!empty($membru->twitter)): ?>
									<li><a class="twitter" href="<?=$membru->twitter?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
									<?php endif; ?>
								</ul>
							</div> -->
							<!-- // Social -->
						</div>
					</div>
					<h4 class="margin-bottom-0px"><a href="javascript:void(0);"><?=$membru->atom_name_ro?></a></h4>
					<small><?=$membru->functie?></small>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

</section>

<?php endif; ?>


<?php if(!is_null($page->b) && isset($page->b["banner1"])): ?>
	<section class="video wow fadeInUp">
		<div class="text-grey background-overlay fixed" style="background-image: url('<?=base_url().'public/upload/img/page/banners/'.$page->b["banner1"]->img?>');">
			<div class="text-center">
				<div class="container padding-tb-150px z-index-2 position-relative">
					<h1 class="font-weight-700 margin-top-30px"><?=$page->b["banner1"]->titlu?></h1>
					<div class="row justify-content-md-center">
						<div class="col-lg-6 text-grey-2"><?=$page->b["banner1"]->subtitlu?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>