<?php session_start();
if(!isset($_SESSION['cno'])){
	header('location:Sign_In.php');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BackIssueHeaven-Questions/Requests</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../StyleSheets/HomeStyle.css"/>
<link rel="stylesheet" type="text/css" href="../StyleSheets/cart_Style.css" />
<script type = "text/javascript">

function validateRequest()
{
	var req= document.getElementById("txtRequest").value;
	if (req=="")
	{
		alert("Please type the name of the item you want to request");
				event.preventDefault();
	}
	else{}
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
        <form id="form2" name="form2" method="post" action="Request.php">
        
       
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
                <td class="main"><h1>Requests/Questions</h1><br /><br />
                <table class="request"><tr>
                <td>
                <label for="type">Type</label>
                <select name="type" id="type">
                	<option value="_">_</option>
                	<option value="request">Request</option>
                    <option value="question">Question</option>
                    <option value="other">Other</option>
                </select>
                </td>
                	<td><label for="txtRequest">Description/Question</label><textarea id="txtRequest" name="txtRequest"></textarea></td>
                   <td> <input type="submit" name="btnsubmit" id="btnsubmit" value="Submit" onclick = "validateRequest()" /></td>
              </tr> </table> </form>
                </td>
                <td class="right side"><img src="../Images/426b384b1cbb9f60842f681a179bcf5a.jpg"</td>
            </tr>
        </table>
    </div>
    <?php
		if(isset($_POST['btnsubmit'])){
			$type=$_POST['type'];
			$description=$_POST['txtRequest'];
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}
			$rowSQL4 = mysqli_query( $con,"SELECT MAX( fno ) AS max FROM `feedback`;" );
			$row4 = mysqli_fetch_array( $rowSQL4 );
			$max = $row4['max'];
			$fno=$max+1;
			$sql="INSERT INTO `feedback` (`fno`, `cno`, `type`, `description`, `status`) VALUES ('".$fno."', '".$_SESSION['cno']."', '".$type."', '".$description."', 'Not Attended');";
			mysqli_query( $con,$sql);
			mysqli_close($con);
			header('location:../Home.php');
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
