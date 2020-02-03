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
<script type= "text/javascript">
function validatePayment()
{
	var cash= document.getElementById("cash").checked;
	var card= document.getElementById("cc").checked;
	
	if(cash==true||card==true);
	else
	{
		alert("Please choose your payment method");
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
        <form id="form2" name="form2" method="post" action="Checkout.php">
        
        
       
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
                <table class="checkout">
                	<tr>
                    	<th>Name</th>
                        <th>Quantity</th>
                        <th>Price($)</th>
                    </tr>
                    <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `cart` WHERE `cno` = '".$_SESSION['cno']."';";
					$rowSQL= mysqli_query( $con,$sql);
					
					while($row=mysqli_fetch_assoc( $rowSQL )){
					
					$rowSQL2 = mysqli_query( $con,"SELECT * FROM `products` WHERE `pnum`=".$row['pno'].";" );
					$row2 = mysqli_fetch_array( $rowSQL2 );
                   echo" <tr>
                    	<td>".$row['name']."</td>
                        <td>".$row['qty']."</td>
                        <td>".$row['price']."</td>
						<td>".$row['tot_price']."</td>
                    </tr>";}
					$rowSQL3 = mysqli_query( $con,"SELECT SUM(tot_price) AS tot FROM `cart` WHERE `cno`=".$_SESSION['cno']."");
					$row3 = mysqli_fetch_array( $rowSQL3 );
			
                    echo "
					<tr></tr>
					<tr>
                    	<td></td>
						<td></td>
                        <td><b>Total</b></td>
                        <td>".round($row3['tot'],2)."</td>
                    </tr>";
					mysqli_close($con);
					?>
                    
                    <tr>
                    	<td></td>
                    	<td></td>
                        <td><br /><br />Payment Method</td>
                        <td align="left"><br /><br /><input type="radio" name="pmethod" id="cash" value='1' />Pay on Delivery<br /><input type="radio" name="pmethod" id="cc" value='2' />Credit/Debit Card</td>
                    </tr>
                    <tr>
                    	<td></td>
                    	<td></td>
                        <td></td>
                        <td><input type="submit" id="btnconfirm" name="btnconfirm" value="Confirm" onclick="validatePayment()"/></td>
                    </tr>
                </table>
                
                </form>
                </td>
                <td class="right side"><img src="../Images/426b384b1cbb9f60842f681a179bcf5a.jpg"</td>
            </tr>
        </table>
    </div>
    <?php
		if(isset($_POST['btnconfirm'])){
			if(isset($_POST['pmethod'])){
				if($_POST['pmethod']==1){
					$pmethod='Pay on Delivery';
					}else if($_POST['pmethod']==2){
						$pmethod='Credit/Debit Card';
						}
				}
			$con = mysqli_connect("localhost","root","","bih");
			if(!$con)
			{
				die("Error while connecting to database");	
			}
			$sql1="SELECT * FROM `cart` WHERE `cno` = '".$_SESSION['cno']."';";
			$rowSQL4= mysqli_query( $con,$sql1);
			while($row4=mysqli_fetch_assoc( $rowSQL4 )){
				$rowSQL5 = mysqli_query( $con,"SELECT MAX( onum ) AS max FROM `orders`;" );
				$row5 = mysqli_fetch_array( $rowSQL5 );
				$max2 = $row5['max'];
				$onum=$max2+1;
				$oc[]=$onum;
				$sql2="INSERT INTO `orders` (`onum`, `cno`, `name`, `date`, `qty`, `pno`, `tot_amnt`, `p_method`, `status`) VALUES ('".$onum."', '".$_SESSION['cno']."', '".$row4['name']."', '".date("Y/m/d")."', '".$row4['qty']."', '".$row4['pno']."', '".$row4['tot_price']."', '".$pmethod."', 'Order Placed');";
				mysqli_query( $con,$sql2);
				$rowSQL6 = mysqli_query( $con,"SELECT `available_qty` FROM `products` WHERE `pnum` = '".$row4['pno']."';" );
				$row6 = mysqli_fetch_array( $rowSQL6 );
				$a_qty = $row6['available_qty'];
				$a_qty-=$row4['qty'];
				mysqli_query( $con,"UPDATE `products` SET `available_qty` = '".$a_qty."' WHERE `products`.`pnum` = ".$row4['pno'].";");
			}
			$rowSQL4= mysqli_query( $con,$sql1);
			while($row4=mysqli_fetch_assoc( $rowSQL4 )){
				mysqli_query( $con,"DELETE FROM `cart` WHERE `cart`.`cartno` = ".$row4['cartno'].";");	
			}
			
			mysqli_close($con);
			$_SESSION['oc']=$oc;
			header('location:OrderCOnfirmation.php');
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
