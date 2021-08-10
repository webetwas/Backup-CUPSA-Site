<?php
    // print_r($intrebari_frecvente); die;
?>
<div class="container">
    <div class="col-lg-12 col-md-12">
        <?php if(empty($intrebari_frecvente)): ?>
        <span style="font-size:20px;padding:30px;margin:30px;"><?=($site_lang == "en" ? 'There are no data..' : "Nu exista date..")?></span>
        <?php else: ?>
        <div id="accordion" role="tablist" aria-multiselectable="true">
            <?php foreach($intrebari_frecvente as $key_if => $if): ?>
            <div class="card">
                <div class="card-header" role="tab" id="heading<?=$key_if?>">
                    <h5 class="mb-0">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$key_if?>" aria-expanded="true" aria-controls="collapseOne" class="d-block text-dark text-up-small font-weight-700"><i class="fa fa-info margin-right-10px" ></i> <?=$if->{'atom_name_' . $site_lang}?> </a>
                    </h5>
                </div>
                <div id="collapse-<?=$key_if?>" class="collapse" role="tabpanel" aria-labelledby="heading<?=$key_if?>">
                    <div class="card-block padding-30px">
                        <?=$if->{'i_content_' . $site_lang}?>
                        <?php
                            if(!empty($if->images))
                            {
                        ?>
                            <div>
                                <img src="<?=SITE_URL."public/upload/img/intrebari_frecvente/m/".$if->images;?>" />
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>