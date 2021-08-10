<?php
    // print_r($uri); die();
?>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Adaugă utilizator nou</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-7">
                                    <form class="form-horizontal" method="POST" name="<?=$form->item->name;?>" action="<?=base_url().$form->item->segments?>">
                                        <div class="form-group <?=$this->session->flashdata('username_class_error');?>">
                                            <label class="col-sm-5 control-label text-left">Nume utilizator <i>(obligatoriu)</i></label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->item->prefix;?>user_name" value="<?=$this->session->flashdata('user_name');?>">
                                                <span class="help-block m-b-none"><?=$this->session->flashdata('username_title_error');?></span>
                                            </div>
                                        </div>
                                        <div class="form-group <?=$this->session->flashdata('email_class_error');?>">
                                            <label class="col-sm-5 control-label text-left">Email <i>(obligatoriu)</i></label>
                                            <div class="col-sm-7">
                                                <input type="email" class="input-sm form-control" name="<?=$form->item->prefix;?>email" value="<?=$this->session->flashdata('user_email');?>">
                                                <span class="help-block m-b-none"><?=$this->session->flashdata('email_title_error');?></span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Prenume</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->item->prefix;?>prenume" value="<?=$this->session->flashdata('user_prenume');?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Nume</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->item->prefix;?>nume" value="<?=$this->session->flashdata('user_nume');?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Telefon</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="input-sm form-control" name="<?=$form->item->prefix;?>telefon" value="<?=$this->session->flashdata('user_telefon');?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Parolă</label>
                                            <div class="col-sm-7">
                                                <input type="hidden" id="new__password" class="input-sm form-control" name="<?=$form->item->prefix;?>user_password">
                                                <button type="button" onclick="hidePassword(this);" class="btn btn-outline btn-default hide__password m-t"><i class="fa fa-eye-slash"></i> Ascunde</button>
                                                <button type="button" onclick="cancelPassword(this);" class="btn btn-outline btn-default cancel__password m-t">Anulează</button>
                                                <button type="button" onclick="generatePassword();" class="btn btn-outline btn-default generate__password">Generează parolă</button>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Trimite notificări utilizatorului</label>
                                            <div class="col-sm-7">
                                                <div class="i-checks"><label><input type="checkbox" name="sendemail__to_user" id="sendemail__to_user" value="1" checked=""> Trimite noului utilizator un email despre contul său.</label></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-5 control-label text-left">Rol</label>
                                            <div class="col-sm-7">
                                            <select class="form-control m-b" name="<?=$form->item->prefix;?>privilege">
<?php
        $i = 1;
        foreach($utilizatori_permisii as $permisie)
        {
            if($i > 2 && $this->user->id != 1)
            {
?>
                                                <option value="<?=$permisie->id;?>"><?=$permisie->nume;?></option>
<?php
            }
            elseif($this->user->id == 1)
            {
?>
                                                <option value="<?=$permisie->id;?>"><?=$permisie->nume;?></option>
<?php
            }
            ++$i;
        }
?>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="<?=$form->item->prefix;?>submit" type="submit">Adaugă utilizator nou</button>
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