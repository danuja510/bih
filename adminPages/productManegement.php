<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>productManegement</title>
</head>

<body>

	<table>
    <tr>
        <td>
        	<a href="addProduct.php">Add New Product</a>
        </td>
        <td>
            <table>
                <thead><th>Product No.</th><th>Name</th><th>Franchise</th><th>Category</th><th>Available Stocks</th></thead>
                <form id="form1" method="post" action="productManegement.php">
                <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `products`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
						echo "<tr>
							 <td>
								".$row['pnum']."
							 </td>
								<td>
								".$row['name']."
							 </td>
								<td>
								".$row['franchise']."
							 </td>
								<td>
								".$row['category']."
								</td>
								<td>
								".$row['available_qty']."
								</td>
								<td>
								<input type='submit' id='".$row['pnum']."' name='".$row['pnum']."' value='Edit'>
								</td>
						  </tr>";
						}
					mysqli_close($con);
                ?>
                </form>
            </table>
        </td>
    </tr>
    </table>
    <?php
					$con = mysqli_connect("localhost","root","","bih");
					if(!$con)
					{
						die("Error while connecting to database");	
					}
					$sql="SELECT * FROM `products`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
							if(isset($_POST[$row['pnum']])){
							$_SESSION['pnum']=$row['pnum'];
							header('Location:viewProduct.php');
							}
						}
					mysqli_close($con);
					
    ?>
</body>
</html>