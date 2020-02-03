<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../StyleSheets/HomeStyle.css"/>
<link rel="stylesheet" type="text/css" href="../StyleSheets/registerStyles.css">
<script type="text/javascript">
function validateName()
{
	var name = document.getElementById("txtFullName").value;
	if((name == "")||(name == null))
	{
		alert("Please enter your name");
		return false;
	}
	return true;
}
function validateNickName()
{
	var name = document.getElementById("txtNickName").value;
	if((name == "")||(name == null))
	{
		alert("Please enter a nick name");
		return false;
	}
	return true;
}
function validateEmail()
{
	var email = document.getElementById("txtEmail").value;
	var at = email.indexOf("@");
	var dt = email.lastIndexOf(".");
	var len = email.length;
	
	if((at < 2)||(dt-at < 2)||(len-dt < 2))
	{
		alert("Please enter a valid email address");
		return false;
	}
	return true;
}
function validatePassword()
{
	var pwd = document.getElementById("txtPassword").value;
	var cpwd = document.getElementById("txtConfirmPassword").value;
	if((pwd.length < 5)||( pwd != cpwd))
	{
		alert("Please enter a correct Password and enter the to Confirm password");
		return false;
	}
return true;
}
function validateContact()
{
	var cno = document.getElementById("txtContact").value;
	if((isNaN(cno))||(cno.length != 10))
	{
		alert("Please enter a valid contact number");
		return false;
	}
	return true;
}
function Validate()
{
	if(validateName()&& validateNickName()&& validateEmail()&&validatePassword() && validateContact())
	{
		alert("Registration is completed");
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
        <form id="register" name="register" method="post" action="Register2.php">
        
       
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
 <td class="main" align="center" >
                   
                   <img src="../Icons/BIH.png" alt="Avatar"  class="avatar"/> 
                   
                     <table width="600" border="0" cellpadding="6">
  <tr></tr>
  <tr>
    <td width="267"><label for="txtName">Name</label></td>
    <td width="717">
      <input type="text" name="txtName" id="txtName" /></td>
  </tr>
  
  <tr>
    <td><label for="dob">Birthday</label></td>
    <td><input type="date" name="dob" id="dob"></td>
  </tr>
  <tr>
    <td><label for="txtEmail">Email</label></td>
    <td>
      <input type="text" name="txtEmail" id="txtEmail" /></td>
  </tr>
  <tr>
    <td><label for="txtPassword">Password</label></td>
    <td>
      <input type="password" name="txtPassword" id="txtPassword" /></td>
  </tr>
  <tr>
    <td><label for="txtConfirmPassword">Confirm Password</label></td>
    <td>
      <input type="password" name="txtConfirmPassword" id="txtConfirmPassword" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="btnSubmit" id="btnSubmit" value="Register" onclick= "validate()" />   <input type="reset" name="btnReset" id="btnReset" value="Reset" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>By creating an account, you verify that you are at least 13 years of age, and have read and agree to the PopCulture.com <a href="https://popculture.com/page/termsofservice">Terms of Service</a> and <a href="https://popculture.com/page/privacy">Privacy Policy</a></td>
  </tr>
                     </table>
                   
                  
                  
                  
                   </td>

                <td class="right side"><img src="../Images/426b384b1cbb9f60842f681a179bcf5a.jpg" /></td>
            </tr>
      </table>
</div></form>
<?php
	if(isset($_POST['btnSubmit'])){
		$name=$_POST['txtName'];
		$dob=$_POST['dob'];
		$email=$_POST['txtEmail'];
		$pass=$_POST['txtPassword'];
		$con = mysqli_connect("localhost","root","","bih");
		if(!$con)
		{
			die("Error while connecting to database");	
		}
		$rowSQL = mysqli_query( $con,"SELECT MAX( cno ) AS max FROM `customers`;" );
			$row = mysqli_fetch_array( $rowSQL );
			$max = $row['max'];
			$cno=$max+1;
		$sql="INSERT INTO `customers` (`cno`, `email`, `name`, `dob`, `password`) VALUES ('".$cno."', '".$email."', '".$name."', '".$dob."', '".$pass."');";
		mysqli_query($con,$sql);
		mysqli_close($con);
		header('Location:Sign_In.php');
		}?>
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
