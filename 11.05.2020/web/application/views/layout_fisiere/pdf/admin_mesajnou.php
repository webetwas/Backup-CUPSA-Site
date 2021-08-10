<?php
// var_dump($data);die();
?>
<div class="row">
	<div class="col align-self-start"></div>
	<div class="col align-self-end">
			<?=$owner->company;?> - Mesaj nou<br /><br />
			<strong>Subiect: </strong> <?=$data["subiect"]?><br />
			<strong>Nume: </strong> <?=$data["nume"]?><br />
			<strong>Adresa : </strong> <?=$data["adresa"]?><br />
			<strong>Telefon : </strong> <?=$data["telefon"]?><br />
			<strong>Adresa E-mail: </strong> <?=$data["email"]?><br />
			<strong>Mesaj: </strong> <?=$data["mesaj"]?><br />
		<div class="clearfix"></div>
	</div>
</div>