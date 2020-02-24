<?php

require 'config.php';
session_start();
?>

<?php
if(isset($_POST['next']))
{
	$amt1=0;
	$a=$_POST['fla'];
	
	$b=$_POST["theme"];
	$c=$_POST["layer"];
	
	$ll=$_SESSION['yy'];
	$l2=$_SESSION['amt'];
	
	if($c==2)
		$amt1=$amt1+500;
	if($c==3)
		$amt1=$amt1+1000;
	if($c==4)
		$amt1=$amt1+1500;
	if($c==5)
		$amt1=$amt1+2000;
	if($c==6)
		$amt1=$amt1+2500;
	
	
	if($b=="castle")
		$amt1=$amt1+1420;
	if($b=="avengers")
		$amt1=$amt1+1600;
	if($b=="barbie")
		$amt1=$amt1+1400;
	if($b=="frozen")
		$amt1=$amt1+1545;
	if($b=="jungle")
		$amt1=$amt1+1435;
	if($b=="kitty")
		$amt1=$amt1+1560;
	if($b=="mickey")
		$amt1=$amt1+1300;
	if($b=="star and moon")
		$amt1=$amt1+1600;
	if($b=="chota bheem")
		$amt1=$amt1+1500;
	if($b=="mermaid")
	    $amt1=$amt1+1400;
	
		
		$q2="insert into cakes values('$ll','$a','$b','$c','$amt1')";
        $q3=mysqli_query($con,$q2);
	if($q3)
	{
		
		$query="select amount from cakes where cake_id=(select max(cake_id) from cakes)";
	        $query_run=mysqli_query($con,$query);
			$info=mysqli_fetch_assoc($query_run);
	        $_SESSION['amt']="$info[amount]"+$l2;
		    header('location:venue.php');
	}
}	
?>

<!DOCTYPE html>

<html>
<head>
<style>
* {box-sizing: border-box;}

#N
{
	
background-color:#ff793f;
	padding:4px;
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
	height:300px;	
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

.top-container{
background-color:#333;
  padding: 20px;
  text-align: center;
  color:#e1b12c;
}
.li:hover .overla{
  opacity: 1;
}
</style>
</head>
<body style="background-color:black;"> 
<div class="top-container">
  <h1 style="font-family:bold">SELECT CAKE</h1>
  <br>
  </div>
  <br>


<div class="li">
  <img src="castle.jpg" width="200" height="180" class="imag">
  <div class="overla">CASTLE(Rs 1420)</div>
</div>
<div class="li">
  <img src="avengers.jpg" width="200" height="180" class="imag">
  <div class="overla">AVENGERS(Rs 1600)</div>
</div>
<div class="li">
  <img src="barbie.jpg" width="200" height="180" class="imag">
  <div class="overla">BARBIE(Rs 1400)</div>
</div>
<div class="li">
  <img src="frozen.jpg" width="200" height="180" class="imag">
  <div class="overla">FROZEN(Rs 1545)</div>
</div>
<div class="li">
  <img src="jungle.jpg" width="200" height="180" class="imag">
  <div class="overla">JUNGLE(Rs 1435)</div>  
</div>
<div class="li">
  <img src="kitty.jpg" width="200" height="180" class="imag">
  <div class="overla">KITTY(Rs 1560)</div>  
</div>
<div class="li">
  <img src="mickey.jpg" width="200" height="180" class="imag">
  <div class="overla">MICKEY(Rs 1300)</div>  
</div>
<div class="li">
  <img src="star.jpg" width="200" height="180" class="imag">
  <div class="overla">STAR AND MOON(Rs 1600)</div>  
</div>


<div class="li">
  <img src="bheem.jpg" width="200" height="180" class="imag">
  <div class="overla">CHOTA BHEEM(Rs 1500)</div>  
</div>

<div class="li">
  <img src="mermaid.jpg" width="200" height="180" class="imag">
  <div class="overla">MERMAID(Rs 1400)</div>  
</div>

 
<div class="d5">
 <form action="cake.php" method="post" class="f4">
 <br>
 <br>
 Flavour:
 <select name="fla" class="inputvalues" required>
 
 <option value="vanilla">Vanilla</option>
 <option value="strawberry">Strawberry</option>
 <option value="chocolate">Chocolate</option>
 <option value="butter scotch">Butter Scotch</option>
 <option value="pink champagne">Pink Champagne</option>
 <option value="lemon">Lemon</option>
 <option value="red velvet">Red Velvet</option>
 </select>
 
 <br>
 <br>
 
 Theme:
 <select name="theme" class="inputvalues" required>
 
 <option value="castle">castle(Rs 1420)</option>
 <option value="avengers">avengers(Rs 1600)</option>
 <option value="barbie">barbie(Rs 1400)</option>
 <option value="frozen">frozen(Rs 1545)</option>
 <option value="jungle">jungle(Rs 1435)</option>
 <option value="kitty">kitty(Rs 1560)</option>
 <option value="mickey">mickey(Rs 1300)</option>
 <option value="star and moon">star and moon(Rs 1600)</option>
 <option value="chota bheem">chota bheem(Rs 1500)</option>
 <option value="mermaid">mermaid(Rs 1400)</option>
 </select>
 <br>
 <br>
 Layers:
 <select name="layer" class="inputvalues" required>
 
 <option value="1">1-layer(No extra amount)</option>
 <option value="2">2-layers(Rs 500 extra)</option>
 <option value="3">3-layers(Rs 1000 extra)</option>
 <option value="4">4-layers(Rs 1500 extra)</option>
 <option value="5">5-layers(Rs 2000 extra)</option>
 <option value="6">6-layers(Rs 2500 extra)</option>
 </select>
 
 <br>
 <br>
 <br>
<input name="next" type="submit" id="N" value="NEXT"/>
</form>
</div>
</body>
</html>