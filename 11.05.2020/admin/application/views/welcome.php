<?php
// var_dump($allpages);
?>
<div class="wrapper wrapper-content">
    <div class="middle-box text-center animated fadeInRightBig" style="margin-top:0;padding-top:0;max-width:1050px;">
		<h2>Pagini site</h2>

		
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        
                            <table class="table">
                                <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col" width="50%">Titlu Pagina</th>
									  <th scope="col" colspan="4"></th>
                                      <th scope="col">Accesari</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php $keyap = 0; foreach($allpages as $admin_page) { $keyap++; ?>
									  <?php
										$page_url = SITE_URL . ($admin_page->filehtml != 'pagina' ? '' : 'p/') . $admin_page->slug;
									  ?>
                                    <tr>
                                      <th scope="row"><?=$keyap?></th>
									  <td>
                                        <a href="<?=$page_url?>" target="blank" class="vote-title">
                                            <?=$admin_page->atom_name_ro?>
                                        </a>									  
									  </td>
                                      <td>
                                        <a href="<?=base_url(). 'pagini/item/u/id/' . $admin_page->atom_id . '/' . $admin_page->id_page?>" class="btn btn-white btn-xs"><i class="fa fa-pencil"></i> Editeaza pagina</a>
                                      </td>
                                      <td>
                                          <a href="<?=$page_url?>" class="btn btn-success btn-xs">Vezi pagina site </a>
                                      </td>
                                      <td>
                                          <a href="" class="btn btn-danger btn-xs">Sterge </a>
                                      </td>
                                      
                                      <td>
                                          <a href="" class="btn btn-primary btn-xs">Activeaza </a>
                                      </td>
                                      <td><?=$admin_page->vizite?></td>
                                    </tr>
								<?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>	

		

    </div>
</div>