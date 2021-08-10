<?php
// var_dump($links);
// var_dump($item);
// var_dump($item_links);
//var_dump($item->atom_id);
// die();
?>

<div class="wrapper wrapper-content animated fadeIn">

		<div class="row">
			<div class="col-md-12">

				<div class="tabs-container">

					<ul role="tablist" class="nav nav-tabs">
						<li role="presentation">
							<a href="javascript:void(0);"><strong style="color:black;"><?=$air->air_identnewitem?></strong></a>
						</li>
						<li role="presentation" class="active">
							<a href="#tab1" data-toggle="tab"><?=(!is_null($item) && !is_null($item->atom_name_ro) ? $item->atom_name_ro : "Noua");?></a>
						</li>
						<?php if(!is_null($item)):?>
						<li role="presentation">
							<a href="#tab2" data-toggle="tab"><i class="fa fa-file"></i> Documente</a>
						</li>
						<?php endif; ?>
					</ul>

						<div class="tab-content">
							<!--start#tab1-->
							<div id="tab1" class="tab-pane active">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<form class="form-horizontal" method="POST" name="<?=$form->item->name;?>" action="<?=base_url().$form->item->segments?>">
												<div class="content content-full-width">
													<div class="panel-group">
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label"><?=$air->air_identnewitem?></label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Denumire <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->item->prefix;?>atom_name_ro" value="<?=(!is_null($item) && !is_null($item->atom_name_ro) ? $item->atom_name_ro : "");?>" required>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Alege sucursala</label>
																<div class="col-sm-10">
																	<select class="form-control" style="max-width:350px;" name="<?=$form->item->prefix;?>sucursala">
																		<?php foreach ($sucursale as $key=>$s) {?>
																				<option value="<?=$s->atom_id?>" <?=($item->sucursala)==($s->atom_id) ? "selected" : "" ?>><?=$s->atom_name_ro?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Alege an</label>
																<div class="col-sm-10">
																	<select class="form-control" style="max-width:100px;"name="<?=$form->item->prefix;?>an">
																		<?php
																		$current_year = date("Y");
																		for($i=($current_year-10);$i<=($current_year);$i++){
																		?>
																			<option value="<?=$i?>" <?=($item->an)==$i ? "selected" : "" ?>><?=$i?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Alege luna</label>
																<div class="col-sm-10">
																	<select class="form-control" style="max-width:100px;" name="<?=$form->item->prefix;?>luna">
																		<?php for($i=1;$i<=12;$i++){?>
																			<option value="<?=$i?>" <?=($item->luna)==$i ? "selected" : "" ?>><?=$i?></option>
																		<?php } ?>
																	</select>
																</div>
															</div>
														</div>
														<hr>														
														
														<fieldset>
																<div class="form-group">
																	<div class="col-sm-12">
																		<button class="btn btn-white" type="button" onClick="location.href='<?=base_url()?>/texte_diverse'">Anuleaza</button>
																		<button class="btn btn-primary" type="submit" name="<?=$form->item->prefix;?>submit"><?=(isset($uri->item) && $uri->item == "i" ? "Creeaza " . $air->air_identnewitem : "Salveaza modificarile")?></button>
																	</div>
																</div>
														</fieldset>
													</div>
												</div>
											</form>
											
										</div> <!-- end col-md-12 -->
									</div>
								</div>
							</div><!--end#tab1-->
							<!--start#tab2-->
							<div id="tab2" class="tab-pane">
								<div class="panel-body">
									<div class="row">
										<h2 style="margin:0;">Fisier PDF</h2>
										<div class="mail-attachment" id="pdf-container"></div>
									</div>
								</div>
							</div>
							<!--end#tab2-->								
						</div>
					</div>
				</div>
			</div>

</div>
	
<?php if(!is_null($item)): ?>
	
<?php if(!is_null($item)): ?>
	<!-- Modal upload pdf -->
	<form method="POST" id="fmodalupfilepdf" class="form-horizontal" enctype="multipart/form-data">
	  <div class="modal fade" id="inpfilePdfModal" tabindex="-1" role="dialog" aria-labelledby="inpfilePdfModalLabel">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="inpfilePdfModalLabel">Incarca fisier PDF</h4>
			</div>
			<div class="modal-body">
			  <input type="file" name="inpfilepdf" size="50" class="form-control" accept="application/pdf"/>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Renunta</button>
			  <button type="button" class="btn btn-primary btn-fill" onClick="return pdf.upfile(<?=$item->atom_id?>);return false;">Incarca fisier PDF</button>
			</div>
		  </div>
		</div>
	  </div>
	</form>
<?php endif; ?>
<?php endif; ?>
