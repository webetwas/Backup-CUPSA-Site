<?php
// var_dump($items);
?>

<div class="wrapper wrapper-content">
	<div class="middle-box text-center animated fadeInRightBig" style="margin-top:0;padding-top:0;max-width:1050px;">
	<div class="row">
		<div class="form-group">
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
	</div>	
		<div class="row">
				<div class="col-lg-12">
						<div class="wrapper wrapper-content animated fadeInUp">

								<div class="ibox">
										<div class="ibox-content">
										<?php if(is_null($items)): echo "Nu s-au gasit Iteme."; ?>
											<?php elseif(!is_null($items)): ?>
												<div class="project-list">

														<table class="table table-hover">
																<tbody>
																<?php foreach($items as $keyitem => $item): ?>
																<tr>
																		<td class="project-title text-left">
																				<a href="<?=base_url().$controller_fake?>/item/u/id/<?=$item->atom_id?>"><?=$item->atom_name_ro?></a>
																				<!--<br/>-->
																				<!--<small>Created 14.08.2014</small>-->
																		</td>																
																		
																		<td class="project-actions">
																			<a href="<?=base_url().$controller_fake?>/item/u/id/<?=$item->atom_id?>" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editeaza </a>
																			<a href="<?=base_url().$controller_fake?>/item/d/id/<?=$item->atom_id?>" class="btn btn-danger btn-sm ahrefaskconfirm"><i class="fa fa-trash"></i> Sterge </a>
																		</td>
																</tr>
																<?php endforeach; ?>
																</tbody>
														</table>
												</div>
											<?php endif; ?>
										</div>
								</div>
						</div>
				</div>
		</div>	
	</div>
</div>