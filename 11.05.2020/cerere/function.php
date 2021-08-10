<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function db2img($hex){
echo '<img src="data:image/jpeg;base64,'.base64_encode($hex).'">';
}

function loadcarttabledata($idprodus,$cantitate,$prettotal){

require 'include/db.php';
$pid=$con->real_escape_string($idprodus);
$exec=$con->query("SELECT * FROM produse WHERE id='".$pid."'");
$res=$exec->fetch_assoc();
$cookie = $_COOKIE['cos'];
$cookie = stripslashes($cookie);
$arr = json_decode($cookie, true);

echo "['".base64_encode($res['producator'])."','{$res['nume']}', '{$cantitate}','".euro2lei($res['pret'])."' ,'".euro2lei($prettotal)."'],";





}



function loadfacturi(){
// daca e achitata statusul sa fie verde daca nu rosu
require 'include/db.php';
$uid=$con->real_escape_string(getuid());
$sql=$con->query("SELECT * FROM facturi WHERE forid='".$uid."'");
while($res=$sql->fetch_assoc()){


if ($res['status'] == "ACHITATA") {
  $status='label label-success';
} else{
  $status='label label-danger';
}

echo "
<tr>
  <td>{$res['id']}</td>
  <td>{$res['data']}</td>
  <td>
    <span class='{$status}'> {$res['status']}</span>
  </td>
  <td>".euro2lei($res['suma'])." lei</td>
  <td><a href='vezi-factura.php?id={$res['id']}' target='_blank'><span class='glyphicon glyphicon-file'></span></a></td>
  </tr>


";



}





}



function loadcart(){

if(chkuser2() == false){
  echo "var data = [['','','','','']];";
}
else {

 if(isset($_COOKIE['cos'])){
echo "var data = [";


$cookie = $_COOKIE['cos'];
$cookie = stripslashes($cookie);
$arr = json_decode($cookie, true);

foreach($arr as $key =>$value){

loadcarttabledata($value[1],$value[2],$value[0]);


}
echo "];";

}
else
{
  echo "


  ";
}
}




}

function cos2(){
  if(isset($_COOKIE['cos'])){


$cookie = $_COOKIE['cos'];
$cookie = stripslashes($cookie);
$arr = json_decode($cookie, true);
foreach($arr as $key =>$value){
echo " <div class='cart-entry'>

                <div class='content'>

                    <a class='title' href='#'>".numeprodus($value[1])."</a>

                    <div class='quantity'>Cantitate: {$value[2]}</div>

                    <div class='price'>".euro2lei($value[0])." lei</div>

                </div>

                <div class='button-x'><i class='fa fa-close'></i></div>

            </div> ";
}

}






}

function totalcos(){

if(isset($_COOKIE['cos'])){

$cookie = $_COOKIE['cos'];
$cookie = stripslashes($cookie);
$arr = json_decode($cookie, true);
$suma=0;
foreach($arr as $key =>$value){
$suma=$suma + $value[0];
}
return $suma;

}
else
{
  return "0";
}

}


function euro2lei($pret){

require 'include/db.php';
$curseuro=setari("curseuro");
return $curseuro * $pret;



}
function numeprodus($pid){
include 'include/db.php';
$sql="SELECT * FROM produse WHERE id='".$pid."' ";
$exec=$con->query($sql);
$res=$exec->fetch_assoc();
return $res['nume'];





}


function reducere($catid,$pret){
include 'include/db.php';
if(chkuser2() == true){
$uid=getuid();

$sql="SELECT * FROM discounturi_categorie WHERE pentruid='".$uid."' AND categoria='".$catid."'";
$exec=$con->query($sql);
$res=$exec->fetch_assoc();

if($exec->num_rows >= 1) {


$ppret=$res['procent'] / 100 * $pret;
$fpret=$pret - $ppret;
return $fpret;




} else {return $pret;} 




} 
else
{

return $pret;

}





$con->close();


}


function loadproduse($catid){


require 'include/db.php';
$pid=$con->real_escape_string($catid);

$sql=$con->query("SELECT * FROM produse WHERE id_categorie = '".$pid."' ORDER BY ordine ASC");
echo " var data = [";
$lang="Adauga";
while($res=$sql->fetch_assoc()){
$uid=$res['id'];

echo "['img/{$res['producator']}.png','{$res['nume']}','{$res['locatie_stoc']}',  '{$res['stoc']}', '".reducere($catid,$res['pret'])." &euro;','<a data-fancybox data-type=iframe data-width=400 data-height=200 data-src=addc.php?pid={$res['id']} href=# class=btn>Adauga in cos</a>'],";



}


echo "];";

$con->close();


}


