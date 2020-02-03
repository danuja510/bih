<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>addEmployee</title>
<script type= "text/javascript">

function validateName()
{
	var name=document.getElementById("txtname").value;
	if(name=="")
	{
		alert("Enter the Name");
		return false;
	}
	else
		return true;
}

function checkPassword()
{
	var pwd=document.getElementById("txtpass").value;
	
	if(pwd=="")
	{
		alert("You have not typed a password");
		return false;
	}
	else
		return true;
}

function validatePassword()
{
	var pwd=document.getElementById("txtpass").value;
	var cpwd=document.getElementById("txtconpass").value;
	
	if(pwd!=cpwd)
	{
		alert("Passwords do not match");
		return false;
	}
	else
		return true;	
}

function validate()
{
	if(validateName() && checkPassword() && validatePassword())
		alert("New Employee added");
	else
		event.preventDefault;
}

</script>
</head>

<body>
	<form action="addEmployee.php" method="post" id="addEmployee">
    	<table>
        	<tr><td><label for="txtname">Name</label></td><td><input type="text" id="txtname" name="txtname"></td></tr>
            <tr><td><label for="txtpass">Password</label></td><td><input type="password" id="txtpass" name="txtpass"></td></tr>
            <tr><td><label for="txtconpass">Confirm Password</label></td><td><input type="password" id="txtconpass" name="txtconpass"></td></tr>
            <tr><td></td><td><input type="submit" id="btnsubmit" name="btnsubmit"onclick="validate()"><input type="reset" id="btnreset"></td></tr>
        </table>
    </form>
    <?php
		if(isset($_POST["btnsubmit"])){
			$name=$_POST["txtname"];
			$password=$_POST["txtpass"];
			
			$con=mysqli_connect("localhost","root","","bih");
			if(!con){
				die("Cannot connect to DB server");
			}
			$rowSQL = mysqli_query( $con,"SELECT MAX( emp_no ) AS max FROM `employees`;" );
			$row = mysqli_fetch_array( $rowSQL );
			$max = $row['max'];
			$eno=$max+1;
			$sql="INSERT INTO `employees` (`emp_no`, `type`, `name`, `password`) VALUES ('".$eno."', 'Regular', '".$name."', '".$password."');";
			mysqli_query($con,$sql);
			mysqli_close($con);
			header('Location:empManenegemt.php');
			}
	?>
</body>
</html>