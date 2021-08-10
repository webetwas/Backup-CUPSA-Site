<?php

if(chkuser2() == false){

	echo "<center>Trebuie sa fii inregistrat!";

  
}
else
{

?>

<h6 style="font-size:40px">Profilul meu</h6>
<br>
<div class="container">
<br>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Detalii cont</a></li>
    <li><a data-toggle="tab" href="#setaricont">Setari cont</a></li>
    <li><a data-toggle="tab" href="#facturi">Facturile mele</a></li>
   
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

 <div class="panel panel-primary">
<div class="panel-heading"><?php echo ccu("nume");?> / <?php echo ccu("companie"); ?> -- > <?php echo ccu("privilegii"); ?> </div>
<div class="panel-body">


<table class="table">
  <thead>
    <tr>
    
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  	  <tr>
      <th scope="row">E-mail</th>
      <td><?php echo ccu("email"); ?></td>
      <td></td>
    
    </tr>
    <tr>
      <th scope="row">Adresa</th>
      <td><?php echo ccu("adresa"); ?></td>
      <td>
      	<form id="sadresa">
			<input type="text" required maxlength="50" minlength="5" placeholder="noua valoare" name="adresa"></input>
			<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form>
      </td>
    </tr>

    <tr>
      <th scope="row">Adresa facturare</th>
      <td><?php echo ccu("adresa_facturare"); ?></td>
      <td>
      	<form id="sadresa_facturare">
			<input type="text" required maxlength="50" minlength="5" placeholder="noua valoare" name="adresa_facturare"></input>
			<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form>
      </td>
    </tr>

   <tr>
      <th scope="row">Telefon</th>
      <td><?php echo ccu("telefon"); ?></td>
      <td>	<form id="stelefon">
<input type="number" required maxlength="50" minlength="5" placeholder="noua valoare" name="telefon"></input>
<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form>
      </td>
    
    </tr>

    <tr>
      <th scope="row">Companie</th>
      <td><?php echo ccu("companie"); ?></td>
      <td><form id="scompanie">
<input type="text" required maxlength="50" minlength="5" placeholder="noua valoare" name="companie"></input>
<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form></td>
    
    </tr>
    <tr>
      <th scope="row">CUI</th>
      <td><?php echo ccu("CUI"); ?></td>
      <td><form id="scui">
<input type="text" required maxlength="50" minlength="5" placeholder="noua valoare" name="cui"></input>
<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form></td>
    
    </tr>
    <tr>
      <th scope="row">Nr. Reg. Comert</th>
      <td><?php echo ccu("reg"); ?></td>
      <td><form id="sreg">
<input type="text" required maxlength="50" minlength="5" placeholder="noua valoare" name="reg"></input>
<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form></td>
    
    </tr>
    <tr>
      <th scope="row">Judet</th>
      <td><?php echo ccu("judet"); ?></td>
      <td><form id="sjudet">
<select name="judet" >
<option value="0">Alege Judet</option>
<option value="Alba">Alba</option>
<option value="Arad">Arad</option>
<option value="Arges">Arges</option>
<option value="Bacau">Bacau</option>
<option value="Bihor">Bihor</option>
<option value="Bistrita Nasaud">Bistrita Nasaud</option>
<option value="Botosani">Botosani</option>
<option value="Brasov">Brasov</option>
<option value="Braila">Braila</option>
<option value="Bucuresti">Bucuresti</option>
<option value="Buzau">Buzau</option>
<option value="Caras Severin">Caras Severin</option>
<option value="Calarasi">Calarasi</option>
<option value="Cluj">Cluj</option>
<option value="Constanta">Constanta</option>
<option value="Covasna">Covasna</option>
<option value="Dambovita">Dambovita</option>
<option value="Dolj">Dolj</option>
<option value="Galati">Galati</option>
<option value="Giurgiu">Giurgiu</option>
<option value="Gorj">Gorj</option>
<option value="Harghita">Harghita</option>
<option value="Hunedoara">Hunedoara</option>
<option value="Ialomita">Ialomita</option>
<option value="Iasi">Iasi</option>
<option value="Ilfov">Ilfov</option>
<option value="Maramures">Maramures</option>
<option value="Mehedinti">Mehedinti</option>
<option value="Mures">Mures</option>
<option value="Neamt">Neamt</option>
<option value="Olt">Olt</option>
<option value="Prahova">Prahova</option>
<option value="Satu Mare">Satu Mare</option>
<option value="Salaj">Salaj</option>
<option value="Sibiu">Sibiu</option>
<option value="Suceava">Suceava</option>
<option value="Teleorman">Teleorman</option>
<option value="Timis">Timis</option>
<option value="Tulcea">Tulcea</option>
<option value="Vaslui">Vaslui</option>
<option value="Valcea">Valcea</option>
<option value="Vrancea">Vrancea</option>
</select>
<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form></td>
    
    </tr>
     </tr>
    <tr>
      <th scope="row">Oras</th>
      <td><?php echo ccu("oras"); ?></td>
      <td><form id="soras">
		<input type="text" required maxlength="50" minlength="5" placeholder="noua valoare" name="oras"></input>
		<input type="submit" class="btn btn-xs" value="schimba"></input>
      	</form></td>
    
    </tr>
     </tr>
    
  </tbody>
</table>






	</div></div>






    </div>
    <div id="setaricont" class="tab-pane fade">
   
		<div class="panel panel-danger">
			<div class="panel-heading">Setari cont</div>
				<div class="panel-body">
					<center><a href="stergere" class="btn btn-danger">Stergere cont</a> <a href="schimbparola" class="btn btn-danger">Schimba parola</a></center>
			    </div>
		</div>
  	</div>

  	<div id="facturi" class="tab-pane fade">
   
		<div class="panel panel-success">
			<div class="panel-heading">Facturile mele</div>
				<div class="panel-body">
					aici punem facturile
			    </div>
		</div>
  	</div>

</div>




<br><br>
<?php 
}
?>