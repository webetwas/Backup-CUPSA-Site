<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['pid'])){
$pid=$_POST['pid'];
include 'include/db.php';
include 'include/function.php';

$pido=$con->real_escape_string($pid);
$sql="SELECT * FROM produse WHERE id='".$pido."' ";
$exec=$con->query($sql);

if($exec->num_rows <= 0){

die("Acest produs nu exista!");

}
if(!isset($_POST['cantitate'])){
die("Cantitatea nu a fost aleasa!");

}
$cantitate=trim($_POST['cantitate']);

if(is_numeric($cantitate) == false){
	die("Cantitatea trebuie sa fie un numar!");
}

if($cantitate < 1){
	die("Cantitatea trebuie sa fie mai mare de 0!");
}

$chk="pid";
$chk.=$pid;

$res=$exec->fetch_assoc();
$pret=reducere($res['id_categorie'],$res['pret']*$cantitate);
if(!isset($_COOKIE['cos'])){


$produse=array(

array($pret,$pid,$cantitate,$chk),


);
$json=json_encode($produse);
setcookie("cos",$json,time()+7200);

echo "<center><h4>Produsul a fost adaugat in cos!";


}
else
{
	$cookie = $_COOKIE['cos'];
$cookie = stripslashes($cookie);
$arr = json_decode($cookie, true);



$ex=array($pret,$pid,$cantitate,$chk);

array_push($arr, $ex);

$json=json_encode($arr);
setcookie("cos",$json,time()+7200);
echo "<center><h4>Produsul a fost adaugat in cos!";

}








//pid check
}
$con->close();


?>