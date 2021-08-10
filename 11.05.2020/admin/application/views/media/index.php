<?php
// var_dump($items);
?>

<div class="wrapper wrapper-content">
	<div class="middle-box text-center animated fadeInRightBig" style="margin-top:0;padding-top:0;max-width:1050px;">
		<div class="row">
				<div class="col-lg-12">
						<div class="wrapper wrapper-content animated fadeInUp">

								<div class="ibox">
										<div class="ibox-content">
										<?php if(is_null($items)): echo "Nu s-au gasit Iteme."; ?>
											<?php elseif(!is_null($items)): ?>
												<div class="project-list">

														<table class="table table-hover" style="table-layout: fixed;">
																<tbody>
																<?php foreach($items as $keyitem => $item): ?>
																<!-- <tr>
																	<td>#</td>
																	<td>Item</td>
																	<td>Titlu</td>
																	<td></td>
																</tr> -->
																<tr>
																		<td class="project-title" style="width:40%; text-align: left;">
																				<a href="<?=base_url().$controller_fake?>/item/u/id/<?=$item->atom_id?>"><?=$item->atom_name_ro?></a>
																				<!--<br/>-->
																				<!--<small>Created 14.08.2014</small>-->
																		</td>																
																		<td style="width:25%;">
																			<?php foreach($nodes as $node): ?>
																				<?php
																				
																				if(isset($airdrop[$keyitem])){
																					if(array_key_exists($node["node_id"], $airdrop[$keyitem])){
																						echo $node["denumire_ro"];
																					}
																				}else{
																					echo "<b style='color:red'>Nu exista legatura</b>";
																					break;
																				}
																				?>																			
																			<?php endforeach; ?>
																		</td>
																		<td class="project-actions" style="width:15%;">
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