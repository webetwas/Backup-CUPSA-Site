<?php
    // date_default_timezone_set("Europe/Bucharest");
    // print_r($utilizatori); die();
?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-5 m-b-xs">
                                <!--  <select class="input-sm form-control input-s-sm inline">
                                    <option value="0">Option 1</option>
                                    <option value="1">Option 2</option>
                                    <option value="2">Option 3</option>
                                    <option value="3">Option 4</option>
                                </select> -->
                                </div>
                                <div class="col-sm-4 m-b-xs">
                                   <!--   <div data-toggle="buttons" class="btn-group">
                                        <label class="btn btn-sm btn-white"> <input type="radio" id="option1" name="options"> Day </label>
                                        <label class="btn btn-sm btn-white active"> <input type="radio" id="option2" name="options"> Week </label>
                                        <label class="btn btn-sm btn-white"> <input type="radio" id="option3" name="options"> Month </label>
                                    </div> -->
                                </div>
                                <div class="col-sm-3">
                                    <!--<div class="input-group">
                                        <input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> Cauta</button> </span>
                                    </div> -->
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                       <!--   <th><input type="checkbox"   class="i-checks" name="input[]"></th> -->
                                        <th>Nume utilizator</th>
                                        <th>Nume</th>
                                        <th>Email</th>
                                        <th>Telefon</th>
                                        <th>Rol</th>
                                        <!--<th>Ultima logare</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
<?php
    if(!empty($utilizatori))
    {
        foreach($utilizatori as $utilizator)
        {
?>
                                        <tr class="utilizator__setari__img">
                                         <!--     <td><input type="checkbox" class="i-checks" name="input[]"></td> -->
                                            <td>
                                                <img src="<?=(isset($utilizator->image_logo) && !is_null($utilizator->image_logo) ? SITE_URL.PATH_IMG_PROFILE_PICTURE.$utilizator->image_logo : SITE_URL.'admin/public/assets/img/html_logo.png');?>" class="utilizator-image img-sm img-rounded" />
                                                <a href="<?=base_url() . $controller_edit . $utilizator->id;?>"><strong><?=$utilizator->user_name;?></strong></a>
                                                <div class="utilizator__setari">
                                                    <a href="<?=base_url() . $controller_edit . $utilizator->id;?>">Editează</a>
                                                    <?=($utilizator->id != 1 && $utilizator->id != $this->user->id ? '<a id="'.$utilizator->id.'" href="javascript:void(0);" class="text-danger sterge__utilizator">Șterge</a>' : '');?>
                                                </div>
                                            </td>
                                            <td><?=$utilizator->nume . " " . $utilizator->prenume;?></td>
                                            <td><a href="mailto:<?=$utilizator->email;?>"><?=$utilizator->email;?></a></td>
                                            <td><a href="tel:<?=$utilizator->telefon;?>"><?=$utilizator->telefon;?></a></td>

<?php
            foreach($utilizatori_permisii as $permisie)
            {
                if($utilizator->privilege == $permisie->id)
                {
?>
                                            <td><?=$permisie->nume;?></td>
<?php
                }
            }
?>
                                            <!--<td><?=(!empty($utilizator->timestamp_login) ? date("F j, Y g:i a", $utilizator->timestamp_login) : '');?></td>-->
                                        </tr>
<?php
        }
    }
    else
    {
?>
                                        <tr>
                                            <td colspan="6">Niciun utilizator gasit.</td>
                                        </tr>
<?php
    }
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>