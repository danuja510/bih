<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adminHome2</title>
</head>

<body>
    <div id="main" style=" height:auto; width:auto; " >
    	<a href="customerManegement.php"><div style="height:200px; border:1px solid black; width:200px;display:inline-block; float:left;">
        	<h2>Customer Manegment</h2>
        </div></a>
    <a href="productManegement.php"><div style="height:200px; border:1px solid black; width:200px;display:inline-block; float:left;">
        	<h2>Product Manegment</h2>
        </div></a>
    <a href="orderManegement.php"><div style="height:200px; border:1px solid black; width:200px;display:inline-block; float:left;">
        	<h2>Order Manegment</h2>
        </div></a>
        <a href="feedbackManegement.php"><div style="height:200px; border:1px solid black; width:200px;display:inline-block; float:left;">
        	<h2>Feedback Manegment</h2>
        </div></a>
        <?php 

		$con = mysqli_connect("localhost","root","","bih");
		if(!$con)
		{
			die("Error while connecting to database");	
		}
		$rowSQL = mysqli_query( $con,"SELECT `type` from `employees` WHERE `emp_no` = ".$_SESSION["eno"].";" );
		$row = mysqli_fetch_array( $rowSQL );
		if($row['type']=='Manager')
  { echo " <a href='empManenegemt.php'><div style='height:200px; border:1px solid black; width:200px;display:inline-block; float:left;'>
        	<h2>Employee Manegment</h2>
        </div></a>";}
		?>
    </div>
</body>
</html>