<?php
// var_dump($servicii);
?>

<section class="padding-tb-10px">
	<div class="container">	
		<div class="row  text-center padding-tb-20px d-block  text-capitalize text-large text-dark font-weight-400 margin-bottom-10px back-subtitle" style="padding-top: 10px">
			<div class="col-lg-12">
				<h5><a href="<?=base_url()?>web/public/upload/cerere-eliberare-avize.pdf" target="_blank"><i class="fa fa-file-pdf-o" style="margin: 0 10px 0 10px"></i>Cerere pentru Eliberare Avize Servicii Conexe</a></h5>
			</div>
		</div>
	</div>
</section>

<?php if(!empty($servicii)): ?>
<section class="padding-tb-10px">
		<div class="container">
			
			<?php foreach($servicii as $servicii_node): ?>
			<!-- section title -->
			<div class="row justify-content-center wow fadeInUp">
				<div class="col-md-12">
					<div class="text-center margin-bottom-55px">
						<h4 class="font-weight-300 text-title-large font-3"><?=$servicii_node->{'denumire_' . $site_lang}?></h4>
						<span class="opacity-7"><?=$servicii_node->{'i_subtitlu_' . $site_lang}?></span>
					</div>
				</div>
			</div>
			<!-- // section title -->

			<div class="row text-dark">
				<?php if(!empty($servicii_node->servicii)): ?>
					<?php foreach($servicii_node->servicii as $serviciu): ?>
						<?php
						$serviciu_image = false;
						if(!is_null($serviciu->images))
						{
							$serviciu_image = base_url() . 'public/upload/img/servicii/m/' . explode(',', $serviciu->images)[0];
						}
						?>
						
							<div class="text-left hvr-bob opacity-hover-7 col-lg-12">
								<ul>
									<li>
										<div class="row">
                                            <div class="col-sm-8">
                                                <h5>
                                                    <?=(!empty($serviciu->i_pictograma) ? '<i class="' .$serviciu->i_pictograma. ' text-icon-medium d-inlin-block margin-right-20px"></i>' : '')?>
                                                    <?=$serviciu->{'atom_name_' . $site_lang}?>
                                                </h5>
                                            </div>

                                            <div class="col-sm-2">
                                            <?php
                                                if(!empty($serviciu->pdf))
                                                {
                                            ?>
                                                <p class="pull-right text-blue">
                                                    <?=$serviciu->{'titlu_pdf_' . $site_lang};?>
                                                    <?=(!empty($serviciu->pdf)) ? '<a href="' . SITE_URL.PATH_SERVICII_PDF.$serviciu->pdf.'" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>' : '';?>
                                                </p>
                                            <?php
                                                }
                                            ?>
                                            </div>
                                            <div class="col-sm-2">
                                                <?=(!empty($serviciu->i_tarif) ? '<p class="pull-right text-blue">Tarif: '. $serviciu->i_tarif.' Lei</p>' : '' );?>
                                            </div>
										</div>
                                        <div class="row">
                                            <div class="col-md-<?=($serviciu_image ? '12' : '12')?>">
                                                    <p class="opacity-7"><?=$serviciu->{'i_content_' . $site_lang}?></p>
                                            </div>
                                        </div>
									</li>
								</ul> 

							</div>
						
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
			
		</div>
	</section>

		
<?php endif; ?>