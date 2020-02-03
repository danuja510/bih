<?php session_start();
 ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BackIssueHeaven</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="StyleSheets/HomeStyle.css"/>
</head>

<body>
<header>
        <a href="Home.php"><img class="logo" src="Icons/BIH.png"/></a>
  <ul class="A">
            <li><img src="Icons/menu.png" />
                <ul>
                    <li><a href='Pages/Comics.php?category=comic'>Comics</a></li>
                    <li><a href='Pages/Comics.php?category=action'>Action Figures</a></li>
                    <li><a href='Pages/Comics.php?category=apperel'>Apperels</a></li>
                  <li><a href='Pages/Request.php'>Request an Item/ Questions</a></li>
                </ul>
            </li>
    </ul>
        <form id="form1" name="form1" method="post" action="Pages/search_r.php">
        <input type="text" id="txtSearch" name="txtSearch" placeholder="Search">
        <button type="submit"><i class="fa fa-search"></i></button>
        </form>
       
    <ul class="B">
       	<li><a href="Pages/Cart.php"><img src="Icons/Cart.png"/></a>
            	<ul>
                	<li><a href="Pages/Cart.php">View Cart</a></li>
                    <li><a href="Pages/Checkout.php">Checkout</a></li>
                </ul>
            </li>
      <li><a href="Pages/Profile.php"><img src="Icons/acc.png"></a>
            	<ul>
                	<li><a href="Pages/wishlist.php">WishList</a></li>
                    <li><a href="Pages/p_history.php">Purchase History</a></li>
                    <li><a href="Pages/logout.php">Log out</a></li> 
               </ul>
      </li>
  </ul>
</header>
<form id="form2" name="form2" method="post" action="Home.php">
    <div class="container">
        <table class="home">
            <tr>
                <td class="left side"><img src="Images/superman-vs-batman-movie.jpg" /></td>
                <td class="main">
                	<table class="sub">
                      <tr>
                        <td>
                        <?php echo " 
                        <h2 style='margin-bottom:5px;'>New Releases</h2>";
						$con = mysqli_connect("localhost","root","","bih");
						if(!$con)
						{
							die("Error while connecting to database");	
						}
						$sql2="SELECT * FROM `products` ORDER BY `date_added` DESC";
						$rowSQL= mysqli_query( $con,$sql2);
						while($row=mysqli_fetch_assoc( $rowSQL )){
							echo "
						<div class='Item'>
                    	<img src='Pages/".$row['image']."'/>
                        <p>".$row['name']."</p>
                        <p>$ ".$row['price']."</p>
						<input type='submit' name='".$row['pnum']."' value='view'>";
						if($row['available_qty']==0){
							echo "<p style='color:red'>*Out of stock :-(</p>";}
						echo "
                   </div>
						";
						}
						mysqli_close($con);
							
                        
                  echo " </td>
                      </tr>
                      <tr>
                        <td>
                        <h2 style='margin-bottom:5px;'>Best Sellers</h2>";
                        
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT pno,sum(qty) AS sales FROM `orders` GROUP BY pno ORDER BY sales DESC";
					$rowSQL= mysqli_query( $con,$sql);
					
					while($row=mysqli_fetch_assoc( $rowSQL )){
						$rowSQL2 = mysqli_query( $con,"SELECT * FROM `products` where `pnum`=".$row['pno'].";" );
						$row2 = mysqli_fetch_array( $rowSQL2 );
						echo "
						<div class='Item'>
                    	<img src='Pages/".$row2['image']."'/>
                        <p>".$row2['name']."</p>
                        <p>$ ".$row2['price']."</p>
						<input type='submit' name='".$row2['pnum']."' value='view'>";
						if($row2['available_qty']==0){
							echo "<p style='color:red'>*Out of stock :-(</p>";}
						echo "
                   </div>
						";
						}
						mysqli_close($con);
						$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `products` ;";
					$rowSQL= mysqli_query( $con,$sql);
					mysqli_close($con);
					while($row=mysqli_fetch_assoc( $rowSQL )){
						if(isset($_POST[$row['pnum']])){
							$_SESSION["pnum"]=$row['pnum'];
							header('Location:Pages/Product_d1.php');
						}
						}
				?>
                    </td>
                      </tr>
                      </form>
                      <tr>
                        <td><h2 style="margin-bottom:5px;">Popular Franchizes</h2>
                        <div class="Item fanch"><a href="Pages/DC.php?franchise=DC">
                    	<img src="Images/DC_Logo_Blue_Final_573b356bd056a9.41641801.0.0.jpg"/>
                        
                        
                   </a> </div>
                   <div class="Item fanch"><a href="Pages/DC.php?franchise=MiddleEarth">
                    	<img src="Images/MiddleEarthEnterprises.png"/>
                        
                        
                    </a></div>
                    <div class="Item fanch"><a href="Pages/DC.php?franchise=Marvel">
                    	<img src="Images/Font-Marvel-Logo.jpg"/>
                        
                        
                   </a> </div>
                    <div class="Item fanch"><a href="Pages/DC.php?franchise=DragonBall">
                    	<img src="Images/dragon-ball-z-logo-rwpstr1389-medium-original-imaeemtgtspkwgj5.jpeg"/>
                        
                        
                   </a> </div>
                   </td>
                      </tr>
                    </table>

                </td>
                <td class="right side"><img src="Images/426b384b1cbb9f60842f681a179bcf5a.jpg"></td>
            </tr>
        </table>
    </div>
    
    <footer>
    <ul>
    	<li><a href="Pages/AboutUs.php">About Us</a></li>
        <li><a href="Pages/ContactUs.php">Contact Us</a></li>
        <li><a href="Pages/Privacy Policy.php">Privacy Policy</a></li>
        <li><a href="Pages/Terms and Conditions.php">Terms And Conditions</a></li>
    </ul>
    </footer>
</body>
</html>
