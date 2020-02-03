<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}else if(!isset($_SESSION["cno"]))
{
	header('Location:customerManegement.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>viewCustomer</title>

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

function valalidateEmail()
{
	var email= document.getElementById("txtemail").value;
	var dot =  email.lastIndexOf('.');
	var at = email.indexOf('@');
	var len =email.length;
	
	if ((at<2)||(dot-at<2)||(len-dot<2))
	{
		alert("Please enter the correct email address");
		return false;}
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
	if (validateName() && valalidateEmail() && validatePassword() && validateConfirmPassword())
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
<form action='viewCustomer.php' id='viewemp' method='post'>
<?php 
	$cno=$_SESSION['cno'];
	$con = mysqli_connect("localhost","root","","bih");
	if(!$con)
	{
		die("Error while connecting to database");	
	}
	$sql="SELECT * FROM `customers` WHERE `cno` = ".$cno.";";
	$rowSQL= mysqli_query( $con,$sql);
	$row = mysqli_fetch_array( $rowSQL );
	echo "
		<table>
			<tr>
				<td><label for='txtname'>Name</label></td><td><input type='text' id='txtname' name='txtname' value='".$row['name']."'></td>
			</tr>
			<tr>
				<td><label for='txtemail'>Email</label></td><td><input type='text' id='txtemail' name='txtemail' value='".$row['email']."'></td>
			</tr>
            <tr>
				<td><label for='txtpass'>Password</label></td><td><input type='password' id='txtpass' name='txtpass' value='".$row['password']."'></td>
			</tr>
            <tr>
				<td><label for='txtconpass'>Confirm Password</label></td><td><input type='password' id='txtconpass' name='txtconpass' value='".$row['password']."'></td>
			</tr>
				<tr><td></td><td><input type='submit' id='btnsubmit' name='btnsubmit' onclick='validate()'><input type='submit' name='btndelete' id='btndelete' value='Delete Customer'></td></tr>
		</table>";
	mysqli_close($con); 
	?>
</form>

<?php
		if(isset($_POST['btnsubmit'])){
			$name=$_POST['txtname'];
			$pass=$_POST['txtpass'];
			$email=$_POST['txtemail'];
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}	
			$sql2="UPDATE `customers` SET `name` = '".$name."', `password` = '".$pass."', `email`='".$email."' WHERE `customers`.`cno` = ".$cno.";";
			mysqli_query($con,$sql2);
			mysqli_close($con);
			header('Location:customerManegement.php');
		}
		if(isset($_POST['btndelete'])){
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}	
			$sql3="DELETE FROM `customers` WHERE `customers`.`cno` =".$cno.";";
			mysqli_query($con,$sql3);
			mysqli_close($con);
			header('Location:customerManegement.php');
		}
?>
<h3>Orders Made</h3>
<table>
                <thead><th>Order No.</th><th>Name</th><th>Product No.</th><th>Quantity</th><th>Total Amount</th><th>Date</th><th>Payment Method</th><th>Status</th></thead>
                <form id="form1" method="post" action="orderManegement.php">
                <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `orders`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
						echo "<tr>
							 <td>
								".$row['onum']."
							 </td>
								<td>
								".$row['name']."
							 </td>
								<td>
								".$row['pno']."
								</td>
								<td>
								".$row['qty']."
								</td>
								<td>
								".$row['tot_amnt']."
								</td>
								<td>
								".$row['date']."
								</td>
								<td>
								".$row['p_method']."
								</td>
								<td>".$row['status']."</td>
								
						  </tr>";
						}
					mysqli_close($con);
                ?>
                </form>
            </table>
        </td>
    </tr>
    </table>
                
            </table>
        </td>
    </tr>
    </table>
</body>
</html>