<?php
// var_dump($links);
// var_dump($item);
// var_dump($item_links);
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
							<a href="#tab2" data-toggle="tab">Promovarea proiectului</a>
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
															<div class="row" style="background-color:#f1f1f1;margin-left:-20px;margin-right:-20px;border-bottom:1px solid #fdfdfd;padding:7px;padding-bottom:10px;">
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
															
															
															<?php if(!is_null($pages)):?>
																<div class="row" style="background-color:#f1f1f1;margin-left:-20px;margin-right:-20px;border-bottom:30px solid #fdfdfd;padding:7px;padding-bottom:10px;">
																	<div class="form-group" style="margin:0;">
																		<label class="col-sm-2 control-label" style="text-align:left;"><span style="color:black;font-size:17px;font-weight:normal;"><sub><i class="fa fa-tags" style="color:#1c84c6;font-size:25px;"></i></sub>&nbsp;Asociaza pagini</span> <i class="fa fa-angle-double-right" style="font-size:15px;"></i></label>
																		
																		<div class="col-sm-10">
																			<?php if(is_null($pages)): echo "Nu s-au gasit pagini"; ?>
																			<?php elseif(!is_null($pages)): ?>
																			<select multiple data-placeholder="Alege pagini" class="chosen-sl-pages" tabindex="4">
																			
																			<?php foreach($pages as $pages_pg): ?>
																				<?php
																				$selected = "";
																				if(!is_null($page_pages) && array_key_exists($pages_pg->atom_id, $page_pages)) $selected = "selected";
																				?>
																				<option value="<?=$pages_pg->atom_id?>" <?=$selected?>><?=$pages_pg->title?></option>
																			<?php endforeach; ?>
																			</select>
																			<?php endif; ?>
																		</div>
																	</div>
																</div>
															<?php endif; ?>
															
														<?php endif; ?>
														<div class="row">
															<div class="form-group" >
																<div class="col-sm-12">
																	<label class="col-sm-2 control-label">Selecteaza breadcrumbs</label>
																	<div class="col-sm-10">
																		<?php if(is_null($pages_bread)): echo "Nu s-au gasit pagini"; ?>
																			<?php elseif(!is_null(pages_bread)): ?>
																			<select multiple data-placeholder="Alege" class="choose_breadcrumbs" tabindex="4">
																			
																			<?php foreach($pages_bread as $pages_pg): ?>
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
														</div>															
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Nume <?=$air->air_identnewitem?></label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Denumeste <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->item->prefix;?>atom_name_ro" value="<?=(!is_null($item) && !is_null($item->atom_name_ro) ? $item->atom_name_ro : "");?>" required>
																</div>
															</div>
														</div>
														
														<?php if(!is_null($item)):?>
								
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Nume <?=$air->air_identnewitem?><span style="color:red;"> ENG</span></label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Denumeste <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->item->prefix;?>atom_name_en" value="<?=(!is_null($item) && !is_null($item->atom_name_en) ? $item->atom_name_en : "");?>">
																</div>
															</div>
														</div>
														
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Diriginte santier </label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Numele dirigintelui de santier" class="form-control" name="<?=$form->item->prefix;?>diriginte_santier" value="<?=(!is_null($item) && !is_null($item->diriginte_santier) ? $item->diriginte_santier : "");?>">
																</div>
															</div>
														</div>
														
														<hr>
														
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Data proiect</label>
																<div class="col-sm-10">
																	<div class="input-group date">
																		<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
																		<input type="text" class="form-control" value="<?=date_format(date_create($item->data_proiect), 'm/d/Y')?>" name="<?=$form->item->prefix;?>data_proiect" id="data_1">
																	</div>
																</div>
															</div>
														</div>
														
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Status proiect</label>
																<div class="col-sm-10">
																	<select class="form-control m-b" name="<?=$form->item->prefix;?>status_proiect">
																		<option value="0"<?=($item->status_proiect == 0 ? ' selected' : '');?>>In derulare</option>
																		<option value="1"<?=($item->status_proiect == 1 ? ' selected' : '');?>>Finalizat</option>
																	</select>
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

														<div class="row">
															<div class="form-group">
																<div class="col-sm-2">
																	<!-- <input type="file" name="poza" size="50" class="form-control"> -->
																	<!-- Button trigger modal -->
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
										<div class="col-md-12">
											<form class="form-horizontal" method="POST" name="<?=$form->item->name;?>" action="<?=base_url().$form->item->segments?>">
												<div class="content content-full-width">
													<div class="panel-group">
														
														<?php if(!is_null($item)):?>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Titlu promovare <?=$air->air_identnewitem?></label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Titlu promovare <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->promo->prefix;?>promovare_titlu_ro" value="<?=(!is_null($item) && !is_null($item->promovare_titlu_ro) ? $item->promovare_titlu_ro : "");?>">
																</div>
															</div>
														</div>
														
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Titlu promovare <?=$air->air_identnewitem?><span style="color:red;"> ENG</span></label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Titlu promovare <?=$air->air_identnewitem?>" class="form-control" name="<?=$form->promo->prefix;?>promovare_titlu_en" value="<?=(!is_null($item) && !is_null($item->promovare_titlu_en) ? $item->promovare_titlu_en : "");?>">
																</div>
															</div>
														</div>
                            
                            <hr>
                            
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																		<label><h3>Continut</h3></label>
																			<textarea name="<?=$form->promo->prefix;?>promovare_content_ro" id="ncontentpromoro" rows="4"><?=(!is_null($item) && !is_null($item->promovare_content_ro) ? $item->promovare_content_ro : "");?></textarea>
																</div>
															</div>
														</div>		

														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																		<label><h3>Continut <span style="color:red;"> ENG</span></h3></label>
																			<textarea name="<?=$form->promo->prefix;?>promovare_content_en" id="ncontentpromoen" rows="4"><?=(!is_null($item) && !is_null($item->promovare_content_en) ? $item->promovare_content_en : "");?></textarea>
																</div>
															</div>
														</div>														
														<?php endif; ?>
														
														<?php if(!is_null($item)):?>
														<div class="row">
															<div class="form-group">
																<div class="col-sm-2">
																	<!-- <input type="file" name="poza" size="50" class="form-control"> -->
																	<!-- Button trigger modal -->
																	<div class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
																		<div class="img-thumbnail-btn">
																			<button type="button" class="btn btn-primary btn-fill btn-upfile" data-toggle="modal" data-target="#inpfileModal" onClick="filesetvars('poza_promo', 'poza_promo')">
																				Incarca imagine <br /><br/><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i>
																			</button>
																		</div>
																	</div>
																</div>
																<div class="col-sm-10">
																	<div id="p_imgpoza_promo">
																		<?php
																			if(isset($item->ip) && $item->ip) {
																				foreach($item->ip as $img_promo) {
																					echo '
																						<div id="imgpoza_promo-' .$img_promo->id. '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
																							<div class="img-thumbnail" style="padding:2px;">
																								<img class="img-responsive" src="' .$imgpathitem.$img_promo->img. '">
																								<div class="thumbfooter">
																									<a href="javascript:void(0)" onClick="return ajxdelimg(' .$img_promo->id. ', \'poza_promo\');return false"><code-remove>Elimina</code-remove></a>
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
																		<button class="btn btn-primary" type="submit" name="<?=$form->promo->prefix;?>submit"><?=(isset($uri->item) && $uri->item == "i" ? "Creeaza " . $air->air_identnewitem : "Salveaza modificarile")?></button>
																	</div>
																</div>
														</fieldset>
													</div>
												</div>
											</form>
										</div> <!-- end col-md-12 -->
									</div>
								</div>
							</div><!--end#tab2-->							
							
						</div>
					</div>
				</div>
			</div>

</div>
        <!-- Modal upload image -->
        <form method="POST" id="fmodalupfile" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal fade" id="inpfileModal" tabindex="-1" role="dialog" aria-labelledby="inpfileModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="inpfileModalLabel">Incarca imagine</h4>
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