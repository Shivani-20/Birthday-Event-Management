<?php
$con=mysqli_connect("localhost","root","","birthday");
if(!$con)
{
    die("unable to connect".mysqli_connect_error);
}
?>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color:#333">

<div class="top-container">
  <h1 style="font-family:bold">WELCOME TO BIRTHDAY EVENT CORP.</h1>
  </div>
  <br>
  <ul>
 <li><a href="org.php">BOOK EVENT</a></li>
 
  <li><a href="del.php">CANCEL EVENT</a></li>
   <li><a href="index.php">LOG OUT</a></li>
    <li><a href="faq.php">CONTACT US</a></li>
	 <li><a href="abt_us.php">ABOUT US</a></li>
</ul>
 <br>
 <img src="home.jpg" style="width:100%;height:600px;">
 <br>
 <br><br><br>
 <marquee  style="font-family:solid;font-size:20pt;color:white;">We help in making your child's birthday party memorable.</marquee>
 <br>
 <br>
 
</body>
</html>