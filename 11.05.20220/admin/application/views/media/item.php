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
							<a href="#tab1" data-toggle="tab"><?=(!is_null($item) && !is_null($item->atom_name_ro) ? $item->atom_name_ro : "Nou");?></a>
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
														<?php if(!is_null($item)):?>
															<div class="row" style="background-color:#f1f1f1;margin-left:-20px;margin-right:-20px;border-bottom:30px solid #fdfdfd;padding:7px;padding-bottom:10px;">
																<div class="form-group" style="margin:0;">
																	<label class="col-sm-2 control-label" style="text-align:left;"><span style="color:black;font-size:17px;font-weight:normal;"><sub><i class="fa fa-plug" style="color:orange;font-size:25px;"></i></sub>&nbsp;&nbsp;Afi&scedil;eaz&abreve; pe&nbsp;</span> <i class="fa fa-angle-double-right" style="font-size:15px;"></i></label>
																	
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
														<?php endif; ?>													
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label"><?=$air->air_identnewitem?>(titlu)</label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Denumeste <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->item->prefix;?>atom_name_ro" value="<?=(!is_null($item) && !is_null($item->atom_name_ro) ? $item->atom_name_ro : "");?>" required>
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
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Adresa de legatura</label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Creeaza legatura" class="form-control" name="<?=$form->item->prefix;?>link_href" value="<?=(!is_null($item) && !is_null($item->link_href) ? $item->link_href : "");?>">
																	<span class="help-block m-b-none"><i>Exemplu: http://www.site.ro/pagina</i></span>
																</div>
															</div>
														</div>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Data</label>
																<div class="col-sm-10">
																	<div class="input-group date">
																		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																		<input type="text" class="form-control" value="<?=(!empty($item->item_date) ? date_format(date_create($item->item_date), 'm/d/Y') : '')?>" name="<?=$form->item->prefix;?>item_date" id="data_1">
																	</div>
																</div>
															</div>
														</div>														
							
                            <hr>
                            
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																		<label><h3>Continut</h3></label>
																			<textarea name="<?=$form->item->prefix;?>i_content_ro" id="ncontentro" rows="4"><?=(!is_null($item) && !is_null($item->i_content_ro) ? $item->i_content_ro : "");?></textarea>
																</div>
															</div>
														</div>		

														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																		<label><h3>Continut <span style="color:red;"> ENG</span></h3></label>
																			<textarea name="<?=$form->item->prefix;?>i_content_en" id="ncontenten" rows="4"><?=(!is_null($item) && !is_null($item->i_content_en) ? $item->i_content_en : "");?></textarea>
																</div>
															</div>
														</div>														
														<?php endif; ?>
														
														<?php if(!is_null($item)):?>
														<!--
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
														-->
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
									<div class="mail-attachment" id="pdf-container">
									</div>
									</div>
								</div>
							</div><!--end#tab2-->							
							
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
