<?php session_start();
if(!isset($_SESSION['cno'])){
	header('location:Sign_In.php');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BackIssueHeaven</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../StyleSheets/HomeStyle.css"/>
<link rel="stylesheet" type="text/css" href="../StyleSheets/cart_Style.css" />

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


function validateDOB()
{
	var date=document.getElementById("txtdate").value;
	if(date=="")
	{
		alert("Please Enter DOB");
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
	if (validateName() && valalidateEmail() && validatePassword() && validateConfirmPassword() && validateDOB())
	{
		//alert("Account updated");
	}
	else
	{
		event.preventDefault();
	}
}

</script>


</head>

<body>
<header>
        <a href="../Home.php"><img class="logo" src="../Icons/BIH.png"/></a>
  <ul class="A">
            <li><img src="../Icons/menu.png" />
                <ul>
                    <li><a href='Comics.php?category=comic'>Comics</a></li>
                    <li><a href='Comics.php?category=action'>Action Figures</a></li>
                    <li><a href='Comics.php?category=apperel'>Apperels</a></li>
                  <li><a href='Request.php'>Request an Item/ Questions</a></li>
                </ul>
            </li>
    </ul>
    <form id="form1" name="form1" method="post" action="search_r.php">
        <input type="text" id="txtSearch" name="txtSearch" placeholder="Search">
        <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <form id="form1" name="form1" method="post" action="Profile.php">
        
       
    <ul class="B">
       	<li><a href="Cart.php"><img src="../Icons/Cart.png"/></a>
            	<ul>
                	<li><a href="Cart.php">View Cart</a></li>
                    <li><a href="Checkout.php">Checkout</a></li>
                </ul>
            </li>
      <li><a href="Profile.php"><img src="../Icons/acc.png"></a>
            	<ul>
                	<li><a href="wishlist.php">WishList</a></li>
                    <li><a href="p_history.php">Purchase History</a></li>
                    <li><a href="logout.php">Log out</a></li>               
                </ul>
      </li>
  </ul>
</header>
    <div class="container">
        <table class="home">
            <tr>
                <td class="left side"><img src="../Images/superman-vs-batman-movie.jpg" /></td>
                <td class="main">
                <h1>Profile</h1><br /><br />
                <table class="Profile">
                	
                    <?php
					$cno=$_SESSION['cno'];
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$rowSQL= mysqli_query( $con,"SELECT * FROM `customers` WHERE `cno` = ".$cno.";");
					mysqli_close($con);
					$row = mysqli_fetch_array( $rowSQL );
					 
					if(isset($_POST['btnupdate'])){
			$name=$_POST['txtname'];
			$pass=$_POST['txtpass'];
			$email=$_POST['txtemail'];
			$dob=$_POST['txtdate'];
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}	
			$sql2="UPDATE `customers` SET `name` = '".$name."', `password` = '".$pass."', `dob` = '".$dob."', `email`= '".$email."' WHERE `customers`.`cno` = ".$cno.";";
			mysqli_query($con,$sql2);
			mysqli_close($con);
			header('location:Profile.php');
		}

					 
                    	echo "
						<tr>
						<th colspan='2'>
                        Hi! ".$row['name']."
                    	</th>
                    	
                    </tr>
                    <tr>
                    	<th>Name
                    	</th>
                    	<td><input type='text' id='txtname' name='txtname' value='".$row['name']."'>
                    	</td>
                    </tr>
                    <tr>
                    	<th>Bithday
                    	</th>
                    	<td><input type='date' id='txtdate' name='txtdate' value='".$row['dob']."'>
                    	</td>
                    </tr>
                    <tr>
                    	<th>E-MAIL
                    	</th>
                    	<td><input type='text' id='txtemail' name='txtemail' value='".$row['email']."'>
                    	</td>
                    </tr>
					<tr>
                    	<th>Password
                    	</th>
                    	<td><input type='password' id='txtpass' name='txtpass' value='".$row['password']."'>
                    	</td>
                    </tr>
					<th>Confirm Password
                    	</th>
                    	<td><input type='password' id='txtconpass' name='txtconpass' value='".$row['password']."'>
                    	</td>
                    </tr>"; ?>
                    
                    <tr>
                    	<td>
                    	</td>
                    	<td><a href="wishlist.php">WishList</a>
                    	</td>
                    </tr><tr>
                    	<td>
                    	</td>
                    	<td><a href="p_history.php">Purchase History</a>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                    	</td>
                    	<td><input type="submit" id="btnChange" name="btnupdate" id='btnupdate' value='Change Account Details' onclick="validate()">
                    	</td>
                    </tr>
                    </form>
                </table>
                </td>
                <td class="right side"><img src="../Images/426b384b1cbb9f60842f681a179bcf5a.jpg" /></td>
            </tr>
        </table>
    </div>
   
    <footer>
    <ul>
    	<li><a href="AboutUs.php">About Us</a></li>
        <li><a href="ContactUs.php">Contact Us</a></li>
        <li><a href="Privacy Policy.php">Privacy Policy</a></li>
        <li><a href="Terms and Conditions.php">Terms And Conditions</a></li>
    </ul>
    </footer>
</body>
</html>
