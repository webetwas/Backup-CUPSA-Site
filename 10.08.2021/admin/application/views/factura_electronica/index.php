<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$start_date_error = '';
$end_date_error = '';

if(isset($_POST["export"]))
{
    if(empty($_POST["start_date"]))
    {
        $start_date_error = '<label class="text-danger">Data de inceput este obligatorie</label>';
    }
    else if(empty($_POST["end_date"]))
    {
        $end_date_error = '<label class="text-danger">Data de sfarsit este obligatorie</label>';
    }
    else
    {

        $file_name = 'export factura electronica zilnica.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");
        $file = fopen('php://output', 'w');

        

        $header = array("Nume", "Adresa", "Cod client", "CNP / CIF", "Trimitere factura", "Trimitere SMS", "Data");

        fputcsv($file, $header);


        $start_date = strtotime($_POST["start_date"]);
        $end_date = strtotime($_POST["end_date"]);


        foreach($items as $row)
        {
            $data = array();
            $data_datetime = new DateTime($row->data);
            $data_datetime =  $data_datetime->format('Y-m-d');
            $data_datetime = strtotime($data_datetime);
            if ($data_datetime >= $start_date &&
                $data_datetime <= $end_date ){

                $data[] = $row->nume;
                $data[] = $row->adresa;
                $data[] = $row->cod_client;
                //$data[] = $row->telefon;
                //$data[] = $row->email;
                $data[] = strval($row->cnp_cif);
                $data[] = $row->trimitere_factura;
                $data[] = $row->trimitere_sms;
                $data[] = $row->data;
                fputcsv($file, $data);
            }


        }

        
        exit;
    }
}


?>

<style>
	.center{
		text-align: center;
	}
</style>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12">
			<div class="row">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 class="col-sm-4">Factura electronica</h5>
                
					<h3  class="col-sm-8" style="color: red">
						<?php
							echo "Data " . date("d-m-Y") . " / " . date("h:i:sa");
						?>
					</h3>
				</div>
                <div class="ibox-content">


                     <?php if(!isset($items)){ ?>
                      <h1 class="text-center">Nu s-au gasit Iteme.</h1>
                     <?php } ?>


					 <div class="table-responsive">
						<br />
						<div class="row">
							<form method="post" action="">
								<div class="input-daterange">
									<div class="col-md-5">
										<input type="text" name="start_date" class="form-control" readonly required placeholder="introdu data de inceput" />
										<?php echo $start_date_error; ?>
									</div>
									<div class="col-md-5">
										<input type="text" name="end_date" class="form-control" readonly required   placeholder="introdu data de sfarsit" />
										<?php echo $end_date_error; ?>
									</div>
								</div>
								<div class="col-md-2 pull-right">
									<input type="submit" name="export" value="Exporta fisier CSV" class="btn btn-danger" />
								</div>
							</form>
						</div>

						<table class="table table-striped" >
						  <tr>
							<th>Nume</th>
							<th>Adresa</th>
							<th>Cod client</th>
							<th>Telefon</th>
							<th>Email</th>
							<th>CNP CIF</th>
							<th>Trimitere factura</th>
							<th>Trimtiere sms</th>
							<th>Data</th>
						  </tr>
						<?php
						 foreach ($items as $item){
						?>
						  <tr>
							<td><?= $item->nume?></td>
							<td><?= $item->adresa?></td>
							<td><?= $item->cod_client?></td>
							<td><?= $item->telefon?></td>
							<td><?= $item->email?></td>
							<td><?= $item->cnp_cif?></td>
							<td><?= $item->trimitere_factura?></td>
							<td><?= $item->trimitere_sms?></td>
							<td><?= $item->data?></td>
						  </tr>
						<?php
						}
						?>

						</table>
					</div>	
                </div>
            </div>
        </div>
    </div>
</div>

<script>

	$(document).ready(function(){
	$('.input-daterange').datepicker({
	todayBtn:'linked',
	format: "yyyy-mm-dd",
	autoclose: true
	});
	});

</script>			