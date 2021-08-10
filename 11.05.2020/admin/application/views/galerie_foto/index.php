<?php
// print_r($chain_links); die;
// var_dump($chain_links);
// var_dump($id_link);
// var_dump($items);

if(is_null($items) && !is_null($unchainedobjs)) {
  $items = $unchainedobjs;
}
?>
<style>
.project-people, .project-actions {
  text-align:left;
}

.project-list table tr td {
  padding:3px;
}

.faq-question {
  color:#1c84c6;
}
.faq-question:hover {
  color:#16699e;
}
</style>

<div class="wrapper wrapper-content">
    <div style="margin-top:0;padding-top:0;">
        <div class="row">
                <div class="col-lg-12">
                        <div class="wrapper wrapper-content animated fadeIn">
                
                <?php if(is_null($chain_links)): echo '<h3>Nu exista sectiuni create</h3>'; ?>
                <?php elseif(!is_null($chain_links) && is_null($id_link)): ?>
                <?php foreach($chain_links as $chlink): ?>
                  <div class="faq-item">
                      <div class="row">
                          <div class="col-md-7">
                              <a href="<?=base_url()?>galerie_foto/sectiune/<?=$chlink->node_id?>" class="faq-question"><i class="fa fa-angle-double-right" style="color:#777;"></i> <?=$chlink->denumire_ro?></a>
                          </div>
                          <div class="col-md-3 pull-right"><a href="<?=base_url();?>legaturi/item/d/id/<?=$chlink->node_id?>/page/gfoto" class="btn btn-danger ahrefaskconfirm"><i class="fa fa-trash"></i> Sterge</a></div>
                      </div>
                  </div>
                <?php endforeach; ?>
                <div style="margin-bottom:30px;"></div>
                <?php endif; ?>            
                
                <?php if(is_null($id_link) && !is_null($items)): ?>
                <div style="padding:10px;">
                  <div class="alert alert-danger" style="border-radius:2px;">
                    <i class="fa fa-info-circle"></i> Imaginile fara sectiune nu sunt afisate in Website.<br/>
                    <span>Imaginile de mai jos nu sunt asociate unei Sectiuni</span>
                  </div>
                </div>
                <?php endif; ?>                
                
                                <div class="ibox">
                                        <div class="ibox-content" style="padding:0;">
                    
                      <?php if(!is_null($id_link)): ?>
                      <div class="form-group">
                        <div class="input-group m-b">
                          <span class="input-group-addon" style="border:none;"><span style="color:#1c84c6;font-weight:bold;font-size:18px;">Sectiuni</span> &nbsp;&nbsp;<i class="fa fa-angle-double-right" style="font-size:15px;"></i></span>
                            <select class="form-control input-lg m-b" name="gfsectiuni" id="gfsectiuni">
                            
                            <?php if(!is_null($chain_links)): ?>
                              
                              <option value="0">Galerie foto</option>
                              <?php foreach($chain_links as $chain): ?>
                              <option value="<?=$chain->node_id?>" <?=(!is_null($id_link) && $id_link == $chain->node_id ? 'selected' : '')?>><?=$chain->denumire_ro?></option>
                              <?php endforeach;?>
                              
                            <?php endif; ?>
                            </select>
                        </div>
                      </div>
                      <?php endif; ?>
                      
                      <?php if(!is_null($id_link)): ?>
                      <div style="padding-left:20px;margin-top:40px;">
                        <a class="btn btn-success" href="<?=base_url().$controller?>/item/i/sectiune/<?=$id_link?>"><i class="fa fa-plus-circle"></i> Adauga imagine in galerie</a>
                      </div>
                      <?php endif; ?>
                      
                        <?php if(is_null($items) && !is_null($id_link)): echo "<h3>In acesta sectiune nu exista Imagini.</h3>"; ?>
                            <?php elseif(!is_null($items)): ?>
                                <?php if(!is_null($id_link)) echo '<hr>'?>
                                <div class="project-list">
            
                                        <table class="table table-hover">
                                          <tbody>
                                          <?php foreach($items as $keyitem => $obj): ?>
                                          <tr>
                                            <td class="project-people">
                                                <?php if($obj->i): ?>
                                                    <?php foreach($obj->i as $img): ?>
                                                        <a href="#"><img alt="image" style="width:150px;height:auto;" src="<?=$imgpathitem.$img->img?>"></a>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                <div style="padding:9px;">
                                                <i class="fa fa-warning" style="color:red;"></i>&nbsp;&nbsp;Item fara imagine
                                                </div>
                                                <?php endif; ?>
                                            </td>
        
                                            <td class="project-people">
                                                <?=!is_null($obj->text_reprezentativ) ? $obj->text_reprezentativ : ''?>
                                            </td>
        
                                            <td class="project-actions">
                                                <a href="<?=base_url().$controller_fake?>/item/u/id/<?=$obj->id_item?>" class="btn btn-white btn-sm"><i class="fa fa-pencil"></i> Editeaza </a>
                                                <a href="<?=base_url().$controller_fake?>/item/d/id/<?=$obj->id_item?>" class="btn btn-danger btn-sm ahrefaskconfirm"><i class="fa fa-trash"></i> Sterge </a>
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