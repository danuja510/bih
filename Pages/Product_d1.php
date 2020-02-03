<?php session_start();
if(!isset($_SESSION['pnum'])){
	header('location:../Home.php');} ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BackIssueHeaven</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../StyleSheets/HomeStyle.css"/>
<link rel="stylesheet" type="text/css" href="../StyleSheets/pd_StyleSheet.css" />
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
        <form id="form2" name="form2" method="post" action="Product_d1.php">
        
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
                <td class="main"><?php
				$pnum=$_SESSION['pnum'];
				$con = mysqli_connect("localhost","root","","bih");
				if(!$con)
				{
					die("Error while connecting to database");	
				}
				$sql="SELECT * FROM `products` WHERE `pnum` = ".$pnum.";";
				
				$rowSQL= mysqli_query( $con,$sql);
				$row = mysqli_fetch_array( $rowSQL );
				
				
				echo "
                <div class='pd cover'>
                	<img src='".$row['image']."' />
                </div>
                <div class='pd p_des'>
                	<h2>".$row['name']."</h2><br />
					<span><br /><b>Price</b>:  $ ".$row['price']."</span><br />
					<span><b>By</b>	 ".$row['franchise']."</span>
					";
					if($row['category']=='comic'){
						$sql2="SELECT * FROM `comics` WHERE `pnum` = ".$pnum.";";
						$rowSQL2= mysqli_query( $con,$sql2);
				$row2 = mysqli_fetch_array( $rowSQL2 );
                    echo "<h3>".$row2['description']."</h3>
                     <span><br /><b>Released Date</b>;	".$row2['release_date']." </span><br />
                    <span><b>Writer(s)</b> : ".$row2['author']."	</span><br /> <span><b>Artist(s)</b> :	".$row2['artist']." </span>
                </div><br />";
				}else if($row['category']=='action'){
					$sql2="SELECT * FROM `action_figures` WHERE `pnum` = ".$pnum.";";
						$rowSQL2= mysqli_query( $con,$sql2);
				$row2 = mysqli_fetch_array( $rowSQL2 );
				echo "<h3>".$row2['description']."</h3>
				<span><br /><b>Manufacturer</b>:	".$row2['manufacturer']." </span><br />";
					}else if($row['category']=='apperel'){
					$sql2="SELECT * FROM `apperel` WHERE `pnum` = ".$pnum.";";
						$rowSQL2= mysqli_query( $con,$sql2);
				$row2 = mysqli_fetch_array( $rowSQL2 );
				echo "<h3>".$row2['description']."</h3>
				<span><br /><b>Manufacturer</b>:	".$row2['manufacturer']." </span><br />";
					}
					                echo "<div class='action'>";
				if($row['available_qty']>0){
                	echo "<input type='submit' name='btncart' id='btncart' value='Add to Cart'>";
				}
				else{echo "<input type='submit' name='btnnotify' value='Notify When Available'>";
				}
                echo "<input type='submit' id='btnWishList' name='btnWishList' value='Add to WishList'>";
               echo" </div>";
				mysqli_close($con);?>
                </td>
                <td class="right side"><img src="../Images/426b384b1cbb9f60842f681a179bcf5a.jpg"</td>
            </tr>
        </table>
    </div>
    </form>
    <?php
		if(isset($_POST['btncart'])){
			if(!isset($_SESSION['cno'])){
				header('location:Sign_In.php');
				}else{
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$rowSQL4 = mysqli_query( $con,"SELECT MAX( cartno ) AS max FROM `cart`;" );
			$row4 = mysqli_fetch_array( $rowSQL4 );
			$max = $row4['max'];
			$cartno=$max+1;
					$sql3="INSERT INTO `cart` (`cartno`,`cno`, `pno`, `name`, `qty`, `price` , `tot_price`) VALUES ('".$cartno."','".$_SESSION['cno']."', '".$pnum."', '".$row['name']."', '1', '".$row['price']."', '".$row['price']."');";
					}
					mysqli_query($con,$sql3);
					mysqli_close($con);
					

					header('location:Cart.php');
			}
			if(isset($_POST['btnnotify'])){
				if(!isset($_SESSION['cno'])){
				header('location:Sign_In.php');
				}else{
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$rowSQL5 = mysqli_query( $con,"SELECT MAX( fno ) AS max FROM `feedback`;" );
					$row5 = mysqli_fetch_array( $rowSQL5 );
					$max = $row5['max'];
					$fno=$max+1;
					$sql="INSERT INTO `feedback` (`fno`, `cno`, `type`, `description`, `status`) VALUES ('".$fno."', '".$_SESSION['cno']."', 'Notify', '".$pnum."-".$row['name']."', 'Not Attended');";
					mysqli_query( $con,$sql);
					mysqli_close($con);
					header('location:../Home.php');
				}
			}
			if(isset($_POST['btnWishList'])){
				if(!isset($_SESSION['cno'])){
				header('location:Sign_In.php');
				}else{
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$rowSQL6 = mysqli_query( $con,"SELECT MAX( wno ) AS max FROM `wishlist`;" );
					$row6 = mysqli_fetch_array( $rowSQL6 );
					$max = $row6['max'];
					$wno=$max+1;
					$sql="INSERT INTO `wishlist` (`wno`, `cno`, `pno`, `name`) VALUES ('".$wno."', '".$_SESSION['cno']."', '".$pnum."', '".$row['name']."');";
					mysqli_query( $con,$sql);
					mysqli_close($con);
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
