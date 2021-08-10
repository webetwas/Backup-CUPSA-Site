<?php
/*
echo "<pre>";
print_r($page);die();
echo "</pre>";
*/
// var_dump($controller_ajax);die();

 //var_dump($page->b);die();
// var_dump($pages);die();
//var_dump($pages_pg);die();
?>

        <div class="wrapper wrapper-content animated fadeIn">

            <div class="row">
              <div class="col-md-12">

                <div class="tabs-container">

                  <ul role="tablist" class="nav nav-tabs">
                    <li role="presentation">
                      <a href="javascript:void(0);"><strong style="color:black;">Editare Pagina:</strong></a>
                    </li>
                    <li role="presentation" class="active">
                      <a href="#pagina" data-toggle="tab"><?=$page->p->title;?> </a>
                    </li>
					<?php if($application->user->privilege): ?>
						<li role="presentation">
						<a href="#structura" data-toggle="tab">Structura</a>
						</li>
						<li role="presentation">
						<a href="#adaugapdf" data-toggle="tab">Documente</a>
						</li>
						<li role="presentation">
						<a href="#pagina_meta" data-toggle="tab">Meta </a>
						</li>
					<?php endif; ?>
					

                  </ul>

                    <div class="tab-content">
											<!--start#pagina-->
                      <div id="pagina" class="tab-pane active">
							<div class="panel-body">
								<div class="row">
									<div class="col-md-12">
									
									
									<?php if(!is_null($page) && !is_null($pages)):?>
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
														$selected_plus = "";
														if(!is_null($page_pages))
														{
															if(array_key_exists($pages_pg->atom_id, $page_pages))
															{
																$selected = "selected";
															}
															if(array_key_exists(intval('19881990' . $pages_pg->atom_id), $page_pages))
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
									<?php endif; ?>														
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
									
										<?php if(!is_null($page) && !is_null($page->s) && $page->s->filehtml == "pagina"): ?>
										<div class="row">
											<div class="col-sm-12">
											<div class="alert alert-info" style="border-radius:2px;"><span>Aceasta pagina se poate ancora prin urmatorul Segment url:</span><br /><code>p/<?=$page->p->id_page?></code></div>
											</div>
										</div>
										<?php endif; ?>
										<form method="POST" name="<?=$form->item->name;?>" action="<?=base_url().$form->item->segments?>">
											<?php
												// User
												if(!$application->user->privilege && !is_null($page->p->admin_message)) echo '<div class="alert alert-info" style="border-radius:2px;"><span>' .$page->p->admin_message. '</span></div>';
											?>

												<?php if( $page->s->banner1 || $page->s->banner2 || $page->s->banner3 || $page->s->banner4): ?>
												<div class="row rowbanner" style="margin-left:25px;">
													<div class="content content-full-width">
                                        <!-- banners_panel -->
					<div class="panel-group" id="banner-main">
                                        
                                        <?php $totalbanners = 4; ?>
                                        <?php for($ib = 1; $ib < $totalbanners+1; $ib++): ?>
                                        
                                        <?php $bannerkey = 'banner' .$ib; ?>
                                        
                                          <?php if(!is_null($page) && !is_null($page->s) && $page->s->{$bannerkey}): ?>
                                          <!-- <?=$bannerkey?>_panel -->
                                          <div class="panel panel-default">
                                              <div class="panel-heading" style="position:relative;">
                                                  <h4 class="panel-title">
                                                    <a data-target="#collapse<?=$bannerkey?>" href="javascript:void(0);" data-toggle="collapse">
                                                    <?php
                                                    // if($page->p->id_page === "acasa") {
                                                    if($bannerkey == "banner1") {
														echo 'Banner';
                                                    } else {
                                                      echo 'Imagine banner';
                                                    }
                                                    ?>
                                                    </a>
                                                  </h4>
                                              </div>
                                              <div id="collapse<?=$bannerkey?>" class="panel-collapse collapse">
                                                  <div class="panel-body">
                                                    <div class="row">
                                                      <div class="col-sm-2" style="padding:20px;">
                                                        <!-- Button trigger modal -->
                                                      <button type="button" id="<?=$bannerkey?>btnup" <?=(isset($page->b->{$bannerkey}) ? 'style="visibility:hidden;"' : "")?> class="btn btn-primary btn-fill" data-toggle="modal" data-target="#inpfileModal" onClick="filesetvars('banner', '<?=$bannerkey?>')">
                                                          Incarca Banner
                                                        </button>
														
														<div class="file-box" style="margin-top:15px;">
															<div class="file">
																<a href="javascript:void(0)" id="images-add-new">
																	<span class="corner"></span>

																	<div class="icon">
																		<i class="fa fa-file-image-o"></i>
																	</div>
																	<div class="file-name">
																		<strong style="font-size:16px;">Incarca imagine</strong>
																	</div>
																</a>
															</div>
														</div>	
                                                      </div>
                                                      <div class="col-sm-10">
                                                        <div id="p_img<?=$bannerkey?>" class="p_imgbanners">
                                                          <?php
                                                          if(isset($page->b->{$bannerkey})) {
                                                            echo
                                                            '
                                                            <div id="img' .$bannerkey. '-' .$page->b->{$bannerkey}->id. '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
                                                              <div class="img-thumbnail" style="padding:2px;">
                                                                <img class="img-responsive" src="' .SITE_URL.PATH_IMG_BANNERS.$page->b->{$bannerkey}->img. '">
                                                                <div class="thumbfooter">
                                                                  <a href="javascript:void(0)" onClick="return ajxdelimg(' .$page->b->{$bannerkey}->id. ', \'' .$bannerkey. '\');return false"><code-remove>Elimina Banner</code-remove></a>
                                                                </div>
                                                              </div>
                                                            </div>
                                                            ';
                                                          }
                                                           ?>
                                                        </div>
                                                      </div>
                                                    </div>

													<?php if($bannerkey == "banner1" && $page->p->id_page == "acasa") : ?>
                                                    <div id="banner1formdata" <?=(isset($page->b->{$bannerkey}) ? 'style="visibility:visible;"' : 'style="visibility:hidden;"')?>>
                                                      
                                                      <div class="row">
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label><span style="font-size:12px;">Titlu</span></label>
                                                            <input type="text" name="<?=$bannerkey?>ti" value="<?=(!is_null($page->b) && isset($page->b->{$bannerkey}) && !is_null($page->b->{$bannerkey}->titlu) ? $page->b->{$bannerkey}->titlu : "");?>" placeholder="Titlu banner" class="form-control input-sm">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      
                                                      <div class="row">
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label><span style="font-size:12px;">Subtitlu</span></label>
                                                            <input type="text" name="<?=$bannerkey?>sti" value="<?=(!is_null($page->b) && isset($page->b->{$bannerkey}) && !is_null($page->b->{$bannerkey}->subtitlu) ? $page->b->{$bannerkey}->subtitlu : "");?>" placeholder="Subtitlu banner" class="form-control input-sm">
                                                          </div>
                                                        </div>
                                                      </div>

                                                      <div class="row">
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label style="color:#1ab394;font-weight:bold;"><span style="font-size:12px;">Buton de legatura</span></label>
                                                            <input type="text" name="<?=$bannerkey?>href1" value="<?=(!is_null($page->b) && isset($page->b->{$bannerkey}) && !is_null($page->b->{$bannerkey}->href1) ? $page->b->{$bannerkey}->href1 : "");?>" placeholder="Adresa link href" class="form-control input-sm">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      
                                                      <div class="row">
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <label><span style="font-size:12px;">Text pentru butonul de legatura</span></label>
                                                            <input type="text" name="<?=$bannerkey?>thref1" value="<?=(!is_null($page->b) && isset($page->b->{$bannerkey}) && !is_null($page->b->{$bannerkey}->thref1) ? $page->b->{$bannerkey}->thref1 : "");?>" placeholder="Text pentru butonul de legatura" class="form-control input-sm">
                                                          </div>
                                                        </div>
                                                      </div>
                                                      
                                                      <fieldset>
                                                      <div class="form-group">
                                                          <div class="col-sm-12">
                                                            <button type="button" class="btn btn-sm btn-info btn-fill btn-wd" onClick="return bannerfdata('<?=$bannerkey?>');return false;">Salveaza modificarile</button>
                                                          </div>
                                                      </div>
                                                      </fieldset>
                                                    </div>
													<?php endif; ?>

                                                  </div>
                                              </div>
                                          </div>
                                          <!-- <?=$bannerkey?>_panel -->
                                          <?php endif; ?>
                                          
                                        <?php endfor; ?>
									</div>
                                        <!-- banners_panel -->
								</div>
							</div>
							<hr>
							<?php endif; ?>

							<?php if($page->s->image): ?>
							<div class="col-sm-12">
							<div class="row">
								<div class="form-group">
									<label>Imagini</label>
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
								</div>
								<div class="form-group">
									<div class="col-sm-10">
										<div id="p_imgpoza">
											<?php
												if(!is_null($page->i)) {
													foreach($page->i as $img) {
														echo '
															<div id="imgpoza-' .$img->id. '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
																<div class="img-thumbnail" style="padding:2px;">
																	<img class="img-responsive" src="' .$imgpathpage.$img->img. '">
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
							<hr>
							<?php if($page->p->id_page === "acasa") { ?>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label><h3>Descriere imagine</h3></label>
											<input type="text" name="<?=$form->item->prefix;?>yt_link_desc" value="<?=(!is_null($page->p->yt_link_desc) ? $page->p->yt_link_desc : "");?>" placeholder="Descrierea imaginii" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label><h3>Youtube link</h3></label>
											<input type="text" name="<?=$form->item->prefix;?>yt_link" value="<?=(!is_null($page->p->yt_link) ? $page->p->yt_link : "");?>" placeholder="Link youtube video" class="form-control">
										</div>
									</div>
								</div>																		
							<?php } ?>
							</div>
							<?php endif; ?>
							
							<?php if($page->s->title_content): ?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label><h3>Titlu continut</h3></label>
										<input type="text" name="<?=$form->item->prefix;?>title_content_ro" value="<?=(!is_null($page->p->title_content_ro) ? $page->p->title_content_ro : "");?>" placeholder="Titlu continut" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label><h3>Titlu continut <span style="color:red;">ENG</span></h3></label>
										<input type="text" name="<?=$form->item->prefix;?>title_content_en" value="<?=(!is_null($page->p->title_content_en) ? $page->p->title_content_en : "");?>" placeholder="Titlu continut eng" class="form-control">
									</div>
								</div>
							</div>
							<?php endif; ?>
							
							<?php if($page->s->subtitle_content): ?>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label><h3>Subtitlu continut</h3></label>
										<input type="text" name="<?=$form->item->prefix;?>subtitle_content_ro" value="<?=(!is_null($page->p->subtitle_content_ro) ? $page->p->subtitle_content_ro : "");?>" placeholder="Subtitlu continut" class="form-control">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label><h3>Subtitlu continut <span style="color:red;">ENG</h3></label>
										<input type="text" name="<?=$form->item->prefix;?>subtitle_content_en" value="<?=(!is_null($page->p->subtitle_content_en) ? $page->p->subtitle_content_en : "");?>" placeholder="Subtitlu continut" class="form-control">
									</div>
								</div>
							</div>
							<?php endif; ?>
							
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
											<label><h3>Continut pagina</h3></label>
												<textarea name="<?=$form->item->prefix;?>content_ro" id="ncontentro" rows="4"><?=$page->p->content_ro;?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
											<label><h3>Continut pagina <span style="color:red;">ENG</span></h3></label>
												<textarea name="<?=$form->item->prefix;?>content_en" id="ncontenten" rows="4"><?=$page->p->content_en;?></textarea>
									</div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<fieldset>
									<div class="form-group">
											<div class="col-sm-12">
													<button class="btn btn-white" type="button" onClick="location.href='<?=base_url()?>'">Anuleaza</button>
													<button type="submit" name="<?=$form->item->prefix;?>submit" class="btn btn-info btn-fill btn-wd" onClick="return showloader();">Salveaza modificarile</button>
											</div>
									</div>
							</fieldset>
					</form>
				</div> <!-- end col-md-12 -->
			</div>
		</div>
                      </div>
					  <!--end#pagina-->

                      <!--add pdf page-->

<!--adauga pdf pagini-->

		<div id="adaugapdf" class="tab-pane">
			<div class="panel-body">
				<div class="row">
					<h2 style="margin:0;">Fisier PDF</h2>
					<div class="mail-attachment" id="pdf-container"></div>
				</div>
			</div>
		</div>

	
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
							<button type="button" class="btn btn-primary btn-fill" onClick="return pdf.upfile(<?=$page->p->atom_id?>);return false;">Incarca fisier PDF</button>
						</div>
					</div>
				</div>
			</div>
		</form>


<!--adauga pdf pagini-->


											
<!--start#pagina_meta-->
	<div id="pagina_meta" class="tab-pane">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12">
					<form method="POST" name="<?=$form->meta->name;?>" action="<?=base_url().$form->meta->segments?>">

						<?php
							// Admin
							if($application->user->privilege) {
								echo '
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>Informatii suplimentare despre Pagina</label>
											<input type="text" name="' .$form->meta->prefix. 'admin_message" value="' .$page->p->admin_message. '" placeholder="" class="form-control">
										</div>
									</div>';
									echo '
									<div class="col-sm-6">
										<div class="form-group">
											<label>ID Page</label>
											<input type="text" name="' .$form->meta->prefix. 'id_page" value="' .$page->p->id_page. '" placeholder="Pagina" class="form-control" disabled>
										</div>
									</div>
								</div>';
						}
						?>													

							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
											<label>Pagina</label>
											<input type="text" name="<?=$form->meta->prefix;?>title" value="<?=$page->p->title;?>" placeholder="Pagina" class="form-control">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Titlu</label>
										<input type="text" name="<?=$form->meta->prefix;?>title_ro" value="<?=$page->p->title_ro;?>" placeholder="Titlu" class="form-control">
									</div>
								</div>
							
								<div class="col-sm-6">
									<div class="form-group">
										<label>Titlu <span style="color:red;">ENG</span></label>
										<input type="text" name="<?=$form->meta->prefix;?>title_en" value="<?=$page->p->title_en;?>" placeholder="Titlu eng" class="form-control">
									</div>
								</div>

								<div class="col-sm-6">
									<div class="form-group">
										<label>Titlu Browser</label>
										<input type="text" name="<?=$form->meta->prefix;?>title_browser_ro" value="<?=$page->p->title_browser_ro;?>" placeholder="Titlu Browser" class="form-control">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Meta description</label>
										<input type="text" name="<?=$form->meta->prefix;?>meta_description" value="<?=(!is_null($page->p->meta_description) ? $page->p->meta_description : "");?>" placeholder="Meta description" class="form-control">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Keywords</label>
										<input type="text" name="<?=$form->meta->prefix;?>keywords" value="<?=(!is_null($page->p->keywords) ? $page->p->keywords : "");?>" placeholder="Keywords" class="form-control">
										<span class="help-block">"cuvant, cuvant cheie, alt cuvant"</span>
									</div>
								</div>
							</div>
							<div class="hr-line-dashed"></div>
							<fieldset>
									<div class="form-group">
											<div class="col-sm-12">
												<button class="btn btn-white" type="button" onClick="location.href='<?=base_url()?>'">Anuleaza</button>
												<button type="submit" name="<?=$form->meta->prefix;?>submit" class="btn btn-info btn-fill btn-wd" onClick="return showloader();">Salveaza modificarile</button>
											</div>
									</div>
							</fieldset>
					</form>
				</div> <!-- end col-md-12 -->
			</div>
		</div>
	</div>


	<!--end#pagina_meta-->											
						
<?php if($application->user->privilege): ?>
<!--#structura-->
<div id="structura" class="tab-pane">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">		
				<form method="POST" name="<?=$form->structura->name;?>" action="<?=base_url().$form->structura->segments?>">
					<?php if($page->p->id_page != "acasa" && $page->p->id_page != "contact"): ?>
					<fieldset>
						<div class="form-group">
							<label class="col-sm-2 control-label"><i class="fa fa-cog" aria-hidden="true"></i> Left sidebar</label>
							<div class="col-sm-10">
								<label class="checkbox">
									<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>left_sidebar" <?=(!is_null($page) && !is_null($page->s) && $page->s->left_sidebar ? "checked" : "")?>>Afiseaza meniul din partea stanga
								</label>
							</div>
						</div>
					</fieldset>
					<hr>
					<?php endif; ?>
				
					<fieldset>
						<div class="form-group">
							<label class="col-sm-2 control-label"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Titlu</label>
							<div class="col-sm-10">
								<label class="checkbox">
									<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>title_content" <?=(!is_null($page) && !is_null($page->s) && $page->s->title_content ? "checked" : "")?>>Titlu continut
								</label>
							</div>
						</div>
					</fieldset>																
					
					<fieldset>
						<div class="form-group">
							<label class="col-sm-2 control-label"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Subtitlu</label>
							<div class="col-sm-10">
								<label class="checkbox">
									<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>subtitle_content" <?=(!is_null($page) && !is_null($page->s) && $page->s->subtitle_content ? "checked" : "")?>>Subtitlu continut
								</label>
							</div>
						</div>
					</fieldset>	

				<hr>
					<fieldset>
						<div class="form-group" id="adaugapdf">
							<label class="col-sm-2 control-label"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pozitionare PDF</label>
							<div class="col-sm-10">
								<label for="top" class="checkbox">
									<input type="checkbox" data-toggle="checkbox" id="top" name="top" value="1"> Deasupra textului
								</label>
								<label for="bottom" class="checkbox">
									<input type="checkbox" data-toggle="checkbox" id="bottom" name="bottom" value="2"> Sfarsitul textului
								</label>
							</div>
						</div>		
					</fieldset>
				<hr>

					<fieldset>
						<div class="form-group">
							<label class="col-sm-2 control-label"><i class="fa fa-fighter-jet" aria-hidden="true"></i> is_active</label>
							<div class="col-sm-10">
								<label class="checkbox">
									<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>is_active" <?=(!is_null($page) && !is_null($page->s) && $page->s->is_active ? "checked" : "")?>>Pagina activa
								</label>
							</div>
						</div>
					</fieldset>
					
					<fieldset>
							<div class="form-group">
									<label class="col-sm-2 control-label"><i class="fa fa-fighter-jet" aria-hidden="true"></i> is_page</label>
									<div class="col-sm-10">
											<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>is_page" <?=(!is_null($page) && !is_null($page->s) && $page->s->is_page ? "checked" : "")?>>IS
											</label>
									</div>
							</div>
					</fieldset>															

					<fieldset>
							<div class="form-group">
									<label class="col-sm-2 control-label"><i class="fa fa-fighter-jet" aria-hidden="true"></i> gotcontroller</label>
									<div class="col-sm-10">
											<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>gotcontroller" <?=(!is_null($page) && !is_null($page->s) && $page->s->gotcontroller ? "checked" : "")?>>Controller
											</label>
									</div>
							</div>
					</fieldset>	
				
					<fieldset>
							<div class="form-group">
									<label class="col-sm-2 control-label"><i class="fa fa-plane" aria-hidden="true"></i> Meniu</label>
									<div class="col-sm-10">
											<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>menu" <?=(!is_null($page) && !is_null($page->s) && $page->s->menu ? "checked" : "")?>>Afiseaza Meniu
											</label>
									</div>
							</div>
					</fieldset>
					
					<fieldset>
							<div class="form-group">
									<label class="col-sm-2 control-label"><i class="fa fa-plane" aria-hidden="true"></i> Slider</label>
									<div class="col-sm-10">
											<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>slider" <?=(!is_null($page) && !is_null($page->s) && $page->s->slider ? "checked" : "")?>>Afiseaza Slider
											</label>
									</div>
							</div>
					</fieldset>

					<fieldset>
							<div class="form-group">
									<label class="col-sm-2 control-label"><i class="fa fa-rocket" aria-hidden="true"></i> View</label>
									<div class="col-sm-10">
										<div class="row">
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><strong style="color:#4285f4;">View</strong></span>
													<input type="text" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->filehtml) ? $page->s->filehtml : "")?>" name="<?=$form->structura->prefix;?>filehtml">
												</div>
												<span class="help-block"><code>view/</code>folder/folder/file</span>
											</div>
											<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon"><strong style="color:#4285f4;">JS</strong></span>
													<input type="text" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->filejs) ? $page->s->filejs : "")?>" name="<?=$form->structura->prefix;?>filejs">
												</div>
												<span class="help-block"><code>view/</code>folder/folder/file</span>
											</div>
										</div>
									</div>
							</div>
					</fieldset>
			
					
					<fieldset style="margin-top:10px;">
							<div class="form-group">
									<label class="col-sm-2 control-label"><i class="fa fa-rocket" aria-hidden="true"></i> Banner</label>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner1" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner1 ? "checked" : "")?>>#1 Afiseaza
												</label>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Width</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner1_w) ? $page->s->banner1_w : "")?>" name="<?=$form->structura->prefix;?>banner1_w">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Height</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner1_h) ? $page->s->banner1_h : "")?>" name="<?=$form->structura->prefix;?>banner1_h">
												</div>
											</div>
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner1_p" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner1_p ? "checked" : "")?>>Proportii
												</label>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner2" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner2 ? "checked" : "")?>>#2 Afiseaza
												</label>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Width</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner2_w) ? $page->s->banner2_w : "")?>" name="<?=$form->structura->prefix;?>banner2_w">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Height</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner2_h) ? $page->s->banner2_h : "")?>" name="<?=$form->structura->prefix;?>banner2_h">
												</div>
											</div>
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner2_p" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner2_p ? "checked" : "")?>>Proportii
												</label>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner3" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner3 ? "checked" : "")?>>#3 Afiseaza
												</label>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Width</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner3_w) ? $page->s->banner3_w : "")?>" name="<?=$form->structura->prefix;?>banner3_w">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Height</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner3_h) ? $page->s->banner3_h : "")?>" name="<?=$form->structura->prefix;?>banner3_h">
												</div>
											</div>
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner3_p" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner3_p ? "checked" : "")?>>Proportii
												</label>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner4" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner4 ? "checked" : "")?>>#4 Afiseaza
												</label>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Width</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner4_w) ? $page->s->banner4_w : "")?>" name="<?=$form->structura->prefix;?>banner4_w">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon">Height</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->banner4_h) ? $page->s->banner4_h : "")?>" name="<?=$form->structura->prefix;?>banner4_h">
												</div>
											</div>
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>banner4_p" <?=(!is_null($page) && !is_null($page->s) && $page->s->banner4_p ? "checked" : "")?>>Proportii
												</label>
											</div>
										</div>
									</div>
							</div>
					</fieldset>
					
					<fieldset style="margin-top:10px;">
							<div class="form-group">
									<label class="col-sm-2 control-label"><i class="fa fa-rocket" aria-hidden="true"></i> Imagini</label>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>image" <?=(!is_null($page) && !is_null($page->s) && $page->s->image ? "checked" : "")?>>Afiseaza
												</label>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon"><code>S</code>.width</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->image_sw) ? $page->s->image_sw : "")?>" name="<?=$form->structura->prefix;?>image_sw">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon"><code>S</code>.height</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->image_sh) ? $page->s->image_sh : "")?>" name="<?=$form->structura->prefix;?>image_sh">
												</div>
											</div>
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>image_sp" <?=(!is_null($page) && !is_null($page->s) && $page->s->image_sp ? "checked" : "")?>>Proportii
												</label>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-3 col-sm-offset-2">
												<div class="input-group">
													<span class="input-group-addon"><code>M</code>.width</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->image_mw) ? $page->s->image_mw : "")?>" name="<?=$form->structura->prefix;?>image_mw">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon"><code>M</code>.height</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->image_mh) ? $page->s->image_mh : "")?>" name="<?=$form->structura->prefix;?>image_mh">
												</div>
											</div>
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>image_mp" <?=(!is_null($page) && !is_null($page->s) && $page->s->image_mp ? "checked" : "")?>>Proportii
												</label>
											</div>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="row">
											<div class="col-sm-3 col-sm-offset-2">
												<div class="input-group">
													<span class="input-group-addon"><code>L</code>.width</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->image_lw) ? $page->s->image_lw : "")?>" name="<?=$form->structura->prefix;?>image_lw">
												</div>
											</div>
											<div class="col-sm-3">
												<div class="input-group">
													<span class="input-group-addon"><code>L</code>.height</span>
													<input type="number" placeholder="" class="form-control" value="<?=(!is_null($page) && !is_null($page->s) && !is_null($page->s->image_lh) ? $page->s->image_lh : "")?>" name="<?=$form->structura->prefix;?>image_lh">
												</div>
											</div>
											<div class="col-sm-2">
												<label class="checkbox">
													<input type="checkbox" data-toggle="checkbox" value="1" name="<?=$form->structura->prefix;?>image_lp" <?=(!is_null($page) && !is_null($page->s) && $page->s->image_lp ? "checked" : "")?>>Proportii
												</label>
											</div>
										</div>
									</div>
							</div>
					</fieldset>
					<div class="hr-line-dashed"></div>
					<fieldset>
							<div class="form-group">
									<div class="col-sm-12">
										<button class="btn btn-white" type="button" onClick="location.href='<?=base_url()?>'">Anuleaza</button>
										<button type="submit" name="<?=$form->structura->prefix;?>submit" class="btn btn-info btn-fill btn-wd" onClick="return showloader();">Salveaza modificarile</button>
									</div>
							</div>
					</fieldset>
				</form>
			</div> <!-- end col-md-12 -->
		</div>
	</div>
	</div> <!--/#structura-->