function loadslider(){
require "include/db.php";
$sql="SELECT * FROM setari";
$exec=$con->query($sql);
$res=$exec->fetch_assoc();
$slider=1;
$sql2="SELECT * FROM slider ORDER BY ordine ASC";
$exec2=$con->query($sql2);
$res2=$exec2->fetch_assoc();

if($slider == 1){
//daca sliderul este activat
  $uniqueid=$res2['id'];

?>
<div class="container">
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">

    </ol>

    <!-- Wrapper for slides -->
   
  <div class="carousel-inner">
    <div class="item active">
     <?php db2img($res2['imagine']); ?>
      <div class="carousel-caption">
        <h3 style='font-size:40px;color:black;'><?php echo $res2['titlu1'];?></h3>
        <p style='color:black;'><?php echo $res2['subtitlu'];?></p>
      </div>
    </div>


<?php

while($res2=$exec2->fetch_assoc()){
if($res2['id'] != $uniqueid){
echo "<div class='item'>
        <img src='data:image/jpeg;base64,".base64_encode($res2['imagine'])."' alt='{$res2['titlu1']}' style='width:100%;'>
        <div class='carousel-caption'>
          <h3 style='font-size:40px;color:black;'>{$res2['titlu1']}</h3>
          <p style='color:black;'>{$res2['subtitlu']}</p>
        </div>
      </div>
";

}





}


//end


echo "  <!-- Left and right controls -->
    <a class='left carousel-control' href='#myCarousel' data-slide='prev'>
      <span class='glyphicon glyphicon-chevron-left'></span>
      <span class='sr-only'>Previous</span>
    </a>
    <a class='right carousel-control' href='#myCarousel' data-slide='next'>
      <span class='glyphicon glyphicon-chevron-right'></span>
      <span class='sr-only'>Next</span>
    </a>
  </div>
</div>";



}


$con->close();


}


function ccu($rand){

require "include/db.php";
$sql="SELECT * FROM utilizator WHERE login_hash='".$_COOKIE['hash']."'";
$exec=$con->query($sql);
$res=$exec->fetch_assoc();
return $res[$rand];






}


function chkuser2(){

require "include/db.php";

  
  if(!isset($_COOKIE['hash'])) {
    return false;


  }
  else



  {


$sql= " SELECT * FROM utilizator WHERE login_hash='".$_COOKIE['hash']."' AND privilegii = 'UTILIZATOR'";
$exec = $con->query($sql);
$res=$exec->fetch_assoc();
if($exec->num_rows >= 1){
$nume=$res['nume'];
return true;
}
else
{
  return false;








}







  }

  
$con->close();




}


function getuid(){

require 'include/db.php';


$sql= " SELECT * FROM utilizator WHERE login_hash='".$_COOKIE['hash']."'";
$exec = $con->query($sql);
$res=$exec->fetch_assoc();

return $res['id'];







}


function incarcalinkurifooter(){

require_once("config.php");
$con = new mysqli(HOST,USER,PASSWORD,DB);
if($con->connect_error){

die("CONEXIUNEA LA BAZA DE DATE NU A PUTUT FI STABILITA");



}
$sql="SELECT * FROM linkuri_footer";
$exec=$con->query($sql);
while($res=$exec->fetch_assoc()){
 echo "<a href='{$res['link']}'>{$res['denumire']}</a>";


                                  



}
$con->close();




}





function incarcacategoriile(){


require_once("config.php");
$con = new mysqli(HOST,USER,PASSWORD,DB);
if($con->connect_error){

die("CONEXIUNEA LA BAZA DE DATE NU A PUTUT FI STABILITA");



}
$sql="SELECT * FROM categorii_produse WHERE vizibil='1'";
$exec=$con->query($sql);
while($res=$exec->fetch_assoc()){
 echo " <li><a href='product-cat.php?id={$res['id']}'><i class='fa fa-angle-right'></i>{$res['denumire']}</a></li>";


                                  



}
$con->close();


}






function incarcapaginileinmeniu(){


require_once("config.php");
$con = new mysqli(HOST,USER,PASSWORD,DB);
if($con->connect_error){

die("CONEXIUNEA LA BAZA DE DATE NU A PUTUT FI STABILITA");



}
$sql="SELECT * FROM pagini ORDER BY ordine ASC";
$exec=$con->query($sql);
while($res=$exec->fetch_assoc()){
 echo "<li class='full-width'><a href='{$res['link']}'>{$res['titlu']}</a>  </li>";


                                  



}
$con->close();

}



function setari($setare) {
require_once("config.php");
$con = new mysqli(HOST,USER,PASSWORD,DB);
if($con->connect_error){

die("CONEXIUNEA LA BAZA DE DATE NU A PUTUT FI STABILITA");



}

$sql="SELECT * FROM setari";
$exe=$con->query($sql);
$res=$exe->fetch_assoc();
$text = $res[$setare];
$con->close();
return $text;


}









function citestepagina(){


if(!isset($_GET['p'])){

//DACA NU AVEM REQUESTUL P INCARCAM PAGINA DEFAULT
require_once("pagini/index.php");

}
else
{
//DACA AVEAM REQUESTUL P INCARCAM PAGINA DIN PAGINI/FISIER.PHP
                          //verificam daca pagina exista ca sa o incarcam
                          if (is_readable("pagini/{$_GET['p']}"))
                          {
                           
                          require_once("pagini/{$_GET['p']}");

                          }
                          else
                          {
                            // daca pagina nu exista incarcam pagina 404

                            require_once("pagini/404.php");
                          }










}







}


?>