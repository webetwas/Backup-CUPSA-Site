<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Factura electronica</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	  <link href="style.css" rel="stylesheet">
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container contact">
         <div class="row">
            <div class="col-md-3">
               <div class="contact-info">
                  <img src="img/contact-image.png" alt="image"/>
                  <h2>Factura Electronica</h2>
                  <h4>Mai usor pentru dvs!</h4>
               </div>
            </div>
            <div class="col-md-9">
               <form method="post" id="frmContactus">
					<div class="contact-form">
					  <div class="form-group">
						 <label class="control-label col-sm-6" for="nume">
							 <span class="fa fa-star fa-xs" style="color:red;"></span>
							 Nume, Prenume / Denumire
						</label>
						 <div class="col-sm-12">          
							<input type="text" class="form-control" id="nume" placeholder="Introdu nume" name="nume" required>
						 </div>
					  </div>
					</div>  
					  <div class="form-group">
						 <label class="control-label col-sm-3" for="adresa">
							<span class="fa fa-star fa-xs" style="color:red;"></span>	 
							Adresa:
						</label>
						 <div class="col-sm-12">
							<input type="adresa" class="form-control" id="adresa" placeholder="Introdu adresa" name="adresa" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-3" for="cod_client">
							<span class="fa fa-star fa-xs" style="color:red;"></span>
							Cod client:
						</label>
						 <div class="col-sm-12">
							<input type="cod_client" class="form-control" id="cod_client" placeholder="Introdu cod client" name="cod_client" maxlength="6" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-3" for="telefon">
						 	<span class="fa fa-star fa-xs" style="color:red;"></span> 
						 	Telefon:
						</label>
						 <div class="col-sm-12">
							<input type="text" class="form-control" id="telefon" placeholder="Introdu telefon" name="telefon" required>
						 </div>
					  </div>
					  <div class="form-group">
						 <label class="control-label col-sm-3" for="email">
						 	<span class="fa fa-star fa-xs" style="color:red;"></span> 
						 	Email:
						</label>
						 <div class="col-sm-12">
							<input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
						 </div>
					  </div>

					  <div class="form-group">
						 <label class="control-label col-sm-3" for="cnp_cif">
						 	<span class="fa fa-star fa-xs" style="color:red;"></span> 
						 	CNP / CIF:</label>
						 <div class="col-sm-12">
							<input type="cnp_cif" class="form-control" id="cnp_cif" placeholder="Introdu CNP / CIF" name="cnp_cif" required>
						 </div>
					  </div>


					  <!-- <div class="form-group">
						 <div class="col-sm-12">
							<input type="checkbox" class="form-control" id="trimitere_factura" name="trimitere_factura" >Trimite Factura online
						 </div>
					  </div>

					  <div class="form-group">
						 <div class="col-sm-12">
							<input type="checkbox" class="form-control" id="trimitere_sms" name="trimitere_sms">Trimite sms
						 </div>
					  </div> -->

					  <div class="form-group">
						 <label class="control-label col-sm-3" for="trimitere_factura">
						 	<span class="fa fa-star fa-xs" style="color:red;"></span>
						 	Trimitere factura:</label>
						 <div class="col-sm-12">
							<input type="trimitere_factura" class="form-control" id="trimitere_factura" placeholder="da sau nu" name="trimitere_factura" maxlength="2" required>
						 </div>
					  </div>

					  <div class="form-group">
						 <label class="control-label col-sm-3" for="trimitere_sms">Trimitere sms:</label>
						 <div class="col-sm-12">
							<input type="trimitere_sms" class="form-control" id="trimitere_sms" placeholder="da sau nu" name="trimitere_sms" maxlength="2">
						 </div>
					  </div>
					  <p>
						<label style="margin: 10px 0 10px;"><span class="fa fa-star fa-xs" style="color:red;"></span> Câmp obligatoriu</label>
					  </p>
					
					  <div class="form-group">
						 <div class="col-sm-offset-2 col-sm-12">
							<button type="submit" class="btn btn-default" name="submit" id="submit">Trimite</button>
							<span style="color:red;" id="msg"></span>
						 </div>
					  </div>
				   </div>
			   </form>
            </div>
         </div>
      </div>
	  <script>
	  jQuery('#frmContactus').on('submit',function(e){
		jQuery('#msg').html('');
		jQuery('#submit').html('Please wait');
		jQuery('#submit').attr('disabled',true);
		jQuery.ajax({
			url:'submit.php',
			type:'post',
			data:jQuery('#frmContactus').serialize(),
			success:function(result){
				jQuery('#msg').html(result);
				jQuery('#submit').html('Submit');
				jQuery('#submit').attr('disabled',false);
				jQuery('#frmContactus')[0].reset();
			}
		});
		e.preventDefault();
	  });
	  </script>
   </body>
</html>