<?php endif; ?>
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
                  <button type="button" class="btn btn-primary btn-fill" onClick="return upfile(<?=$page->p->atom_id;?>);return false;">Incarca imaginea</button>
                </div>
              </div>
            </div>
          </div>
        </form>
		
<?php if(!is_null($page)): ?>
<div id="dialog-images" title="Proceseaza imagine" style="display:none;">
	<div class="row" style="margin-right:-14px;margin-left:-14px;">
	
		<div class="col-sm-2">
		
			<strong>Incarca o imagine si incepe procesarea..</strong>
			<hr>
		
			<div class="btn-group">
				<label title="Upload image file" for="imager-upload-image" class="btn btn-lg btn-success">
					<input type="file" accept="image/*" name="file" id="imager-upload-image" class="hide">
					<i class="fa fa-file-image-o"></i> Incarca o imagine
				</label>
			</div>
			<div class="btn-group" style="margin-top:10px;">
				<button class="btn btn-default" id="imager-removeoptimalsizes" style="display:none;color:red"><i class="fa fa-exclamation-circle"></i> Renunta la dimensiunile optime: <strong style="color:#000;"><?=$imager[0]->height?> x <?=$imager[0]->width?></strong></button>
			</div>
			<div class="btn-group" style="margin-top:10px;">
				<button class="btn btn-default" id="imager-applyoptimalsizes" style="display:none;font-weight:bold;color:#1c84c6;"><i class="fa fa-check"></i> Aplica dimensiunile optime: <strong style="color:#000;"><?=$imager[0]->height?> x <?=$imager[0]->width?></strong></button>
			</div>
		</div>
	
		<div class="col-sm-10">
			<div id="imager-upload-message" style="margin-top:200px;">
				<h2 style="text-align:center;color:#000;"><i class="fa fa-file-image-o"></i> Incarca o imagine pentru a incepe procesarea</h2>
			</div>
			
			<div id="imager-upload-wrap" style="display:none;">
				<div id="imager-croppie"></div>
			</div>
		</div>
	</div>

</div>
<form name="imager-form" id="imager-form">
	<input type="hidden" id="imager-form-data" name="data" />
</form>
<?php endif; ?>	


<script type="text/javascript">
	window.onload = function () {
		var adaugapdf = document.getElementById("adaugapdf");
		var chks = adaugapdf.getElementsByTagName("INPUT");
		for (var i = 0; i < chks.length; i++) {
			chks[i].onclick = function () {
				for (var i = 0; i < chks.length; i++) {
					if (chks[i] != this && this.checked) {
						chks[i].checked = false;
					}
				}
			};
		}
	};
</script>