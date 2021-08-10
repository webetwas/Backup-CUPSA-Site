<?php
    // print_r($post); die;
    // echo $post[0]->atom_name_ro; die;
?>
<style>
.img-in.blog-img {
	background-position: center;
	background-size: cover;
	background-repeat: no-repeat;
	padding-top: 700px;
}
</style>

<div class="img-in blog-img" style="background-image: url(<?=base_url().'public/upload/img/stiri/l/'.$post[0]->images;?>);">

</div>


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


<section class="padding-tb-50px">
	<div class="container margin-bottom-35px">
		<div class="col-lg-12 sticky-content">
		    <!-- post -->
		    <div class="blog-entry background-white margin-bottom-35px">
		        <?php if($post[0]->images): ?>

		        <?php endif; ?>

		            <h1 style="text-align:center;" class="d-block  text-capitalize text-large text-dark font-weight-700 margin-bottom-10px" href="javascript:void(0);"><?=$post[0]->{'atom_name_' . $site_lang};?></h1>
		            <div class="post-entry">
		                <div class="d-block text-up-small text-grey-4 margin-bottom-15px">
		                    <?=$post[0]->{'i_content_' . $site_lang};?>
		                    
		                </div>
		            </div>

		    </div>
		    <!-- // post -->


		</div>
		<!-- <div class="date z-index-10 width-50px padding-10px background-main-color text-white text-center position-absolute top-20px left-20px">
			<?=date_format(date_create($sta->insert_date) ,"d/m Y");?>
		</div> -->
		

		<!--galerie blog-single-->
		<div class="col-lg-12 margin-bottom-35px" style="display: none;">
			<div class="row text-center">
				<div class="col-sm-3">image</div>
				<div class="col-sm-3">image</div>
				<div class="col-sm-3">image</div>
				<div class="col-sm-3">image</div>
			</div>
			<hr>
			<div class="row text-center">
				<div class="col-sm-6">video</div>
				<div class="col-sm-6">video</div>	
			</div>
		</div>
		<!--//galerie blog-single-->



		<div class="pull-right">
			<a href="<?=base_url() . 'blog';?>" class="btn btn-md border-2 border-radius-0 text-dark width-150px opacity-9">Vezi toate stirile</a>
		</div>
	</div>
</section>

<!-- <section class="background-grey padding-tb-50px">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<h2 class="text-blue margin-top-10px"><?=($site_lang == "en" ? 'Type your e-mail address for Newsletter' : 'Introdu adresa de email pentru Newsletter')?>
			</div>
			<div class="col-lg-6">
				<form class="dark-form row">
					<input type="text" name="inregnl" id="register_newsletter_data" class="form-control col-7" />
					<button type="button" id="register_newsletter" class="btn-sm margin-left-20px col-3 btn-lg border-2 border-blue text-blue text-center font-weight-bold text-uppercase rounded-0 padding-15px">Trimite</button>
				</form>
			</div>
		</div>
	</div>
</section>
 -->