<?php
$con=mysqli_connect("localhost","root","","birthday");
if(!$con)
{
    die("unable to connect".mysqli_connect_error);
}
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
.top-container{
background-color:#333;
  padding: 20px;
  text-align: center;
  color:#e1b12c;
}

label{
color: #464646;
text-shadow: 0 1px 0 #fff;
font-size: 14px;
font-weight: bold;
}
.heading{
font-size: 17px;
}
.d5
{
    width:1500px;
	float:right;
	background:#f7f1e3; 
	padding:5px;
	font-family:Arial;
	margin:0 auto;
	height:1000px;	
}
.f4
{
	width:450px;
	margin:0 auto;
	
}


</style>


</head>

<body style="background-color:black">
<div class="top-container">
<h1 style="font-family:bold">SELECT FOOD</h1>
<br>
</div>
<br>

 <div class="d5">
 <form action="food.php" method="post" class="f4">
 <br>
 <br>
 <marquee style="font-family:Forte;font-size:16pt;color:BLACK;"> *******EACH IS RS 60 PER PLATE*******</marquee>
 <br>
<label class="heading">Select Main Course:</label><br>
<input type="checkbox" name="f[]" value="Shahi paneer"><label>Shahi paneer</label><br>
<input type="checkbox" name="f[]" value="Butter chicken"><label>Butter chicken</label><br>
<input type="checkbox" name="f[]" value="Fried rice"><label>Fried rice</label><br>
<input type="checkbox" name="f[]" value="Tandoori roti"><label>Tandoori roti</label><br>
<input type="checkbox" name="f[]" value="Naan"><label>Naan</label><br>
<input type="checkbox" name="f[]" value="Chole bhature"><label>Chole bhature</label><br>
<input type="checkbox" name="f[]" value="Dum aloo"><label>Dum aloo</label><br>
<input type="checkbox" name="f[]" value="Daal tadka"><label>Daal tadka</label><br>
<br>
<marquee style="font-family:Forte;font-size:16pt;color:BLACK;"> *******EACH IS RS 40 PER PLATE*******</marquee>
<br>

<label class="heading">Select Snacks:</label><br>
<input type="checkbox" name="c[]" value="Golgappa"><label>Golgappa</label><br>
<input type="checkbox" name="c[]" value="Samosa"><label>Samosa</label><br>
<input type="checkbox" name="c[]" value="Chowmein"><label>Chowmein</label><br>
<input type="checkbox" name="c[]" value="Milk shakes/Juices/Tea"><label>Milk shakes/Juices/Tea</label><br>
<input type="checkbox" name="c[]" value="Chicken wings"><label>Chicken wings</label><br>
<input type="checkbox" name="c[]" value="Pizza"><label>Pizza</label><br>
<input type="checkbox" name="c[]" value="Cheese balls"><label>Cheese balls</label><br>
<input type="checkbox" name="c[]" value="Pav bhaji"><label>Pav Bhaji</label><br>
<br>
<marquee style="font-family:Forte;font-size:16pt;color:BLACK;"> *******EACH IS RS 20 PER PLATE*******</marquee>
<br>
<label class="heading">Select Desserts:</label><br>
<input type="checkbox" name="t[]" value="Ice cream"><label>Ice cream</label><br>
<input type="checkbox" name="t[]" value="Khoya Kulfi"><label>Khoya kulfi</label><br>
<input type="checkbox" name="t[]" value="Shahi tukda"><label>Shahi tukda</label><br>
<input type="checkbox" name="t[]" value="Phirni"><label>Phirni</label><br>
<input type="checkbox" name="t[]" value="Gulabjamun/Rasgulla"><label>Gulabjamun/Rasgulla</label><br>
<input type="checkbox" name="t[]" value="Jalebi/Imarti"><label>Jalebi/Imarti</label><br>

<br>


<input name="confirm" type="submit" id="N" value="CONFIRM"/>
<br>
<br>
<input name="cancel" type="submit" id="N" value="CANCEL"/>

</form>
<?php

if(isset($_POST['confirm']))
{
	$l2=$_SESSION['amt'];
	 $cust=$_SESSION['xx'];
$ll=$_SESSION['yy'];
$c1=$_SESSION['yx'];
	$amt1=0;
	$b1="";
	$b2="";
	$b3="";
	$r1=0;
	$r2=0;
	$r3=0;
	$r1 = count($_POST['f']);
	$r2 = count($_POST['c']);
	$r3 = count($_POST['t']);
	
	if($r1>0)
	{
	$arr1=$_POST["f"];

	$amt1=$amt1+(60 * $r1);
	$b1=implode($arr1,",");
	}
	if($r2>0)
	{
	$arr2=$_POST["c"];
	
	$amt1=$amt1+(40 * $r2);
	$b2=implode($arr2,",");
	}
	if($r3>0)
	{
	$arr3=$_POST["t"];

	$amt1=$amt1+(20 * $r3);
	$b3=implode($arr3,",");
	}	
	$amt1=$amt1*$c1;
	if($amt1!=0)
	{
		
		
	$q2="insert into food values('$ll','$b1','$b2','$b3','$amt1')";
	 $q3=mysqli_query($con,$q2);
	
	 if($q3)
	{
		
		$query="select amount from food where f_id=(select max(f_id) from food)";
	        $query_run=mysqli_query($con,$query);
			$info=mysqli_fetch_assoc($query_run);
	        $_SESSION['amt']="$info[amount]"+$l2;
			$am=$_SESSION['amt'];
			
			$q2="insert into payment values('$cust','$ll','$am',NOW())";
	 $q3=mysqli_query($con,$q2);
		header('location:bil.php');
	
	}
        
    }
}	

if(isset($_POST['cancel']))
{
	$ll=$_SESSION['yy'];
	$q1="delete from booking where B_ID='$ll'"; 
	$q3=mysqli_query($con,$q1);
	if($q3)
	{
	echo '<script type="text/javascript"> alert("SEE YOU NEXT TIME ") </script>';	
	
	}
}
	
	


?>
</div>

</body>
</html>