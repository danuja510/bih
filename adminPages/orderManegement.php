<?php session_start();
if(!isset($_SESSION["eno"]))
{
	header('Location:adminHome.php');
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>orderManegement</title>
</head>

<body>
<table>
                <thead><th>Order No.</th><th>Name</th><th>Customer No.</th><th>Product No.</th><th>Quantity</th><th>Total Amount</th><th>Date</th><th>Payment Method</th><th>Status</th></thead>
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
								".$row['cno']."
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
								<td><select name='status".$row['onum']."' name='status".$row['onum']."'>
									<option value='".$row['status']."'>".$row['status']."</option>
									<option value='Order Placed'>Order Placed</option>
									<option value='Prepared for Shipment'>Prepared for Shipment</option>
									<option value='Dispatched'>Dispatched</option>
								</td>
								<td>
								<input type='submit' id='".$row['onum']."' name='".$row['onum']."' value='Change Status'>
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
					$sql="SELECT * FROM `orders`;";
					$rowSQL= mysqli_query( $con,$sql);
					while($row=mysqli_fetch_assoc( $rowSQL )){
							if(isset($_POST[$row['onum']])){
							$sql2="UPDATE `orders` SET `status` = '".$_POST['status'.$row['onum']]."' WHERE `orders`.`onum` = ".$row['onum'].";";
							mysqli_query( $con,$sql2);
							header('Location:orderManegement.php');
							}
						}
					mysqli_close($con);
					
					
    ?>
</body>
</html>