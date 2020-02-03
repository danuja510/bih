<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign In</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../StyleSheets/HomeStyle.css"/>
<link rel="stylesheet" type="text/css" href="../StyleSheets/formStyle.css" />
<script type= "text/javascript">
function validateUname()
{
	var uname= document.getElementById("txtuname").value;
	var dot= uname.lastIndexOf('.');
	var at= uname.indexOf('@');
	var len= uname.length;
	
	if((at<2)||(dot-at<2)||(len-dot<2))
	{
		alert("Please enter a correct Email Address")
		return false;
	}
	else 
		return true;
}

function validatePassword()
{
	var pwd=document.getElementById("txtpassword").value;
	if(pwd=="")
	{
		alert("Please enter the password");
		return false();
	}
	else
		return true;
}

function validate()
{
	if(validateUname() && validatePassword())
		;
	else
		event.preventDefault();
			
}
</script>
</head>

<body>
<header>
        <a href="../Home.php"><img class="logo" src="../Icons/BIH.png"/></a>
  <ul class="A">
            <li><img src="../Icons/menu.png" />
                <ul>
                    <li><a href='Pages/Comics.php?category=comic'>Comics</a></li>
                    <li><a href='Pages/Comics.php?category=action'>Action Figures</a></li>
                    <li><a href='Pages/Comics.php?category=apperel'>Apperels</a></li>
                  <li><a href='Pages/Request.php'>Request an Item/ Questions</a></li>     
               </ul>
            </li>
    </ul>
    <form id="form1" name="form1" method="post" action="search_r.php">
        <input type="text" id="txtSearch" name="txtSearch" placeholder="Search">
        <button type="submit"><i class="fa fa-search"></i></button>
        </form>
        <form id="form2" name="form2" method="post" action="Sign_In.php">
        
       
    <ul class="B">
       	<li><a href="Cart.php"><img src="../Icons/Cart.png"/></a>
            	<ul>
                	<li><a href="Cart.php">View Cart</a></li>
                    <li><a href="Checkout.php">Checkout</a></li>
                </ul>
            </li>
      <li><a href="#"><img src="../Icons/acc.png"></a>
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
 <td class="main" align="center"><table align="center" width="411">
      <tr><td width="411" align="center">
      
       <div class="imgcontainer">
      <img src="../Icons/BIH.png" alt="Avatar" width="36%" height="159" class="avatar">
    </div>

    <div class="container2" align="center" >
      <p>
        <label for="txtuname"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="txtuname" id="txtuname" required>
        <br />
        <label for="txtpassword"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="txtpassword" id="txtpassword"required>
      </p>
      <p>
     
     
                  
      </p>
      <button type="submit" name="btnsubmit" name="btnsubmit" onclick="validate()" >Login</button>
      </form>
    </div>

    <div class="container2" style="background-color:#f1f1f1; height:50px;">
      <p>Not a Member?<a href="Register2.php"> Create an Account</a></p>
    </div>
    </td></tr></table>
                   </td>

                <td class="right side"><img src="../Images/426b384b1cbb9f60842f681a179bcf5a.jpg"</td>
            </tr>
      </table>
</div>
<?php
	  if(isset($_POST["btnsubmit"])){
	  	$email=$_POST["txtuname"];
		$pass=$_POST["txtpassword"];
		$sql="SELECT * FROM `customers` WHERE `email` LIKE '".$email."' AND `password` LIKE '".$pass."';";
		$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}
			$result= mysqli_query($con,$sql);
			mysqli_close($con);
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_array( $result );
		$cno = $row['cno'];
		$_SESSION['cno']=$cno;
		
			header('Location:../Home.php');	
		}else{
			echo"Invalid Username or Password";}
		
	  }
	  
	   ?>
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

