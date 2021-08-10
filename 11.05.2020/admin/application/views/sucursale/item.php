<?php
// var_dump($links);
// var_dump($item);
// var_dump($item_links);
// var_dump($air);
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
						<li role="presentation">
							<a href="#tab3" data-toggle="tab"><i class="fa fa-file"></i> Harta sucursala</a>
						</li>
						<li role="presentation">
							<a href="#tab4" data-toggle="tab"><i class="fa fa-file"></i> Date contact</a>
						</li>
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
														<?php if(!is_null($item)):?>
															<div class="row" style="background-color:#f1f1f1;margin-left:-20px;margin-right:-20px;border-bottom:30px solid #fdfdfd;padding:7px;padding-bottom:10px;">
																<div class="form-group" style="margin:0;">
																	<label class="col-sm-2 control-label" style="text-align:left;"><span style="color:black;font-size:17px;font-weight:normal;"><sub><i class="fa fa-plug" style="color:orange;font-size:25px;"></i></sub>&nbsp;&nbsp;Afiseaza pe </span> <i class="fa fa-angle-double-right" style="font-size:15px;"></i></label>
																	
																	<div class="col-sm-10">
																		<?php if(is_null($nodes)): echo "Nu s-au gasit legaturi"; ?>
																		<?php elseif(!is_null($nodes)): ?>
																		<select multiple data-placeholder="Acest item nu se afiseaza pe sit. Creeaza o legatura intre acest item si sit, alegand din lista de mai jos:" class="chosen-sl-links" tabindex="4">
																		
																		<?php foreach($nodes as $node): ?>
																			<?php
																			$selected = "";
																			if(!is_null($airdrop) && array_key_exists($node["node_id"], $airdrop)) $selected = "selected";
																			?>
																			<option value="<?=$node["node_id"]?>" <?=$selected?>><?=$node["denumire_ro"]?></option>
																		<?php endforeach; ?>
																		</select>
																		<?php endif; ?>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-sm-12">
																	<label class="col-sm-2">Selecteaza breadcrumbs</label>
																	<div class="col-sm-10">
																		<?php if(is_null($pages)): echo "Nu s-au gasit pagini"; ?>
																			<?php elseif(!is_null($pages)): ?>
																			<select multiple data-placeholder="Alege" class="choose_breadcrumbs" tabindex="4">
																			
																			<?php foreach($pages as $pages_pg): ?>
																				<?php
																				$selected = "";
																				$selected_plus = "";
																				if(!is_null($breadcrumb_assoc))
																				{
																					if(array_key_exists($pages_pg->atom_id, $breadcrumb_assoc))
																					{
																						$selected = "selected";
																					}
																					if(array_key_exists(intval('19881990' . $pages_pg->atom_id), $breadcrumb_assoc))
																					{
																						$selected_plus = 'selected';
																					}
																				}
																				?>
																				<option value="<?=$pages_pg->atom_id?>" <?=$selected?>><?=$pages_pg->title?></option>
																				<!-- <option value="<?='19881990' . $pages_pg->atom_id?>" <?=$selected_plus?>><?=$pages_pg->title?>( +pagini asociate )</option> -->
																			<?php endforeach; ?>
																			</select>
																			<?php endif; ?>
																	</div>
																</div>
															</div>															
														<?php if(!is_null($item)):?>
															<!--
															<div class="row" style="background-color:#f1f1f1;margin-left:-20px;margin-right:-20px;border-bottom:30px solid #fdfdfd;padding:7px;padding-bottom:10px;">
																<div class="form-group" style="margin:0;">
																	<label class="col-sm-2 control-label" style="text-align:left;"><span style="color:black;font-size:17px;font-weight:normal;"><sub><i class="fa fa-tags" style="color:#1c84c6;font-size:25px;"></i></sub>&nbsp;Asociaza investitii(proiecte)</span> <i class="fa fa-angle-double-right" style="font-size:15px;"></i></label>
																	
																	<div class="col-sm-10">
																		<?php if(is_null($investitii)): echo "Nu exista proiecte.."; ?>
																		<?php elseif(!is_null($investitii)): ?>
																		<select multiple data-placeholder="Alege proiecte" class="chosen-sl-investitii" tabindex="4">
																		
																		<?php foreach($investitii as $proiect): ?>
																			<?php
																			$selected = "";
																			if(!is_null($investitii_assoc) && array_key_exists($proiect->atom_id, $investitii_assoc)) $selected = "selected";
																			?>
																			<option value="<?=$proiect->atom_id?>" <?=$selected?>><?=$proiect->atom_name_ro?></option>
																		<?php endforeach; ?>
																		</select>
																		<?php endif; ?>
																	</div>
																</div>
															</div>-->
														<?php endif; ?>	
														<?php endif; ?>
														
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label"><?=$air->air_identnewitem?></label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Denumire <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->item->prefix;?>atom_name_ro" value="<?=(!is_null($item) && !is_null($item->atom_name_ro) ? $item->atom_name_ro : "");?>" required>
																</div>
															</div>
														</div>
														
														<?php if(!is_null($item)):?>
								
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label"><?=$air->air_identnewitem?><span style="color:red;"> ENG</span></label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Scrie <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->item->prefix;?>atom_name_en" value="<?=(!is_null($item) && !is_null($item->atom_name_en) ? $item->atom_name_en : "");?>">
																</div>
															</div>
														</div>													
							
                            							<hr>
                            
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label><h3>Descriere</h3></label>
																	<textarea name="<?=$form->item->prefix;?>i_content_ro" id="ncontentro" rows="4"><?=(!is_null($item) && !is_null($item->i_content_ro) ? $item->i_content_ro : "");?></textarea>
																</div>
															</div>
														
															<div class="col-md-6">
																<div class="form-group">
																	<label><h3>Descriere <span style="color:red;"> ENG</span></h3></label>
																	<textarea name="<?=$form->item->prefix;?>i_content_en" id="ncontenten" rows="4"><?=(!is_null($item) && !is_null($item->i_content_en) ? $item->i_content_en : "");?></textarea>
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-4">
																<div class="form-group">
																	<label><h3>Anunturi</h3></label>
																	<textarea name="<?=$form->item->prefix;?>anunturi" id="ncontentanunturi" rows="2"><?=(!is_null($item) && !is_null($item->anunturi) ? $item->anunturi : "");?></textarea>
																</div>
															</div>
		
															<div class="col-md-4">
																<div class="form-group">
																	<label><h3>Lucrari programate</h3></label>
																	<textarea name="<?=$form->item->prefix;?>lucrari_programate" id="ncontentlucrari_programate" rows="2"><?=(!is_null($item) && !is_null($item->lucrari_programate) ? $item->lucrari_programate : "");?></textarea>
																</div>
															</div>
															<div class="col-md-4">
																<div class="form-group">
																	<label><h3>Program caserie</h3></label>
																	<textarea name="<?=$form->item->prefix;?>program_caserie" id="ncontentprogram_caserie" rows="2"><?=(!is_null($item) && !is_null($item->program_caserie) ? $item->program_caserie : "");?></textarea>
																</div>
															</div>
														</div>															
														<?php endif; ?>
														
														<?php if(!is_null($item)):?>
														
														<div class="row">
															<div class="form-group">
																<div class="col-sm-2">
																	<div class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
																		<div class="img-thumbnail-btn">
																			<button type="button" class="btn btn-primary btn-fill btn-upfile" data-toggle="modal" data-target="#inpfileModal" onClick="filesetvars('poza', 'poza')">
																				Incarca imagine <br /><br/><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
																			</button>
																		</div>
																	</div>
																</div>
																<div class="col-sm-10">
																	<div id="p_imgpoza">
																		<?php
																			if(isset($item->i) && $item->i) {
																				foreach($item->i as $img) {
																					echo '
																						<div id="imgpoza-' .$img->id. '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
																							<div class="img-thumbnail" style="padding:2px;">
																								<img class="img-responsive" src="' .$imgpathitem.$img->img. '">
																								<div class="thumbfooter">
																									<a href="javascript:void(0)" onClick="return ajxdelimg(' .$img->id. ', \'poza\');return false"><code-remove>Elimina</code-remove></a>
																								</div>
																							</div>
																						</div>
																					';
																				}
																			}
																		?>
																	</div>
																</div>
															</div>
														</div>
														
														<?php endif; ?>
														
														<div class="hr-line-dashed"></div>
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

							<!--start#tab3-->
							<div id="tab3" class="tab-pane">
								<div class="panel-body">
									<div class="row">
										<h2 style="margin:0;">Harta</h2>
										<div class="hr-line-dashed"></div>
										<div class="col-md-12">
											<form class="form-horizontal" method="POST" name="" action="">
												<div class="content content-full-width">
													<div class="panel-group">
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Harta (iframe)</label>
																<div class="col-sm-10">
																	<!-- <input type="text" placeholder="Scrie persoana contact" class="form-control" name="pers_contact"> -->
																	<input type="text" placeholder="Introdu Harta" class="form-control" name="<?=$form->item->prefix;?>harta_suc" value="<?=(!is_null($item) && !is_null($item->harta_suc) ? $item->harta_suc : "");?>">
																</div>
															</div>
														</div>
														<div class="hr-line-dashed"></div>
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
											<div class="row">
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--end#tab3-->		

							<!--start#tab4-->
							<div id="tab4" class="tab-pane">
								<div class="panel-body">
									<div class="row">
										<h2 style="margin:0;">Date Contact</h2>
										<div class="hr-line-dashed"></div>
										<div class="col-md-12">
											<form class="form-horizontal" method="POST" name="<?=$form->date_contact->name;?>" action="<?=base_url().$form->date_contact->segments?>">
												<div class="content content-full-width">
													<div class="panel-group">
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Persoana Contact</label>
																<div class="col-sm-4">
																	<!-- <input type="text" placeholder="Scrie persoana contact" class="form-control" name="<?=$form->date_contact->prefix;?>pers_contact_suc"> -->
																	<input type="text" placeholder="Scrie persoana contact" class="form-control" name="<?=$form->date_contact->prefix;?>pers_contact_suc" value="<?=(!is_null($item) && !is_null($item->pers_contact_suc) ? $item->pers_contact_suc : "");?>">
																</div>

																<label class="col-sm-2 control-label">Adresa Sucursala</label>
																<div class="col-sm-4">
																	<input type="text" placeholder="Introdu adresa sucursalei" class="form-control" name="<?=$form->date_contact->prefix;?>adresa_suc" value="<?=(!is_null($item) && !is_null($item->adresa_suc) ? $item->adresa_suc : "");?>">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Telefon fix sucursala</label>
																<div class="col-sm-4">
																	<input type="text" placeholder="Introdu Telefon fix Sucursala" class="form-control" name="<?=$form->date_contact->prefix;?>tel_fix_suc" value="<?=(!is_null($item) && !is_null($item->tel_fix_suc) ? $item->tel_fix_suc : "");?>">
																</div>
																<label class="col-sm-2 control-label">Telefon mobil sucursala</label>
																<div class="col-sm-4">
																	<input type="text" placeholder="Introdu Telefon Mobil Sucursala" class="form-control" name="<?=$form->date_contact->prefix;?>tel_mob_suc" value="<?=(!is_null($item) && !is_null($item->tel_mob_suc) ? $item->tel_mob_suc : "");?>">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Email</label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Introdu email" class="form-control" name="<?=$form->date_contact->prefix;?>email_suc" value="<?=(!is_null($item) && !is_null($item->email_suc) ? $item->email_suc : "");?>">
																</div>
															</div>
														</div>
														<div class="hr-line-dashed"></div>
														<fieldset>
																<div class="form-group">
																	<div class="col-sm-12">
																		<button class="btn btn-white" type="button" onClick="location.href='<?=base_url()?>/texte_diverse'">Anuleaza</button>
																		<button class="btn btn-primary" type="submit" name="<?=$form->date_contact->prefix;?>submit"><?=(isset($uri->item) && $uri->item == "i" ? "Creeaza " . $air->air_identnewitem : "Salveaza modificarile")?></button>
																	</div>
																</div>
														</fieldset>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<!--end#tab4-->						
							
						</div>
					</div>
				</div>
			</div>

</div>
<?php if(!is_null($item)): ?>
	<!-- Modal upload image -->
	<form method="POST" id="fmodalupfile" class="form-horizontal" enctype="multipart/form-data">
	  <div class="modal fade" id="inpfileModal" tabindex="-1" role="dialog" aria-labelledby="inpfileModalLabel">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title" id="inpfileModalLabel">Incarca fisier</h4>
			</div>
			<div class="modal-body">
			  <input type="file" name="inpfile" size="50" class="form-control" />
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Renunta</button>
			  <button type="button" class="btn btn-primary btn-fill" onClick="return upfile(<?=$item->atom_id?>);return false;">Incarca imaginea</button>
			</div>
		  </div>
		</div>
	  </div>
	</form>
	
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
			  <button type="button" class="btn btn-primary btn-fill" onClick="return pdf.upfile(<?=$item->atom_id?>);return false;">Incarca imaginea</button>
			</div>
		  </div>
		</div>
	  </div>
	</form>
<?php endif; ?>
<?php endif; ?>
