<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>adminHome</title>

<script type="text/javascript">

function validateEmpNo()
{
	var eno= document.getElementById("txtEmpNo").value;
	if(eno=="")
	{
		alert("Enter your Employee Number");
		return false;
	}
	else
		return true;
}

function validatePassword()
{
	var pwd=document.getElementById("txtPass").value;
	if(pwd=="")
	{
		alert("Enter the password");
		return false;
	}
	else
		return true;
}

function validate()
{
	if(validateEmpNo() && validatePassword())
		{}
	else
		event.preventDefault();
}

</script>


</head>

<body>
	<h1>Welcome</h1><table><tr><td><form action="adminHome.php" method="post" id="home">
	<label for="txtEmpNo">Employee No.</label></td></tr>
    <tr><td>
	<input type="text" id="txtEmpNo" name="txtEmpNo" /></td></tr>
    <tr><td>
    <label for="txtPassword">Password</label></td></tr>
    <tr><td>
	<input type="password" id="txtPass" name="txtPass" /></td></tr>
    <tr><td>
    <input type="submit" value="login" id="btnsubmit" name="btnsubmit" onclick ="validate()" />
    <input type="reset" value="reset" /></td></tr>
    </form>
    <?php 
	if(isset($_POST['btnsubmit'])){
		$eno=$_POST['txtEmpNo'];
		$pass=$_POST['txtPass'];
		$sql="SELECT * FROM `employees` WHERE `emp_no` = ".$eno." AND `password` LIKE '".$pass."';";
		$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}
			$result= mysqli_query($con,$sql);
			mysqli_close($con);
	if(mysqli_num_rows($result)>0){
		$_SESSION['eno']=$eno;
		header('Location:adminHome2.php');
		}else{
			echo "invalid credentials";}
		}
		
	?>
</body>
</html>