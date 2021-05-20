<?php
$con=mysqli_connect("localhost","root","","birthday");
if(!$con)
{
    die("unable to connect".mysqli_connect_error);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.ct{
	
	width:300px;
    margin:auto;
	background:url("bg.png");
	  background-repeat: no-repeat;
	padding:5px;
	height:250px;
	
}
#c
{
	margin:auto;
	width:294px;
}
.in
{	
	width:280px;
	margin:0 auto;
	padding:5px;
}
.accordion {
    background-color:#ff9ff3;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: 1px solid black;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

.active, .accordion:hover {
    background-color: #ccc; 
}

.panel {
    padding: 0 18px;
    display: none;
    background-color: white;
    overflow: hidden;
}
</style>
</head>
<body>

<h2>FREQUENTLY ASKED QUESTIONS</h2>

<button class="accordion">What is your Cancellation Policy</button>
<div class="panel">
  <p>The token advance you pay at the time of booking is non-refundable.</p>
</div>

<button class="accordion">What is the booking process</button>
<div class="panel">
  <p>Once you submit a booking,our manager schedules a call.After you are convinced with the us, you can book the service by paying the advance amount.</p>
</div>

<button class="accordion">Why us</button>
<div class="panel">
  <p>Because we are the best in market!</p>
</div>

<script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>
<br>

<h2><center>WE ARE HERE TO SERVE YOU BETTER</center></h2>
<br>
<center><h2><u>contact-form</u></h2></center>
<div class="ct">

<form action="faq.php" method="post" class="fff">

<label style="color:#eb4d4b;"><b>NAME</b></label>
<br>
<input name="nn" type="text" class="in" required/>
<br>
<br>

<label style="color:#eb4d4b;"><b>EMAIL</b></label>
<br>
<input name="ee" type="email" class="in" required/>
<br>
<br>

<label style="color:#eb4d4b;"><b>SUBJECT</b></label>
<br>
<input name="se" type="text" class="in" required/><br>
<br>
<br>
<input name="sm" type="submit" id="c" value="SEND A MESSAGE"/>


</form>

<?php

if(isset($_POST['sm']))
{	
$a=$_POST['nn'];
$b=$_POST['ee'];
$c=$_POST['se'];

		$query="insert into contact values('$a','$b','$c','')";
		$query_run=mysqli_query($con,$query);
		if($query_run)
		{
			echo '<script type="text/javascript"> alert("Thankyou! We will reply soon") </script>';
		}
		else
		{
			echo '<script type="text/javascript"> alert("Sorry!...we did not receive your message") </script>';
		}
		
}
?>
</div>
</body>
</html>
