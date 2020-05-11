<h2>Partenerii nostri</h2>





<?php
	include 'include/db.php';
		$sql="SELECT * FROM parteneri";
		$exe=$con->query($sql);
			while($res=$exe->fetch_assoc()){

			db2img($res['logo']);

}
?>






