<?php

require 'config.php';
session_start();
?>

<!DOCTYPE html>

<html>
<head>
<style>
* {box-sizing: border-box;}

#N
{
	
background-color:#ff793f;
	padding:5px;
	color:black;
	margin:auto;
	width:435px;
	font-family:Arial;
	font-size:18px;
	
}

.d5
{
    width:1500px;
	float:right;
	background:#f7f1e3; 
	padding:5px;
	font-family:Arial;
	margin:0 auto;
	height:400px;	
}
.f4
{
	width:450px;
	margin:0 auto;
	
}


.inputvalues
{
	width:430px;
	margin:0 auto;
	padding:5px;
}


.li{
  float:left;
  width: 50%;
  max-width: 300px;
}

.imag{
  display: block;
  
  
}
.top-container{
background-color:#333;
  padding: 20px;
  text-align: center;
  color:#e1b12c;
}
.overla{
  position:relative; 
  bottom: 0; 
  background: rgb(0, 0, 0);
  background: rgba(0, 0, 0, 0.5); /* Black see-through */
  color: #f1f1f1; 
  
  transition: .5s ease;
  opacity:0;
  color: white;
  font-size: 20px;
  padding: 20px;
  text-align: center;
}

.li:hover .overla{
  opacity: 1;
}
</style>
</head>
<body style="background-color:black;"> 
<div class="top-container">
  <h1 style="font-family:bold">SELECT ACTIVITIES</h1>
  <br>
  </div>
  <br>


<div class="li">
  <img src="mbb.jpg" width="200" height="180" class="imag">
  <div class="overla">Mini bowling(Rs 4000)</div>
</div>
<div class="li">
  <img src="bj.jpg" width="200" height="180" class="imag">
  <div class="overla">Ball in the joker(Rs 2500)</div>
</div>
<div class="li">
  <img src="rr.jpg" width="200" height="180" class="imag">
  <div class="overla">Ring game(Rs 2000)</div>
</div>
<div class="li">
  <img src="mg.jpg" width="200" height="180" class="imag">
  <div class="overla">Mini golf game(Rs 1000)</div>
</div>
<div class="li">
  <img src="balloon.jpg" width="200" height="180" class="imag">
  <div class="overla">Balloon shooting counter(Rs 2760)</div>
</div>

 <div class="d5">
 <form action="lei.php" method="post" class="f4">
 <br>
 <br>
 Game_stalls:
 <select name="gam" class="inputvalues" required>
 
 <option value="Dont want">Don't want</option>
 <option value="Balloon shooting counter">Balloon shooting counter(Rs 2760)</option>
 <option value="Mini golf game">Mini golf game(Rs 1000)</option>
 <option value="Ring game">Ring game(Rs 2000)</option>
 <option value="Ball in the joker">Ball in the joker(Rs 2500)</option>
 <option value="Mini bowling">Mini bowling(Rs 4000)</option>
 </select>
 <br>
 <br>
 Music:
 <select name="mu" class="inputvalues" required>
 
 <option value="Dont want">Don't want</option>
 <option value="dj">DJ(10000)</option>
 <option value="Sound system">Sound system(3000)</option>
 
 
 </select>
 <br>
 <br>
 Video_recording:
 <select name="vr" class="inputvalues" required>
 
 <option value="yes">Yes(9000)</option>
 <option value="no">No</option>
 </select>
 <br>
 <br>
 Photography:
 <select name="pho" class="inputvalues" required>
 
 <option value="yes">Yes(5000)</option>
 <option value="no">No</option>
 </select>
 <br>
 <br>
 <br>
<input name="next" type="submit" id="N" value="NEXT"/>
</form>

 <?php
if(isset($_POST['next']))
{
	$amt1=0;
	$mus=$_POST['mu'];
	
	$gamee=$_POST["gam"];
	$vid=$_POST["vr"];
	$photo=$_POST["pho"];
	$ll=$_SESSION['yy'];
	if($vid=="yes")
		$amt1=$amt1+9000;
	if($photo=="yes")
		$amt1=$amt1+5000;
	if($gamee=="Balloon shooting counter")
		$amt1=$amt1+2760;
	if($gamee=="Mini golf game")
		$amt1=$amt1+1000;
	if($gamee=="Ring game")
		$amt1=$amt1+2000;
	if($gamee=="Ball in the joker")
		$amt1=$amt1+2500;
	if($gamee=="Mini bowling")
		$amt1=$amt1+4000;
	if($mus=="dj")
		$amt1=$amt1+10000;
	if($mus=="Sound system")
		$amt1=$amt1+3000;
		
		$q2="insert into leisure values('$ll','$gamee','$photo','$vid','$mus','$amt1')";
        $q3=mysqli_query($con,$q2);
	if($q3)
	{
		
		$query="select amount from leisure where e_id=(select max(e_id) from leisure)";
	        $query_run=mysqli_query($con,$query);
			$info=mysqli_fetch_assoc($query_run);
	        $_SESSION['amt']="$info[amount]";
			header('location:cake.php');
	}
}
	
?>

 </div>
 </body>
 </html>