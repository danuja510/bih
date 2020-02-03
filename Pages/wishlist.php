<?php session_start();
if(!isset($_SESSION['cno'])){
	header('location:Sign_In.php');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BackIssueHeaven-wishlist</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../StyleSheets/HomeStyle.css"/>
<link rel="stylesheet" type="text/css" href="../StyleSheets/cart_Style.css">
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
        <form id="form2" name="form2" method="post" action="wishlist.php">
       
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
                <h1 align="center">WishList</h1><br /><br />
                <table>
						<tr>
							<th>Name</th><th></th>
						</tr>
                <?php
                $con = mysqli_connect("localhost","root","","bih");
				if(!$con)
				{
					die("Error while connecting to database");	
				}
				$sql="SELECT * FROM `wishlist` WHERE `cno` = '".$_SESSION['cno']."';";
				$rowSQL= mysqli_query( $con,$sql);
				while($row=mysqli_fetch_assoc( $rowSQL )){
					echo "<tr><td>".$row['name']."</td><td><input type='submit' id='".$row['wno']."' name='".$row['wno']."' value='Remove'></td></tr>
					";
				}
					?>
                    </form>
                    </table>
                </td>
                
                <td class="right side"><img src="../Images/426b384b1cbb9f60842f681a179bcf5a.jpg"</td>
            </tr>
        </table>
    </div>
    <?php
		$con = mysqli_connect("localhost","root","","bih");
		if(!$con)
		{
			die("Error while connecting to database");	
		}
		$sql="SELECT * FROM `wishlist` WHERE `cno` = '".$_SESSION['cno']."';";
		$rowSQL2= mysqli_query( $con,$sql);
		while($row2=mysqli_fetch_assoc( $rowSQL2 )){
			if(isset($_POST[$row2['wno']])){
				$sql4="DELETE FROM `wishlist` WHERE `wishlist`.`wno` = ".$row2['wno'].";";
				mysqli_query( $con,$sql4);
				header('location:wishlist.php');
				}
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
