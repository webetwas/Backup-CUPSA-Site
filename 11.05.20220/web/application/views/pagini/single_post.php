<?php
    // print_r($actionariat); die;
?>

            <div class="container padding-tb-50px">
                <!--  content -->
                <div class="col-lg-12 col-md-12" style="text-align:center;">
                    <h1><?=$actionariat[0]->atom_name_ro;?></h1>
                </div>
                <div class="col-md-12">
                    <ul style="list-style-type: disc;">
<?php
    foreach($actionariat[0]->pdf as $row)
    {
?>
                        <li><a href="<?=SITE_URL . 'public/upload/documents/actionariat/' . $row->pdf_file;?>" target="_blank"><?=$row->name;?> <i style="color:red;font-size:20px;" class="fa fa-file-pdf-o"></i></a></a> 

<?php
    }
?>
                    </ul>
                </div>
            </div>