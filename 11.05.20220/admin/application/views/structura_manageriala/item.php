<?php
// var_dump($structura_info); die;
// var_dump($item);
// var_dump($item_links);
?>

<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-md-12">
            <div class="tabs-container">
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" name="<?=$form->item->name;?>" action="<?=base_url().$form->item->segments?>">
                                        <div class="content content-full-width">
                                            <div class="panel-group">
                                                <?php if(is_null($item)):?>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 control-label">Se creaza o noua inregistrare</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" placeholder="Creare imagine" class="form-control" name="<?=$form->item->prefix;?>item_key" value="<?=(!is_null($last_id) ? 'NR_CRT_' .$last_id : "");?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>  
                                                <?php endif; ?>
                                                
                                                <?php if(!is_null($item)):?>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Nume</label>
                                                                    <input type="text" placeholder="Nume" class="form-control" name="<?=$form->item->prefix;?>nume" value="<?=(!is_null($item) && !is_null($item->nume) ? $item->nume : "");?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Prenume</label>
                                                                    <input type="text" placeholder="Prenume" class="form-control" name="<?=$form->item->prefix;?>prenume" value="<?=(!is_null($item) && !is_null($item->prenume) ? $item->prenume : "");?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Functie</label>
                                                                    <input type="text" placeholder="Functie" class="form-control" name="<?=$form->item->prefix;?>functie" value="<?=(!is_null($item) && !is_null($item->functie) ? $item->functie : "");?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Categorie</label>
                                                                    <select name="<?=$form->item->prefix;?>id_info" class="form-control">
                                                                    <?php
                                                                        foreach($structura_info as $row)
                                                                        {
                                                                    ?>
                                                                        <option value="<?=$row->id_item;?>" <?=(!is_null($item) && !is_null($item->id_info) && $item->id_info == $row->id_item ? "selected" : "");?>><?=$row->nume;?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                    <div class="col-md-6">
                                                        <?php if(!is_null($item)):?>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                <?php
                                                                    if(empty($item->pdf))
                                                                    {
                                                                ?>
                                                                    <div class="col-sm-12">
                                                                        <!-- <input type="file" name="poza" size="50" class="form-control"> -->
                                                                        <!-- Button trigger modal -->
                                                                        <div class="col-md-4 col-xs-6 col-xs-12 thumb-nomg" style="padding:0px;">
                                                                            <div class="img-thumbnail-btn">
                                                                                <button type="button" class="btn btn-primary btn-fill btn-upfile" data-toggle="modal" data-target="#inpfileModal" onClick="filesetvars('poza', 'poza')">
                                                                                    Incarca un pdf <br /><br/><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                    }
                                                                ?>
                                                                    <div class="col-md-12">
                                                                        <div id="pdf">
                                                                         <h5>PDF</h5>
                                                                            <?php
                                                                                if(isset($item->pdf) && $item->pdf)
                                                                                {
                                                                                    echo '
                                                                                        <div id="pdf-' .$item->id_item. '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">
                                                                                            <div class="" style="padding:2px;">
                                                                                                <a href="'.SITE_URL.PATH_STRUCTURA_MANAGERIALA.$item->pdf . '" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                                                                                <div class="thumbfooter">
                                                                                                    <a href="javascript:void(0)" onClick="return ajxdelimg(' .$item->id_item. ', \'pdf\');return false"><code-remove>Elimina</code-remove></a>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    ';
                                                                                }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                

                                                <div class="hr-line-dashed"></div>
                                                <fieldset>
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <button class="btn btn-white" type="button" onClick="location.href='<?=base_url()?>setari_pdf'">Anuleaza</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    if(empty($item->pdf))
    {
?>
<style>
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>
    <!-- Modal upload image -->
    <form method="POST" id="fmodalupfile" class="form-horizontal" enctype="multipart/form-data">
      <div class="modal fade" id="inpfileModal" tabindex="-1" role="dialog" aria-labelledby="inpfileModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="inpfileModalLabel">INCARCA UN FISER PDF</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <div class="fileUpload btn btn-primary">
                            <span>Alege fisier</span>
                            <input id="uploadBtn" type="file" class="upload" name="inpfile_file" size="50" />
                        </div>
                    </div>
                    <div class="col-md-10">
                        <input id="uploadFile" class="form-control fileUpload" placeholder="Alege un fisier (pdf)..." disabled="disabled" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Renunta</button>
              <button type="button" class="btn btn-primary btn-fill" onClick="return upfile(<?=$item->id_item?>);return false;">Incarca</button>
            </div>
          </div>
        </div>
      </div>
    </form>
<script>
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
    $('.chosen-select').chosen({width: "100%"});
</script>
<?php
    }
?>