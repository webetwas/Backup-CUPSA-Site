<?php
    // print_r($structura_info);
    // if(!empty($items))
    // {
?>

<style>
	.center{
		text-align: center;
	}
</style>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Tabel Persoane Structura Manageriala</h5>
                </div>
                <div class="ibox-content">
<?php
if(!empty($items))
{
?>
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Nr. crt</th>
                            <th>Nume & Prenume</th>
                            <th>Functia Detinuta</th>
                            <th>Categorie</th>
                            <th colspan="1">PDF</th>
                            <th colspan="2">Optiuni</th>
                        </tr>
                        </thead>
                        <tbody>
<?php
# - Declaratii Avere
$nr = 1;
foreach($items as $item)
{
    $categorie = $this->_Item->msqlGetAll(DB_STRUCTURA_MANAGERIALE . "_info", array("id_item" => $item->id_info));
?>
                            <tr>
                                <td class=" center"><?=$nr;?></td>
                                <td><span class="pie"><?=$item->nume . ' ' . $item->prenume;?></span></td>
                                <td><?=$item->functie;?></td>
                                <td><?=$categorie[0]->nume;?></td>
                                <td class="text-navy center"><?=(!empty($item->pdf)) ? '<a href="' . SITE_URL.PATH_STRUCTURA_MANAGERIALA.$item->pdf.'" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>' : '';?></td> 
                                <td class="text-navy center">
                                	<a href="<?=base_url().$controller_fake?>/item/u/id/<?=$item->id_item;?>" class="btn btn-xs btn-outline btn-warning" title="Editeaza">
                                		<i class="fa fa-edit"></i>
                                	</a>
                                </td>
                                <td class="text-navy center"><a href="<?=base_url().$controller_fake?>/item/d/id/<?=$item->id_item;?>" class="btn btn-xs btn-outline btn-danger" title="Sterge">Sterge</a></td>
                            </tr>
<?php
    ++$nr;
}
?>
                        </tbody>
                    </table>
<?php
}
else
{
?>
                    <h1 class="text-center">Nu s-au gasit Iteme.</h1>
<?php
}
?>
                </div>
            </div>
        </div>
    </div>
</div>