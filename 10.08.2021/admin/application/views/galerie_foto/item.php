<?php
// var_dump($links);
// var_dump($item);
// var_dump($item_links);
// var_dump($data_object);
?>

<div class="wrapper wrapper-content animated fadeIn">

		<div class="row">
			<div class="col-md-12">

				<div class="tabs-container">

					<ul role="tablist" class="nav nav-tabs">
						<li role="presentation">
							<a href="javascript:void(0);"><strong style="color:black;">Imagine:</strong></a>
						</li>
						<li role="presentation" class="active">
							<a href="#tab1" data-toggle="tab"><?=(!is_null($item) && !is_null($item->item_name) ? $item->item_name : "Adauga imagine in galerie");?></a>
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
														<div class="row" style="background-color:#f1f1f1;margin-left:-20px;margin-right:-20px;border-bottom:30px solid #fdfdfd;border-top:2px solid #f8f8f8;padding:2px;">
															<div class="form-group" style="margin:0;">
																<label class="col-sm-3 control-label" style="text-align:left;"><span style="color:black;font-size:17px;font-weight:normal;"><i class="fa fa-anchor" style="color:#1c84c6"></i>&nbsp;&nbsp;Afisare in Galerie &nbsp;</span> <i class="fa fa-angle-double-right" style="font-size:15px;"></i></label>
																
                                <div class="col-sm-9">
																	<?php if(is_null($links)): echo '<h4 style="margin-top:10px;">Nu exista Sectiuni create in Galeria foto</h4>'; ?>
																	<?php elseif(!is_null($links)): ?>
																	<select multiple data-placeholder="Acest item nu se afiseaza" class="chosen-sl-links" tabindex="4">
																	
																	<?php foreach($links as $link): ?>
																		<?php
																		$selected = "";
																		if(!is_null($item_links) && array_key_exists($link->id_link, $item_links)) $selected = "selected";
																		?>
																		<option value="<?=$link->id_link?>" <?=$selected?>><?=$link->denumire_ro?></option>
																	<?php endforeach; ?>
																	</select>
																	<?php endif; ?>
																</div>
															</div>
														</div>
														<?php endif; ?>
														
                            <?php if(is_null($item)):?>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Nr. ordine</label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Numar ordine" class="form-control" name="<?=$form->item->prefix;?>item_name" value="<?=(!is_null($item) && !is_null($item->item_name) ? $item->item_name : $auto_increment);?>" required readonly>
																</div>
															</div>
														</div>
                            <?php endif; ?>
														
														<?php if(!is_null($item)):?>
														<div class="row">
															<div class="form-group">
																<label class="col-sm-2 control-label">Text reprezentativ imaginii<br>max. 50 caractere</label>
																<div class="col-sm-10">
																	<input type="text" placeholder="Descriere scurta a imaginii" class="form-control" name="<?=$form->item->prefix;?>text_reprezentativ" value="<?=(!is_null($item) && !is_null($item->text_reprezentativ) ? $item->text_reprezentativ : "");?>">
																</div>
															</div>
														</div>													
														
														<?php endif; ?>
														
                            <hr>
                            
														<?php if(!is_null($item)):?>
														<div class="row">
															<div class="form-group">
																<div class="col-sm-2">
																	<!-- <input type="file" name="poza" size="50" class="form-control"> -->
																	<!-- Button trigger modal -->
																	<div class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
																		<div class="img-thumbnail-btn">
																			<button type="button" id="btnupimg" style="<?=$item->i ? 'visibility:hidden;' : ''?>" class="btn btn-primary btn-fill btn-upfile" data-toggle="modal" data-target="#inpfileModal" onClick="filesetvars('poza', 'poza')">
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
																						<div id="imgpoza-' .$img->id. '" class="col-lg-4 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
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
																		<button class="btn btn-white" type="button" onClick="location.href='<?=base_url().$controller?>/sectiune/<?=$id_link?>'">Anuleaza</button>
																		<button class="btn btn-primary" type="submit" name="<?=$form->item->prefix;?>submit"><?=(isset($uri->item) && $uri->item == "i" ? "Mai departe" : "Salveaza modificarile")?></button>
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
                  <button type="button" class="btn btn-primary btn-fill" onClick="return upfile(<?=$item->id_item?>);return false;">Incarca imaginea</button>
                </div>
              </div>
            </div>
          </div>
        </form>