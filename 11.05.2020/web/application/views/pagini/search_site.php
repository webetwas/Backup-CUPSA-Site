<?php
// var_dump($pagini_site);
// var_dump($results);
function remove_html_tags($text){
    $text = strip_tags($text,"<style>");

    $substring = substr($text,strpos($text,"<style"),strpos($text,"</style>"));

    $text = str_replace($substring,"",$text);
    $text = str_replace(array("\t","\r","\n"),"",$text);
    $text = trim($text);
	if(!empty($text)){
		return substr($text, 0, 100)." ...";		
	}
}
?>

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


	<!-- page output -->
	<div class="padding-tb-80px background-light-grey">
		<div class="container">
			<div class="row">

				<!-- sidebar -->
				<!--<div class="col-lg-4 col-md-4">

					<?php if(!is_null($pagini_site)): ?>
					<div class="widget widget_categories">
						<h4 class="widget-title clearfix"><span>pagini site</span></h4>
						<ul>
							<?php foreach($pagini_site as $page_ps): ?>
							<li><a href="<?=base_url() . 'p/' . $page_ps->slug?>" target="_blank"><?=$page_ps->{'title_' . $site_lang}?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					<?php endif; ?>

					<?php if(!is_null($texte_diverse_texte_site)): ?>
						<?php foreach($texte_diverse_texte_site as $tdts): ?>
							<div class="widget">
								<h4 class="widget-title clearfix"><span><?=$tdts->{'atom_name_' . $site_lang}?></span></h4>
								<h1 class="text-center"><a href="javascript:void(0);" class="text-blue"><?=$tdts->{'i_content_' . $site_lang}?></a></h1>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>

				<div class="widget">
						<form name="search_site" method="POST" action="<?=base_url()?>search_site">
							<h4 class="widget-title clearfix"><span>Cautare in site</span></h4>
							<input class="form-control rounded-0" name="search_site_query" type="text" placeholder="introdu un text">
							<button type="submit" name="search_site" href="#" class="btn text-white text-uppercase text-small btn-block margin-top-15px background-grey-3 rounded-0 border-0">Cauta in site!</a>
						</form>
					</div> 



					
					<div class="widget">
						<h4 class="widget-title clearfix"><span>Postari Recente</span></h4>

						<div class="row margin-bottom-40px">
							<div class="col-4"><img src="assets/img/div/1.jpg" alt=""></div>
							<div class="col-8">
								<h3 class="text-up-small d-block">
									<a href="#" class="text-grey-4">Aifi afisam stiri/proiecte numai din administrare sau le scoatem de tot </a>
								</h3>
							</div>
						</div>

					</div>
				

				-->
				</div>
				<!-- // sidebar -->

				<!--  content -->
				<div class="row">
						<?php if(empty($results)): ?>
						<span style="font-size:20px;padding:30px;margin:30px;"><?=($site_lang == "en" ? 'We didn\'t find any record matching your query..' : "Nu s-au gasit rezultate in urma cautarilor tale..")?></span>
						<?php else: ?>
						<h2 class="col-lg-12">Rezultate cautare:</h2>
						<?php foreach($results as $search_result): ?>
							
							<?php
								if($stiri){
									foreach($stiri as $s){
										//print_r($search_result->atom_id);die();
										if( ($s->atom_id) == ($search_result->atom_id) ){
										//echo "aaaa";die();
							?>
											<div class="col-lg-3 col-md-4 mb-10">
												<!--  Author  -->
												<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
													<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
														<a href="/blog/articol/<?=$s->airdrop_id?>" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
													</h5>
													<!-- // Social -->
													<div class="clearfix"></div>
													<div style="max-height:95px;overflow:hidden">
														<?=remove_html_tags($search_result->{'i_content_' . $site_lang})?>
													</div>
												</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>
							<?php
								if($servicii){
									foreach($servicii as $s){
										if( ($s->atom_id) == ($search_result->atom_id) ){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/servicii" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
												</h5>
												<!-- // Social -->
												<div class="clearfix"></div>
												<div style="max-height:95px;overflow:hidden">
													<?=remove_html_tags($search_result->{'i_content_' . $site_lang})?>
												</div>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>
							<?php
								if($proiecte){
									foreach($proiecte as $s){
										if( ($s->atom_id) == ($search_result->atom_id) ){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/investitii/proiect/<?=$s->slug?>" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
												</h5>
												<!-- // Social -->
												<div class="clearfix"></div>
												<div style="max-height:95px;overflow:hidden">
													<?=remove_html_tags($search_result->{'i_content_' . $site_lang})?>
												</div>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>
							<?php
								if($media){
									foreach($media as $s){
										if( ($s->atom_id) == ($search_result->atom_id) ){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/media/p/<?=$s->atom_id?>" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
												</h5>
												<!-- // Social -->
												<div class="clearfix"></div>
												<div style="max-height:95px;overflow:hidden">
													<?=remove_html_tags($search_result->{'i_content_' . $site_lang})?>
												</div>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>
							<?php
								if($avizier){
									foreach($avizier as $s){
										if( ($s->atom_id) == ($search_result->atom_id) ){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/avizier" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
												</h5>
												<!-- // Social -->
												<div class="clearfix"></div>
												<div style="max-height:95px;overflow:hidden">
													<?=remove_html_tags($search_result->{'i_content_' . $site_lang})?>
												</div>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>
							<?php
								if($sucursale){
									foreach($sucursale as $s){
										if( ($s->atom_id) == ($search_result->atom_id) ){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/sucursale/p/<?=$s->atom_id?>" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
												</h5>
												<!-- // Social -->
												<div class="clearfix"></div>
												<div style="max-height:95px;overflow:hidden">
													<?=remove_html_tags($search_result->{'i_content_' . $site_lang})?>
												</div>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>
							<?php
								if($fe_pages){
									foreach($fe_pages as $s){
										if( ($s->atom_id) == ($search_result->atom_id) ){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/p/<?=$s->slug?>" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
												</h5>
												<!-- // Social -->
												<div class="clearfix"></div>
												<div style="max-height:95px;overflow:hidden">
													<?=remove_html_tags($search_result->{'content_' . $site_lang})?>
												</div>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>
							<?php
								if($intrebari_frecvente){
									foreach($intrebari_frecvente as $s){
										if( ($s->atom_id) == ($search_result->atom_id) ){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/intrebari_frecvente" class="text-blue"><?=$search_result->{'atom_name_' . $site_lang}?></a>
												</h5>
												<!-- // Social -->
												<div class="clearfix"></div>
												<div style="max-height:95px;overflow:hidden">
													<?=remove_html_tags($search_result->{'i_content_' . $site_lang})?>
												</div>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										}
									}
									
								}
							?>								
						<?php endforeach; ?>
							<?php
								if($declaratii_avere){
									foreach($declaratii_avere as $s){
							?>
											<div class="col-lg-3 col-md-4 mb-10">
											<!--  Author  -->
											<div class="background-white border-1 border-grey-1 margin-bottom-35px padding-30px h-100">
												<h5 class="text-medium text-dark text-uppercase  margin-top-8px" style="min-height:46px">
													<a href="/p/actionariat" class="text-blue"><?=$s->nume?> <?=$s->prenume?></a>
												</h5>
											</div>
											<!-- // Author  -->
											</div>
							<?php
										
									}
									
								}
							?>	
						<?php endif; ?>
				</div>
				<!-- //  content -->

			</div>
		</div>
	</div>
	<!-- //  page output -->