<?php
    // date_default_timezone_set("Europe/Bucharest");
    // print_r($application->user); die();
?>


        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
<?php
    if($user_details->id != $this->user->id)
    {
?>
                            <h5>Editează utilizatorul <strong><?=(!empty($user_details->nume) && !empty($user_details->prenume) ? $user_details->nume. " " .$user_details->prenume : $user_details->user_name);?></strong></h5>
<?php
    }
    else
    {
?>
                            <h5>Profil</h5>
<?php
    }
?>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-7">
                                    <form class="form-horizontal" method="POST" name="<?=$form->meta->name;?>" action="<?=base_url().$form->meta->segments?>">
                                        <h2>Opțiuni personale</h2>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Nume utilizator</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->meta->prefix;?>user_name" disabled="disabled" value="<?=$user_details->user_name;?>">
                                                <span class="help-block m-b-none text-warning">Numele de utilizator nu pot fi modificate.</span>
                                            </div>
                                        </div>
                                        <div class="form-group<?=$this->session->flashdata('email_class_error');?>">
                                            <label class="col-sm-5 control-label text-left">Email <i>(obligatoriu)</i></label>
                                            <div class="col-sm-7">
                                                <input type="email" class="input-sm form-control" name="<?=$form->meta->prefix;?>email" value="<?=(!empty($this->session->flashdata('user_email')) ? $this->session->flashdata('user_email') : $user_details->email);?>">
                                                <span class="help-block m-b-none"><?=$this->session->flashdata('email_title_error');?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Prenume</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->meta->prefix;?>prenume" value="<?=$user_details->prenume;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Nume</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->meta->prefix;?>nume" value="<?=$user_details->nume;?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Telefon</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->meta->prefix;?>telefon" value="<?=$user_details->telefon;?>">
                                            </div>
                                        </div>
                                        <h2>Despre tine</h2>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Informații biografice</label>
                                            <div class="col-sm-7">
                                                <textarea class="input-sm form-control" name="<?=$form->meta->prefix;?>info_bio" rows="5" cols="30"><?=$user_details->info_bio;?></textarea>
                                                <span class="help-block m-b-none">Scrie aici câteva date biografice despre tine pentru a-ți completa profilul. Acestea ar putea fi arătate public.</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Poză de profil</label>
                                            <div id="utilizator__poza__profil" class="col-sm-7">
												<?php if(!empty($user_details->image_logo)): ?>
                                                <img src="<?=$imgpathlogo . $user_details->image_logo;?>" class="img-md">
												<?php else: ?>
                                                <img src="<?=SITE_URL?>admin/public/assets/img/html_logo.png" class="img-md">												
												<?php endif; ?>
											
												
                                                <div class="utilizator__poza__profil">
                                                    <a href="javascript:void(0)" class="btn btn-outline btn-success btn-xs" data-toggle="modal" data-target="#inpfileModal" onClick="filesetvars('logo', 'logo')">Schimbă</a>
<?php
    // if(!empty($user_details->image_logo))
    // {
?>
                                                    <a id="remove__profile_picture" href="javascript:void(0)" style="<?=(!empty($user_details->image_logo) ? '' : 'display:none' );?>" onClick="return ajxdelimg('<?=$user_details->id;?>', 'logo');return false" class="btn btn-outline btn-danger btn-xs">Șterge</a>
<?php
    // }
?>
                                                </div>
                                            </div>
                                        </div>
<?php
    if($user_details->id != 1 && $user_details->id != $this->user->id)
    {
?>
                                        <div class="hr-line-dashed"></div>
                                        <h2>Gestiunea contului</h2>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Rol</label>
                                            <div class="col-sm-7">
                                            <select <?=($this->user->id != 1 && $user_details->id != 1 && $application->user->privilege != 2 ? 'disabled' : '');?> class="form-control m-b" name="<?=$form->meta->prefix;?>privilege">
<?php
        $i = 1;
        foreach($utilizatori_permisii as $permisie)
        {
            if($i > 2 && $this->user->id != 1)
            {
?>
                                                <option value="<?=$permisie->id;?>"<?=($user_details->privilege == $permisie->id ? ' selected' : '');?>><?=$permisie->nume;?></option>
<?php
            }
            elseif($this->user->id == 1)
            {
?>
                                                <option value="<?=$permisie->id;?>"<?=($user_details->privilege == $permisie->id ? ' selected' : '');?>><?=$permisie->nume;?></option>
<?php
            }
            ++$i;
        }
?>
                                            </select>
                                            <span class="help-block m-b-none text-warning">Rolul poate fi schimbat doar de administrator sau manager.</span>
                                            </div>
                                        </div>
<?php
    }
?>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Parolă nouă</label>
                                            <div class="col-sm-7">
                                                <input type="hidden" id="new__password" class="input-sm form-control" name="<?=$form->meta->prefix;?>user_password">
                                                <button type="button" onclick="hidePassword(this);" class="btn btn-outline btn-default hide__password m-t"><i class="fa fa-eye-slash"></i> Ascunde</button>
                                                <button type="button" onclick="cancelPassword(this);" class="btn btn-outline btn-default cancel__password m-t">Anulează</button>
                                                <button type="button" onclick="generatePassword();" class="btn btn-outline btn-default generate__password">Generează parolă</button>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="<?=$form->meta->prefix;?>submit" type="submit">Salvează profil</button>
                                                <button class="btn btn-white" onClick="location.href='<?=base_url().$controller;?>'" type="button">Anulează</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal upload user image -->
        <form method="POST" id="fmodalupfile" class="form-horizontal" enctype="multipart/form-data">
          <div class="modal fade" id="inpfileModal" tabindex="-1" role="dialog" aria-labelledby="inpfileModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="inpfileModalLabel">Incarca imagine</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="fileUpload btn btn-primary">
                                <span>Alege fisier</span>
                                <input id="uploadBtn" type="file" class="upload" name="inpfile" size="50" />
                            </div>
                        </div>
                        <div class="col-md-10">
                            <input id="uploadFile" class="form-control fileUpload" placeholder="Alege un fisier..." disabled="disabled" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Renunta</button>
                  <button type="button" class="btn btn-primary btn-fill" onClick="return upfile(<?=$user_details->id;?>);return false;">Incarca imaginea</button>
                </div>
              </div>
            </div>
          </div>
        </form>