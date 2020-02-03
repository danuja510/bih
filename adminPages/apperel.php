<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}
else if(!isset($_SESSION["pno"]))
{
	header('Location:addProduct.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>addProduct-Apperel</title>
<script type="text/javascript">

function validateManufacturer()
{
	var man= document.getElementById("txtManufacturer").value;
	if(man=="")
	{
		alert("Add Manufacturer");
		return false;
	}
	else
		return true;
}

function checkDescription()
{
	var des= document.getElementById("txtdescription");
	if (des=="")
	{
		alert("Add Description");
		return false;
	}
	else
		return true;
}

function validate()
{
	if(validateManufacturer() && checkDescription())
		alert ("Apparel update completed");
	else
		event.preventDefault();
}

</script>

</head>

<body>
	<form method="post" action="apperel.php" id="apperel">
    	<table>
        	<tr><td><label for="txtManufacturer">Manufacturer</label></td><td><input type="text" id="txtManufacturer" name="txtManufacturer" /></td></tr>
            <tr><td><label for="txtdescription">Description</label></td><td><input type="text" id="txtdescription" name="txtdescription" /></td></tr>
            <tr><td></td><td><input type="submit" id="btnsubmit" name="btnsubmit" onclick="validate()"/><input type="reset" name="reset" /></td></tr>

        </table>
    </form>
    <?php
    	if(isset($_POST["btnsubmit"])){
			$manu=$_POST["txtManufacturer"];;
			$description=$_POST["txtdescription"];
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}
			$sql="INSERT INTO `apperel` (`pnum`, `description`, `manufacturer`) VALUES ('".$_SESSION["pno"]."', '".$description."', '".$manu."');";
			mysqli_query($con,$sql);
			mysqli_close($con);
			header('location:productManegement.php');
			}
	?>
</body>
</html>