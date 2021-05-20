<?php
$con=mysqli_connect("localhost","root","","birthday");
if(!$con)
{
    die("unable to connect".mysqli_connect_error);
}
session_start();
?>

<?php
if(isset($_POST['next']))
{
	$l2=$_SESSION['amt'];
	$amt1=0;
	$vthe=$_POST['them'];
	$ll=$_SESSION['yy'];
	$venue=$_POST['ven'];
	$date=$_POST['date'];
	$time=$_POST['time'];
	$query="select * from venue where date='$date' AND v_name='$venue'";
	
	$query_run=mysqli_query($con,$query);
	
	if(mysqli_num_rows($query_run)<=5)
		{
	    
	    if($venue=="silver oak")
		$amt1=$amt1+20000;
	    if($venue=="empire yolee grande")
		$amt1=$amt1+17000;
	    if($venue=="jasmine")
		$amt1=$amt1+16000;
	    if($venue=="morris")
		$amt1=$amt1+15000;
	    if($venue=="gravity")
		$amt1=$amt1+15000;
	
	
	    if($vthe=="carnival")
		$amt1=$amt1+1999;
	    if($vthe=="movie night")
		$amt1=$amt1+2999;
	    if($vthe=="fiesta")
		$amt1=$amt1+3499;
	    if($vthe=="sports")
		$amt1=$amt1+3999;
	    if($vthe=="animal")
		$amt1=$amt1+3999;
	    if($vthe=="super hero")
		$amt1=$amt1+2499;
	    if($vthe=="winter")
		$amt1=$amt1+8999;
	    if($vthe=="pirate")
		$amt1=$amt1+9999;
			
		$q2="insert into venue values('$ll','$venue','$vthe','$amt1','$date','$time')";
        $q3=mysqli_query($con,$q2);
	    if($q3)
	    {
		
		$query="select amount from venue where v_id=(select max(v_id) from venue)";
	        $query_run=mysqli_query($con,$query);
			$info=mysqli_fetch_assoc($query_run);
	        $_SESSION['amt']="$info[amount]"+$l2;
			header('location:food.php');
	    }
	
    }	
	else
	{
	echo '<script type="text/javascript"> alert("Sorry venue already booked for today,please select any other venue or date") </script>';	
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
	padding:5px;
	color:black;
	margin:auto;
	width:435px;
	font-family:Arial;
	font-size:18px;
	
}
.iv
{
	width:430px;
	margin:0 auto;
	padding:5px;
	
	
}


.d5
{
    width:1500px;
	float:right;
	background:#f7f1e3; 
	padding:5px;
	font-family:Arial;
	margin:0 auto;
	height:380px;	
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
  float:below;
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
<body style="background-color:black">

<div class="top-container">
  <h1 style="font-family:bold">SELECT VENUE</h1>
  <br>
  </div>
  <br>
<div class="li">
  <img src="venue1.jpg" width="800" height="360" class="imag">
  <div class="overla">SILVER OAK(Rs 20000)</div>
</div>
<div class="li">
  <img src="venue2.jpg" width="800" height="360" class="imag">
  <div class="overla">EMPIRE YOLEE GRANDE(Rs 16000)</div>
</div>
<div class="li">
  <img src="venue3.jpg" width="800" height="360" class="imag">
  <div class="overla">JASMINE(Rs 17000)</div>
</div>
<div class="li">
  <img src="ven4.jpg" width="800" height="360" class="imag">
  <div class="overla">MORRIS(Rs 15000)</div>
</div>
<br>
<div class="li">
  <img src="venue5.jpg" width="800" height="360" class="imag">
  <div class="overla">GRAVITY(Rs 15000)</div>
</div>

 <div class="d5">
 <form action="venue.php" method="post" class="f4">
 <br>
 <br>
 select_venue:
 <select name="ven" class="inputvalues" required>
 
 
 <option value="silver oak">SILVER OAK(Rs 20000)</option>
 <option value="empire yolee grande">EMPIRE YOLEE GRANDE(Rs 17000)</option>
 <option value="jasmine">JASMINE(Rs 16000)</option>
 <option value="morris">MORRIS(Rs 15000)</option>
 <option value="gravity">GRAVITY(Rs 15000)</option>
 </select>
 <br>
 <br>
 venue_theme:
 <select name="them" class="inputvalues" required>
 
 
 <option value="carnival">carnival(1999)</option>
 <option value="movie night">movie night(2999)</option>
 <option value="fiesta">fiesta(3499)</option>
 <option value="sports">sports(3999)</option>
 <option value="animal">animal(3999)</option>
 <option value="super hero">super hero(2499)</option>
 <option value="winter">winter(8999)</option>
 <option value="pirate">pirate(9999)</option>
 </select>
 <br> <br>
 
 <label><b>date</b></label>
<br>
<input name="date" type="date"  class="iv" placeholder="select date of event" required/><br>
<br>

<label><b>time</b></label>
<br>
<input name="time" type="time"  class="iv" placeholder="Type time of event " required/><br>
<br>

 
<input name="next" type="submit" id="N" value="NEXT"/>
</form>
 </div>
 </body>
 </html>