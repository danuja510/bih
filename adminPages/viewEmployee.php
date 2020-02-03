<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}else if(!isset($_SESSION["empno"]))
{
	header('Location:empManenegemt.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>viewEmployee</title>

<script type="text/javascript">

function validateName()
{
	var name=document.getElementById("txtname").value;
	if(name=="")
	{
		alert("Please Enter Name");
		return false;
	}
	else
		return true;
}

function validatePassword()
{
	var pwd=document.getElementById("txtpass").value;
	if(pwd=="")
	{
		alert("Please enter the password");
		return false;
	}
	else
		return true;
}

function validateConfirmPassword()
{
	var pwd=document.getElementById("txtpass").value;
	var cpwd=document.getElementById("txtconpass").value;
	
	if((pwd!=cpwd)||(cpwd==""))
	{
		alert("Passwords do not match. Try again!");
		return false;
	}
	else
		return true;	
}

function validate()
{
	if (validateName() && validatePassword() && validateConfirmPassword())
	{
		alert("Registration Completed");
	}
	else
	{
		event.preventDefault();
	}
}

</script>


</head>

<body>
<form action='viewEmployee.php' id='viewemp' method='post'>
<?php 
	$empno=$_SESSION['empno'];
	$con = mysqli_connect("localhost","root","","bih");
	if(!$con)
	{
		die("Error while connecting to database");	
	}
	$sql="SELECT * FROM `employees` WHERE `emp_no` = ".$empno.";";
	$rowSQL= mysqli_query( $con,$sql);
	$row = mysqli_fetch_array( $rowSQL );
	echo "
		<table>
			<tr>
				<td><label for='txtname'>Name</label></td><td><input type='text' id='txtname' name='txtname' value='".$row['name']."'></td>
			</tr>
            <tr>
				<td><label for='txtpass'>Password</label></td><td><input type='password' id='txtpass' name='txtpass' value='".$row['password']."'></td>
			</tr>
            <tr>
				<td><label for='txtconpass'>Confirm Password</label></td><td><input type='password' id='txtconpass' name='txtconpass' value='".$row['password']."'></td>
			</tr>
				<tr><td></td><td><input type='submit' id='btnsubmit' name='btnsubmit' onclick = 'validate()'><input type='submit' name='btndelete' id='btndelete' value='Delete Employee'></td></tr>
		</table>";
	mysqli_close($con); 
	?>
</form>

<?php
		if(isset($_POST['btnsubmit'])){
			$name=$_POST['txtname'];
			$pass=$_POST['txtpass'];
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}	
			$sql2="UPDATE `employees` SET `name` = '".$name."', `password` = '".$pass."' WHERE `employees`.`emp_no` = ".$empno.";";
			mysqli_query($con,$sql2);
			mysqli_close($con);
			header('Location:empManenegemt.php');
		}
		if(isset($_POST['btndelete'])){
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}	
			$sql2="DELETE FROM `employees` WHERE `employees`.`emp_no` =".$empno.";";
			mysqli_query($con,$sql2);
			mysqli_close($con);
			header('Location:empManenegemt.php');
		}
?>
</body>
</html>